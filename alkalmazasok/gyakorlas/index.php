<?php
@include '../../config.php';
session_start();
if(!isset($_SESSION['user_name'])){
   echo "HTTP403 | MSG => Nincs bejelentkezve!";
   header('location:../../index.php');
   exit;
}
$query = "SELECT karakterszam, email, user_uuid FROM user_form WHERE name = '".$_SESSION['user_name']."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$kszam = $row['karakterszam'];
?>

<!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="../assets/styles.css">
        <title>MAITE - gyakorlás</title>
    </head>
    <body>
        
        <!-- js app azonosításhoz -->
        <input id="app_id" style="display:none;" value="gyakorlo" >

        <header class="header">
            <div class="header__container">
                <p class="keszitette" "> MAITE Coinok: <b><span id="maite_coinok"><?php echo $kszam ?></span></b></p>
                <a href="#" class="header__logo">MAITE</a>
                
                <div class="header__search">
                    <input type="search" placeholder="Funkció keresése" id="kereses" class="header__input">
                    <i class='bx bx-search header__icon'></i>
                </div>
                
                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
                
            </div>
        </header>
        <!-- oldalsáv/menű -->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="../../" class="nav__link nav__logo">
                        <i class='bx bxl-medium nav__icon' ></i>
                        <span class="nav__logo-name">MAITE</span>
                    </a>
                    
                    <div class="nav__list">
                        <div class="nav__items">
                            <a href="../../" class="nav__link ">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Kezdőlap</span>
                            </a>

                            <h3 class="nav__subtitle">ALKOTÁS</h3>
<a href="../szovegbolkep/" class="nav__link">
                                <i class='bx bx-paint nav__icon' ></i>
                                <span class="nav__name"><b>Szövegből kép</b></span>
                            </a>
                            <h3 class="nav__subtitle">ISKOLA</h3>
                            

                            <a href="../essze/" class="nav__link ">
                                <i class='bx bx-pen nav__icon' ></i>
                                <span class="nav__name">Esszé</span>
                            </a>
                            <a href="../szoveges/" class="nav__link">
                                <i class='bx bx-text nav__icon' ></i>
                                <span class="nav__name">Szöveges feladat</span>
                            </a>
                            <a href="#" class="nav__link active">
                                <i class='bx bxs-bar-chart-alt-2 nav__icon' ></i>
                                <span class="nav__name">Gyakorló feladatok</span>
                            </a>
                            <a href="../fordito/" class="nav__link">
                                <i class='bx bxs-book-open nav__icon' ></i>
                                <span class="nav__name">Fordító</span>
                            </a>
                        </div>
    
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Életmód</h3>
                            <a href="../email/" class="nav__link">
                                <i class='bx bx-envelope nav__icon' ></i>
                                <span class="nav__name">E-mail</span>
                            </a>

                            <a href="../edzesterv/" class="nav__link">
                                <i class='bx bx-cycling nav__icon' ></i>
                                <span class="nav__name">Edzésterv</span>
                            </a>
                        </div>
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Informatika</h3>
                            <a href="../kodolo/" class="nav__link">
                                <i class='bx bx-code-alt nav__icon' ></i>
                                <span class="nav__name">Kódoló</span>
                            </a>

                            <a href="../kod_hibakereso/" class="nav__link">
                                <i class='bx bx-bug nav__icon' ></i>
                                <span class="nav__name">Kód hibakereső</span>
                            </a>
                        </div>

                       
                            <div class="nav__dropdown">
                                <a href="../../profil/index.php" class="nav__link">
                                    <i class='bx bx-user nav__icon' ></i>
                                    <span class="nav__name">Profil</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
<a href="../../profil/info/index.php" class="nav__dropdown-item">Profil</a>
                                        <a href="../../profil/coinok/index.php" class="nav__dropdown-item">MAITE Coinok</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <a href="../../kijelentkezes/" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' style="margin-bottom: 30px;"></i>
                    <span class="nav__name" style="margin-bottom: 30px;">Kijelentkezés</span>
                    <br>
                </a>
            </nav>
        </div>
        <main>
            <section>
                <!-- esszé paraméterei -->
                <div class="essze_main">
                    <div class="parameter_cim">
                        <p class="essze_parameterek_text" style="margin-top: 5px; margin-left: 0px; text-align: center; font-size: 25px"><b>Gyakorló feladatok</b> </p>
                    </div>
                    <p id="nincs_coin" class="parameter_cim" style="text-align:center;color: red;margin-top: 0px; display: none"><b>Nincs elég MAITE Coinod :(</b></p>
                    <p id="coinok_szama" style="display:none"><?php echo $kszam ?></p>
                    <div class="essze_parameterek">
                        <p class="essze_parameterek_text" style="margin-top: 5px; margin-left: 5px; font-size: 18px;"><b>Paraméterek a feladatok generálásához:</b></p>
                        <div class="essze_parameter_flex">
                            <p class="essze_parameterek_subtext" style="margin-top: 2px; margin-left: 15px;"> Tantárgy: </p>
                            <input id="tantargy" placeholder="pl. kémia" style="font-family: 'Poppins', sans-serif; color: rgb(39, 39, 39)" class="essze_bevitel szoveghossz" style="color: rgb(39, 39, 39);" value="" >
                        </div>
                        <div class="essze_parameter_flex">
                            <p class="essze_parameterek_subtext" style="margin-top: 3px; margin-left: 15px;"> Tananyag:  </p>
                            <input id="tananyag" placeholder="pl. szerves kémia" style="font-family: 'Poppins', sans-serif; color: rgb(39, 39, 39)"  class="essze_bevitel szoveghossz" style="margin-top: 4px; color: rgb(39, 39, 39);" value="" >
                        </div>
                        <div class="essze_parameter_flex">
                            <p class="essze_parameterek_subtext" style="margin-top: 3px; margin-left: 15px;"> Tudásszint:  </p>
                            <input id="tudasszint" placeholder="pl. 11. osztály" style="font-family: 'Poppins', sans-serif; color: rgb(39, 39, 39)"  class="essze_bevitel szoveghossz" style="margin-top: 4px; color: rgb(39, 39, 39);" value="" >
                        </div>
                        <div class="essze_parameter_flex">
                            <script>
                                var egyeb_parameter = 'További paraméter még például:  \n - 10 kérdés legyen \n - igaz-hamis feladatok legyenek \n - legyen kiírva a megoldása is \nés ezekhez hasonlók' 
                                function e_parameter(){
                                    alert(egyeb_parameter)
                                }
                            </script>
                            <p class="essze_parameterek_subtext" style="margin-top: 5px; margin-left: 15px;"> További paraméterek:  <i onclick="e_parameter()" class='bx bx-help-circle essze_ikon tudasszintek_help'></i></p>
                            <textarea id="parameterek" placeholder='hány kérdés legyen, milyen típusú legyen(pl. kifejtős, igaz hamis)... " ' onkeyup="magassag(this)"  class="egyeb_text szoveghossz_textarea" style="margin-top: 4px; color: rgb(39, 39, 39); font-family: 'Poppins', sans-serif; " value="általános" ></textarea>
                            <script>
                                function magassag(element) {
                                    element.style.height = "1px";
                                    element.style.height = (10+element.scrollHeight)+"px";
                                }

                            </script>
                        </div>
                        <div class="rajta">
                            <button class="button">Start!</button>
                        </div>
                    </div>
                    <div class="essze_parameterek " id="betolt_kep"  style="text-align: center; min-height: 10px; display: none;">
                        <img id="betoltes" class="kep2" src="../assets/betoltes.gif" alt="Kérlek várj..." style="height: 70px;" >
                    </div>
                    <br>
                    <br>
                    <div class="kesz_essze" >
                        <div class="essze_parameter_flex">
                            <p class="kesz_essze_szoveg" style="margin: 5px;"><b>Gyakorló feladatok:</b> </p>
                            <p class="kesz_essze_szoveg"  style="margin: 5px; margin-top: 5px; padding-left:10px; font-size: 13px; cursor: pointer;" onclick="torles()"><b>Szöveg törlése/stop/hibajavítás</b> </p>
                        </div>
                        <textarea readonly name="" id="kesz"   placeholder="Kimenet"  style="width: 99%; min-height: 500px; max-width: none; font-family: var(--body-font)" class="egyeb_text szoveghossz_textarea autoresizing" spellcheck="false" ></textarea>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <p class="footer">Készítette: <b>Kósa Máté</b></p>
        </footer>
        <!-- Keresés -->
        <script>            
        document.getElementById("kereses").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            if (document.getElementById("kereses").value.trim() == "") {
                alert("Kérlek adj meg egy kulcsszót legalább!");
                return false;
        }
        else
            event.preventDefault();
            var user_kereses = document.getElementById("kereses").value;
            window.location.href = "../../kereso.php?k=" + user_kereses;
            }
        });
        </script>
        <script src="../assets/main.js"></script>
        <script src="../assets/sse.js"></script>
        <script src="gyakorlas_api_kommunikator.js"></script>
    </body>
</html>
