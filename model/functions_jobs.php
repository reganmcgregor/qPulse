<?php

    //create a function to retrieve a single job
    function get_job()
    {
        global $conn;

        //retrieve the jobID from the URL
        $jobID = $_GET['jobID'];

        //query the database to select all data from the qp_job table and some data from qp_job_code and qp_station by jobID
        $sql = 'SELECT qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_job_code.category AS jobCodeCategory, qp_station.name AS stationName FROM qp_job INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station USING (stationID) WHERE qp_job.jobID = :jobID ORDER BY priority, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all jobs
    function get_jobs()
    {
        global $conn;
        //query the database to select all data from the qp_job table and some data from qp_job_code and qp_station
        $sql = 'SELECT qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_station.name AS stationName FROM qp_job INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station USING (stationID) ORDER BY priority, status, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all jobs by status
    function get_jobs_by_status($status)
    {
        global $conn;
        //query the database to select all data from the qp_job table and some data from qp_job_code and qp_station by status
        $sql = 'SELECT qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_station.name AS stationName FROM qp_job INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station USING (stationID) WHERE qp_job.status = :status ORDER BY priority, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all jobs by badgeID
    function get_jobs_by_badgeID($badgeID)
    {
        global $conn;
        //query the database to select all data from the qp_job_officer and qp_job table and some data from qp_job_code and qp_station by badgeID
        $sql = 'SELECT qp_job_officer.*, qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_station.name AS stationName FROM qp_job_officer INNER JOIN qp_job USING (jobID) INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station ON qp_job.stationID = qp_station.stationID WHERE qp_job_officer.badgeID = :badgeID ORDER BY priority, status, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all jobs by badgeID and status
    function get_in_progress_jobs_by_badgeID($badgeID)
    {
        global $conn;
        //query the database to select all data from the qp_job_officer and qp_job table and some data from qp_job_code and qp_station by badgeID and status
        $sql = 'SELECT qp_job_officer.*, qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_station.name AS stationName FROM qp_job_officer INNER JOIN qp_job USING (jobID) INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station ON qp_job.stationID = qp_station.stationID WHERE qp_job_officer.badgeID = :badgeID AND qp_job.status = 1 ORDER BY priority, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all jobs by poiID
    function get_jobs_by_poi()
    {
        //retrieve the poiID from the URL
        $poiID = $_GET['poiID'];

        global $conn;
        //query the database to select all data from the qp_job_poi and qp_job table and some data from qp_job_code and qp_station by poiID
        $sql = 'SELECT qp_job_poi.*, qp_job.*, qp_job_code.code AS jobCode, qp_job_code.description AS jobCodeDescription, qp_station.name AS stationName FROM qp_job_poi INNER JOIN qp_job USING (jobID) INNER JOIN qp_job_code USING (jobCodeID) INNER JOIN qp_station ON qp_job.stationID = qp_station.stationID WHERE qp_job_poi.poiID = :poiID ORDER BY priority, status, createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve the total number of jobs with status open (0)
    function count_open_jobs()
    {
        global $conn;
        $sql = 'SELECT * FROM qp_job WHERE status = 0';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

	//create a function to add a new job
	function add_job($status, $priority, $jobCodeID, $stationID)
	{
		global $conn;
		$sql = "INSERT INTO qp_job (status, priority, jobCodeID, stationID, createdDate) VALUES (:status, :priority, :jobCodeID, :stationID, now())";
		$statement = $conn->prepare($sql);
		//Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':status', $status);
        $statement->bindValue(':priority', $priority);
        $statement->bindValue(':jobCodeID', $jobCodeID);
		$statement->bindValue(':stationID', $stationID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

    //create a function to add a new badgeID to jobID
    function add_officer_job($jobID, $badgeID)
    {
        global $conn;
        $sql = "INSERT INTO qp_job_officer (jobID, badgeID) VALUES (:jobID, :badgeID)";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':badgeID', $badgeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve the total number of matching badgeID and jobID
    function count_officer_job($jobID, $badgeID)
    {
        global $conn;
        $sql = 'SELECT * FROM qp_job_officer WHERE jobID = :jobID AND badgeID = :badgeID';
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

    //create a function to delete badgeID from jobID
    function delete_officer_job($jobID, $badgeID)
    {
        global $conn;
        $sql = "DELETE FROM qp_job_officer WHERE jobID = :jobID AND badgeID = :badgeID";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':badgeID', $badgeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new poiID and jobID
    function add_poi_job($jobID, $poiID, $relationship)
    {
        global $conn;
        $sql = "INSERT INTO qp_job_poi (jobID, poiID, relationship) VALUES (:jobID, :poiID, :relationship)";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':poiID', $poiID);
        $statement->bindValue(':relationship', $relationship);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve the total number of matching poiID and jobID
    function count_poi_job($jobID, $poiID)
    {
        global $conn;
        $sql = 'SELECT * FROM qp_job_poi WHERE jobID = :jobID AND poiID = :poiID';
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

    //create a function to delete badgeID and jobID
    function delete_poi_job($jobID, $poiID)
    {
        global $conn;
        $sql = "DELETE FROM qp_job_poi WHERE jobID = :jobID AND poiID = :poiID";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':poiID', $poiID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update job status
    function update_job_status($jobID, $status)
    {
        global $conn;
        $sql = "UPDATE qp_job SET status = :status, updatedDate = now() WHERE jobID = :jobID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->bindValue(':status', $status);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

?>