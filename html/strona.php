<?php
session_start();

if (!isset($_SESSION['selCht'])){
    header ("Location: ./lista-czatow.php");


}


require_once "./includes/dbh.inc.php";
$chatId = 'm' . $_SESSION['selCht'];

$querry = "SELECT * FROM $chatId;";
$stmt = $pdo->prepare($querry);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super chat</title>
    <link rel="stylesheet" href="style-glowna.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            console.log('strona się załadowała');

        setInterval(codingCourse, 1000);
            function codingCourse() {
            
                $("#msgVievhold").load("load-messages.php");
            }   
        });

    </script>
</head>
<body>

    <div class="mainDiv">        
        <div class="contentHolder">
            <div class="topText">
                <div class="topTextChild">
                    <h1>
                        Super chat
                    </h1>
                    <p1>
                        Witaj w komunikatorze Super chat

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
                    echo '<br> <form action="strona.php" method="post">
                    <input type="hidden" name="logOutSig" value=test >

                    <input type="submit" value="wyloguj">
                    </form>';

                }
                else{
                   echo '<form action="strona.php" method="post"> 
                    <input type="text" name="username"><br>
                    <input type="submit" value="zaloguj">
                    </form>';
                }
                
                ?>

                </div>
                <div class="logOut">
                </div>
                <div class ="chatsBack">

                    <form method='post'>
                        <input type='hidden' id='lp-war' name='backToList' value="aa">
                        <input type='submit' name='button1'  class='backbtn' value='lista czatow' />
                    </form>
                    
                </div>
            </div>
                <div class="msgVievhold" >
                <div class="msgViev" id="msgVievhold">
                    
                            <?php


                                    if (empty($results)){
                                        echo '<p> no messsages yet </p>';
                                    }
                                    else{
                                        foreach($results as $row){
                                            echo "<div class=msgHoldBox>";
                                            echo "<p4>" . htmlspecialchars($row["name"]) . "</p4>" . ":";
                                            echo "<p5>" . htmlspecialchars($row["message_content"]) . "</p5>" . "<br>";
                                            echo "</div>";
                                        }
                                    }
                                    
                            ?>

                    

                </div>
            </div>

            <div class="msgSendhold">
                <?php
                    if ($_SESSION['username']!=null){
                        echo '<form name="wiad" action="includes/formhandler.inc.php" onsubmit="return validateForm()" method="post">
                              <input type="text" name="message" maxlength=200 class=msgBox>';
                            
                        echo '<input type="hidden" name="username-2" value="'.$_SESSION['username'].'" />';
                        echo '<input type="submit" value="wyślij" class=sndButn>
                              </form>';
                    }
                    if (isset($_POST['backToList'])){

                        header ("Location: ./lista-czatow.php");
                    }

                ?>
            </div>
        </div>

 

    </div>
    <script src="script.js"></script> 
    <script>

        const element = document.getElementById('msgVievhold');
        element.scrollTop = element.scrollHeight;

        function validateForm() {
          var x = document.forms["wiad"]["message"].value;
          if (x == "") {
            alert("Nie można wysłać pustej wiadomości");
            return false;
          }
        } 



    </script>
    <?php


    ?>
</body>
</html>
