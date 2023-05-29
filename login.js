function check(event) {
  event.preventDefault();
  const usr = document.getElementById("username");
  const psw = document.getElementById("password");
  console.log("sono entrato");
  
  if (usr.value.length == 0 || psw.value.length == 0) {
    err.textContent = "Non hai riempito tutti i campi\n";
    return;
  }
  
  const formData = new FormData(form); // Ottiene i dati del modulo
  
  fetch('mhw3.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (response.ok) {
        return response.text();
      } else {
        throw new Error('Errore nella richiesta');
      }
    })
    .then(data => {
      console.log(data); // Ottiene la risposta dal server
	err.textContent = data;
      selSpan(1);
    })
    .catch(error => {
      console.error('Si è verificato un errore:', error);
    });
}
//switch per vedere password in chiaro
function showPass(){
    const pass=document.getElementById('password');
    if(pass.type=== 'password'){
        pass.type='text';
    }
    else{
        pass.type='password';
    }
}

const form= document.forms["form"];
const err=document.getElementById('errorlog');
err.innerHTML='';
form.addEventListener('submit',check);
document.getElementById('showpass').addEventListener('click',showPass);