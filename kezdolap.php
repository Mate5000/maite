<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}
$query = "SELECT karakterszam, name FROM user_form WHERE name = '".$_SESSION['user_name']."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$kszam = $row['karakterszam'];
$nev = $row['name'];
?>
<!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <title>MAITE - főoldal</title>
    </head>
    <body>
        
        <header class="header">
            <div class="header__container">
                <p class="keszitette" "> MAITE Coinok: <b><?php echo $kszam ?></b></p>
                <!-- <img src="assets/perfil.jpg" alt="" class="header__img"> -->
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

        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="#" class="nav__link nav__logo">
                        <i class='bx bxl-medium nav__icon' ></i>
                        <span class="nav__logo-name">MAITE</span>
                    </a>
    
                    <div class="nav__list">
                        <div class="nav__items">
                            
                            <a href="#" class="nav__link active">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Kezdőlap</span>
                            </a>
                            <h3 class="nav__subtitle">ALKOTÁS</h3>
                            <a href="alkalmazasok/szovegbolkep/" class="nav__link ">
                                <i class='bx bx-paint nav__icon' ></i>
                                <span class="nav__name"><b>Szövegből kép</b></span>
                            </a>
                            <h3 class="nav__subtitle">ISKOLA</h3>
                            

                            <a href="alkalmazasok/essze/" class="nav__link">
                                <i class='bx bx-pen nav__icon' ></i>
                                <span class="nav__name">Esszé</span>
                            </a>
                            <a href="alkalmazasok/szoveges/" class="nav__link">
                                <i class='bx bx-text nav__icon' ></i>
                                <span class="nav__name">Szöveges feladat</span>
                            </a>
                            <a href="alkalmazasok/gyakorlas/" class="nav__link">
                                <i class='bx bxs-bar-chart-alt-2 nav__icon' ></i>
                                <span class="nav__name">Gyakorló feladatok</span>
                            </a>
                            <a href="alkalmazasok/fordito/" class="nav__link">
                                <i class='bx bxs-book-open nav__icon' ></i>
                                <span class="nav__name">Fordító</span>
                            </a>
                        </div>
    
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Életmód</h3>
                            <a href="alkalmazasok/email/" class="nav__link">
                                <i class='bx bx-envelope nav__icon' ></i>
                                <span class="nav__name">E-mail</span>
                            </a>

                            <a href="alkalmazasok/edzesterv/" class="nav__link">
                                <i class='bx bx-cycling nav__icon' ></i>
                                <span class="nav__name">Edzésterv</span>
                            </a>
                        </div>
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Informatika</h3>
                            <a href="alkalmazasok/kodolo/" class="nav__link">
                                <i class='bx bx-code-alt nav__icon' ></i>
                                <span class="nav__name">Kódoló</span>
                            </a>

                            <a href="alkalmazasok/kod_hibakereso/" class="nav__link">
                                <i class='bx bx-bug nav__icon' ></i>
                                <span class="nav__name">Kód hibakereső</span>
                            </a>
                        </div>

                       
                        <div class="nav__dropdown">
                            <a href="profil/index.php" class="nav__link">
                                <i class='bx bx-user nav__icon' ></i>
                                <span class="nav__name">Profil</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                        <a href="profil/info/index.php" class="nav__dropdown-item">Profil</a>
                                        <a href="profil/coinok/index.php" class="nav__dropdown-item">MAITE Coinok</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="kijelentkezes/" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' style="margin-bottom: 30px;"></i>
                    <span class="nav__name" style="margin-bottom: 30px;">Kijelentkezés</span>
                    <br>
                </a>
            </nav>
        </div>
        <main>
            <section>

                <div>
                    <p class="udv mh1 kozepre">Üdvözöllek az oldalamon!</p>
                    <p class="udv mh2 kozepre">Az oldalt készítette: <b>Kósa Máté</b></p>
                    <p class="udv mh3 kozepre">Ezt a weboldalt azzal a céllal hoztam létre, hogy megmutassam, mire képes a <b>mesterséges intelligencia</b> manapság.</p>
                    <div class="funkciok mh3">
                        <p class="eszkozok kozepre">Alkalmazások</p>
                        
                        <p class="kozepre">Jelenleg bejelentkezve <b><?php echo $nev ?></b> néven.</p>
                        <div class="osszes_funkcio">
                            <!-- <div style="background-color: #bed9f0;" class="funkcio" id="szovegbolkep"><p class="ecim box1"><b>Szövegből kép</b></p><i class='bx bx-paint funkcio_ikon box2'></i><p class="box3">Csak gondold ki, írd le, és én legenerálom róla neked a képet.</p></div> -->
                            <div style="border: 4px #0c99d0 solid;" class="funkcio" id="szovegbolkep"><p class="ecim box1"><b>Szövegből kép</b></p><i class='bx bx-paint funkcio_ikon box2'></i><p class="box3">Csak gondold ki, írd le, és én megalkotom róla neked a képet.</p></div>
                            <div class="funkcio" id="essze"><p class="ecim box1"><b>Esszéíró</b></p><i class='bx bx-pen funkcio_ikon box2'></i><p class="box3">Könnyedén, pár mp alatt egy komplett esszét készíthethetsz.</p></div>
                            <div class="funkcio" id="matek"><p class="ecim box1"><b>Feladat</b></p><i class='bx bx-text funkcio_ikon box2'></i><p class="box3">Pár mp alatt megoldja neked a szöveges feladatot.</p></div>
                            <div class="funkcio" id="gyakorlo"><p class="ecim box1"><b>Gyakorló</b></p><i class='bx bxs-bar-chart-alt-2  funkcio_ikon box2'></i><p class="box3">Bármely tantárgyból ír neked gyakorló feladatokat, hogy a dolgozat is jól sikerüljön.</p></div>
                            <div class="funkcio" id="fordito"><p class="ecim box1"><b>Fordító</b></p><i class='bx bxs-book-open funkcio_ikon box2'></i><p class="box3">Inkább szövegeket, rengeteg nyelvre képes lefordítani.</p></div>
                            <div class="funkcio" id="email"><p class="ecim box1"><b>E-mail</b></p><i class='bx bx-envelope funkcio_ikon box2'></i><p class="box3">Akár hivatalos, akár panasz e-mail pár mp megírom neked.</p></div>
                            <div class="funkcio" id="edzesterv"><p class="ecim box1"><b>Edzésterv</b></p><i class='bx bx-cycling funkcio_ikon box2'></i><p class="box3">Fontos hogy jó kardióban legyél, úgyhogy itt akár egy teljes edzéstervet is készíthetsz.</p></div>
                            <div class="funkcio" id="kodolo"><p class="ecim box1"><b>Kódoló</b></p><i class='bx bx-code-alt funkcio_ikon box2'></i><p class="box3">Csak írd be mit szeretnél, és szinte bármilyen programnyelven megírom számodra.</p></div>
                            <div class="funkcio" id="kod_hibakereso"><p class="ecim box1"><b>Kód bug</b></p><i class='bx bx-bug funkcio_ikon box2'></i><p class="box3">Belefáradtál már, hogy órák óta nem találod azt a fránya hibát? Én pillanatok alatt megtalálom neked!</p></div>
                            <!-- <div class="funkcio" id="beszelgetes"><p class="ecim box1"><b>Beszélgetés</b></p><i class='bx bx-chat funkcio_ikon box2'></i><p class="box3">Kérdezz az AI-tól kb bármit* <br><i>Fejlesztés alatt</i></p></div> -->
                        </div>
                        <br>
                        <p style="font-size: 13px;" class="kozepre">*bármilyen illegális tartalmú kérdést, választ, kérést, tartalmat kérni szigorúan <b>tilos.</b> A kérésekért, válaszokért te tartozol felelősséggel.</p>
                    </div>
                    <!-- klikkelés érzékelése -->
                    <script>
                        document.getElementById("essze")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/essze/";
                        });
                        document.getElementById("matek")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/szoveges/";
                        });
                        document.getElementById("gyakorlo")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/gyakorlas/";
                        });
                        document.getElementById("fordito")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/fordito/";
                        });
                        document.getElementById("email")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/email/";
                        });
                        document.getElementById("edzesterv")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/edzesterv/";
                        });
                        document.getElementById("kodolo")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/kodolo/";
                        });
                        document.getElementById("kod_hibakereso")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/kod_hibakereso/";
                        });
                        document.getElementById("szovegbolkep")
                            .addEventListener('click', function (event) {
                                window.location.href = "alkalmazasok/szovegbolkep/";
                        });
                    </script>
                </div>
                
            </section>
        </main>
        <!-- Keresés -->
        <script>            
        document.getElementById("kereses").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var user_kereses = document.getElementById("kereses").value;
            window.location.href = "kereso.php?k=" + user_kereses;
            }
        });

            
            
        </script>
        <script src="assets/main.js"></script>

    </body>
</html>