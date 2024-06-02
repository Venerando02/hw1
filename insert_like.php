<?php

require_once "auth.php";

if(!$utente = checkAuth())
{
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

insert_like();

function insert_like()
{
    global $dbconfig;
    $utente = checkAuth();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    if($conn)
    {
        $userid = mysqli_real_escape_string($conn, $utente);

        $id_album = mysqli_real_escape_string($conn, $_POST['id']);
        
        $query_verifica = "SELECT * FROM LIKES WHERE utente = '$userid' AND album = '$id_album'";
        $verifica = mysqli_query($conn, $query_verifica);
        if(mysqli_num_rows($verifica)>0)
        {
            $numero_like = "SELECT COUNT(*) AS likes_totali FROM LIKES WHERE album = '$id_album'";
            $res = mysqli_query($conn, $numero_like);
            $row = mysqli_fetch_assoc($res);
            $likes_totali = $row['likes_totali'];
            echo json_encode(array('response' => false, 'numero_like'=> $likes_totali, 'message' => 'like già inserito'));
            exit;
        }

        $query = "INSERT INTO LIKES(utente, album) VALUES ('$userid','$id_album')";


        $res_insert = mysqli_query($conn, $query);

        if($res_insert)
        {
            $numero_like = "SELECT COUNT(*) AS likes_totali FROM LIKES WHERE album = '$id_album'";
            $res = mysqli_query($conn, $numero_like);
            $row = mysqli_fetch_assoc($res);
            $likes_totali = $row['likes_totali'];
            echo json_encode(array('response' => true, 'numero_like'=> $likes_totali, 'message' => 'like inserito'));
        }
        else
        {
            echo json_encode(array('response' => false, 'message' => 'like non inserito'));
        }
        mysqli_close($conn);
    }else
    {
        echo json_encode(array('response' => false, 'message' => 'non connesso'));
    }
}
?>