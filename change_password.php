<?php

require_once "auth.php";
if(!$utente = checkAuth())
{
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

update_password();

function update_password()
{
    if(isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-new-password']))
    {
        global $dbconfig, $utente;
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $userid = mysqli_real_escape_string($conn, $utente);
        $new_password = mysqli_real_escape_string($conn, $_POST['new-password']);
        $confirm_new_password = mysqli_real_escape_string($conn, $_POST['confirm-new-password']);
        if ($new_password !== $confirm_new_password)
        {
            echo json_encode(array('update' => false, 'message' => 'Le nuove password non coincidono.'));
            mysqli_close($conn);
            exit;
        }
        $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
        $query_update_password = "UPDATE utenti SET password = '$new_password_hashed' WHERE id = '$userid'";
        $res = mysqli_query($conn, $query_update_password);

        if($res)
        {
            echo json_encode(array('update' => true, 'message' => 'password modificata con successo!'));
            header('Location: profile.php');
        }
        else
        {
            echo json_encode(array('update' => false, 'message' => 'password non modificata! Errore: ' . mysqli_error($res)));
            header('Location: profile.php');
        }
    }
    else
    {
        echo json_encode(array('update' => false, 'message' => 'Impossibile modificare la password, non hai compilato tutti i campi'));
        header('Location: profile.php');
    }
    mysqli_close($conn);
}
?>