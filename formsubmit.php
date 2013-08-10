<?php
    
    require_once $_SERVER['DOCUMENT_ROOT']."/classes/loggingmodule.php";
    sleep(2);
    if(!isset($_GET['name']) or !isset($_GET['registernumber']) or !isset($_GET['email'])
            or !isset($_GET['siteblocked']) or !isset($_GET['reasonspecified'])
            or !isset($_GET['reasonsuggested']) or !isset($_GET['comment']))
        die('not set');
    
    if(empty($_GET['email']) or empty($_GET['siteblocked']) or empty($_GET['reasonspecified'])
            or empty($_GET['reasonsuggested']))
        header('HTTP/1.1 404 Page Not Found');
    
    $mysqli = LoggingModule::connectToDb();
    
    $name = htmlspecialchars($_GET['name']);
    $registerNumber = htmlspecialchars($_GET['registernumber']);
    $email = htmlspecialchars($_GET['email']);
    $siteBlocked = htmlspecialchars($_GET['siteblocked']);
    $reasonSpecified = htmlspecialchars($_GET['reasonspecified']);
    $reasonSuggested = htmlspecialchars($_GET['reasonsuggested']);
    $feedback = htmlspecialchars($_GET['comment']);
    $unblockcheckbox = (isset($_GET['unblockcheckbox']) && !empty($_GET['unblockcheckbox']))
                            ?1
                            :0;
    
    //preparing the query
    $query = 'INSERT INTO `feedback` (`name`, `registernumber`, `email`,
                `siteblocked`, `reasonspecified`, `reasonsuggested`, `feedback`, `unblock`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    if(!$statement = $mysqli->prepare($query))
        echo $mysqli->error;
    
    //binding the statement
    if(!$statement->bind_param("sssssssi", $name, $registerNumber, $email, $siteBlocked, $reasonSpecified,
                            $reasonSuggested, $feedback, $unblockcheckbox))
        echo $statement->error;
    
    //ecexuting the statement
    if(!$statement->execute())
        echo $statement->error;
    

?>