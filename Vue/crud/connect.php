<?php
class config
{
    private static $pdo = null; // Static property to hold the connection

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            $servername = "localhost"; // Hostname or IP of the database server
            $username = "root";        // Database username
            $password = "";            // Database password
            $dbname = "event";         // Name of your database
            try {
                // Establish the PDO connection
                self::$pdo = new PDO(
                    "mysql:host=$servername;dbname=$dbname;charset=utf8", 
                    $username, 
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                echo "Connected successfully";
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
config::getConnexion();
?>
