/*
3. Read Operations
Create a read.php file to fetch records from the database:
*/
<?php
require 'db.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$stmt = $user->read();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "Username: $username, First Name: $first_name, Last Name: $last_name<br>";
}
?>
