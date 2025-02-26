<?php

session_start();

require 'database.php';


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

//check if all fields are filled in
if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['role']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['backgroundColor']) || empty($_POST['font'])) {
    echo "Please fill in all fields";
    exit;
}

$email = $_POST['email'];
$wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$address = $_POST['address'];
$city = $_POST['city'];
$is_active = 1;

try {
    // Insert into the users table
    $sql = "INSERT INTO users (email, password, firstname, lastname, role, address, city, is_active) VALUES (:email, :password, :firstname, :lastname, :role, :address, :city, :is_active)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':email'=> $email,
        ':password'=> $password,
        ':firstname'=> $firstname,
        ':lastname'=> $lastname,
        ':role'=> $role,
        ':address'=> $address,
        ':city'=> $city,
        ':is_active'=> $is_active, PDO::PARAM_INT
    ]);


    // Get the last inserted user ID
    $user_id = $conn->lastInsertId();

    // Insert into the user_settings table
    $backgroundColor = $_POST['backgroundColor'];
    $font = $_POST['font'];
    $sql = "INSERT INTO user_settings (user_id, backgroundColor, font) VALUES (:user_id, :backgroundColor, :font)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':backgroundColor', $backgroundColor);
    $stmt->bindParam(':font', $font);

    $stmt->execute();

    // Redirect if everything is successful
    header("Location: users_index.php");
    exit;
} catch (PDOException $e) {
    echo "Something went wrong: " . $e->getMessage();
    exit;
}

echo "Something went wrong";
