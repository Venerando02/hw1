<?php
include 'auth.php';

// verifica che l'utente sia già loggato
if(CheckAuth())
{
    header('Location: home.php');
    exit;
}

if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
    
    // connessione al db
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $query = "SELECT * FROM utenti WHERE username = '".$username."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0)
    {
        $entry = mysqli_fetch_assoc($res);
        if (password_verify($_POST['password'], $entry['password']))
         {
            $_SESSION["user_username"] = $entry['username'];
            $_SESSION["user_id"] = $entry['id'];
            $_SESSION["user_email"] = $entry['email'];
            header("Location: home.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        }
    }
    //Se l'utente non è stato trovato o la password non ha passato la verifica 
    $error = "Username o Password non corretta.";
} 
else if (isset($_POST["username"]) || isset($_POST["password"])) 
{
    // Se solo uno dei due è impostato 
    $error = "Inserisci username e password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Metadati della pagina web -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- Titolo della pagina web -->
    <title> Log-in </title>
    <!-- Collegamento al file CSS -->
    <link rel="stylesheet" href="registrazione_login.css">
    <!-- Collegamento ai font di Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Utilizzo iconcina Fantacalcio -->
    <link rel="icon" href="favicon_fanta.png">
    <!-- Collegamento al file di controllo in Javascript -->
    <script src="control_login.js" defer></script>
</head>
<body>
    <div>
    <form action = "login.php" id="login" method = "post" name="login">
        <h1> Inserisci i tuoi dati per accedere alla Home </h1>
        <p><label>Username <input type="text" name="username"></label></p>
        <p><label>Password <input type="password" name="password"></label></p>
        <?php
        if (isset($error)) 
        {
            echo "<p class='Error'>$error</p>";
        }    
        ?>
        <input type="submit" id="Tasto_submit" value="Accedi"> 
        <a href="registeer.php" id="utente_già_loggato">Non sei registrato?</a>
    </form>
    </div>
</body>
</html>