<?php

require_once "auth.php";

if(!$utente = checkAuth()){
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $utente);

$id_album = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$artista = mysqli_real_escape_string($conn, $_POST['artista']);
$immagine = mysqli_real_escape_string($conn, $_POST['immagine']);
$data_rilascio = mysqli_real_escape_string($conn, $_POST['data']);
$url = mysqli_real_escape_string($conn, $_POST['url']);



$query_inserimento = "INSERT INTO albums(id, nome, artista, immagine, data_rilascio, url) VALUES ('$id_album','$nome','$artista','$immagine','$data_rilascio','$url')";


$query_verifica = "SELECT * FROM albums WHERE id = '$id_album'";
$res_verifica = mysqli_query($conn, $query_verifica);

if (mysqli_num_rows($res_verifica) > 0) {
    echo json_encode(array('response' => false, 'message' => 'Album già presente nel database.'));
} else {
$res = mysqli_query($conn, $query_inserimento);
if($res)
{
    echo json_encode(array('response' => true, 'message' => 'Inserimento avvenuto con successo!'));
}
else
{
    echo json_encode(array('response' => false));
}
mysqli_close($conn);
}
?>