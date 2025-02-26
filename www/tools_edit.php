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

try {
    // Haal alle gebruikers op uit de database
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Haal de resultaten op als een associatieve array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Something went wrong: " . $e->getMessage();
    exit;
}

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
            <label for="category">Categorie:</label>
            <input type="text" name="category" id="category">
        </div>
        <div>
            <label for="price"></label>
            <input type="number" name="price" id="price">
        </div>
        <div>
            <label for="brand">Merk:</label>
            <select name="brand" id="brand">
                <?php foreach ($brands as $brand):?>
                    <option value="<?php echo $brand['brand_id'] ?>"><?php echo $brand['brand_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="image">Afbeelding:</label>
            <input type="text" name="image" id="image">
        </div>
    </div>
</main>
<?php require 'footer.php' ?>