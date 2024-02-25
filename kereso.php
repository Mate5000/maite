<!-- <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAITE - Keresőmotor</title>
</head>



<style>
    * {
        text-align: center; 
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    #hibakod {
        font-size: 23px;
    }
    #hiba {
        font-size: 17px;
    }
    #vissza {
        font-size: 17px; 
        color: darkblue;
    }
    #vissza:visited {
        font-size: 17px; 
        color: darkblue; 
        }
</style> -->

<?php
if (isset($_GET['k'])) {
    $kereses = $_GET['k'];
    $str = mb_strtolower($kereses);

    $essze = array("essze", "esszé", "esszé író", "esszéíró", "fogalmazás", "fogalmazas", "fogalmazás író");
    $szoveges = array("matek","matematika", "matek gyakorlás", "matek gyakorlas", "Szöveges feladatok", "Szöveges feladat", "matematika feladat", "matematika feladatok", "feladat", "feladatok", "feladatos");
    $gyakorlas = array("gyakorlás", "gyakorlas", "gyakorló feladatok", "gyakorlo feladatok", "feladatok");
    $fordito = array("fordító", "fordito", "forditas", "fordítás");
    $email = array("email", "e-mail", "ímél", "imel", "imél", "ímel");
    $edzesterv = array("edzésterv", "edzesterv", "terv", "edzes", "terv", "edzésrend", "rend", "edzesrend");
    $kodolo = array("kódoló", "kód", "kódolás", "kod", "kodolo", "code", "cod");
    $kod_hibakereso = array("bug kereso", "bug kereső","bugkereső", "bug", "hibakereső", "kód hibakereső", "hibakereso", "hiba", "kod hibakereso");
    $profil = array("profil", "profile","profilom","account","fiók","fiókom");
    // $nev = array("név","profilnév","profilnev","nev","név módosítása","nev modositasa","felhasználónév","felhasznalonev");
    // $jelszo = array("jelszó","jelszo","jelszó módosítása","jelszo modositasa","password");
    // $elozmenyek = array("előzmények","elozmenyek","history","előzmény", "elozmeny");
    $kezdolap = array("kezdolap", "kezdlap", "kezdőlap", "start", "startlap");
    $szovegbolkep = array("szoveg","szovegbolkep","szovegbol kep","szövegből kép","kép","festés","rajz","rajzolás","alkotás","kép generálás","generál","generálás");

    if (in_array($str, $essze)) {
        header('Location: alkalmazasok/essze');
    } else if (in_array($str, $szoveges)){
        header('Location: alkalmazasok/szoveges');
    } else if (in_array($str, $gyakorlas)){
        header('Location: alkalmazasok/gyakorlas');
    } else if (in_array($str, $fordito)){
        header('Location: alkalmazasok/fordito');
    } else if (in_array($str, $email)){
        header('Location: alkalmazasok/email');
    }  else if (in_array($str, $edzesterv)){
        header('Location: alkalmazasok/edzesterv');
    }  else if (in_array($str, $kodolo)){
        header('Location: alkalmazasok/kodolo');
    }  else if (in_array($str, $kod_hibakereso)){
        header('Location: alkalmazasok/kod_hibakereso');
    }  else if (in_array($str, $profil)){
        header('Location: profil');
    // }  else if (in_array($str, $nev)){
    //     header('Location: profil/nev');
    // }  else if (in_array($str, $jelszo)){
    //     header('Location: profil/jelszo');
    // }  else if (in_array($str, $elozmenyek)){
        // header('Location: profil/elozmenyek');
    }  else if (in_array($str, $kezdolap)){
        header('Location: kezdolap.php');
    }  else if (in_array($str, $szovegbolkep)){
        header('Location: alkalmazasok/szovegbolkep');
    } else header('location:hiba.php');

}
else header('location:keres_hiba.php');
// else echo '<p id="hibakod">400 Bad request</p><p id="hiba">Hibásan, vagy nem lett megadva a paraméter.</p><p id="vissza"><a href="index.html"><i>Vissza a főoldalra</i></a></p>';
?>
