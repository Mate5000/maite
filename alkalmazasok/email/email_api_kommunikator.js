
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
var alkalmazas = document.getElementById("app_id").value;
var communicator = ''
document.querySelector('button').onclick = () => {

    
    if(betoltes2.style.display == "none"){
        document.querySelector("button").disabled = true; 
        document.getElementById('betoltes').disabled = true; 
        betoltes2.style.display = "block";
        bottomScroll();

        const stilus = document.getElementById('stilus').value;
        const cimzett = document.getElementById('cimzett').value;
        const egyeb = document.getElementById('egyeb').value;

        const xhr = new XMLHttpRequest();
        const url = '../../api/request.php';
        const params = `app=${alkalmazas}&cimzett=${cimzett}&stilus=${stilus}&egyeb=${egyeb}`;

        xhr.open('GET', `${url}?${params}`, true);

        xhr.onload = function () {
        if (xhr.status == 200) {
            
            document.getElementById('kesz').value = xhr.responseText;
            betoltes2.style.display = "none";
            console.log('Kérés befejezve.');
            document.querySelector("button").disabled = false; 
            karakterszam_lekeres();
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