<?php $id = $_GET['id'];
$status = $_GET['status'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'kontrolinis';

try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbName, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $sql = 'UPDATE forms SET status ="' . $_GET['status'] . '" WHERE id=' . $_GET['id'];

    $conn->query($sql);
    header('Location: http://localhost/pamokos/kontrolinis/forms.php');
}
