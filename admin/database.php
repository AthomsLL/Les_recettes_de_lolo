<?php 

    class Database
    {
        private static $dbHost = "localhost";
        private static $dbName = "les_recettes_de_lolo";
        private static $dbUser = "root";
        private static $dbUserPassword = "";
        
        private static $connexion = null;
        
        public static function connect()
        {
            try
            {
                self::$connexion = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUser , self::$dbUserPassword );
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
            return self::$connexion;
        }
        
        public static function disconnect()
        {
            self::$connexion = null;
        }
    }

?>