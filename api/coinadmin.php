<?php
// Adatbázis kapcsolat beállítása
@include '../config.php';
session_start();
if(!isset($_SESSION['user_name'])){
    echo "HTTP403 | MSG => Nincs bejelentkezve!";
    header('location:../../index.php');
    exit;
}
// Ellenőrizze, hogy a form elküldésre került-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizze, hogy az "ertek" paraméter létezik és nem üres
    if (isset($_POST['ertek']) && !empty($_POST['ertek'])) {
        $ertek = $_POST['ertek'];

        // Készítsünk egy random szám-betű sorozatot a "XXXXX-XXXXX-XXXXX" formátumban
        $randomKod = generateRandomCode();
        
        // Ellenőrizze, hogy a kód még nem létezik-e az adatbázisban
        $checkStmt = $conn->prepare("SELECT * FROM kodok WHERE kod = ?");
        $checkStmt->bind_param("s", $randomKod);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "A kód már létezik az adatbázisban.";
        } else {
            // Kód beszúrása az adatbázisba
            $insertStmt = $conn->prepare("INSERT INTO kodok (kod, ertek, letrehozva, hasznalat) VALUES (?, ?, NOW(), 0)");
            $insertStmt->bind_param("ss", $randomKod, $ertek);
            $insertStmt->execute();
            $insertStmt->close();
            
            echo "A kód sikeresen hozzáadva az adatbázishoz.";
            echo "Kód: " . $randomKod;
        }

        // Ellenőrzéshez használt prepared statement lezárása
        $checkStmt->close();
    } else {
        echo "Az érték mező nem lehet üres.";
    }
}

// Adatbázis kapcsolat lezárása
$conn->close();

// Random kód generálása a "XXXXX-XXXXX-XXXXX" formátumban
function generateRandomCode() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 5; $j++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        if ($i < 2) {
            $randomCode .= '-';
        }
    }
    return $randomCode;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kód Létrehozása</title>
</head>
<body>
    <h2>Kód Létrehozása</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- <label for="kod">Kód:</label> -->
        <!-- <input type="text" id="kod" name="kod" readonly value="<?php echo generateRandomCode(); ?>"> -->
        
        <label for="ertek">Érték:</label>
        <input type="text" id="ertek" name="ertek" required>
        
        <button type="submit">Létrehozás</button>
    </form>
</body>
</html>