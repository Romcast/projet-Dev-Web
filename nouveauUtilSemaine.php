<?php 
require('sqlConn.php');
$email = $_GET['email'];
$conn->query("UPDATE utilisateur SET util_semaine = 0 WHERE util_semaine = 1" );
$conn->query("UPDATE utilisateur SET util_semaine = 1 WHERE email = '$email'" );
$conn->close();
header('Location:home.php');

?>