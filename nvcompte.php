<?php

$servername = "localhost";
$username = "root";
$password = "";
$name = "projet";

$email = $_POST["email"];
$mdp = $_POST["password"];

// Create connection
$conn = new mysqli($servername, $username, $password,$name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
};

$conn->query("INSERT INTO utilisateur VALUES ('$email','$mdp')");
$conn->close();
header("Location:connexion.html");

?>

