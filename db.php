/* 
To connect to a MySQL database using PHP and perform CRUD (Create, Read, Update, Delete) operations in 
a professional manner, it's best to use PDO (PHP Data Objects). PDO provides a consistent interface for 
accessing databases in PHP and includes support for prepared statements, which help prevent SQL injection.

Below is an example of how to set up a connection and perform CRUD operations using PDO.

1. Set Up Database Connection
First, create a db.php file to handle the database connection:
*/
<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'your_database_name';
    private $username = 'your_username';
    private $password = 'your_password';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
/* 
Other resources:
PDO::__construct https://www.php.net/manual/en/pdo.construct.php
PHP Tutorial https://youtu.be/zpTlJ6dtOxA

*/
