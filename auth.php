<?php
require_once 'dbconfig.php';
session_start();

function CheckAuth()
{
    // se esiste la sessione la ritorno, sennò torno 0
    if(isset($_SESSION['user_id']))
    {
        return $_SESSION['user_id'];
    }
    else 
    { 
        return 0;
    }
}
?>