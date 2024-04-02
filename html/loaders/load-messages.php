<?php
session_start();

require_once "../includes/dbh.inc.php";
$chatId = 'm' . $_SESSION['selCht'];

$querry = "SELECT * FROM $chatId;";
$stmt = $pdo->prepare($querry);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<?php

if (empty($results)){
    echo '<p> no messsages yet </p>';
}
else{
    foreach($results as $row){
        echo "<div class=msgHoldBox>";
        echo "<p4>" . htmlspecialchars($row["name"]) . "</p4>" . ":";
        echo "<p5>" . htmlspecialchars($row["message_content"]) . "</p5>" . "<br>";
        if (isset($row["file_name"])){
            echo '<img class="sentImage" style="max-width: 50%; max-height: 100px;" src="./uploads/'.$row["file_name"] .'" alt="'.$row["file_name"].'">';

        }
        echo "</div>";
    }
}
?>
