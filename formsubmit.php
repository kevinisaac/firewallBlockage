<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/classes/loggingmodule.php";
    
    
    //checking if the values are set
    if(
        !isset($_GET['registernumber'])
        or !isset($_GET['siteblocked']) 
        or !isset($_GET['reasonspecified'])
        or !isset($_GET['reasonsuggested']) 
        or !isset($_GET['comment'])
    )
        header('HTTP/1.1 404 Page Not Found');
    
    //checking if the values are not empty
    if(
        empty($_GET['registernumber']) 
        or empty($_GET['siteblocked']) 
        or empty($_GET['reasonspecified'])
        or empty($_GET['reasonsuggested'])
    )
        header('HTTP/1.1 404 Page Not Found');
    
    //connecting to the database
    $mysqli = LoggingModule::connectToDb();
    
    //filling out the variables
    $registerNumber = htmlspecialchars($_GET['registernumber']);
    $siteBlocked = htmlspecialchars($_GET['siteblocked']);
    $reasonSpecified = htmlspecialchars($_GET['reasonspecified']);
    $reasonSuggested = htmlspecialchars($_GET['reasonsuggested']);
    $feedback = htmlspecialchars($_GET['comment']);
    
    //assigning the query value
    $query = 'INSERT INTO `feedback`
                (`registernumber`,`siteblocked`,`reasonspecified`,`reasonsuggested`,`feedback`)
              VALUES
                (?, ?, ?, ?, ?)';
    
    //preparing the query
    if(!($statement = $mysqli->prepare($query)))
        header('HTTP/1.1 404 Page Not Found');
    
    //binding the statement
    if(!$statement->bind_param("sssss",
                        $registerNumber, $siteBlocked, $reasonSpecified, $reasonSuggested, $feedback
                    )
    )
        header('HTTP/1.1 404 Page Not Found');
    
    //executing the statement
    if(!$statement->execute())
        header('HTTP/1.1 404 Page Not Found');

?>