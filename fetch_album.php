<?php

require_once "auth.php";

if (!$utente = checkAuth()) {
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $utente);

$query = "SELECT * FROM albums LIMIT 6";
$res = mysqli_query($conn, $query);

if ($res) {
    $albums = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $albums[] = array(
            'id' => $row['id'],
            'nome' => $row['nome'],
            'artista' => $row['artista'],
            'immagine' => $row['immagine'],
            'data' => $row['data_rilascio'],
            'url' => $row['url']
        );
    }
    echo json_encode(array('response' => true, 'albums' => $albums));
} else {
    echo json_encode(array('response' => false, 'message' => 'Errore nella query.'));
}

mysqli_close($conn);
?>
