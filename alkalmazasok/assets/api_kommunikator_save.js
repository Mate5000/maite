
// const parameterek = document.getElementById("program_parameterek");
// const nyelv = document.getElementById("nyelv");

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

var communicator = ''
document.querySelector('button').onclick = () => {
    betoltes2.style.display = "block";
    document.querySelector('button').disabled = true; 
    // textarea.value = '';
    document.getElementById('betoltes').disabled = true; 
    // var parancs = "#/usr/bin/env python3\n" + document.getElementById("nyelv").value + " program, details: " + document.getElementById("program_parameterek").value + " \n" + document.getElementById("nyelv").value + " language code after this: \n#!/usr/bin/env python\n"
    // var parancs = "write an " + document.getElementById("nyelv").value + " program, details: " + document.getElementById("program_parameterek").value + " \n" + document.getElementById("nyelv").value + " language code after this: \n#!/usr/bin/env python\n"
    // var parancs = "// /usr/bin/env python3\n" + "// in " +  document.getElementById("nyelv").value + " language, create: "+ document.getElementById("program_parameterek").value + " \n" + "\n//next the code:\n"
    // var reszletek1 = "te egy program író gép vagy, csak programkódot írhatsz le, mást nem.  \nfeladatod: írj "  +  document.getElementById("nyelv").value + " nyelven egy ilyen programot: "+ document.getElementById("program_parameterek").value + "\n kód (csak a kódot): "
    var alkalmazas = document.getElementById("app_id").value
    var nyelv = document.getElementById("nyelv").value
    var parameterek = document.getElementById("szoveg").value
    // var reszletek = reszletek1
    if(parameterek != ''){
        bottomScroll();
        // (textarea.innerHTML == '') ? communicator = 'You: ' : communicator = '\n\nYou: '
        // textarea.innerHTML += communicator + prompt
        // use SSE to get server Events

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
                    console.log('Kérés befejezve.');
                }
            }
        })
        source.stream()
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

