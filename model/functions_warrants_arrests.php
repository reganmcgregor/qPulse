<?php

    //create a function to retrieve a single warrant
    function get_warrant()
    {
        global $conn;

        //retrieve the warrantID from the URL
        $warrantID = $_GET['warrantID'];

        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by warrantID and status warrant (0)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 0 AND qp_arrest_warrant.warrantID = :warrantID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve a single product
    function get_arrest()
    {
        global $conn;

        //retrieve the warrantID from the URL
        $warrantID = $_GET['warrantID'];

        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by warrantID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND qp_arrest_warrant.warrantID = :warrantID ORDER BY updatedDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve all warrants
	function get_warrants()
	{
		global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by status warrant (0)
		$sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 0 ORDER BY createdDate';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve the total number of matching status
    function count_warrants()
    {
        global $conn;
        $sql = 'SELECT * FROM qp_arrest_warrant WHERE status = 0';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

    //create a function to retrieve all arrests
    function get_arrests()
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 ORDER BY updatedDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all warrants by stationID
    function get_warrants_by_station($stationID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by stationID and status warrant (0)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 0 AND stationID = :stationID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':stationID', $stationID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all arrests by stationID
    function get_arrests_by_station($stationID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by stationID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND stationID = :stationID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':stationID', $stationID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all arrests by processingBadgeID
    function get_arrests_by_processingBadgeID($processingBadgeID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by processingBadgeID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND processingBadgeID = :processingBadgeID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':processingBadgeID', $processingBadgeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all arrests by arrestingBadgeID
    function get_arrests_by_arrestingBadgeID($arrestingBadgeID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by arrestingBadgeID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND arrestingBadgeID = :arrestingBadgeID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':arrestingBadgeID', $arrestingBadgeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all warrants by poiID
    function get_warrants_by_poi($poiID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by poiID and status warrant (0)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 0 AND qp_arrest_warrant.poiID = :poiID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all warrants by jobID
    function get_warrants_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by jobID and status warrant (0)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 0 AND qp_arrest_warrant.jobID = :jobID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all arrests by poiID
    function get_arrests_by_poi($poiID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by poiID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND qp_arrest_warrant.poiID = :poiID ORDER BY updatedDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all arrests by jobID
    function get_arrests_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_arrest_warrant table and some data from qp_poi and qp_station by jobID and status arrest (1)
        $sql = 'SELECT qp_arrest_warrant.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName, qp_station.name AS stationName FROM qp_arrest_warrant INNER JOIN qp_poi USING (poiID) INNER JOIN qp_station USING (stationID) WHERE status = 1 AND qp_arrest_warrant.jobID = :jobID ORDER BY updatedDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

	//create a function to add a new warrant
	function add_warrant($status, $poiID, $jobID, $court, $judge, $stationID)
	{
		global $conn;
		$sql = "INSERT INTO qp_arrest_warrant (status, poiID, jobID, court, judge, stationID, createdDate) VALUES (:status, :poiID, :jobID, :court, :judge, :stationID, now())";
		$statement = $conn->prepare($sql);
		//Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':status', $status);
        $statement->bindValue(':poiID', $poiID);
		$statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':court', $court);
        $statement->bindValue(':judge', $judge);
		$statement->bindValue(':stationID', $stationID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

    //create a function to update warrant
    function update_warrant($warrantID, $jobID, $court, $judge)
    {
        global $conn;
        $sql = "UPDATE qp_arrest_warrant SET jobID = :jobID, court = :court, judge = :judge WHERE warrantID = :warrantID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':court', $court);
        $statement->bindValue(':judge', $judge);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update warrant status and process into arrest status
    function process_arrest($warrantID, $jobID, $court, $judge, $newPhotoName, $arrestingBadgeID, $processingBadgeID)
    {
        global $conn;
        $sql = "UPDATE qp_arrest_warrant SET status = 1, jobID = :jobID, court = :court, judge = :judge, mugshot = :newPhotoName, arrestingBadgeID = :arrestingBadgeID, processingBadgeID = :processingBadgeID, updatedDate = now() WHERE warrantID = :warrantID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':court', $court);
        $statement->bindValue(':judge', $judge);
        $statement->bindValue(':newPhotoName', $newPhotoName);
        $statement->bindValue(':arrestingBadgeID', $arrestingBadgeID);
        $statement->bindValue(':processingBadgeID', $processingBadgeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new arrest
    function add_arrest($status, $poiID, $jobID, $court, $judge, $stationID, $newPhotoName, $arrestingBadgeID, $processingBadgeID)
    {
        global $conn;
        $sql = "INSERT INTO qp_arrest_warrant (status, poiID, jobID, court, judge, stationID, mugshot, arrestingBadgeID, processingBadgeID, createdDate, updatedDate) VALUES (:status, :poiID, :jobID, :court, :judge, :stationID, :newPhotoName, :arrestingBadgeID, :processingBadgeID, now(),now())";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':status', $status);
        $statement->bindValue(':poiID', $poiID);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':court', $court);
        $statement->bindValue(':judge', $judge);
        $statement->bindValue(':stationID', $stationID);
        $statement->bindValue(':newPhotoName', $newPhotoName);
        $statement->bindValue(':arrestingBadgeID', $arrestingBadgeID);
        $statement->bindValue(':processingBadgeID', $processingBadgeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update an person of interest mugshot
    function update_poi_mugshot($poiID, $mugshot)
    {
        global $conn;
        $sql = "UPDATE qp_poi SET photo = :mugshot WHERE poiID = :poiID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->bindValue(':mugshot', $mugshot);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all charges by warrantID
    function get_charges()
    {
        global $conn;

        //retrieve the warrantID from the URL
        $warrantID = $_GET['warrantID'];
        //query the database to select all data from the qp_charge table and some data from qp_offence by warrantID
        $sql = 'SELECT qp_charge.*, qp_offence.* FROM qp_charge INNER JOIN qp_offence USING (offenceID) WHERE qp_charge.warrantID = :warrantID ORDER BY chargeID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new charge
    function add_charge($warrantID, $offenceID)
    {
        global $conn;
        $sql = "INSERT INTO qp_charge (warrantID, offenceID) VALUES (:warrantID, :offenceID)";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':warrantID', $warrantID);
        $statement->bindValue(':offenceID', $offenceID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to delete an existing charge
    function delete_charge($chargeID)
    {
        global $conn;
        $sql = "DELETE FROM qp_charge WHERE chargeID = :chargeID";
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement = $conn->prepare($sql);
        $statement->bindValue(':chargeID', $chargeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

?>