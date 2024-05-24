<?php
session_start();


if ((!isset($_SESSION['selCht']))and(!isset($_POST['lp-war']))){
    echo "<script>location.href='./lista-czatow.php';</script>";
}
if (isset($_POST['lp-war'])){
$curchat_lp = $_POST['lp-war'];
$curchat_name = $_POST['name-war'];
}
else{
$curchat_lp=$_SESSION['selCht'];
$curchat_name=$_SESSION['selChtname'];

}
$_SESSION['selCht']= $curchat_lp;
$_SESSION['selChtname']= $curchat_name; 




require_once "./includes/dbh.inc.php";
$chatId = 'm' . $curchat_lp;

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
    <link rel="stylesheet" href="./styles/style-glowna.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            console.log('strona się załadowała');

        //setInterval(codingCourse, 1000);
            function codingCourse() {

                var sidebar = document.querySelector(".sidebar");

let top = localStorage.getItem("sidebar-scroll");
if (top !== null) {
  sidebar.scrollTop = parseInt(top, 10);
}

window.addEventListener("beforeunload", () => {
  localStorage.setItem("sidebar-scroll", sidebar.scrollTop);
});
            
                $("#msgVievhold").load("./loaders/load-messages.php");
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
                        Witaj w komunikatorze Super chat <br>
                        Patrzysz na chat: 
                        <?php 
                        echo  htmlspecialchars($curchat_name);  
                        ?>

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
                    echo '<br> <form action="./strona.php" method="post">
                    <input type="hidden" name="logOutSig" value=test >

                    <input type="submit" value="wyloguj">
                    </form>';

                }
                else{
                   echo '<form action="./strona.php" method="post"> 
                    <input type="text" name="username"><br>
                    <input type="submit" value="zaloguj">
                    </form>';
                }
                
                ?>

                </div>
                <div class="logOut">
                </div>
                <div class ="chatsBack">

                    <form action='./lista-czatow.php' method='post'>
                        <input type='hidden' id='backToList' name='backToList' value="aa">
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
                                            $id = $row["lp"];
                                            echo "<p4>" . htmlspecialchars($row["name"]) . "</p4>" . ":";
                                            echo "<p5>" . htmlspecialchars($row["message_content"]) . "</p5>";
                                            echo "<p6>" . htmlspecialchars($id). "</p6>"."<br>";
                                            if (isset($row["file_name"])){
                                                echo '<img class="sentImage" style="max-width: 50%; max-height: 100px;" src="./uploads/'.$row["file_name"] .'" alt="'.$row["file_name"].'">';

                                            }
                                            echo "</div>";
                                        }
                                    }
                                    
                            ?>

                    

                </div>
            </div>

            <div class="msgSendhold">
                <?php
                    if ($_SESSION['username']!=null){
                        echo '<form name="wiad" action="./includes/formhandler.inc.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                              <input type="text" name="message" maxlength=200 class=msgBox>';
                            
                        echo '<input type="hidden" name="username-2" value="'.$_SESSION['username'].'" />';
                        echo '<input type="submit" value="wyślij" class=sndButn>'; 
                        

                        echo '<input type="file" name="fileToUpload" id="fileToUpload">
                              </form>';

                        #echo '<form action="upload-pics.php" method="post" enctype="multipart/form-data"> Select image to upload: <input type="file" name="fileToUpload" id="fileToUpload"> <input type="submit" value="Upload Image" name="submit"> </form>';


                    }
                    if (isset($_POST['backToList'])){

                        echo "<script>location.href='./lista-czatow.php';</script>";
                    }
                    echo $_FILES["fileToUpload"]["name"];
                ?>
            </div>
        </div>

 

    </div>
    <script>
        var msdiv = document.getElementById('msgVievhold').children;
        console.log(msdiv);

        function insert(str, index, value) {
        return str.substr(0, index) + value + str.substr(index);
        }
        for (let kid of msdiv){
            //urlrer();
            let messagecont = kid.children[1].innerHTML;
            console.log(messagecont);
            console.log((messagecont.search(/(\w+\.\w{2,3}(?!(\.)|(\w)))|(\w+\.\w+\.\w{2,3})/)));
            console.log();
            if ((messagecont.search(/(\w+\.\w{2,3}(?!(\.)|(\w)))|(\w+\.\w+\.\w{2,3})/))>=0){
                let fstindex = (urlrer(messagecont))[0];
            let endindex = (urlrer(messagecont))[1];
            let linktoweb = (urlrer(messagecont))[2];


            
            kid.children[1].innerHTML = insert(kid.children[1].innerHTML, fstindex,'<a href=http://www.'+ linktoweb +'>' );
            kid.children[1].innerHTML = insert(kid.children[1].innerHTML, (endindex+22+linktoweb.length),'</a>' );
            messagecont = kid.children[1].innerHTML;
            let partofmess = messagecont.slice(endindex+22+linktoweb.length+4);
            let msgdelta = messagecont.slice(0,endindex+22+linktoweb.length+4).length;
            console.log('this is message delta:'+msgdelta);
            console.log(partofmess);
            while ((partofmess.search(/(\w+\.\w{2,3}(?!(\.)|(\w)))|(\w+\.\w+\.\w{2,3})/))>0){
                let fstindex1 = (urlrer(partofmess))[0];
                let endindex1 = (urlrer(partofmess))[1];
                let linktoweb1 = (urlrer(partofmess))[2];
                kid.children[1].innerHTML = insert(kid.children[1].innerHTML, (fstindex1+msgdelta),'<a href=http://www.'+ linktoweb1 +'>' );
                kid.children[1].innerHTML = insert(kid.children[1].innerHTML, (endindex1+22+linktoweb1.length + msgdelta),'</a>' );

                msgdelta = msgdelta + partofmess.slice(0,endindex1+1).length+ 24 + linktoweb1.length;
                partofmess = partofmess.slice(endindex1+1);
                console.log('this is message delta:'+msgdelta);
            console.log(partofmess);
            }

            
            } 
            
            //(\w+\.\w{2,3}(\s{1}|(\/w+)+))|(\w+\.\w+\.\w{2,3})
                
            

        }
        function urlrer(value){
                let fstindex = (value.search(/(\w+\.\w{2,3}(?!(\.)|(\w)))|(\w+\.\w+\.\w{2,3})/));
                console.log('this is the beggining index:'+fstindex);
                let newstr = value.slice(fstindex);
                console.log(newstr);
                let linktoweb;
                let endindex;
                if (newstr.search(/\s\w*/) > -1){
                endindex =fstindex + (newstr.search(/\s\w*/))-1;
                linktoweb = newstr.slice(0,((newstr.search(/\s\w*/)+1)));
                console.log(value.search(/\w+.pl/));
                }
                else{
                    endindex = newstr.length + fstindex; 
                    linktoweb = newstr;
                }
                
                console.log('this is the end index:'+(endindex));
                return [fstindex, endindex, linktoweb];
                
        
        }
    </script>
    <script>

        const element = document.getElementById('msgVievhold');
        element.scrollTop=element.scrollHeight;
        var maxfilesize = 1999999;
        function validateForm() {
          var x = document.forms["wiad"]["message"].value;
          var filesiz;
          try{
            filesiz = document.forms['wiad']['fileToUpload'].files[0].size;
          }
          catch(err){
            console.log(err.messsage);
          }
          
          
          element.scrollTop = element.scrollHeight
          if (x == "") {
            alert("Nie można wysłać pustej wiadomości");
            return false;
          }
          if (filesiz >= maxfilesize){
            alert("rozmiar pliku jest zbyt duży");
            document.forms['wiad']['fileToUpload'].files[0] = null;
            return false;
          }
        } 



    </script>
    <?php  

    ?>
</body>
</html>
