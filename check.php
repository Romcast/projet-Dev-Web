<?php
session_start();
$email=$_POST['email'];
$mdp=$_POST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$name = "projet";

// Create connection
$conn = new mysqli($servername, $username, $password,$name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
};

$sql = "SELECT * FROM utilisateur";
$utilisateur = $conn->query($sql);

if ($utilisateur->num_rows > 0) {
  while($row = $utilisateur->fetch_assoc()) {
    if ($row["email"] == $email && $row["password"] == $mdp){
      $_SESSION['time']=time();
      $_SESSION['email']=$email;
      header("Location:profil.php");
    }
  }
}




?>
