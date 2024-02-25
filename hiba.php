<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
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
        <link rel="stylesheet" href="assets/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <title>MAITE - kifejezés nem található</title>
    </head>
    <body>
        
        <header class="header">
            <div class="header__container">
            <p class="keszitette" style=""> MAITE Coinok: <b><?php echo $kszam ?></b></p>
                <a href="index.php" class="header__logo">MAITE</a>
                
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
                            <a href="index.php" class="nav__link">
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
                                <span class="nav__name">Kódoló </span>
                            </a>

                            <a href="alkalmazasok/kod_hibakereso/" class="nav__link">
                                <i class='bx bx-bug nav__icon' ></i>
                                <span class="nav__name">Kód hibakereső</span>
                            </a>
                        </div>

                       
                            <div class="nav__dropdown">
                                <a href="profil/" class="nav__link">
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
                <p class="nem_talalhato">A keresett oldal <b>nem</b> található.</p>
                <!-- <p class="email">Amennyiben szerinted hibásan működik a keresőmotor, erre az emailre válom javaslatod: <a href="mailto:mate@kosa.hu">mate@kosa.hu</a></p> -->
            </section>
        </main>
        <footer>
            <p class="footer">Készítette: <b>Kósa Máté</b></p>
        </footer>
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