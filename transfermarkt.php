<?php
if(isset($_GET['query']))
{
    $value = $_GET['query'];
    $value_codified = urlencode($value);
    $curl = curl_init();

    curl_setopt_array($curl, 
    [
        CURLOPT_URL => "https://transfermarket.p.rapidapi.com/search?query=" . $value_codified . "&domain=it",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: transfermarket.p.rapidapi.com",
		    "X-RapidAPI-Key: 2c07a93685msh0a8352a96992360p1eff81jsnacdc2ab30de8"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err)
    {
        echo "Curl Error #:" . $err;
    } else
    {
        echo $response;
    }
}
?>
