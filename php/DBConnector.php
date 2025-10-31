<?php
/**
 * Database Connector
 * Singleton pattern to ensure only one database connection is used throughout the application
 */
class DBConnector {
    private static $instance = null;
    private $pdo;
    
    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct() {
        $this->loadEnv();
        $this->connect();
    }
    
    /**
     * Load environment variables from .env file
     */
    private function loadEnv() {
        $envFile = __DIR__ . '/../.env';
        
        if (!file_exists($envFile)) {
            throw new Exception('.env file not found. Please create one based on .env.example');
        }
        
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Parse KEY=VALUE
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes if present
                if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                    $value = $matches[2];
                }
                
                // Set environment variable if not already set
                if (!isset($_ENV[$key])) {
                    $_ENV[$key] = $value;
                    putenv("$key=$value");
                }
            }
        }
    }
    
    /**
     * Establish database connection
     */
    private function connect() {
        $host = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
        $dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
        $username = getenv('DB_USER') ?: $_ENV['DB_USER'];
        $password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];
        
        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed. Please check your credentials.");
        }
    }
    
    /**
     * Get singleton instance
     * @return DBConnector
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Get PDO connection
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }
    
    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}
    
    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

/**
 * Helper function to get database connection
 * @return PDO
 */
function getDB() {
    return DBConnector::getInstance()->getConnection();
}
?>
