<?php
include_once('config.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Database{

    private $host = "127.0.0.1"; // أو "localhost"
    private $db_name = "test"; 
    private $username = "root"; 
    private $password = "Mohamed@8112001"; 
    public $pdo;    
    // public function __construct()
    // {
    //     global $pdo ,$host,$database,$username,$password;

    //     $dns = "mysql:host=$host;dbname=$database;";

    //     try{

    //         $pdo = new PDO($dns ,$username , $password);
    //     }
    //     catch(\PDOException $e)
    //     {
    //         throw new \PDOException($e->getMessage(),(int)$e->getCode());
    //     }

    // }
    public function __construct() {
        global $host, $database, $username, $password; // تأكد أن هذه القيم تُستخدم

        $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
        }
    }
    public function getPDO() {
        return $this->pdo;
    }

    // public function getPDO() {
    //     if ($this->pdo === null) {
    //         try {
    //             $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
    //             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         } catch (PDOException $e) {
    //             die("❌ فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
    //         }
    //     }
    //     return $this->pdo;
    // }
    public function insert($tablename,$columns,$values)
    {
        global $pdo ;
        if(count($columns) !== count($values))
        {
            throw new Exception("Number of columns not match with the values");
        }

        $placeholders = array_map(function($col){
            return ":$col";
        },$columns);

        $columnsStr = implode(",",$columns);
        $placeholdersStr = implode(",",$placeholders);

        $sql = "insert into $tablename ($columnsStr) values ($placeholdersStr)";
        $stmt = $pdo->prepare($sql);

        // $params = array_combine($columns, $values);

        $params = array_combine($placeholders,$values);
        echo "Query: " . $sql;
        print_r($params);
        // $stmt->execute($params);
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
        }

        return $stmt->rowCount();

    }

    public function select($tablename, $conditions = [], $fetchAll = true) {
        // connecttodb();
        //  global $pdo;
         try {
            
             // Build query dynamically
             $sql = "SELECT * FROM $tablename";
             
             if (!empty($conditions)) {
                 $whereClauses = [];
                 foreach ($conditions as $column => $value) {
                     $whereClauses[] = "$column = :$column";
                 }
                 $sql .= " WHERE " . implode(" AND ", $whereClauses);
             }
     
             // Prepare and execute statement
             
             $stmt = $this->pdo->prepare($sql);

             $stmt->execute($conditions);
     
             // Fetch data based on mode
             return $fetchAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
         } catch (PDOException $e) {
             return "Error: " . $e->getMessage();
         }
     }
    // public function select($tablename, $conditions = [], $fetchAll = true) {
    //     try {
    //         $sql = "SELECT * FROM $tablename";
    //         if (!empty($conditions)) {
    //             $whereClauses = [];
    //             foreach ($conditions as $column => $value) {
    //                 $whereClauses[] = "$column = :$column";
    //             }
    //             $sql .= " WHERE " . implode(" AND ", $whereClauses);
    //         }
    
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute($conditions);
    
    //         return $fetchAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         error_log("Select error: " . $e->getMessage());
    //         return false;
    //     }
    // }
      
}
?>