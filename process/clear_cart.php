<?php
// Include required files
require_once '../includes/session.php';
require_once '../config/database.php';

// Log the request
error_log("Clear cart request received in clear_cart.php");

// Function to clear cart directly (not using cart_functions.php)
function directClearCart() {
    global $conn;
    
    if (!isset($_SESSION['session_id'])) {
        error_log("Session ID not set in directClearCart()");
        return false;
    }
    
    $session_id = $_SESSION['session_id'];
    error_log("Clearing cart for session ID: " . $session_id);
    
    // Direct SQL query to clear cart
    $query = "DELETE FROM cart WHERE session_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        error_log("Failed to prepare statement in directClearCart(): " . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        error_log("Failed to execute statement in directClearCart(): " . mysqli_stmt_error($stmt));
        return false;
    }
    
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    error_log("Cart cleared successfully. Affected rows: " . $affected_rows);
    
    return $affected_rows >= 0; // Return true even if no rows were affected (empty cart)
}

// Clear the cart
if (directClearCart()) {
    $_SESSION['success'] = "Cart cleared successfully.";
    error_log("Cart cleared successfully");
} else {
    $_SESSION['error'] = "Failed to clear cart.";
    error_log("Failed to clear cart");
}

// Redirect back to referring page or index page
$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect");
exit;
?>
