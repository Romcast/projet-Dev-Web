<?php
require('sqlConn.php');
session_start();

$id_user = $_COOKIE['id'];
$email = $_COOKIE['email'];

if (isset($_POST['ban'])) {
    $ban = $_COOKIE['ban'];
    if ($ban == 0) {
        $sql = "UPDATE utilisateur SET ban=1 WHERE email='$email'";
        $conn->query($sql);
        $_SESSION['ban'] = 1;
        setcookie('ban', 1); // mise à jour du cookie
    } else {
        $sql = "UPDATE utilisateur SET ban=0 WHERE email='$email'";
        $conn->query($sql);
        $_SESSION['ban'] = 0;
        setcookie('ban', 0); // mise à jour du cookie
    }
}

$conn->close();
header("Location: visuelProfil.php?id_user=" . $id_user);
?>
