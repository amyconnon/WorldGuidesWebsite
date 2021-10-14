<?php

class Site {
    // DB stuff
    private $conn;
    private $table = 'WG_site';

    // Site properties
    public $ID;
    public $UniqueNumber;
    public $SiteName;
    public $SiteDescription;
    public $Longitude;
    public $Latitude;
    public $Area;
    public $CategoryID;
    public $StateID;
    public $RegionID;
    public $YearID;
    public $DangerID;
    public $IsoID;
    public $CategoryType;
    public $RegionName;
    public $StateName;
    public $YearInscribed;
    public $DangerStatus;
    public $IsoCode;


    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    

    public function read() {

        $query = 'SELECT
        s.ID,
        s.UniqueNumber,
        s.SiteName,
        s.SiteDescription,
        s.Longitude,
        s.Latitude,
        s.Area,
        c.CategoryType as CategoryType,
        s.CategoryID,
        st.StateName as StateName,
        s.StateID,
        r.RegionName as RegionName,
        s.RegionID,
        y.YearInscribed,
        s.YearID,
        d.DangerStatus,
        s.DangerID,
        i.IsoCode,
        s.IsoID
        FROM
        ' .$this->table . ' 
        AS s
        INNER JOIN 
        WG_category AS c
        ON s.CategoryID = c.ID
        INNER JOIN 
        WG_state AS st
        ON s.StateID = st.ID
        INNER JOIN 
        WG_region AS r
        ON s.RegionID = r.ID
        INNER JOIN 
        WG_year AS y
        ON s.YearID = y.ID
        INNER JOIN 
        WG_danger AS d
        ON s.DangerID = d.ID
        INNER JOIN 
        WG_iso AS i
        ON s.IsoID = i.ID
        ORDER BY
        s.ID ASC';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;

    }


    // Get Single post
    public function read_single() {


        $query = 'SELECT
        s.ID,
        s.UniqueNumber,
        s.SiteName,
        s.SiteDescription,
        s.Longitude,
        s.Latitude,
        s.Area,
        c.CategoryType as CategoryType,
        s.CategoryID,
        st.StateName as StateName,
        s.StateID,
        r.RegionName as RegionName,
        s.RegionID,
        y.YearInscribed,
        s.YearID,
        d.DangerStatus,
        s.DangerID,
        i.IsoCode,
        s.IsoID
        FROM
        ' .$this->table . ' 
        AS s
        INNER JOIN 
        WG_category c
        ON s.CategoryID = c.ID
        INNER JOIN 
        WG_state AS st
        ON s.StateID = st.ID
        INNER JOIN 
        WG_region AS r
        ON s.RegionID = r.ID
        INNER JOIN 
        WG_year AS y
        ON s.YearID = y.ID
        INNER JOIN 
        WG_danger AS d
        ON s.DangerID = d.ID
        INNER JOIN 
        WG_iso AS i
        ON s.IsoID = i.ID
        WHERE s.ID = ?
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
        $this->UniqueNumber = $row['UniqueNumber'];
        $this->SiteName = $row['SiteName'];
        $this->SiteDescription = $row['SiteDescription'];
        $this->Longitude = $row['Longitude'];
        $this->Latitude = $row['Latitude'];
        $this->UniqueNumber = $row['UniqueNumber'];
        $this->Area = $row['Area'];
        $this->CategoryType = $row['CategoryType'];
        $this->CategoryID = $row['CategoryID'];
        $this->StateName = $row['StateName'];
        $this->StateID = $row['StateID'];
        $this->RegionName = $row['RegionName'];
        $this->RegionID = $row['RegionID'];
        $this->YearInscribed = $row['YearInscribed'];
        $this->YearID = $row['YearID'];
        $this->DangerStatus = $row['DangerStatus'];
        $this->DangerID = $row['DangerID'];
        $this->IsoCode = $row['IsoCode'];
        $this->IsoID = $row['IsoID'];

}



      // Update Site
      public function update() {
        // Update query
        $query = 'UPDATE ' . 
        $this->table . '
        SET
        ID = :ID,
        UniqueNumber = :UniqueNumber,
        SiteName = :SiteName,
        SiteDescription = :SiteDescription,
        Longitude = :Longitude,
        Latitude = :Latitude,
        Area = :Area,
        CategoryID = :CategoryID,
        StateID = :StateID,
        RegionID = :RegionID,
        YearID = :YearID,
        DangerID = :DangerID,
        IsoID = :IsoID
            WHERE
            ID = :ID';
    
        //Prepare statament
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->ID = htmlspecialchars(strip_tags($this->ID));
        $this->UniqueNumber = htmlspecialchars(strip_tags($this->UniqueNumber));
        $this->SiteName = htmlspecialchars(strip_tags($this->SiteName));
        $this->SiteDescription = htmlspecialchars(strip_tags($this->SiteDescription));  
        $this->Longitude = htmlspecialchars(strip_tags($this->Longitude));  
        $this->Latitude = htmlspecialchars(strip_tags($this->Latitude));
        $this->Area = htmlspecialchars(strip_tags($this->Area));
        $this->CategoryID = htmlspecialchars(strip_tags($this->CategoryID));
        $this->StateID = htmlspecialchars(strip_tags($this->StateID));  
        $this->RegionID = htmlspecialchars(strip_tags($this->RegionID));  
        $this->YearID = htmlspecialchars(strip_tags($this->YearID));
        $this->DangerID = htmlspecialchars(strip_tags($this->DangerID));  
        $this->IsoID = htmlspecialchars(strip_tags($this->IsoID));  
    


        // Bind data
        $stmt->bindParam(':ID', $this->ID);
        $stmt->bindParam(':UniqueNumber', $this->UniqueNumber);
        $stmt->bindParam(':SiteName', $this->SiteName);
        $stmt->bindParam(':SiteDescription', $this->SiteDescription);
        $stmt->bindParam(':Longitude', $this->Longitude);
        $stmt->bindParam(':Latitude', $this->Latitude);
        $stmt->bindParam(':Area', $this->Area);
        $stmt->bindParam(':CategoryID', $this->CategoryID);
        $stmt->bindParam(':StateID', $this->StateID);
        $stmt->bindParam(':RegionID', $this->RegionID);
        $stmt->bindParam(':YearID', $this->YearID);
        $stmt->bindParam(':DangerID', $this->DangerID);
        $stmt->bindParam(':IsoID', $this->IsoID);
   
        // Execute data
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete site
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



?>