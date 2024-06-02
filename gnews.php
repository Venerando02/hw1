<?php
if (isset($_GET['query']))
{
    $query = urlencode($_GET['query']);
    $apikey = '705faec60d22bdd88aced263448b7380';

    $url = "https://gnews.io/api/v4/search?q=$query&lang=en&country=us&max=10&apikey=$apikey";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);
    header('Content-Type: application/json');
    echo $data;
} else 
{
    echo json_encode(['error' => 'No query parameter provided.']);
}
?>