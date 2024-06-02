<?php
// avvia la sessione 
session_start();
// elimina la sessione
session_destroy();
// vai alla pagina iniziale
header('Location: index.php');
exit;
?>