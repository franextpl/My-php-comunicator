<?php
session_start();

require_once "./includes/dbh.inc.php";

$querry = "SELECT * FROM chats ORDER BY lp";
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
    <link rel="stylesheet" href="./styles/style-admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

</head>
<body>

    <div class="mainDiv">        
        <div class="contentHolder">
            <div class="topText">
                <div class="topTextChild">
                    <h1>
                        Super chat-admnistrator
                    </h1>
                    <p1>
                        Witaj w menu admnistracyjnym Super chat

                    </p1>
                </div>
                <div class="topUsername">


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
            <div class="msgSendhold">
                <p1>Tworzenie czatu</p1>
                <?php
                    
                        echo '<form name="wiad" action="./includes/chat-creator-handler.php" onsubmit="return validateForm()" method="post" >
                              <input type="text" name="chatName" maxlength=200 class=msgBox>';
                            
                        echo '<input type="submit" value="create" class=sndButn>'; 
                        echo '</form>';

                        #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';


                
                    if (isset($_POST['backToList'])){

                        echo "<script>location.href='./lista-czatow.php';</script>";
                    }
                    echo $_FILES["fileToUpload"]["name"];
                ?>
            </div>
            <div class="msgSendhold">
                <p1>usuwanie czatu</p1>
                <?php
                        if (empty($results)){
                            echo '<p> no chats to delete </p>';
                        }
                        else{
                            echo '<form name="wiad" action="./includes/chat-deleter-handler.php" onsubmit="return validateForm()" method="post" >';
                            echo '<select name="chatid" id="chatDeleteSelector" class="nazwaChatu">';
                            foreach($results as $row){
                                echo '<option value='.$row["lp"].'>'.$row["lp"].":".$row["chat_name"]. '</option>';

                            }
                        
                        
                        echo '</select>';     
                        echo '<input type="submit" value="delete" class=sndButn>'; 

                        #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';
                        echo '</form>';
                        }
                ?>
            </div>
            <div class="msgSendhold">
                <p1>usuwanie zawartości czatu</p1>
                <?php
                    if (empty($results)){
                        echo '<p> no chats to remove messages from </p>';
                            }
                            else{
                                echo '<form name="wiad" action="./includes/chat-emptier-handler.php" onsubmit="return validateForm()" method="post" >';
                                echo '<select name="chatid" id="chatDeleteSelector" class="nazwaChatu">';
                                foreach($results as $row){
                                    echo '<option value='.$row["lp"].'>'.$row["lp"].":".$row["chat_name"]. '</option>';
                    
                                }
                                            
                                            
                                echo '</select>';     
                                echo '<input type="submit" value="delete" class=sndButn>'; 
                    
                                #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';
                                echo '</form>';
                            }

                ?>
            </div>
            <div class="msgSendhold">
                <p1>usuwanie pojedyńczych wiadomości przez id</p1>
                <?php


if (empty($results)){
        echo '<p> no chats to remove messages from </p>';
        }
        else{
            echo '<form name="wiadom" action="./includes/message-deleter-handler.php" onsubmit="return validateForm()" method="post" >';
            echo '<select name="chatid" id="chatDeleteSelector" class="nazwaChatu">';
            foreach($results as $row){
                echo '<option value='.$row["lp"].'>'.$row["lp"].":".$row["chat_name"]. '</option>';

            }
                        
                        
            echo '</select>';
            
            if (empty($results)){
                echo '<p>nie ma wiadomości do usunięcia>';
            }
            else{
                echo '<select name="messageid" class="nazwaChatu">';
                foreach($results as $row){
                    require_once "./includes/dbh.inc.php";
                    $chatLp= 'm'.$row['lp'];

                    $querry = "SELECT * FROM $chatLp";
                    $stmt = $pdo->prepare($querry);
                    $stmt->execute();
                    
                    $resultsmesg = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($resultsmesg)){
                        echo 'chat jest pusty';
                    }  
                    else{
                        #echo '<optgroup label="'.$row["chat_name"].'"id="'.$row["chat_name"].'"></optgroup>';
                        foreach ($resultsmesg as $rowmsg) {
                            echo '<option value="'.$rowmsg["lp"].'"'.'class="'.$chatLp.'">'.$rowmsg["lp"].":".htmlspecialchars($rowmsg["message_content"]).'</option>';
                            
                        }
                        


                    }

                }






                echo '</select>';
            }   
            echo '<input type="submit" value="delete" class=sndButn>'; 

            #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';
            echo '</form>';
        }
                ?>
            </div>
        </div>

 

    </div>
    <script src="script.js"></script> 
    <script>

        const element = document.getElementById('msgVievhold');

        function validateForm() {
          var x = document.forms["wiad"]["message"].value;
          if (x == "") {
            alert("Nie można wpisać pustej wartości");
            return false;
          }
        } 

        function checkforvalue(){
            var y = 'm' + document.forms["wiadom"]["chatid"].value;
            var lenlista = document.forms["wiadom"]["messageid"].length;
            console.log(lenlista);
            for (let i =0;i<lenlista; i++){
                let elem = document.forms["wiadom"]["messageid"][i];
                let z = elem.attributes.class.value
                if (z !=y){
                    elem.style.display="none";
                }
                else{
                    elem.style.display="initial";
                }
                

            }
            
        }
        setInterval(checkforvalue, 1000);


    </script>
    <?php


    ?>
</body>
</html>
