<?php

@include '../config.php';
session_start();
if(!isset($_SESSION['user_name'])){
    echo "HTTP403 | MSG => Nincs bejelentkezve!";
    header('location:../../index.php');
    exit;
}

$query = "SELECT karakterszam FROM user_form WHERE name = '".$_SESSION['user_name']."'";
    $sql_keres = mysqli_query($conn, $query);
    $oszlop = mysqli_fetch_assoc($sql_keres);
    $kszam = $oszlop['karakterszam'];

    $conn->close();

echo $kszam;
?>