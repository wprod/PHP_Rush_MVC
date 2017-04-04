<?php
include_once "configuration.php";

class dbConn extends Configuration {
    
    protected static $db;

    private function __construct() {

        try {
            self::$db = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

    }

    public static function getConnection() {

        if (!self::$db) {
            new dbConn();
        }
        return self::$db;
    }

}

?>