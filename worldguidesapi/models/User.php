<?php

class User {
    // DB stuff
    private $conn;
    private $table = 'WG_user';

    // Site properties
    public $ID;
    public $Username;
    public $Password;
    public $AdminStatus;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    



    public function read() {

        $query = 'SELECT
        ID,
        Username,
        Password,
        AdminStatus
        FROM
        ' .$this->table . ' 
        ORDER BY
        ID ASC';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;

    }

        // Create User
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                Username = :Username,
                Password = :Password,
                AdminStatus = :AdminStatus';
        
            //Prepare statament
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->Username = htmlspecialchars(strip_tags($this->Username));
            $this->Password = htmlspecialchars(strip_tags($this->Password));
            $this->AdminStatus = htmlspecialchars(strip_tags($this->AdminStatus)); 
        
            // Bind data
            $stmt->bindParam(':Username', $this->Username);
            $stmt->bindParam(':Password', $this->Password);
            $stmt->bindParam(':AdminStatus', $this->AdminStatus);
       
            // Execute data
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

  // Update User
  public function update() {
    // Update query
    $query = 'UPDATE ' . 
    $this->table . '
    SET
    Username = :Username,
    Password = :Password,
    AdminStatus = :AdminStatus
        WHERE
        ID = :ID';

    //Prepare statament
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->Username = htmlspecialchars(strip_tags($this->Username));
    $this->Password = htmlspecialchars(strip_tags($this->Password));
    $this->AdminStatus = htmlspecialchars(strip_tags($this->AdminStatus));  
    $this->ID = htmlspecialchars(strip_tags($this->ID));  

    // Bind data
    $stmt->bindParam(':Username', $this->Username);
    $stmt->bindParam(':Password', $this->Password);
    $stmt->bindParam(':AdminStatus', $this->AdminStatus);
    $stmt->bindParam(':ID', $this->ID);

    // Execute data
    if($stmt->execute()) {
        return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

    // Delete user
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . 
        ' WHERE ID = :ID';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // This is a delete, only takes in id
        // Clean data
        $this->ID = htmlspecialchars(strip_tags($this->ID));  
    
        // Bind data
        $stmt->bindParam(':ID', $this->ID);

        // Execute data
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
        
    }

    }