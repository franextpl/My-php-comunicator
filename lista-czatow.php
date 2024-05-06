<?php
session_start();

require_once "./includes/dbh.inc.php";

$querry = "SELECT * FROM chats;";
$stmt = $pdo->prepare($querry);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>super-chat lista czatów</title>
    <link rel="stylesheet" href="./styles/style-czaty.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            console.log('strona się załadowała');

        setInterval(codingCourse, 1000);
            function codingCourse() {
            
                $("#msgVievhold").load("./loaders/load-chats-list.php");
            }   
        });

    </script>
</head>





<div class="mainDiv">
         
 
         <div class="contentHolder">
             <div class="topText">
                 <div class="topTextChild">
                     <h1>
                         Super chat
                     </h1>
                     <p1>
                         Witaj to jest lista czatów
                     </p1>
                 </div>
                 <div class="topUsername">

    <?php
    if (isset($_POST["logOutSig"])){
        unset ($_SESSION['username']);
    }

    if (($_POST['username']!=null)) {

        $_SESSION['username'] = $_POST['username'];


    }
    if ($_SESSION['username']!=null){
        echo $_SESSION['username'];
        echo '<br> <form action="./lista-czatow.php" method="post">
        <input type="hidden" name="logOutSig" value=test >

        <input type="submit" value="wyloguj">
        </form>';

    }
    else{
    echo '<form action="./lista-czatow.php" method="post"> 
        <input type="text" name="username"><br>
        <input type="submit" value="zaloguj">
        </form>';
    }

    ?>

    </div>
    <div class="logOut">
    </div>



            </div>
                 <div class="msgVievhold" >
                 <div class="msgViev" id="msgVievhold">
                     
                             <?php
 
 
                                     if (empty($results)){
                                         echo '<p> no chats yet </p>';
                                     }
                                     else{
                                         foreach($results as $row){
                                             echo "<div class=chatNameHoldBox>";
                                             echo "<p4 style='color:white;'>" . htmlspecialchars($row["lp"]) . "</p4>"."<br>";
                                             echo "<p5>" . htmlspecialchars($row["chat_name"]) . "</p5>";
                                             echo "<form action='./strona.php' method='post' >".
                                             "<input type='hidden' id='lp-war' name='lp-war' value=".$row["lp"].">".
                                             "<input type='hidden' id='name-war' name='name-war' value='".htmlspecialchars($row["chat_name"])."'.p>".
                                             "<input type='submit' name='button1'  class='button' value='przejdz do czatu' />" .
                                             "</form>"; 
                                             echo "</div>";
                                         }
                                     }
                                     
                             ?>
 
                     
 
                 </div>
             </div>
 
         </div>




 
     </div>
     <script>
         const element = document.getElementById('msgVievhold');
         element.scrollTop = element.scrollHeight;
     </script>
 </body>
 </html>
