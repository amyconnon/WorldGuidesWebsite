<?php

class ListItems {
    // DB stuff
    private $conn;
    private $table = 'WG_listitems';

    // Site properties
    public $ID;
    public $ListNameID;
    public $SiteID;
    public $SiteName;


    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {

        $query = 'SELECT
        ln.ID,
        ln.ListNameID,
        ln.SiteID,
        s.SiteName
        FROM
        ' .$this->table . ' 
        AS ln
        INNER JOIN 
        WG_site AS s
        ON ln.SiteID = s.ID
        ORDER BY
        ln.SiteID ASC';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;

    }


      // Get Single listitem
      public function read_single() {

        $query = 'SELECT
        ln.ID,
        ln.ListNameID,
        ln.SiteID,
        s.SiteName
        FROM
        ' .$this->table . ' 
        AS ln
        INNER JOIN 
        WG_site AS s
        ON ln.SiteID = s.ID
        WHERE ln.ID = ?
        LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1,$this->ID);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->ID = $row['ID'];
        $this->ListNameID = $row['ListNameID'];
        $this->SiteID = $row['SiteID'];
        $this->SiteName = $row['SiteName'];

}

        // Create list item
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
            ListNameID = :ListNameID,
            SiteID = :SiteID';
        
            //Prepare statament
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->ListNameID = htmlspecialchars(strip_tags($this->ListNameID));
            $this->SiteID = htmlspecialchars(strip_tags($this->SiteID));
        
            // Bind data
            $stmt->bindParam(':ListNameID', $this->ListNameID);
            $stmt->bindParam(':SiteID', $this->SiteID);
       
            // Execute data
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

}
?>
   