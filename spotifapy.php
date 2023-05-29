<?php
$clientId = '62dff88510094fa4b4eede9a97457a47';
$clientSecret='740f88ff1e7b4f5fad4e3b6344c8b17f';
$playlistId = '13g8N0hgcBhyO0ceKW7OES';


$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $headers = array("Authorization: Basic ".base64_encode($clientId.":".$clientSecret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    
    $token = json_decode($result)->access_token;
https://api.spotify.com/v1/playlists/".$playlistId."/tracks"
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/playlists/".$playlistId."/tracks");
    $headers = array("Authorization: Bearer ".$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    header("Content-Type: application/json");
    
print_r($result);
?>