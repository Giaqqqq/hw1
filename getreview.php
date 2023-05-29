<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","hw1");
    $review=array();
    $res=mysqli_query($conn,"SELECT viewer, text,time FROM recensioni ORDER BY time DESC LIMIT 10");
    while($row = mysqli_fetch_assoc($res))
      {
		if($row['viewer']==$_SESSION["username"]){$row['viewer']="tu";}
            $time= getTime($row['time']);
            $posts[] = array( 'username'=>$row['viewer'],'text'=> $row["text"], "time"=>"$time");
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($posts);
      exit; 

      function getTime($timestamp) {            
            $posted = strtotime($timestamp); 
            $diff = time() - $posted;           
            $posted = date('d/m/y', $posted);
    
            if ($diff /60 <1) {
                return intval($diff%60)." secondi fa";
            } else if (intval($diff/60) == 1)  {
                return "Un minuto fa";  
            } else if ($diff / 60 < 60) {
                return intval($diff/60)." minuti fa";
            } else if (intval($diff / 3600) == 1) {
                return "Un'ora fa";
            } else if ($diff / 3600 <24) {
                return intval($diff/3600) . " ore fa";
            } else if (intval($diff/86400) == 1) {
                return "Ieri";
            } else if ($diff/86400 < 30) {
                return intval($diff/86400) . " giorni fa";
            } else {
                return $posted; 
            }
        }
    
    
?>