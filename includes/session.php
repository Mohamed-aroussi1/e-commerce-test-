<?php
// Start the session
session_start();

// Generate a unique session ID for guest users
if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = session_id();
}

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>
