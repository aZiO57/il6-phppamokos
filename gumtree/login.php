<?php

$email = $_POST['email'];
$userPassword = ($_POST['password']);

$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'auto_minusas';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = ' SELECT * FROM users WHERE email ="' . $email . '" AND password ="' . $userPassword . '"';
echo $sql;
$rez = $conn->query($sql);
$user = $rez->fetchAll();

if (!empty($user)) {
    // login
} else {
    echo 'Check your login information';
}