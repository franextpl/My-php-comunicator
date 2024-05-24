<?php
session_start();
$pass = 'dupa';
if (isset($_POST['password'])){
    $inppass=$_POST['password'];
    if ($inppass != $pass){
        $wrgpass = true;
    }
    if ($inppass == $pass){
        $_SESSION['login'] = true;
    echo "<script>location.href='../czat-creator.php';</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style-admin.css">
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
                        Aby przejść do menu administracyjnego musisz wpisać hasło <br>

                    </p1>
                </div>
                <div class="topUsername">


                </div>
                <div class="logOut">
                </div>
                <div class ="chatsBack">

                    <form action='../lista-czatow.php' method='post'>
                        <input type='hidden' id='backToList' name='backToList' value="aa">
                        <input type='submit' name='button1'  class='backbtn' value='lista czatow' />
                    </form>
                    
                </div>
            </div>
                <div class="msgVievhold" >
                <div class="msgViev" id="msgVievhold">
                    <?php
                        if ($wrgpass){
                            echo 'złe hasło';
                        }

                        ?>


                    

                </div>
            </div>

            <div class="msgSendhold">
                    <form action='./admin-login.php' method='post'>
                        <input type='password' id='password' name='password'>
                        <input type='submit' name='button1'  class='backbtn' value='zaloguj' />
                    </form>

            </div>
        </div>

 

    </div> 
</body>
</html>