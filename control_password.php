<?php

require_once "auth.php";

if(!$utente = checkAuth())
{
    header('Location: login.php');
    exit;
}

if(!isset($_GET['q']))
{
    echo json_encode(array('response' => false, 'message' => 'password non inserita'));
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$old_password = mysqli_real_escape_string($conn, $_GET['q']);

$query = "SELECT password FROM utenti WHERE id = '$utente'";

$res = mysqli_query($conn, $query);

if($res)
{
    $riga = mysqli_fetch_assoc($res);
    $password_hashata = $riga['password'];
    if(password_verify($old_password, $password_hashata))
    {
        echo json_encode(array('response' => true));
    }else{
    echo json_encode(array("response" => false, "message" => "password non coincidenti"));
}
}

mysqli_close($conn);

?>