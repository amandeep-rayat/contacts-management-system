<?php
class Database {
    private $pdo;

    public function __construct() {
        $config = include(__DIR__ . '/../../config/config.php');
        $db = $config['db'];
        
        try {
            $this->pdo = new PDO(
                "mysql:host={$db['host']};dbname={$db['dbname']};charset={$db['charset']}", 
                $db['username'], 
                $db['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, __DIR__ . '/../../logs/error.log');
            die('Database connection error');
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
