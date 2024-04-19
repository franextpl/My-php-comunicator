<?php
session_start();

    $chatid = $_POST["chatid"];
    echo 'test';


    require_once "./dbh.inc.php";

    $querry1 = "DELETE FROM chats WHERE lp=?;";
    $stmt1 = $pdo->prepare($querry1);
    $stmt1->execute([$chatid]);

    $tableid = 'm'. $chatid;
 
    echo $chatid;


    try {
       



        $querry2 = "DROP TABLE $tableid";
        $stmt2 = $pdo->prepare($querry2);
        $stmt2->execute();


        echo "<script>location.href='../lista-czatow.php';</script>";
        die();
    } catch (PDOException $e) {
        die("Querry falied" . $e->getMessage());
    }

?>