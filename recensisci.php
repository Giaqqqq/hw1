<?php 
session_start();
if(isset($_GET["text"]))
      {
            $conn = mysqli_connect("localhost", "root", "", "hw1");
            $text = mysqli_real_escape_string($conn, $_GET["text"]);
            $viewer=mysqli_real_escape_string($conn, $_SESSION["username"]);
            $res=mysqli_query($conn,"SELECT * FROM utenti WHERE username='$viewer'");
            $row=mysqli_fetch_assoc($res);
            echo(mysqli_query($conn, "INSERT INTO recensioni (viewer,text) VALUES ('$viewer','$text')" ));
            mysqli_close($conn);
      }

?>