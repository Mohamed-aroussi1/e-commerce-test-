<?php
require_once 'session.php';
require_once __DIR__ . '/../config/database.php';

/**
 * Add a product to the cart
 *
 * @param int $product_id The ID of the product to add
 * @param int $quantity The quantity to add (default: 1)
 * @return bool True if successful, false otherwise
 */
function addToCart($product_id, $quantity = 1) {
    global $conn;

    // Validate product exists
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        return false; // Product not found
    }

    $product = mysqli_fetch_assoc($result);

    // Check if product is already in cart
    $session_id = $_SESSION['session_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    $query = "SELECT * FROM cart WHERE session_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $session_id, $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Update quantity if product already in cart
        $cart_item = mysqli_fetch_assoc($result);
        $new_quantity = $cart_item['quantity'] + $quantity;

        $query = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $cart_item['id']);
        return mysqli_stmt_execute($stmt);
    } else {
        // Add new product to cart
        $query = "INSERT INTO cart (user_id, session_id, product_id, quantity) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "isii", $user_id, $session_id, $product_id, $quantity);
        return mysqli_stmt_execute($stmt);
    }
}

/**
 * Get all items in the cart
 *
 * @return array Array of cart items with product details
 */
function getCartItems() {
    global $conn;

    $session_id = $_SESSION['session_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    $query = "SELECT c.id as cart_id, c.quantity, p.*
              FROM cart c
              JOIN products p ON c.product_id = p.id
              WHERE c.session_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $cart_items = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = $row;
    }

    return $cart_items;
}

/**
 * Update the quantity of a cart item
 *
 * @param int $cart_id The ID of the cart item
 * @param int $quantity The new quantity
 * @return bool True if successful, false otherwise
 */
function updateCartItem($cart_id, $quantity) {
    global $conn;

    if ($quantity <= 0) {
        return removeCartItem($cart_id);
    }

    $query = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $quantity, $cart_id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Remove an item from the cart
 *
 * @param int $cart_id The ID of the cart item to remove
 * @return bool True if successful, false otherwise
 */
function removeCartItem($cart_id) {
    global $conn;

    $query = "DELETE FROM cart WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cart_id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Get the total number of items in the cart
 *
 * @return int The total number of items
 */
function getCartItemCount() {
    global $conn;

    $session_id = $_SESSION['session_id'];

    $query = "SELECT SUM(quantity) as total FROM cart WHERE session_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    return $row['total'] ? $row['total'] : 0;
}

/**
 * Get the total price of all items in the cart
 *
 * @return float The total price
 */
function getCartTotal() {
    global $conn;

    $session_id = $_SESSION['session_id'];

    $query = "SELECT SUM(c.quantity * p.price) as total
              FROM cart c
              JOIN products p ON c.product_id = p.id
              WHERE c.session_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    return $row['total'] ? $row['total'] : 0;
}

/**
 * Clear all items from the cart
 *
 * @return bool True if successful, false otherwise
 */
function clearCart() {
    global $conn;

    if (!isset($_SESSION['session_id'])) {
        error_log("Session ID not set in clearCart()");
        return false;
    }

    $session_id = $_SESSION['session_id'];
    error_log("Clearing cart for session ID: " . $session_id);

    $query = "DELETE FROM cart WHERE session_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        error_log("Failed to prepare statement in clearCart(): " . mysqli_error($conn));
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $session_id);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        error_log("Failed to execute statement in clearCart(): " . mysqli_stmt_error($stmt));
        return false;
    }

    error_log("Cart cleared successfully. Affected rows: " . mysqli_stmt_affected_rows($stmt));
    return true;
}
?>
