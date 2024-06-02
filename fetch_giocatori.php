<?php

require_once "auth.php";

if (!$utente = checkAuth()) {
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$userid = mysqli_real_escape_string($conn, $utente);

$query_giocatori = "SELECT giocatore , info_giocatore FROM giocatori_preferiti WHERE utente = '$userid' LIMIT 9";
$res = mysqli_query($conn, $query_giocatori);

if ($res) {
    $giocatoriRes = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $giocatoriRes[] = array('id_player' => $row['giocatore'] , 'giocatore' => json_decode($row['info_giocatore']));
    }
    echo json_encode($giocatoriRes);
} else {
    echo json_encode(array('Error' => mysqli_error($conn)));
}

mysqli_close($conn);
?>
