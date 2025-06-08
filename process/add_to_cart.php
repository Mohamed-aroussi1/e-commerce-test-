<?php
require_once '../includes/session.php';
require_once '../includes/cart_functions.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product ID and quantity
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    // Validate inputs
    if ($product_id <= 0 || $quantity <= 0) {
        $_SESSION['error'] = "Invalid product or quantity.";
        header("Location: ../index.php");
        exit;
    }
    
    // Add to cart
    if (addToCart($product_id, $quantity)) {
        $_SESSION['success'] = "Product added to cart successfully.";
    } else {
        $_SESSION['error'] = "Failed to add product to cart.";
    }
    
    // Redirect back to referring page or home
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
    header("Location: $redirect");
    exit;
} else {
    // If not POST request, redirect to home
    header("Location: ../index.php");
    exit;
}
?>
