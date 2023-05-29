function check(event){
 	event.preventDefault();
	const text=document.getElementById("text").value;
        fetch("recensisci.php?text=" + text);// Ottiene i dati del modulo
	  recensioni();}


const formrec= document.forms["text_form"];
formrec.addEventListener('submit',check);
console.log(formrec);



function onResponserec(response) {
console.log(response);
 return response.json();}


function onJsonrec(json){
console.log('JSON ricevuto');
console.log(json);
}
  