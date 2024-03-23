<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username2 = $_POST["username-2"];
    $message = $_POST["message"];
    $chatId = 'm' . $_SESSION['selCht'];


    try {
        require_once "dbh.inc.php";

        $querry = "INSERT INTO $chatId(name, message_content) VALUES(?, ?);";
        $stmt = $pdo->prepare($querry);
        $stmt->execute([$username2, $message]);

        header ("Location: ../strona.php");
        die();
    } catch (PDOException $e) {
        die("Querry falied" . $e->getMessage());
    }

} else {
    header ("Location: ../strona.php");
}

?>