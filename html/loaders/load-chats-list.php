<?php
session_start();

require_once "../includes/dbh.inc.php";

$querry = "SELECT * FROM chats;";
$stmt = $pdo->prepare($querry);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php

if (empty($results)){
    echo '<p> no chats yet </p>';
}
else{
    foreach($results as $row){
        echo "<div class=chatNameHoldBox>";
        echo "<p4 style='color:white;' >" . htmlspecialchars($row["lp"]) . "</p4>"."<br>";
        echo "<p5>" . htmlspecialchars($row["chat_name"]) . "</p5>";
        echo "<form action='../strona.php' method='post'>"."<input type='hidden' id='lp-war' name='lp-war' value=".$row["lp"].">"."<input type='hidden' id='name-war' name='name-war' value=".$row["chat_name"].">" . "<input type='submit' name='button1'  class='button' value='przejdz do czatu' />" .   "</form>";
        echo "</div>";
    }
}
?>
<script>

    element.scrollTop = element.scrollHeight;

</script>
