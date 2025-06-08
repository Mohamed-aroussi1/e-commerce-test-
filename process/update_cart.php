<?php
require_once '../includes/session.php';
require_once '../includes/cart_functions.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("POST request received in update_cart.php");
    error_log("POST data: " . print_r($_POST, true));

    // Update cart item
    if (isset($_POST['update'])) {
        $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        error_log("Update cart item: cart_id=$cart_id, quantity=$quantity");

        if ($cart_id > 0) {
            if (updateCartItem($cart_id, $quantity)) {
                $_SESSION['success'] = "Cart updated successfully.";
                error_log("Cart updated successfully");
            } else {
                $_SESSION['error'] = "Failed to update cart.";
                error_log("Failed to update cart");
            }
        }
    }

    // Remove cart item
    if (isset($_POST['remove'])) {
        $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;

        error_log("Remove cart item: cart_id=$cart_id");

        if ($cart_id > 0) {
            if (removeCartItem($cart_id)) {
                $_SESSION['success'] = "Item removed from cart.";
                error_log("Item removed from cart successfully");
            } else {
                $_SESSION['error'] = "Failed to remove item from cart.";
                error_log("Failed to remove item from cart");
            }
        }
    }

    // Clear cart
    if (isset($_POST['clear'])) {
        error_log("Clear cart request received");

        // Force clear cart
        $result = clearCart();
        error_log("clearCart() result: " . ($result ? "true" : "false"));

        if ($result) {
            $_SESSION['success'] = "Cart cleared successfully.";
            error_log("Cart cleared successfully");
        } else {
            $_SESSION['error'] = "Failed to clear cart.";
            error_log("Failed to clear cart");
        }
    }

    // Redirect back to referring page or cart page
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../cart.php';
    header("Location: $redirect");
    exit;
} else {
    // If not POST request, redirect to cart page
    header("Location: ../cart.php");
    exit;
}
?>
