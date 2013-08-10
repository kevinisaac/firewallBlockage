<?php
    
    require_once $_SERVER['DOCUMENT_ROOT']."/classes/registrationmodule.php";
    
    $mysqli = LoggingModule::connectToDb();
    $password = RegistrationModule::generateHash('admin', RegistrationModule::generateSalt('admin'));
    $query = "INSERT INTO admin (username, password, email) VALUES ('admin', '$password', 'admin@admin')";
    if($mysqli->query($query))
        echo 'success';
    
?>