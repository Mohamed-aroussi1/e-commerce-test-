<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Get all products
 *
 * @param string $category Optional category filter
 * @return array Array of products
 */
function getAllProducts($category = null) {
    global $conn;

    $query = "SELECT * FROM products";

    if ($category) {
        $query .= " WHERE category = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $category);
    } else {
        $stmt = mysqli_prepare($conn, $query);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}

/**
 * Get a single product by ID
 *
 * @param int $product_id The ID of the product
 * @return array|bool Product details or false if not found
 */
function getProductById($product_id) {
    global $conn;

    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return false;
}

/**
 * Get featured products
 *
 * @param int $limit Number of products to return
 * @return array Array of featured products
 */
function getFeaturedProducts($limit = 4) {
    global $conn;

    $query = "SELECT * FROM products ORDER BY RAND() LIMIT ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
?>
