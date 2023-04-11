<?php
require ('sqlConn.php');

session_start();

$email=$_GET['email'];
$mdp=$_GET['password'];

$sql = "SELECT * FROM utilisateur";
$utilisateur = $conn->query($sql);
$erreur = true;

if ($utilisateur->num_rows > 0) {
  while($row = $utilisateur->fetch_assoc()) {
    if ($row["email"] == $email && $row["password"] == $mdp){
      $erreur = false;
      $_SESSION['time']=time();
      $_SESSION['email']=$email;
      $_SESSION['password']=$row['password'];
      $_SESSION['nom']=$row['nom'];
      $_SESSION['prenom']=$row['prenom'];
      $_SESSION['image']=$row['image'];
    }
  }
}

$conn->close();
echo $erreur;

?>
