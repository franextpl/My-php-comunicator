<?php
session_start();

    $chatName = $_POST["chatName"];


    require_once "./dbh.inc.php";

    $querry1 = "INSERT INTO chats(chat_name) VALUES(?);";
    $stmt1 = $pdo->prepare($querry1);
    $stmt1->execute([$chatName]);


    $querry = "SELECT lp FROM chats ORDER BY lp DESC LIMIT 1";
    $stmt = $pdo->prepare($querry);
    $stmt->execute();


    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    foreach($results as $row){
        $chatId = 'm' . $row["lp"];


    }



    try {
       



        $querry2 = "CREATE TABLE $chatId(lp int AUTO_INCREMENT, name varchar(20) NOT NULL, message_content varchar(2048) NOT NULL, file_name varchar (255),PRIMARY KEY (lp));";
        $stmt2 = $pdo->prepare($querry2);
        $stmt2->execute();


        echo "<script>location.href='../lista-czatow.php';</script>";
        die();
    } catch (PDOException $e) {
        die("Querry falied" . $e->getMessage());
    }

?>