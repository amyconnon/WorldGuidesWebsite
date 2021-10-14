<?php

class Lists {
    // DB stuff
    private $conn;
    private $table = 'WG_listname';

    // Site properties
    public $ID;
    public $ListName;
    public $UserID;


    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {

        $query = 'SELECT
        ID,
        ListName,
        UserID
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

        // Create list
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
            ListName = :ListName,
            UserID = :UserID';
        
            //Prepare statament
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->ListName = htmlspecialchars(strip_tags($this->ListName));
            $this->UserID = htmlspecialchars(strip_tags($this->UserID));
        
            // Bind data
            $stmt->bindParam(':ListName', $this->ListName);
            $stmt->bindParam(':UserID', $this->UserID);
       
            // Execute data
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }