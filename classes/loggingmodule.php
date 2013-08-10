<?php
        
    abstract class LoggingModule{

        static private $host = 'localhost';
        static private $host_username = 'root';
        static private $host_password = 'bennette';
        static private $database = 'firewall';

        public static function connectToDb(){
            $mysqli = new mysqli(self::$host, self::$host_username, self::$host_password, 
                                    self::$database);
            return $mysqli;
        }

        public static function generateSalt($username){
            $salt = '$2a$11$';
            $salt .= md5(strtolower($username));
            return $salt;
        }
        
        public static function generateHash($password, $salt){
            $hash = crypt($password, $salt);
            return $hash;
        }
        
        /* Actual way to generate the hash of the password is as follows:
         * 
         * generateHash(`password`, generateSalt(`username`));
         *
         */

    }

?>
