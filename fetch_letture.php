<?php

require_once "auth.php";
if(!$utente = checkAuth())
{
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$userid = mysqli_real_escape_string($conn, $utente);

$query_letture = "SELECT id_articolo, contenuto FROM lettura WHERE utente = '$userid' LIMIT 9";

$res = mysqli_query($conn, $query_letture);

if($res)
{
    $articoli = array();
    while($riga = mysqli_fetch_assoc($res))
    {
        $articoli[] = array('id' => $riga['id_articolo'], 'lettura' => json_decode($riga['contenuto']));
    }
    echo json_encode($articoli);
}
else
{
    echo json_encode(array('Error' => mysqli_error($conn)));
}
mysqli_close($conn);

?>