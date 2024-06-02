<?php
require_once "auth.php";

// Verifica autenticazione utente
if (!$utente = CheckAuth()) {
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(array("success" => false, "message" => "Errore di connessione: " . mysqli_connect_error()));
    exit;
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome_g']);
$immagine_giocatore = mysqli_real_escape_string($conn, $_POST['img_p']);
$immagine_club = mysqli_real_escape_string($conn, $_POST['img_c']);
$nome_club = mysqli_real_escape_string($conn, $_POST['club']);
$luogo_n = mysqli_real_escape_string($conn, $_POST['p_birth']);
$compleanno = mysqli_real_escape_string($conn, $_POST['birthday']);
$eta = mysqli_real_escape_string($conn, $_POST['age']);
$numero_maglia = mysqli_real_escape_string($conn, $_POST['number']);
$goal = mysqli_real_escape_string($conn, $_POST['goal']);
$valore_di_mercato = mysqli_real_escape_string($conn, $_POST['value']);
$posizione = mysqli_real_escape_string($conn, $_POST['pos']);

// Creazione dell'array giocatore
$giocatore = json_encode(array(
    "name" => $nome,
    "immagine_giocatore" => $immagine_giocatore,
    "immagine_club" => $immagine_club,
    "nome_club" => $nome_club,
    "luogo_nascita" => $luogo_n,
    "compleanno" => $compleanno,
    "eta'" => $eta,
    "numero_maglia" => $numero_maglia,
    "goals" => $goal,
    "valore" => $valore_di_mercato,
    "posizione" => $posizione
));

$giocatore_ = mysqli_real_escape_string($conn, $giocatore);

$query = "SELECT * FROM giocatori_preferiti WHERE giocatore = '$id' AND utente = '$utente'";
$res = mysqli_query($conn, $query);
if (!$res) {
    echo json_encode(array("response" => false, "message" => "Errore nella query: " . mysqli_error($conn)));
    exit;
}

if (mysqli_num_rows($res) > 0) {
    echo json_encode(array("response" => false, "message" => "Giocatore gia' esistente"));
}
else 
{
    $query_inserimento = "INSERT INTO giocatori_preferiti (utente, giocatore, info_giocatore) VALUES ('$utente', '$id', '$giocatore_')";
    $result = mysqli_query($conn, $query_inserimento);
    if ($result) {
        echo json_encode(array("response" => true, "message" => "Inserimento avvenuto con successo"));
    } else {
        echo json_encode(array("response" => false, "message" => "Errore nell'inserimento: " . mysqli_error($conn)));
    }
}

mysqli_close($conn);
?>
