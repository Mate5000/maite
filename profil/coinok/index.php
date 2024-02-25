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
        <link rel="stylesheet" href="../../alkalmazasok/assets/styles.css">
        <link rel="stylesheet" href="style_n.css">
        <title>MAITE - MAITE Coin feltöltés</title>
    </head>
    <body>
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
        <!-- oldalsáv/menü -->
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
                            <a href="../../alkalmazasok/szovegbolkep/" class="nav__link">
                                <i class='bx bx-paint nav__icon' ></i>
                                <span class="nav__name"><b>Szövegből kép</b></span>
                            </a>
                            <h3 class="nav__subtitle">ISKOLA</h3>
                            

                            <a href="../../alkalmazasok/essze/" class="nav__link ">
                                <i class='bx bx-pen nav__icon' ></i>
                                <span class="nav__name">Esszé</span>
                            </a>
                            <a href="../../alkalmazasok/matek" class="nav__link">
                                <i class='bx bx-text nav__icon' ></i>
                                <span class="nav__name">Szöveges feladat</span>
                            </a>
                            <a href="../../alkalmazasok/gyakorlas/" class="nav__link">
                                <i class='bx bxs-bar-chart-alt-2 nav__icon' ></i>
                                <span class="nav__name">Gyakorló feladatok</span>
                            </a>
                            <a href="../../alkalmazasok/fordito/" class="nav__link">
                                <i class='bx bxs-book-open nav__icon' ></i>
                                <span class="nav__name">Fordító</span>
                            </a>
                        </div>
    
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Életmód</h3>
                            <a href="../../alkalmazasok/email/" class="nav__link">
                                <i class='bx bx-envelope nav__icon' ></i>
                                <span class="nav__name">E-mail</span>
                            </a>

                            <a href="../../alkalmazasok/edzesterv/" class="nav__link">
                                <i class='bx bx-cycling nav__icon' ></i>
                                <span class="nav__name">Edzésterv</span>
                            </a>
                        </div>
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Informatika</h3>
                            <a href="../../alkalmazasok/kodolo/" class="nav__link">
                                <i class='bx bx-code-alt nav__icon' ></i>
                                <span class="nav__name">Kódoló</span>
                            </a>

                            <a href="../../alkalmazasok/kod_hibakereso/" class="nav__link">
                                <i class='bx bx-bug nav__icon' ></i>
                                <span class="nav__name">Kód hibakereső</span>
                            </a>
                        </div>

                       
                            <div class="nav__dropdown">
                                <a href="../" class="nav__link active">
                                    <i class='bx bx-user nav__icon' ></i>
                                    <span class="nav__name">Profil</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="../../profil/info/index.php" class="nav__dropdown-item">Profil</a>
                                        <a href="#" class="nav__dropdown-item">MAITE Coinok</a>
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
                <div>
                <p id="coinok_szama" style="display:none"><?php echo $kszam ?></p>
                    <p class="udv mh1 kozepre" style="font-size: 25px;"><b>MAITE Coin feltöltés</b></p>
                    
                    <div class="funkciok mh3">
                        <p class="eszkozok kozepre"></p>

                        <div class="osszes_funkcio">
                            <div class="kozep_div">
                                <p class="kerdes">Feltöltés ajándék kóddal: </p>
                            
                                <input id="kod"  placeholder="" style="font-family: 'Poppins', sans-serif; color: rgb(39, 39, 39)" class="szoveg_bevitel szoveghossz" style="color: rgb(39, 39, 39); background-color: #d2daf0; text-align: center;" value="" >
                                
                            </div>
                            <br>
                            <br>
                            <button class="button2" id="ellenorzes" style="margin: 0;">Mentés</button>
                        </div>
                        <br>
                    </div>
            </section>
        </main>
        <script>
        document.getElementById("ellenorzes").addEventListener("click", function() {
            
            var kodInput = document.getElementById("kod");
            var kod = kodInput.value.trim(); 

            if (kod !== "") {
                
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../../api/coin_feltoltes.php?c=" + encodeURIComponent(kod), true);

                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(xhr.responseText); 
                        kodInput.value = ""; 
                        karakterszam_lekeres()
                    } else {
                        alert("Hiba történt az adatok elküldésekor.");
                    }
                };

                xhr.send();
            } else {
                alert("A kód mező nem lehet üres.");
            }
        });


function karakterszam_lekeres() {
    
    const k_xhr = new XMLHttpRequest();
    const k_url = '../../api/coinok.php';
    k_xhr.open('GET', `${k_url}`, true);
    k_xhr.onload = function () {
        if (k_xhr.status == 200) {
            document.getElementById("maite_coinok").textContent=k_xhr.responseText;
            console.log('Coinok frissítve.');
        }
    };

    k_xhr.send();  
}
</script>
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
        <script src="../../assets/main.js"></script>

    </body>
</html>
