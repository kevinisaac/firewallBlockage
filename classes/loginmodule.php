<?php
    session_start();
    require_once 'loggingmodule.php';

    class LoginModule extends LoggingModule
    {
        
        /* Inherited functions are:
         * 1. connectToDb($host, $username, $password, $database);
       	 * 2. generateSalt($username);
       	 * 3. generateHash($password, $salt);
         */
        
        public static function login($username, $password){
            
            $password = self::generateHash($password, self::generateSalt($username));
            $mysqli = self::connectToDb();
            
            if($mysqli){
                $query = 'SELECT `id` FROM `admin` WHERE `username` = ?
                            AND `password` = ?';
                
                //preparing the query
                $statement = $mysqli->prepare($query);
                if(!$statement){
                    return false;
                }

                //binding the statement
                if(!$statement->bind_param("ss", $username, $password)){
                    return false;
                }

                //executing the statement
                if(!$statement->execute()){
                    return false;
                }
                //storing and fetching the results
                $statement->store_result();
                $statement->fetch();
                $result = $statement->num_rows();
                
                if($result === 1){
                    $_SESSION['username'] = 'admin';
                    return true;
                }
                else{
                    return false;
                }
                
                //closing the statement
                $statement->close();
            
                if(mysqli_num_rows($result)===1){
                    return $result;
                }
            }
            
            return false;
        }
        
        
        
    }

?>