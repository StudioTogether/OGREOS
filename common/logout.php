<?php
    session_start();
    include_once("../classes/global.class.php");

    $global = new Ogreos();
    $check = $global->logout($_SESSION['OGR_ID']);
    session_unset();
    session_destroy(); 
    header('Location: ../index.html');
?>