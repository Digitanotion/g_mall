<?php
//error_reporting(0);
require_once("configGlobal.php");
class InitDB{
    public $pdo;
    public function __construct($db, $username = NULL, $password = NULL, $host)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password, PDO_OPTIONS);
            //CONNECTED TO DB
        } catch (\PDOException $e) {
            //SEND THIS TO AUDIT SERVICE FOR LOGGING
        }
    }
    public function run($sql, $args = NULL)
    {
        $stmt=null;
        
            if (!$args)
        {
            return $this->pdo->query($sql);
        }
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($args);
        } catch (PDOException $e) {
            //SEND THIS TO AUDIT SERVICE FOR LOGGING
            echo $e->getMessage();
        }
        
        return $stmt;
    }
}

/* 

USAGE

$unitTest=new InitDB(DB_OPTIONS[2], DB_OPTIONS[0],DB_OPTIONS[1],DB_OPTIONS[3]);
$stmt=$unitTest->run("SELECT * FROM commission_tb WHERE id <= ?", [5]);
echo $stmt->rowCount(); */
?>