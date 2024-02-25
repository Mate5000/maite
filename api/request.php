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
if (!isset($_GET['app'])) {
    echo "HIBA: App paraméter hibás használata.";
    die;
} else {
    $app = $_GET['app'];
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

switch($app) {
    case "essze":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít fogalmazásokat, esszéket írni.";
        if (isset($_GET['tema'])) {
            $tema = $_GET['tema'];
        } else { 
            $tema = "A felhasználó nem adott meg témát. Írj ki egy hibát.";
        }

        if (isset($_GET['hossz'])) {
            $hossz = $_GET['hossz'];
        } else { 
            $hossz = "100";
        }

        if (isset($_GET['tudasszint'])) {
            $tudasszint = $_GET['tudasszint'];
        } else { 
            $tudasszint = "közepes";
        }

        if (isset($_GET['egyeb'])) {
            $egyeb = $_GET['egyeb'];
        } else { 
            $egyeb = "nincs egyéb infó";
        }
        $parameter = "Válaszolj az alábbi témában: " . $tema . ". A válasz hossza legyen " . $hossz . " szó. Egyéb megjegyzés: " . $egyeb;
        break;
    case "szoveges":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít megoldani különféle szöveges feladatokat. Ez lehet matek, magyar, bármilyen feladat.";
        if (isset($_GET['reszletesseg'])) {
            $reszletesseg = $_GET['reszletesseg'];
        } else { 
            $reszletesseg = "A felhasználó nem adott meg részletességet.";
        }

        if (isset($_GET['feladatszoveg'])) {
            $feladatszoveg = $_GET['feladatszoveg'];
        } else { 
            $feladatszoveg = "A felhasználó nem adota meg a feladatszöveget. Írj ki egy hibát.";
        }
        $parameter = "Oldd meg ezt a szöveges feladatot: " . $feladatszoveg . ". Ennyire részletesen írd le a megoldást:" . $reszletesseg;
        break;
    case "kodolo":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít számítógépes programokat írni, különféle programnyelveken. Ne használj markdown / md formázást. Csak a kódot írd le. Ne írj ``` jeleket.";
        if (isset($_GET['programnyelv'])) {
            $programnyelv = $_GET['programnyelv'];
        } else { 
            $programnyelv = "A felhasználó nem adott meg nyelvet. Írj ki egy hibát.";
        }

        if (isset($_GET['programleiras'])) {
            $programleiras = $_GET['programleiras'];
        } else { 
            $programleiras = "A felhasználó nem adott meg leírást.";
        }
        $parameter = "Írj egy programot az alábbi nyelven: " . $programnyelv . ". A program leírása, hogy mit tudjon:" . $programleiras;
        break;
    case "fordito":
        $kontextus = "Te egy fordítógép vagy, aki bármilyen mondatot kap, annak csak a fordítását írja le.";
        if (isset($_GET['nyelv'])) {
            $nyelv = $_GET['nyelv'];
        } else { 
            $nyelv = "A felhasználó nem adott meg nyelvet. Írj ki egy hibát.";
        }

        if (isset($_GET['forditandoszoveg'])) {
            $forditandoszoveg = $_GET['forditandoszoveg'];
        } else { 
            $forditandoszoveg = "A felhasználó nem adott meg szöveget.";
        }
        $parameter = "Fordítsd le " . $nyelv . " nyelvre, az alábbi szöveget: " . $forditandoszoveg;
        break;

    case "bug_kereso":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít megkeresni a hibát a programban, amit a felhasználó ad. Ne írj ``` jeleket. Ne használj markdown / md formázást";
        if (isset($_GET['nyelv'])) {
            $nyelv = $_GET['nyelv'];
        } else { 
            $nyelv = "A felhasználó nem adott meg nyelvet. Írj ki egy hibát.";
        }

        if (isset($_GET['program'])) {
            $program = $_GET['program'];
        } else { 
            $program = "A felhasználó nem adott meg szöveget.";
        }
        $parameter = "Keresd meg a hibát, az alábbi " . $nyelv . " nyelvű programban. Program kódja: " . $program;
        break;
        
    case "edzesterv":
        $kontextus = "Te egy személyi edző vagy, aki segít létrehozni a felhasználó által megadott információk alapján egy személyre szóló edzéstervet. Napokra felbontva írd le. Csak az edzéstervet írd le. Ne írj ``` jeleket. Ne használj markdown / md formázást";
        //így egyszerűbbnek tűnt közben 😆
        $kor = isset($_GET['k']) ? $_GET['k'] : "Nincs beállítva";
        $suly = isset($_GET['s']) ? $_GET['s'] : "Nincs beállítva";
        $magassag = isset($_GET['m']) ? $_GET['m'] : "Nincs beállítva";
        $hanyszor = isset($_GET['h']) ? $_GET['h'] : "Nincs beállítva";
        $hanypercnaponta = isset($_GET['hpn']) ? $_GET['hpn'] : "Nincs beállítva";
        $edzestipus = isset($_GET['et']) ? $_GET['et'] : "Nincs beállítva";
        $cel = isset($_GET['c']) ? $_GET['c'] : "Nincs beállítva";
        $eszkozok = isset($_GET['e']) ? $_GET['e'] : "Nincs beállítva";
        $egyeb = isset($_GET['egyeb']) ? $_GET['egyeb'] : "Nincs beállítva";

        $parameter = "Az edzéstervhez az infók: kor: " . $kor . " súly: " . $suly . " magasság: " . $magassag . "hányszor egy héten: ". $hanyszor . " naponta hány percet: ". $hanypercnaponta . "milyen típusú edzés: ". $edzestipus . " cél: ". $cel . " eszközök: " . $eszkozok . " egyéb dolgok: " . $egyeb;
        break;
    case "gyakorlo":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít gyakorló feladatokat készíteni, egy adott tantárgyhoz, adott tananyagból. Csak a feladatot írhatod le, semmi mást. Ne írj ``` jeleket. Ne használj markdown / md formázást";
        $tantargy = isset($_GET['tantargy']) ? $_GET['tantargy'] : "Nincs beállítva";
        $tananyag = isset($_GET['tananyag']) ? $_GET['tananyag'] : "Nincs beállítva";
        $tudasszint = isset($_GET['tudasszint']) ? $_GET['tudasszint'] : "Nincs beállítva";
        $egyeb = isset($_GET['egyeb']) ? $_GET['egyeb'] : "Nincs beállítva";
        $parameter = "Készíts gyakorló feladatokat a következő tantárgyból: ". $tantargy . ", a következő tananyagból: " . $tananyag . ", ilyen szinten: ". $tudasszint . ", egyéb dolgok: " . $egyeb;
        break;
    case "email":
        $kontextus = "Te egy segítőkész asszisztens vagy, aki segít emaileket írni.";
        $cimzett = isset($_GET['cimzett']) ? $_GET['cimzett'] : "Nincs beállítva";
        $stilus = isset($_GET['stilus']) ? $_GET['stilus'] : "Nincs beállítva";
        $egyeb = isset($_GET['egyeb']) ? $_GET['egyeb'] : "Nincs beállítva";
        $parameter = "Írj egy emailt " . $stilus . "stílusban, " . $cimzett . "-nek címezve, a következő egyéb beállítások alapján: ". $egyeb;
        break;
}

$generalt = $client->chat()->create([
    'model' => 'gpt-3.5-turbo-0125',
    'messages' => [
        ['role' => 'system', 'content' => strval($kontextus)],
        ['role' => 'user', 'content' => strval($parameter)],
    ],
]);
$tokenek = $generalt->usage->totalTokens;


$maradek_token = $kszam - $tokenek;
$update_query = "UPDATE user_form SET karakterszam = '".$maradek_token."' WHERE user_uuid = '".$uuid."'";
$update_result = mysqli_query($conn, $update_query);
// echo $maradek_token;
// debug csak
// echo "context: ". $kontextus . "\n ". $app;
echo $generalt->choices[0]->message->content; 


?>