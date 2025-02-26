<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}
require 'database.php';

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'header.php';
?>
<main>
    <div class="container">
        <form action="" method=""></form>
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="category"></label>
            <input type="text" name="">
        </div>
        <div>
            <label for="price"></label>
        </div>
        <div>
            <label for="brand"></label>
            <select name="brand" id=""></select>
        </div>
    </div>
</main>
<?php require 'footer.php' ?>