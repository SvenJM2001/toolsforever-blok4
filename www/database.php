<?php

//database connection   
$dbhost = "mariadb";
$dbuser = "root";
$dbpass = "password";
$dbname = "tools4ever";

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);


