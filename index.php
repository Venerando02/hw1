<!DOCTYPE html>
<html>
<head>
    <!-- Metadati della pagina web -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- Titolo della pagina web -->
    <title> Fantacalcio </title>
    <!-- Collegamento al file CSS -->
    <link rel="stylesheet" href="index.css">
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
    <script src="index.js" defer></script>
</head>

<body>
    <nav id="topnavbar">
        <h1 id="title">
            FANTACALCIO
        </h1>
    </nav>
    <header></header>
    <section>
        <div id="supernav"></div>
        <nav id="subnavbar">
            <div id="flex-container">
                <div id="menu-tendina">
                    <img src="immagini/menu.png" />
                    <div id="menu_item" class="hidden">
                        <a href="login.php"> LOGIN </a>
                        <a href="fanpage.php"> FAN CLUB FANTACALCIO </a>
                        <a href="profile.php"> PROFILO </a>  
                    </div>
                </div>
                <a href="login.php" id="link2"> ACCEDI </a>
            </div>
        </nav>
        <div class="welcome-box">
            <h1>LEGHE FANTACALCIO</h1>
            <img src='immagini/image1.png' id="blocco-iniziale" />
            <h5> IL FANTASY GAME UFFICIALE DELLA SERIE A TIM </h5>
            <div class="gioca">
                <h4> INIZIA A GIOCARE! </h4>
            </div>
            <div class="flex-benvenuto">
                <div class="crealega">
                    <h6> VUOI REGISTRARTI AL SITO PER AVERE INFO <br> SULLE NEWS DI LEGATE AL CALCIO?</h6>
                    <a href="registeer.php" id="link3"> REGISTRATI </a>
                    <p>e invita i tuoi amici!</p>
                </div>
                <div class="uniscitilega">
                    <h6> ENTRA NELLA COMMUNITY PER AVERE INFO SUI CALCIATORI DI TUTTO <br> IL MONDO </h6>
                    <a href="fanpage.php" id="link4"> FANPAGE </a>
                    <p> e coinvolgi i tuoi amici! </p>
                </div>
            </div>
        </div>
        <div id="Menu">
            <div id="Menu-Container">
                <button id="b1" class="bottone"> HOME </button>
                <button id="b2" class="bottone"> INFO GIOCO </button>
                <button id="b3" class="bottone"> INFO MANTRA EXPERIENCE </button>
            </div>
            <div id="flex-colonne">
                <div id="colonna1">
                    <div id="f-container1">
                        <div id="col1">
                            <h4>Il Fantacalcio in 2 modalità</h4>
                            <div id="FANTA-CLASSIC">
                                <div class="classic">
                                    <span>CLASSIC</span>
                                </div>
                                <div class="p">
                                    Il classico gioco del fantacalcio, arricchito dalla possibilità di giocare con
                                    moduli personalizzabili
                                    per Lega e di impostare numero di panchinari e ordine panchina secondo le proprie
                                    preferenze,
                                    insieme a centinaia di altre opzioni!
                                </div>
                            </div>
                            <div id="FANTA-MANTRA">
                                <div class="mantra">
                                    <span>MANTRA</span>
                                </div>
                                <div class="p">
                                    Un'esperienza di gioco coinvolgente e divertente con calciatori polivalenti,
                                    specializzazione dei ruoli e moduli "reali" con enfatizzazione della componente
                                    tattico-strategica.
                                    Avanzato meccanismo di sostituzioni.
                                </div>
                            </div>
                        </div>
                        <div id="col2">
                            <h5>OPZIONI SU MISURA PER LA TUA LEGA!</h5>
                            <h3>CARATTERISTICHE DEL GIOCO</h3>
                            <li>Competizioni multiple</li>
                            <li>Competizioni a Calendario, Formula 1, Coppe, Ognuno per sè, Scontri Diretti</li>
                            <li>Calendario personalizzabile</li>
                            <li>Gestione mercati online con aste e buste</li>
                            <li>Scambi tramite messaggi privati</li>
                            <li>Documenti di lega</li>
                            <li>Amministratori delegati</li>
                            <li>Cambio partecipanti</li>
                            <li>Classifiche di giornata</li>
                            <li>Calcolo con voti e medie voti</li>
                        </div>
                    </div>
                    <div id="pubblicita">
                        <div id="mistery-box">
                            <h1> Clicca Mago Merlino per conoscere la sua previsione <br> sull'esito della tua giornata
                                al Fantacalcio! </h1>
                            <img src='immagini/magomerlino.png' />
                        </div>
                        <div id="win-box" class="hidden">
                            <img src="immagini/mago.jpeg" />
                        </div>
                        <div id="lose-box" class="hidden">
                            <img src="immagini/mago2.jpg" />
                        </div>
                    </div>
                    <div id="regole">
                        <div id="box">
                            <div class="riga">
                                <div class="immagine">
                                    <img src='immagini/dispositivi.png'>
                                    <p>
                                        Uno spazio esclusivo solo per la tua Lega per giocare con i tuoi amici da
                                        desktop, web mobile, app iOS e Android
                                    </p>
                                </div>
                                <div class="immagine">
                                    <img src='immagini/calcolatrice.png'>
                                    <p>
                                        Gestione automatizzata di calcoli e punteggi in un solo click
                                    </p>
                                </div>
                            </div>
                            <div class="riga">
                                <div class="immagine">
                                    <img src='immagini/calcio.png'>
                                    <p>
                                        Voti LIVE! per seguire l'andamento della tua squadra in tempo reale
                                    </p>
                                </div>
                                <div class="immagine">
                                    <img src='immagini/agenda.png'>
                                    <p>
                                        Centinaia di opzioni personalizzabili per assecondare le più svariate abitudini
                                        di gioco
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    </section>
</body>
</html>