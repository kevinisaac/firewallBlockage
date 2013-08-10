<?php
    
    require_once 'loggingmodule.php';
    
    class RegistrationModule extends LoggingModule{
        
        /* Inherited functions are:
         * 1. connectToDb($host, $username, $password, $database);
       	 * 2. generateSalt($username);
       	 * 3. generateHash($password, $salt);
         */
        
        public static function register($username, $password, $email){
        
        	$password = self::generateHash($password, self::generateSalt($username));
            $mysqli = self::connectToDb();
            
            if(!$mysqli){
                echo 'unable to connect to db';
                return false;
            }
            
            //preparing the query
            $query = 'INSERT INTO `login` (`username`,`password`,`email`)
                        VALUES ("?","?","?")';
            $statement = $mysqli->prepare($query);
            if(!$statement){
            	echo 'preparation failed.';
            	return false;
            }
            
            //binding the statement
            if(!$statement->bind_param("sss", $username, $password, $email)){
            	echo 'binding failed.';
            	return false;
            }
            
            //executing the statement
            if(!$statement->execute()){
            	echo 'execution failed.';
            	return false;
            }
            
            //fetching the results
            if(!($result = $statement->get_result())){
            	echo 'Getting reault failed.';
            	return false;
            }
            
            //closing the statement
            $statement->close();
            
            
            // To write
            // To write
            // To write
            
            
            
            echo 'User account successfully created!<br/>';
            echo 'username = '.$username.'<br/>';
            echo 'password = '.$password.'<br/>';
            echo 'email = '.$email.'<br/>';
            
            return true;
        }
    }
    

?>
