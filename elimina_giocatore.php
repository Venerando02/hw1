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

if(isset($_GET['q']))
{
    $giocatore = mysqli_real_escape_string($conn, $_GET['q']);
    $query_elimina = "DELETE FROM giocatori_preferiti WHERE utente = '$utente' AND giocatore = '$giocatore'";
    $res = mysqli_query($conn, $query_elimina);
    if($res)
    {
        echo json_encode(array('response' => true, 'id' => $giocatore ,'message' => 'Eliminazione della riga avvenuta con successo'));
    }
    else
    {
        echo json_encode(array('response' => false, 'message' => 'Errore durante l\'eliminazione della riga'));
    }
    mysqli_close($conn);
}
else
{
    echo json_encode(array('response' => false, 'message' => 'Parametro mancante nella richiesta'));
}

?>