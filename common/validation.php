<?php
    session_start();
    include_once("../classes/global.class.php");

    $global = new Ogreos();
    $check = $global->checkAccount($_POST['rg45GV2'], $_POST['ADE23ks3']);
    if ($check == -1)
    {
        header('Location: http://www.ogreos.com:8888/forbidden.html');
    }
    else
    {
        $global->lockAccount($check);
        $_SESSION['OGR_ID'] = $check;
        $_SESSION['OGR_NAME'] = $global->getIdentity($check);
        $_SESSION['OGR_GROUP'] = $global->getGroup($check);
        $_SESSION['OGR_PHOTO'] = $global->getPhoto($check);
        header('Location: http://www.ogreos.com:8888/TableauxDeBord.html');
    }
?>