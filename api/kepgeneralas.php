<?php
require __DIR__ . '/vendor/autoload.php';
@include '../config.php';
session_start();
$apikey = "API KULCS HELYE";
$client = OpenAI::client($apikey);

if(!isset($_SESSION['user_name'])){
    echo "HTTP403 | MSG => Nincs bejelentkezve!";
    header('location:../../index.php');
    exit;
}

$query = "SELECT karakterszam, email, user_uuid, name FROM user_form WHERE name = '".$_SESSION['user_name']."'";
    $sql_keres = mysqli_query($conn, $query);
    $oszlop = mysqli_fetch_assoc($sql_keres);
    $kszam = $oszlop['karakterszam'];
    $uuid = $oszlop['user_uuid'];

if ($kszam < 10){
    echo "Nincs elég MAITE Coinod.";
    die;
}

if (!isset($_GET["stilus"]) && !isset($_GET["leiras"])) {
    echo "Nincs megadva egyik paraméter sem.";
    exit;
} else {
    $stilus = $_GET["stilus"];
    $leiras = $_GET["leiras"];
}
$parancs = "Stílus: ". $stilus . ", a kép leírása: " . $leiras;
$response = $client->images()->create([
    'model' => 'dall-e-3',
    'prompt' => strval($parancs),
    'n' => 1,
    'size' => '1024x1024',
    'response_format' => 'url',
]);

$response->created; 

foreach ($response->data as $data) {
    echo $data->url; 
    $data->b64_json; 
}

$response->toArray(); 

$maradek_coin = $kszam - 2000;
$update_query = "UPDATE user_form SET karakterszam = '".$maradek_coin."' WHERE user_uuid = '".$uuid."'";
$update_result = mysqli_query($conn, $update_query);
?>