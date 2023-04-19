<?php

$servername = "localhost";
$username = "root";
$password = "";
$name = "miam";



// Create connection
$conn = new mysqli($servername, $username, $password,$name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
};

$utilisateur = "CREATE TABLE IF NOT EXISTS utilisateur(
  id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  email VARCHAR(100),
  password VARCHAR(30),
  nom VARCHAR(50) DEFAULT '',
  prenom VARCHAR(50) DEFAULT '',
  image VARCHAR(50) DEFAULT 'imageProfil/utilisateur.png',
  administrateur INTEGER DEFAULT 0
  )";

$conn->query($utilisateur);
?>