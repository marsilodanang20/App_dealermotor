<?php
require_once __DIR__ . "/../vendor/autoload.php"; // add this library using: composer require vlucas/phpdotenv

class Database {
    private $pdo;

    public function __construct() {
        // Load environment variables from the .env file
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();

        $host = $_ENV["DB_HOST"];
        $dbname = $_ENV["DB_DATABASE"];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];
        $charset = $_ENV["DB_CHARSET"];
        
        $this->connect($host, $dbname, $username, $password, $charset);
    }

    private function connect($host, $dbname, $username, $password, $charset) {
        try {
            $this->pdo = new PDO("mysql:host={$host};dbname={$dbname};charset={$charset}", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);

        if ($stmt) {
            $stmt->execute($params);
            return $stmt;
        } else {
            die("Error in query: " . print_r($this->pdo->errorInfo(), true));
        }
    }

    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);

            if ($stmt) {
                $stmt->execute($params);
                return $stmt;
            } else {
                die("Error in query: " . print_r($this->pdo->errorInfo(), true));
            }
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    
}
