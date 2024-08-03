/*
4. Update Operations
Create an update.php file to update existing records:
*/
<?php
require 'db.php';

class User {
    private $conn;
    private $table_name = "users";

    public $username;
    public $password;
    public $last_name;
    public $first_name;
    public $middle_initial;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET password=:password, last_name=:last_name, first_name=:first_name, middle_initial=:middle_initial, role=:role WHERE username=:username";
        
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->middle_initial = htmlspecialchars(strip_tags($this->middle_initial));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->username = htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":middle_initial", $this->middle_initial);
        $stmt->bindParam(":role", $this->role);
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
$user->password = 'newpassword';
$user->last_name = 'Smith';
$user->first_name = 'John';
$user->middle_initial = 'B';
$user->role = 'user';

if ($user->update()) {
    echo "User was updated.";
} else {
    echo "Unable to update user.";
}
?>
