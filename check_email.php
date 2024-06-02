<?php

require_once 'dbconfig.php';
if(!isset($_GET["q"])) {
    echo "Non dovresti essere qui";
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$email = mysqli_real_escape_string($conn, $_GET["q"]);

$query = "SELECT email FROM utenti WHERE email = '$email'";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$json_array_email = array('exists'=> mysqli_num_rows($res) > 0 ? true : false);

$json_array_email_encoded = json_encode($json_array_email);

echo $json_array_email_encoded;

mysqli_close($conn);
?>