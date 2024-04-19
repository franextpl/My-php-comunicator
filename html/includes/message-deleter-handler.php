<?php
session_start();

    $chatid = $_POST["chatid"];
    $messageid=$_POST["messageid"];
    echo $chatid;
    echo $messageid;

    require_once "./dbh.inc.php";

    $tableid = 'm'. $chatid;


    try {
        $querry2 = "DELETE FROM $tableid where lp='$messageid';";
        $stmt2 = $pdo->prepare($querry2);
        $stmt2->execute();


        echo "<script>location.href='../lista-czatow.php';</script>";
        die();
    } catch (PDOException $e) {
        die("Querry falied" . $e->getMessage());
    }

?>