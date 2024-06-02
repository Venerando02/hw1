<?php

require_once 'dbconfig.php';

// verifico se è stato chiamato il parametro get

if(!isset($_GET['q']))
{
    echo "Non dovresti essere qui.";
    exit();
}

// vado a specificare che voglio come contenuto un json
header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

$username = mysqli_real_escape_string($conn , $_GET['q']);

$query = "SELECT username FROM utenti WHERE username = '$username'";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$json_array = array('exists'=>mysqli_num_rows($res) > 0 ?true : false );

$json_encode = json_encode($json_array);

echo $json_encode;

mysqli_close($conn);
?>