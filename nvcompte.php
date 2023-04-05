<?php

$servername = "localhost";
$username = "root";
$password = "";
$name = "projet";

$email = $_GET["email"];
$mdp = $_GET["password"];

// Create connection
$conn = new mysqli($servername, $username, $password,$name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
};

$sql = "SELECT * FROM utilisateur";
$result = $conn->query($sql);
$erreur = false;

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if ($row["email"] == $email){
      $erreur = true;
    }
  }
}

if ($erreur){
  echo $erreur;
}
else{
  $conn->query("INSERT INTO utilisateur VALUES ('$email','$mdp')");
}

$conn->close();

?>
