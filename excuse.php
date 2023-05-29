<?php
        
    	 // URL dell'API
	$url = 'https://excuser-three.vercel.app/v1/excuse';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
    		'Content-Type: application/json'
	]);

	$response = curl_exec($ch);
	if ($response === false) {
    	echo 'Errore nella richiesta cURL: ' . curl_error($ch);
	}
curl_close($ch);

$conn=mysqli_connect("localhost","root","","hw1");
$oggi=date("Y-m-d");
$dati=mysqli_real_escape_string($conn,$oggi);
$res=mysqli_query($conn,"SELECT Data FROM spettacoli WHERE Data>'$oggi'");
if ($res->num_rows>0) {
    	$concat=mysqli_fetch_assoc($res);
	}
else{
$concat=array("Data"=>"Non ci sono date programmate per adesso");}

$return=json_encode(array_merge(json_decode($response, true),$concat));

echo $return;
?>