<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super chat</title>
    <link rel="stylesheet" href="styles/style-glowna.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

</head>
<body>

    <div class="mainDiv">        
        <div class="contentHolder">
            <div class="topText">
                <div class="topTextChild">
                    <h1>
                        Super chat-creator
                    </h1>
                    <p1>
                        Witaj w menu twożenia czatów Super chat

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
                <div class="msgVievhold" >
                <div class="msgViev" id="msgVievhold">
                    

                    

                </div>
            </div>

            <div class="msgSendhold">
                <?php
                    
                        echo '<form name="wiad" action="./includes/chat-creator-handler.php" onsubmit="return validateForm()" method="post" >
                              <input type="text" name="chatName" maxlength=200 class=msgBox>';
                            
                        echo '<input type="submit" value="create" class=sndButn>'; 

                        #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';


                
                    if (isset($_POST['backToList'])){

                        echo "<script>location.href='./lista-czatow.php';</script>";
                    }
                    echo $_FILES["fileToUpload"]["name"];
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
            alert("Nie można wysłać pustej wiadomości");
            return false;
          }
        } 



    </script>
    <?php


    ?>
</body>
</html>
