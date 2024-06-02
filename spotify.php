<?php
require_once 'auth.php';

if(!$utente = checkAuth()) {
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

spotify();

function spotify() {
    $client_id = '90a1585f134a4e93a7472db48dc50bb1';
    $client_secret = 'fbada056cfd24061ad1f5277b2f827be';

    // Ottenere il token di accesso
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo json_encode(array('error' => curl_error($ch)));
        curl_close($ch);
        exit;
    }

    $token = json_decode($response, true);
    curl_close($ch);    

    if(!isset($token['access_token'])) {
        echo json_encode(array('error' => 'Failed to obtain access token'));
        exit;
    }

    // Cercare l'album
    $url = 'https://api.spotify.com/v1/search?type=album&q=Fantacalcio';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 

    $res = curl_exec($ch);
    if(curl_errno($ch)) {
        echo json_encode(array('error' => curl_error($ch)));
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    echo $res;
}
?>
