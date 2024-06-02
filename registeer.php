<?php

require_once 'dbconfig.php';


// verifica della compilazione di tutti i campi
if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['conferma_password']))
{
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // password criptata
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // connessione al db
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    // Validazione dei campi 
    $errori = array();

    if(!preg_match("/^[a-zA-Z0-9_]+$/", $username))
    {
        $errori[] = "L'username può contenere solamente lettere, numeri e underscores.";
    }
    else 
    {
        // verifichiamo l'unicità nel database
        $query_username = "SELECT username FROM utenti WHERE username = '$username'";
        $risultato = mysqli_query($conn, $query_username);
        if(mysqli_num_rows($risultato) > 0)
        {
            $errori[] = "L'username che stai cercando di utilizzare è già stato usato.";
        }
    }

    // Serie di controlli sulla password

    if(strlen($password) < 8)
    {
        $errori[] = "La password deve contenere almeno 8 caratteri";
    }

    if(strcmp($password , $_POST['conferma_password'])!=0)
    {
        $errori[] = "Le due password non coincidono";
    }

    if(!preg_match("/^[a-zA-Z0-9_!@#$%^&*()-+=]+$/", $password))
    {
        $errori[] = "La password deve contenere almeno un carattere speciale";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errori[] = "L'indirizzo email non è valido";
    }
    else
    {
        $query_email = "SELECT EMAIL FROM UTENTI WHERE EMAIL = '$email'";
        $risultato_email = mysqli_query($conn, $query_email);
        if(mysqli_num_rows($risultato_email) > 0)
        {
            $errori[] = "L'indirizzo e-mail è già stato usato.";
        }
    }

    // INSERIMENTO NEL DATABASE

    if(count($errori) == 0)
    {
        $query_inserimento = "INSERT INTO utenti(nome, cognome, email, username, password) VALUES ('$nome','$cognome','$email','$username','$hashed_password')";
        $res = mysqli_query($conn, $query_inserimento);
        mysqli_close($conn);

        if($res)
        {
            $errori[] = "Utente registrato con successo. ";
            echo $errori;
            session_start();
            $_SESSION['user_username'] = $username;
            $_SESSION['user_email'] = $email;
            header('Location: home.php');
            exit;
        }
        else
        {
            $errori[] = "Errore nell'inserimento nel database.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <!-- Metadati della pagina web -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- Titolo della pagina web -->
    <title> Registrazione </title>
    <!-- Collegamento al file CSS -->
    <link rel="stylesheet" href="registrazione_login.css">
    <!-- Collegamento ai font di Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Utilizzo iconcina Fantacalcio -->
    <link rel="icon" href="favicon_fanta.png">
    <!-- Collegamento al file di controllo in Javascript -->
    <script src="registration_control.js" defer></script>
</head>
<body>
    <div>
        <form action="registeer.php" enctype="multipart/form-data" id="registrazione" method="post">
            <h1> Inserisci i tuoi dati per accedere alla Home </h1>
            <p><label for="nome">
                Nome
                <input type="text" id="nome" name="nome"></label></p>
            <p><label for="cognome">
                Cognome 
                <input type="text" id="cognome" name="cognome"></label></p>
            <p><label for="email">
                E-mail 
                <input type="text" id="email" name="email"></label></p>
            <p><label for="username">
                Username 
                <input type="text" id="username" name="username"></label></p>
            <p><label for="password">
                Password 
                <input type="password" id="password" name="password"></label></p>
            <p><label for="conferma_password">
                Conferma Password 
            <input type="password" id="conferma_password" name="conferma_password"></label></p>
            <input type="submit" id="Tasto_submit" value="Invia"> 
            <a href="login.php" id="utente_già_loggato">Sei già registrato?</a>
        </form>
    </div>
</body>
</html>