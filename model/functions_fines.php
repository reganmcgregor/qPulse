<?php

    //create a function to retrieve a single fine
    function get_fine()
    {
        global $conn;

        //retrieve the fineID from the URL
        $fineID = $_GET['fineID'];

        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station by fine ID
        $sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID WHERE qp_fine.fineID = :fineID ORDER BY fineID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':fineID', $fineID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve all fines
	function get_fines()
	{
		global $conn;
        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station
		$sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID ORDER BY createdDate';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve all fines with status
    function get_fines_by_status($status)
    {
        global $conn;
        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station based upon status
        $sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID WHERE qp_fine.status = :status ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all fines with badgeID
    function get_fines_by_officer($badgeID)
    {
        global $conn;
        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station based upon badgeID
        $sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID WHERE qp_fine.badgeID = :badgeID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all fines with poiID
    function get_fines_by_poi($poiID)
    {
        global $conn;

        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station based upon poiID
        $sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID WHERE qp_fine.poiID = :poiID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all fines with jobID
    function get_fines_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_fine table and some data from qp_poi, qp_offence, qp_officer and qp_station based upon jobID
        $sql = 'SELECT qp_fine.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_offence.name AS offenceName, qp_officer.rank AS officerRank, qp_officer.firstName AS officerFirstName, qp_officer.lastName AS officerLastName, qp_station.name AS stationName FROM qp_fine INNER JOIN qp_poi USING (poiID) INNER JOIN qp_offence USING (offenceID) INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station ON qp_fine.stationID = qp_station.stationID WHERE qp_fine.jobID = :jobID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }


    //create a function to retrieve the total number of unpaid and paid fines
    function count_fines()
    {
        global $conn;
        $sql = 'SELECT * FROM qp_fine WHERE status = 0 OR status = 1';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

	//create a function to add a new fine
	function add_fine($status, $offenceID, $poiID, $jobID, $stationID, $badgeID, $penalty)
	{
		global $conn;
		$sql = "INSERT INTO qp_fine (status, offenceID, poiID, jobID, stationID, badgeID, createdDate, penalty) VALUES (:status, :offenceID, :poiID, :jobID, :stationID, :badgeID, now(), :penalty)";
		$statement = $conn->prepare($sql);
		//Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':status', $status);
        $statement->bindValue(':offenceID', $offenceID);
        $statement->bindValue(':poiID', $poiID);
		$statement->bindValue(':jobID', $jobID);
		$statement->bindValue(':stationID', $stationID);
		$statement->bindValue(':badgeID', $badgeID);
        $statement->bindValue(':penalty', $penalty);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

    //create a function to update fine status
    function update_fine_status($fineID, $status)
    {
        global $conn;
        $sql = "UPDATE qp_fine SET status = :status, updatedDate = now() WHERE fineID = :fineID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':fineID', $fineID);
        $statement->bindValue(':status', $status);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update an existing fine
    function update_fine($fineID, $jobID)
    {
        global $conn;
        $sql = "UPDATE qp_fine SET jobID = :jobID, updatedDate = now() WHERE fineID = :fineID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':fineID', $fineID);
        $statement->bindValue(':jobID', $jobID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
?>