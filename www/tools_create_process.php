<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}

if ($_SESSION['role'] != 'administrator') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}

//check method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "You are not allowed to view this page";
    exit;
}
require 'database.php';

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$brand = $_POST['brand'];
$image = $_POST['image'];


try {
    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO tools (tool_name, tool_category, tool_price, tool_brand, tool_image) 
            VALUES (:name, :category, :price, :brand, :image)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters to the placeholders
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':image', $image);
    
    // Execute the statement
    $stmt->execute();

    // Redirect to the tool index page if successful
    header("Location: tool_index.php");
    exit;

} catch (PDOException $e) {
    // Handle any errors
    echo "Something went wrong: " . $e->getMessage();
    exit;
}

echo "Something went wrong";
