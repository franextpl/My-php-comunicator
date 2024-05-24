<?php
$dsn="mysql:host=localhost;dbname=strona";
$dbusername = "root";
$dbpassword = "root";

try {
    $pdo = new PDO($dsn,$dbusername,$dbpassword); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conection falied: " . $e->getMessage();

}
?>