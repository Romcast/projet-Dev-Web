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
  date_creation DATE DEFAULT '0000-00-00',
  administrateur INTEGER DEFAULT 0,
  ban INTEGER DEFAULT 0,
  note_moy FLOAT DEFAULT 0.0,
  util_semaine INTEGER DEFAULT 0
  )";

  $conn->query($utilisateur);
  $util = $conn->query("SELECT * FROM utilisateur");
  if ($util->fetch_assoc() == NULL){
    $admin = "INSERT INTO utilisateur(email,password,administrateur) VALUES ('admin',0000,1)";
    $conn->query($admin);
  }



?>