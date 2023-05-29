<?php
session_start();
    if(isset($_SESSION["username"])){
            $conn = mysqli_connect("localhost", "root", "", "hw1");
		$username=$_SESSION["username"];
            mysqli_query($conn, "DELETE FROM recensioni WHERE viewer='$username'");
            mysqli_close($conn);
      }

