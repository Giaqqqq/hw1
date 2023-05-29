<?php
session_start();
$error = array();
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])){
      	$conn=mysqli_connect("localhost","root","","hw1");
		$_POST["username"]=strtolower($_POST["username"]);
		
		if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            	$error[] = "Username non valido";
        	} 
		else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $res = mysqli_query($conn, "SELECT username FROM utenti WHERE username = '$username'");
            if (mysqli_num_rows($res) > 0) {
               	$error[] = "Username gia' utilizzato";
            }
        }


		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            	$error[] = "Email non valida";
      	} 
		else {
           		$email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            	$res = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$email'");
            	if (mysqli_num_rows($res) > 0) {
            		$error[] = "Email gia' utilizzata";
            	}
        	}
	


		if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {
            $error[] = "Lunghezza password non adatta";
       	}
		if(!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $_POST["password"])){$error[] = "password non presenta caratteri speciali";}
		if(!preg_match('/[A-Z]/',$_POST["password"])){$error[] = "password non presenta lettere maiuscole";}
		if(!preg_match('/[0-9]/',$_POST["password"])){$error[] = "password non presenta numeri";}
		if(!preg_match('/[a-z]/',$_POST["password"])){$error[] = "password non presenta lettere minuscole";}
	

      	if (count($error) == 0) {
            	$password = mysqli_real_escape_string($conn, $_POST['password']);
            	$password = password_hash($password, PASSWORD_BCRYPT); 
            	$query = "INSERT INTO utenti(username, password, email) VALUES('$username', '$password','$email')";
           		if (mysqli_query($conn, $query)) {
              		$_SESSION["username"] = $_POST["username"];
                		mysqli_close($conn);  
				exit;
           		}
			else {
                		$error[] = "Errore nella connessione al Database";
                		echo"query non riuscita";
		    		mysqli_close($conn);
            	}
		}
		else{
			print_r(json_encode($error));
	 		exit;
		}
        
        
}

if(isset($_POST["username"]) && isset($_POST["password"])){
        $conn=mysqli_connect("localhost","root","","hw1");
	  $_POST["username"]=strtolower($_POST["username"]);
        $username=mysqli_real_escape_string($conn,$_POST["username"]);
        $password=mysqli_real_escape_string($conn,$_POST["password"]);
        $query="SELECT username,password FROM utenti WHERE username= '$username'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
        	$entry = mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $entry['password'])){
            	$_SESSION["username"]=$username; 
            	mysqli_free_result($res);
            	mysqli_close($conn);
            }
            else {print_r("username o password non corretti"); exit;}
        }
        else {print_r("username o password non corretti"); exit;}
exit;
}
?>


<html>
  <head>
    <title>
      hw1
    </title>
	<link href="mhw3.css" rel="stylesheet" type="text/css">
	<link href="provided-style.css" rel="stylesheet" type="text/css">
	<link rel='stylesheet' href='login.css'>
      <script src='login.js' defer></script>
	<script src='recensisci.js' defer></script>
	<script src='signin.js' defer> </script>
	<script src="script.js" defer="true"></script>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200&display=swap" rel="stylesheet">
	<?php
        $conn=mysqli_connect("localhost","root","","hw1");
    	?>
  </head>
  

  <body> 
      <header>
        <div id="overlay"></div>
        <div id="link"> 
	    <nav>
          <span data-request-id="Home"> Home</span>
	    <span data-request-id="progetto"> Il Progetto </span>
          <span data-request-id="Canzoni"> Le nostre canzoni </span>
          <span data-request-id="Recensioni"> Recensioni </span>
	    </nav>

	    <div id="dropdown">
  	    	<img src="menu.png">
  	    	<div id="dropdown-content">
          		   <span data-request-id="Home"> Home</span>
	    		   <span data-request-id="progetto"> Il Progetto </span>
          		   <span data-request-id="Canzoni"> Le nostre canzoni </span>
          		   <span data-request-id="Recensioni"> Recensioni </span>
  		</div>
	    </div>
	    
	 </div>

    
    	 <div id="scritte">
      	<h1> 7even the musical  </h1> 
     		<em> un progetto indipendente </em>
    	 </div> 

      
     	 <div id="social">
       	<nav>
         	 <a id="insta" href="https://www.instagram.com/7even_musical/"> <img src="instagram.png"></a>
         	 <a id="Fb" href="https://www.facebook.com/profile.php?id=100090760561071"> <img src="facebook.png"></a>
         	 <a id="whatsapp"> <img src="whatsapp.png"> </a>
       	</nav>
      </div> 
     </header>

	
<div id="intestazione"> 
	<h1> </h1>
	<h5> </h5>
</div>

    <div id="contenuti">

    </div>

<div class="hidden" id="login">
        <div class="card">
            <div class="card-image">	
                <h2 class="card-heading">
                    Get in
                    <p class="small">Accedi al tuo account</p>
                </h2>
            </div>
            <form class="card-form" id="form" name="form" method="post" autocomplete="off">
                <div class="input">
                    <input type="text" class="input-field"  id= "username" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?> >
                    <label class="input-label"> Username</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" id="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];}?> >
                    <label class="input-label">Password</label>
                    <img class="showpass" id="showpass" src="eye.png">
                </div>
                <div class="action">
                    <input type="submit" class="action-button"></button>
                </div>
            </form>
            <div class="er" id="errorlog"></div>
            <div class="card-info">
                <p>Se non possiedi ancora un account effettua <div id="registrati">QUI</div> la tua registrazione</p>
            </div>
        </div>
    </div>


<div class="hidden" id="reg">
        <div class="card">
           	
                <h2 class="card-heading">
                    Sign in
                    <p class="small">Crea il tuo account</p>
                </h2>
           
            <form class="card-form" id="formreg" name="formreg" method="post" autocomplete="off">
                <div class="input username">
                    <input type="text" class="input-field" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <label class="input-label"> Username</label>
                    <span></span>
                </div>
                <div class="input email">
                    <input type="text" class="input-field" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <label class="input-label">Email</label>
                    <span></span>
                </div>
                <div class="input password">
                    <input type="password" class="input-field" id="passwordreg" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <label class="input-label">Password</label>
                    <img class="showpass" id="showpass2" src="eye.png">
                    <span></span>
                </div>
                <div class="action">
                    <input type="submit" class="action-button"></button>
                </div>
            </form>
            <div class="card-info">
		     <div class="er" id="error">
    </div>
            <p>Registrandoti qui stai accettando i nostri <a href="#">Termini e Condizioni</a></p>
            <p>Se invece hai già un account <div id="logga">Accedi</div></p>
            </div>
            
        </div>
    </div>
<div class="hidden" id="project"> <h1> Guarda come è bello, questo progetto </h1> <p> 7even:The musical, nasce dalla esperienza pregressa di alcuni membri del cast alla GMG,Giornata Mondiale della gioventù, In cui hanno sperimentato un vero incontro con Dio e voglio permettere anche ad altri di poter effettuare la stessa esperienza. Perciò nasce lo spettacolo come metodo di autofinanziamento.  </div>



<div class="hidden" id="recensisci">
<div class="card">
            <form name='text_form' method='post' autocomplete="off">
                    <input id="text" type='textarea' name='text' placeholder="Scrivi il tuo post..">
                <div class="action">
                    <input type='submit' class="action-button">
                </div>
            </form>
        </div>
</div>


<div id="stampate">

</div>

  	
<div class="hidden" id="Slogga"> Esci =) </div>


    <div id="footer">
 Realizzato da Giulio Giaquinta 1000016440
    </div>
  </body>
</html>