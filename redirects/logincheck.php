<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/classes/loginmodule.php';
    
    if(LoginModule::login($_POST['username'], $_POST['password']))
        header('Location: /index.php');
    else
        header('Location: /index.php?attempt=1');
?>