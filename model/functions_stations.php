<?php

    //create a function to retrieve a single station
    function get_station()
    {
        global $conn;
    
        //retrieve the stationID from the URL
        $stationID = $_GET['stationID'];
    
        $sql = 'SELECT qp_station.*, qp_officer.lastName, qp_officer.firstName, qp_officer.rank FROM qp_station INNER JOIN qp_officer USING(badgeID) WHERE qp_station.stationID = :stationID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':stationID', $stationID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }	
    
    //create a function to retrieve all stations
	function get_stations()
	{
		global $conn;
		//query the database to select all data from the qp_station table
		$sql = 'SELECT qp_station.* FROM qp_station INNER JOIN qp_officer USING(badgeID) ORDER BY name';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve data for the station dropdown menu
	function get_station_dropdown()
	{
		global $conn;

		$sql = 'SELECT * FROM qp_station ORDER BY stationID';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//create a function to add a new station
	function add_station($name, $division, $street, $streetType, $suburb, $state, $postcode, $phone, $fax, $email, $badgeID)
	{
		global $conn;
		$sql = "INSERT INTO qp_station (name, division, street, streetType, suburb, state, postcode, phone, fax, email, badgeID) VALUES (:name, :division, :street, :streetType, :suburb, :state, :postcode, :phone, :fax, :email, :badgeID)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':division', $division);
		$statement->bindValue(':street', $street);
		$statement->bindValue(':streetType', $streetType);
		$statement->bindValue(':suburb', $suburb);
		$statement->bindValue(':state', $state);
		$statement->bindValue(':postcode', $postcode);
		$statement->bindValue(':phone', $phone);
		$statement->bindValue(':fax', $fax);
		$statement->bindValue(':email', $email);
        $statement->bindValue(':badgeID', $badgeID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

	//create a function to update an existing station
	function update_station($stationID, $name, $division, $street, $streetType, $suburb, $state, $postcode, $phone, $fax, $email, $badgeID)
	{
		global $conn;
		$sql = "UPDATE qp_station SET name = :name, division = :division, street = :street, streetType = :streetType, suburb = :suburb, state = :state, postcode = :postcode, phone = :phone, fax = :fax, email = :email, badgeID = :badgeID WHERE stationID = :stationID";
		$statement = $conn->prepare($sql);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':division', $division);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':streetType', $streetType);
        $statement->bindValue(':suburb', $suburb);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postcode', $postcode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':fax', $fax);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->bindValue(':stationID', $stationID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

?>