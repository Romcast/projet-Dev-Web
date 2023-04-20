<?php

require ('sqlConn.php');

$email = $_GET["email"];
$mdp = $_GET["password"];
$date = date("Y-m-d");
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
  $conn->query("INSERT INTO utilisateur(email,password,date_creation) VALUES ('$email','$mdp','$date')");
}

$conn->close();

?>
