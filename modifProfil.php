<?php
require ('sqlConn.php');
session_start();

$email=$_GET['email'];
$old_password=$_GET['old_password'];
$new_password=$_GET['new_password'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$email_actuel= $_SESSION['email'];
$erreur = 0;
if($email == $email_actuel && $nom == $_SESSION['nom'] && $prenom == $_SESSION['prenom'] && $new_password == ""){

}
else{
    if($old_password == $_SESSION['password']){
        $user = "SELECT * FROM utilisateur";
        $result = $conn->query($user);


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["email"] == $email && $email != $email_actuel){
                $erreur = 1;
                }
            }
        }

        if ($erreur){}
        else{
            $sql="UPDATE utilisateur SET email = '$email', nom = '$nom', prenom = '$prenom' WHERE email = '$email_actuel' ";
            $conn->query($sql);
                if ($new_password != ""){
                    $conn->query("UPDATE utilisateur SET password = '$new_password' WHERE email = '$email_actuel' ");
                    $_SESSION['password']=$new_password;
                }
            $_SESSION['email']=$email;
            $_SESSION['nom']=$nom;
            $_SESSION['prenom']=$prenom;
        }
    }
    else{
        $erreur = 2;
    }
}
$conn->close();
echo $erreur;

?>