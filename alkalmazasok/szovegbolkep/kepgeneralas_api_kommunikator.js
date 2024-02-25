
// MAITE api kommunikátor script
  
const input = document.getElementById('kesz')
const button = document.querySelector('button')
const textarea = document.getElementById('kesz')

var charCount = document.getElementById("coinok_szama");
var nincsCoin = document.getElementById("nincs_coin");
if (parseInt(charCount.innerText) < 40) {
    nincsCoin.style.display = "block";
    document.querySelector('button').disabled = true; 
    console.log(charCount);
}    


const betoltes2 = document.getElementById("betolt_kep");
var communicator = ''
document.querySelector('button').onclick = () => {
    
    if(betoltes2.style.display == "none"){
        document.querySelector("button").disabled = true; 
        document.getElementById('betoltes').disabled = true; 
        betoltes2.style.display = "block";
     
        const stilus = document.getElementById('stilus').value;
        const leiras = document.getElementById('leiras').value;

        const xhr = new XMLHttpRequest();
        const url = '../../api/kepgeneralas.php';
        const params = `stilus=${stilus}&leiras=${leiras}`;
        const keszKepDiv = document.getElementById("keszkep");
    
        xhr.open('GET', `${url}?${params}`, true);

        xhr.onload = function () {
            if (xhr.status == 200) {


                // Kép src megváltoztatása
                const imageUrl = xhr.responseText;

                // Kép státuszának ellenőrzése
                var imgCheck = new Image();
                imgCheck.src = imageUrl;

                imgCheck.onload = function() {
                    keszKepDiv.style.backgroundImage = `url('${imageUrl}')`;
                    karakterszam_lekeres();
                    betoltes2.style.display = "none";
                    document.querySelector("button").disabled = false; 
                    console.log('Kérés befejezve.');

                    // Háttérkép beállítása a .keszkep div-ben
                };
                
                imgCheck.onerror = function() {
                    console.error('Hiba történt a kép betöltésekor.');
                };
            }
        };

        xhr.send();

    } else {
        alert("Már fut egy generálás.")
    }
}


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

function ujra(){
    var button = document.getElementsByClassName('button');
    button.innerText = 'Új szöveg';
    document.getElementById("button").disabled = false; 
    button.innerHTML = 'ujra';
}
function bottomScroll(){
    textarea.scrollIntoView(false)
    textarea.scrollTo(0, textarea.scrollHeight)
}

function torles() {
    location.reload(true); 
}