<?php
require_once '../includes/session.php';
require_once '../includes/cart_functions.php';

// Check if cart_id is provided
if (isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']);
    
    // Remove item from cart
    if (removeCartItem($cart_id)) {
        $_SESSION['success'] = "Item removed from cart successfully.";
    } else {
        $_SESSION['error'] = "Failed to remove item from cart.";
    }
    
    // Redirect back to referring page or home
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
    header("Location: $redirect");
    exit;
} else {
    // If cart_id is not provided, redirect to home
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../index.php");
    exit;
}
?>
