<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username2 = $_POST["username-2"];
    $message = $_POST["message"];
    $chatId = 'm' . $_SESSION['selCht'];

    if (($_FILES["fileToUpload"]["name"]) != null) {

        $target_dir = "../uploads/";
        $target_name = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $target_name;
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        
        // Check if file already exists
        while (file_exists($target_file)) {
          $target_name = 'm' . $target_name;
          $target_file = $target_dir . $target_name;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        echo 'check upl';
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        
              $username2 = $_POST["username-2"];
              $message = $_POST["message"];
              $chatId = 'm' . $_SESSION['selCht'];
          
          
              try {
                  require_once "dbh.inc.php";
          
                  $querry = "INSERT INTO $chatId(name, message_content, file_name) VALUES(?, ?, ?);";
                  $stmt = $pdo->prepare($querry);
                  $stmt->execute([$username2, $message, $target_name]);
          
                  echo "<script>location.href='../strona.php';</script>";
                  die();
              } catch (PDOException $e) {
                  #die("Querry falied" . $e->getMessage());
                  echo "<script>location.href='../strona.php';</script>";
              }  
        
        
        
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
        #
        
    

    }
    if (($_FILES["fileToUpload"]["name"]) == null) {

    try {
        require_once "dbh.inc.php";

        $querry = "INSERT INTO $chatId(name, message_content) VALUES(?, ?);";
        $stmt = $pdo->prepare($querry);
        $stmt->execute([$username2, $message]);

        echo "<script>location.href='../strona.php';</script>";
        die();
    } catch (PDOException $e) {
        #die("Querry falied" . $e->getMessage());
        echo "<script>location.href='../strona.php';</script>";
    }
    }

} else {
    echo "<script>location.href='../strona.php';</script>";
}

?>