<?php
class Database
{
    public static $dbHost = "localhost";
    public static $dbName = "burgercode_fini" ;
    public static $dbUser = "root" ;
    public static $dbUserPassword = "";
    public static $connection = null;

    public static function connect()
        {
            try
            {
                self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,self::$dbUser,self::$dbUserPassword);
            }
            catch (PDOException $e)
            {
                die($e -> getMessage());
            }

            return self::$connection;
        }

        public static function disconnect ()
        {
           self::$connection = null;
        }
       
}
 
?>