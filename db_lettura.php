<?php

require_once 'auth.php';

if (!$user = CheckAuth()) {
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) 
{
    die
    (json_encode(array("success" => false, "message" => "Connessione fallita: " . mysqli_connect_error())));
}

// sanificazione dei dati per evitare sql injection
$utente = mysqli_real_escape_string($conn, $user);
$url_articolo = mysqli_real_escape_string($conn, $_POST['url_articolo']);
$titolo_articolo = mysqli_real_escape_string($conn, $_POST['titolo_articolo']);
$descrizione_articolo = mysqli_real_escape_string($conn, $_POST['descrizione_articolo']);
$immagine_articolo = mysqli_real_escape_string($conn, $_POST['immagine_articolo']);

// Creazione del contenuto JSON
$contenuto_json = json_encode(array(
    'url' => $url_articolo,
    'title' => $titolo_articolo,
    'desc' => $descrizione_articolo,
    'img' => $immagine_articolo
));
$contenuto_json = mysqli_real_escape_string($conn, $contenuto_json);

// Verifica se l'articolo è già memorizzato
$query_exist = "SELECT * FROM lettura WHERE utente = '$utente' AND contenuto = '$contenuto_json'";
$result = mysqli_query($conn, $query_exist);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(array('success' => true, 'message' => "Articolo già memorizzato"));
} else {
    // Inserisci l'articolo nel database
    $query = "INSERT INTO lettura (utente, contenuto) VALUES ('$utente', '$contenuto_json')";
    if (mysqli_query($conn, $query))
    {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => "Errore durante l'inserimento dei dati nel db: " . mysqli_error($conn)));
    }
}

// Chiudi la connessione
mysqli_close($conn);

?>
