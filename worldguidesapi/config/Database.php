<?php
class Database {
    // DB Parameters
    private $host = 'username.lampt.school.uni.ac.uk'; // change
    private $db_name = 'username'; // change
    private $username = 'username'; // change
    private $password = 'password'; // change
    private $conn;

    //DB connect
    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: '.$e->getMessage();
        }

        return $this->conn;
    }

}

?>