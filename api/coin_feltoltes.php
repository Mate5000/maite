<?php
@include '../config.php';
session_start();
if(!isset($_SESSION['user_name'])){
    echo "HTTP403 | MSG => Nincs bejelentkezve!";
    header('location:../../index.php');
    exit;
}


if (isset($_GET['c']) && preg_match('/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}$/', $_GET['c'])) {
    $kod = $_GET['c'];
    $stmt = $conn->prepare("SELECT * FROM kodok WHERE kod = ?");
    $stmt->bind_param("s", $kod);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ertek = $row['ertek'];

        $query = "SELECT karakterszam, email, user_uuid, name FROM user_form WHERE name = '".$_SESSION['user_name']."'";
            $sql_keres = mysqli_query($conn, $query);
            $oszlop = mysqli_fetch_assoc($sql_keres);
            $kszam = $oszlop['karakterszam'];
            $uuid = $oszlop['user_uuid'];
        

        $ujcoinok = $kszam + $ertek;
        $update_query = "UPDATE user_form SET karakterszam = '".$ujcoinok."' WHERE user_uuid = '".$uuid."'";
        $update_result = mysqli_query($conn, $update_query);

        $updateStmt = $conn->prepare("DELETE from kodok WHERE kod = ?");
        $updateStmt->bind_param("s", $kod);
        $updateStmt->execute();
        $updateStmt->close();

        echo "Helyes kód. MAITE Coinok száma növelve.";
    } else {
        echo "A megadott kód helytelen.";
    }

    $stmt->close();
} else {
    echo "Hibás kódformátum.";
}

$conn->close();


?>