<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $emailForm = $_POST['email'];
            $passwordForm = $_POST['password'];

            try {
                $conn = new PDO('mysql:host=mariadb;dbname=tools4ever', 'root', 'password');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Zorg ervoor dat PDO fouten goed behandelt
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit;
            }

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $emailForm);
            $stmt->execute();

            //als de email bestaat dan is het resultaat groter dan 0
            if ($stmt->rowCount() > 0) {

                //resultaat gevonden? Dan maken we een user-array $dbuser
                $dbuser = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($dbuser['password'] == $passwordForm) {

                    session_start();
                    $_SESSION['user_id']    = $dbuser['id'];
                    $_SESSION['email']      = $dbuser['email'];
                    $_SESSION['firstname']  = $dbuser['firstname'];
                    $_SESSION['lastname']   = $dbuser['lastname'];
                    $_SESSION['role']       = $dbuser['role'];

                    // echo "You are logged in";
                    header("Location: dashboard.php");
                    exit;
                } else {
                    include 'header.php';
                    $_GET['message'] = 'wrongpassword';
                    include 'login-message.php';
                    include 'footer.php';
                    exit;
                }
            } else {
                include 'header.php';
                $_GET['message'] = 'usernotfound';
                include 'login-message.php';
                include 'footer.php';
                exit;
            }
        }
    }
}

include 'footer.php';
