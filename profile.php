<?php

require_once "auth.php";
if(!$utente = checkAuth())
{
    header("Location: login.php");
    exit;
}

$username = $_SESSION['user_username'];
$email_utente = $_SESSION['user_email'];

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$id_utente = mysqli_real_escape_string($conn, $utente); 
if($conn)
{
    $query = "SELECT nome, cognome FROM utenti WHERE id = '$id_utente'";
    $res = mysqli_query($conn, $query);
    if ($res) 
    {
        $row = mysqli_fetch_assoc($res);
        $nome = $row['nome'];
        $cognome = $row['cognome'];
    }      
}
else
{
    echo "Impossibile connettersi al db: " . mysqli_connect_error($conn);
}

mysqli_close($conn);



?>


<!DOCTYPE html>
<html>

<head>
    <!-- Metadati della pagina web -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- Titolo della pagina web -->
    <title> Profilo </title>
    <!-- Collegamento al file CSS -->
    <link rel="stylesheet" href="stile_profile.css">
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
    <!-- Collegamento ai file JavaScript -->
    <script src="change_password.js" defer></script>
    <script src= "insert_object.js" defer></script>
</head>

<body>
    <div id="navbar">
        <h1> FANTACALCIO </h1>
    </div>
    <div id="search">
        <header>
            <nav>
                <div id="logo">
                    <img src="immagini/logo-fantacalcio.svg">
                </div>
                <div id="Menu">
                    <a href="home.php"> HOME </a>
                    <a href="fanpage.php"> FANPAGE </a>
                    <a href="logout.php"> LOGOUT </a>
                </div>
            </nav>
        </header>
        <section id="info-utente">
            <h1 class="titolo">Dati Account</h1>
            <div class="dati">
                <div class="item">
                    <label for="name">NOME:</label>
                    <input type="text" id="name" value="<?php echo $nome ?>" disabled>
                </div>
                <div class="item">
                    <label for="surname">COGNOME:</label>
                    <input type="text" id="surname" value="<?php echo $cognome ?>" disabled>
                </div>
                <div class="item">
                    <label for="username">USERNAME:</label>
                    <input type="text" id="username" value="<?php echo $username ?>" disabled>
                </div>
                <div class="item">
                    <label for="email">INDIRIZZO EMAIL:</label>
                    <input type="text" id="email" value="<?php echo $email_utente ?>" disabled>
                </div>
            </div>
            <h1 class="titolo">Password di Accesso</h1>
            <form action="change_password.php" id="modifica-password" method="POST">
                <div class="dati">
                    <div class="options">
                        <label>VECCHIA PASSWORD:</label>
                        <input type="password" name="old-password" id="old-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="options">
                        <label>NUOVA PASSWORD:</label>
                        <input type="password" name="new-password" id="new-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="options">
                        <label>RIPETI NUOVA PASSWORD:</label>
                        <input type="password" name="confirm-new-password" id="confirm-new-password">
                        <button type="button" class="bottone">MOSTRA</button>
                    </div>
                    <div class="submit-container">
                        <input type="submit" id="submit-password" value="MODIFICA PASSWORD">
                    </div>
                </div>
            </form>
        </section>
        <div id="sezione-articoli">
            <h1 class="titolo">
                Articoli Letti
            </h1>
            <div id="articoli-letti"></div>
        </div>
        <div id="sezione-calciatori">
            <h1 class="titolo">
                Calciatori Preferiti
            </h1>
            <div id="Calciatori-preferiti"></div>
        </div>

        <footer>
            <div id="flex-container-footer">
                <div id="blocco-immagine">
                    <img src='immagini/logo_footer.png' />
                </div>
                <div class="desc">
                    <h2><strong>
                            STRUMENTI
                    </h2></strong>
                    <a href="">
                        <li> Consigli sulle formazioni</li>
                    </a>
                    <a href="">
                        <li> Probabili formazioni </li>
                    </a>
                    <a href="">
                        <li> Voti Fantacalcio Serie A</li>
                    </a>
                    <a href="">
                        <li> Rigoristi Serie A</li>
                    </a>
                    <a href="">
                        <li> Euroleghe Fantacalcio</li>
                    </a>
                    <a href="">
                        <li> FantaAsta Desktop</li>
                    </a>
                    <a href="">
                        <li> FantaAsta Live</li>
                    </a>
                </div>
                <div class="desc">
                    <h2>LE APP DI FANTACALCIO</h2>
                    <li>
                        <strong>
                            Leghe Fantacalcio
                        </strong>
                    </li>
                    <li>
                        <strong>
                            Euroleghe Fantacalcio
                        </strong>
                    </li>
                    <li>
                        <strong>
                            Fantacalcio
                        </strong>
                    </li>
                    <li>
                        <strong>
                            Guida per L'asta perfetta
                        </strong>
                    </li>
                </div>
                <div class="desc">
                    <h2> <strong> PUBBLICITA' SU FANTACALCIO </strong></h2>
                    <div id="immagine-finale">
                        <a href="http://www.sky.it/info/sky-digital.html"><img src='immagini/sky.png'></a>
                    </div>
                </div>
            </div>
            <div id="subfooter">
                <span>
                    Musumeci Venerando Pio M-Z matricola: 1000015141
                </span>
                <span></span>
                <span>
                    Privacy | Cookie | Termini e Condizioni
                </span>
            </div>
        </footer>
</body>
</html>