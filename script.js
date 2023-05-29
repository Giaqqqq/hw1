//definiamo
const prosegui=0;
const griglia=document.querySelector('#contenuti');
const intestazione=document.querySelector('#intestazione');
const reg=document.querySelector('#registrati');
const log=document.querySelector('#logga');
const slog=document.querySelector('#slogga');
const rec=document.querySelector('#recensisci');
const rev=document.querySelector('#stampate');
const container=document.querySelectorAll('.hidden');
const prog=document.querySelector("#project");
const boxes = document.querySelectorAll('span');
let box=0;
let isLoading=false;
let token;


//aggiungo i listener dei "pulsanti"
slog.addEventListener('click',slogga);
reg.addEventListener('click',register);
log.addEventListener('click',login);

//chiamo due funzioni che popolano la home
home();
show();

//aggiungo i listener per le varie pagine
for (const top of boxes)
{
  top.addEventListener('click', selSpan)
}


//funzione in cui gestisco la scelta delle pagine
function selSpan(event){
  	if (isLoading) {
    		return; // Se una richiesta è già in corso, ignora il click
  	}
	//nel caso in cui viene chiamata direttamente da login.php prendo dal container la pagina
	if (event == 1){
		box=document.querySelector(".container");
		console.log(box);
	} 
	else{
		box=event.currentTarget;
	}
	//cancello e/o nascondo le parti generate dinamicamente
	griglia.innerHTML=" "; 
	rev.innerHTML="";
	container[0].classList.remove("container");
	container[1].classList.remove("container");
	prog.classList.add("hidden");
	rec.classList.add("hidden");
	intestazione.childNodes[1].innerHTML=" ";
	intestazione.childNodes[3].innerHTML=" ";

	
	//seleziono la pagina
	switch(box.dataset.requestId){

		case 'Canzoni':
		//controllo se siamo loggati o meno nel caso negativo mando alla registrazione o al log
			fetch('check.php').then(response => response.text()).then(data => {if(data==0){if(box.id=="reg"){
			register();
			throw new Error('registrati');}

		else{
			login();
			throw new Error('devi accedere');
    		} } else{canzoni();}});
			break;
		case 'Home':
			//non serve essere loggati per vedere la home
			home();
			break;
		case 'Recensioni':
			//stessa cosa di prima
			fetch('check.php').then(response => response.text()).then(data => {if(data==0){if(box.id=="reg"){
			register();
			throw new Error('registrati');}

		else{
			login();
			throw new Error('devi accedere');
    		}} else{recensioni();}});
			break;
		case 'progetto':
			//non serve essere loggati per vedere di cosa parla il progetto
			progetto();
			break;

		default: 
			console.log("come hai fatto"); 
			break;

	}
	
}



function onResponsePlay(response){
 	return response.json();
}





function onJsonPlay(json) {
  //carico le canzoni
  console.log('JSON ricevuto');
  console.log('Potrebbe essere lento,molto lento, ma parte parte');
  let frame;
  intestazione.childNodes[1].textContent="Le nostre canzoni";
  intestazione.childNodes[3].textContent="tutte reinterpretate dai nostri Artisti";
  for (const element of json.items){
  	frame = document.createElement('iframe');
  	frame.setAttribute('src',"https://open.spotify.com/embed/track/"+ element.track.id);
  	frame.setAttribute('frameborder',"0");
  	frame.setAttribute('allow',"encrypted-media"); //se no mi genera una serie di warning
  	intestazione.appendChild(intestazione.childNodes[1]);
  	intestazione.appendChild( intestazione.childNodes[3]);
  	griglia.appendChild(frame);
	show();
	
  }
  isLoading = false; 
}





function onExcuseResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}


function onExcuseJson(json){
	console.log(json);
 	intestazione.childNodes[1].textContent=json[0].excuse;
 	intestazione.childNodes[3].textContent="è una scusa che sicuramente potresti utilizzare per altre occasioni, ma 	non per 7even: The musical, ti aspettiamo =)";
	const div = document.createElement('div');
	div.classList.add("Spettacolo");
	div.textContent="Il prossimo spettacolo sarà: "+json["Data"];
	griglia.appendChild(div);
	console.log(div);
}




function login(){
//mostro il login
intestazione.childNodes[1].textContent="Accedi per questo contenuto";
container[1].classList.remove("container");
container[0].classList.add("container");
container[0].dataset.requestId=box.dataset.requestId;
}


function register(){
//mostro la registrazione
intestazione.childNodes[1].textContent="Registrati";
container[0].classList.remove("container");
container[1].classList.add("container");
container[1].dataset.requestId=box.dataset.requestId;
}


function slogga(){
//esco
fetch("logout.php");
slog.classList.add("hidden");
rev.innerHTML="";
home();
} 


       

function show(){
//se sono loggato mi appare il "pulsante" Esci =)
fetch('check.php')
  .then(response => response.text())
  .then(data => {
	console.log(data);
    if (data === '1') {
     slog.classList.remove("hidden");
    }
  });
}




function home(){	
griglia.innerHTML=" "; 
fetch("excuse.php").then(onExcuseResponse).then(onExcuseJson);}




function canzoni(){fetch("spotifapy.php").then(onResponsePlay).then(onJsonPlay);}




function recensioni(){
fetch("getreview.php").then(onResponsereview).then(onJsonreview);
}




function onResponsereview(response) {
  rec.classList.remove("hidden")
  console.log('Risposta ricevuta');
  return response.json();
}




function onJsonreview(json) {
  //stampo tutte le recensioni
  rev.innerHTML="";
  console.log('Risposta ricevuta');
  console.log(json);
  for (let row in json) {
  	console.log(row);
  	let rev1=document.createElement('div');
  	let username=document.createElement('div');
  	let text=document.createElement('div');
  	let time=document.createElement('div');
  	username.textContent=json[row].username + " ";
  	username.classList.add("username");
  	text.classList.add("text");
  	time.classList.add("time");
  	text.textContent=json[row].text + " ";
  	time.textContent=json[row].time + " ";
  	rev1.appendChild(username);
  	rev1.appendChild(text);
  	rev1.appendChild(time);
  	rev1.classList.add("review");
  	if(json[row].username=="tu"){
		//se la recensione è la tua non viene iscritto l'username ma tu e aggiungo il "pulsante" per eliminare
  		let del=document.createElement('div');
  		del.textContent="cancella recensione";
  		del.addEventListener('click',elimina);
  		del.classList.add("delete");
  		rev1.appendChild(del);
  		rec.classList.add("hidden");
	}
 	rev.appendChild(rev1);
   }
}


function elimina(){
fetch("delreview.php");
recensioni();
}


function progetto(){
prog.classList.remove("hidden");
}












