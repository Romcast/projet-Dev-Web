<?php
require ('sqlConn.php');
session_start();
$email = $_SESSION['email'];

if ($_FILES["file"]["name"] == ""){
    $image = "image/utilisateur.png";
    if (basename($_SESSION['image']) !== "utilisateur.png"){
        unlink($_SESSION['image']);
    }
    $conn->query("UPDATE utilisateur SET image = '$image' WHERE email = '$email' ");
    $_SESSION['image']=$image;
    $conn->close();
    header("Location:changeProfil.php");
}
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  header("Location:erreurImage.html");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    if (basename($_SESSION['image']) !== "utilisateur.png"){
        unlink($_SESSION['image']);
    }
    $conn->query("UPDATE utilisateur SET image = '$target_file' WHERE email = '$email' ");
    $_SESSION['image']=$target_file;
    $conn->close();
    header("Location:changeProfil.php");
    
  } else {
    echo "Sorry, there was an error uploading your file.";
    sleep(3);
    $conn->close();
    header("Location:changeProfil.php");
  }
}
?>