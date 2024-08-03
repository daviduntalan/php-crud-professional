/*
5. Delete Operations
Create a delete.php file to delete records:
*/
<?php
require 'db.php';

class User {
    private $conn;
    private $table_name = "users";

    public $username;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE username=:username";
        
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(":username", $this->username);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->username = 'testuser';

if ($user->delete()) {
    echo "User was deleted.";
} else {
    echo "Unable to delete user.";
}
?>

/*
Summary

- db.php: Handles the database connection.
- create.php: Inserts a new record into the users table.
- read.php: Fetches and displays records from the users table.
- update.php: Updates an existing record in the users table.
- delete.php: Deletes a record from the users table.

This setup uses PDO to interact with the MySQL database securely and efficiently, 
leveraging prepared statements to prevent SQL injection.
*/