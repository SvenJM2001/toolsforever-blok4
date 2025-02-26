<?php

if($_SERVER["REQUEST_METHOD"] != "GET"){
    echo "Huh? Wat doe je?";
    exit;
}


if(    isset($_GET['id'])     ){

    require 'database.php';

    $id = $_GET["id"];

    try {
        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: users_index.php");
        exit;

    } catch (PDOException $e) {
        // Foutafhandeling
        echo "Something went wrong: " . $e->getMessage();
        exit;
    }
}