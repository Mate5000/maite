
// MAITE api kommunikátor script

//script

// bugfix issue: 0.12.3
  
const input = document.querySelector('input')
const button = document.querySelector('button')
const textarea = document.getElementById('kesz')

var charCount = document.getElementById("karakterszam");
var nincsCoin = document.getElementById("nincs_coin");
if (parseInt(charCount.innerText) < 40) {
    nincsCoin.style.display = "block";
    document.querySelector('button').disabled = true; 
}    

const betoltes2 = document.getElementById("betolt_kep");
var alkalmazas = document.getElementById("app_id").value;
var communicator = ''
document.querySelector('button').onclick = () => {
    var nyelv = document.getElementById("nyelv").value;
    var parameterek = document.getElementById("szoveg").value;
    if(parameterek != ''){
        document.querySelector('button').disabled = true; 
        document.getElementById('betoltes').disabled = true; 
        betoltes2.style.display = "block";
        bottomScroll();
        var source = new SSE("../../api/request.php?app=" + alkalmazas + "&ny=" + nyelv + "&sz="+ parameterek);
        input.value = ''
        input.focus()
        source.addEventListener('message', function (e) {
            if(e.data){
                if(e.data != '[DONE]'){
                    var tokens = JSON.parse(e.data).choices[0].text
                    textarea.innerHTML += tokens
                    bottomScroll();
                }else{
                    ujra()
                    betoltes2.style.display = "none";
                    textarea.innerHTML += "\n"
                    console.log('Kérés befejezve.');
                }
            }
        })
        source.stream()
    } else {
        alert("Nincs megadva minden információ.")
    }
}
function ujra(){
    var button = document.getElementsByClassName('button');
    button.innerText = 'Új szöveg';
    document.querySelector('button').disabled = false; 
    button.innerHTML = 'ujra';
}
function bottomScroll(){
    textarea.scrollIntoView(false)
    textarea.scrollTo(0, textarea.scrollHeight)
}

function torles() {
    location.reload(true); 
}