<?php

    //create a function to retrieve all notes by fineID
    function get_notes_by_fine($fineID)
    {
        global $conn;
        //query the database to select all data from the qp_note table by fineID
        $sql = 'SELECT * FROM qp_note WHERE fineID = :fineID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':fineID', $fineID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all notes by poiID
    function get_notes_by_poi($poiID)
    {
        global $conn;
        //query the database to select all data from the note table by poiID
        $sql = 'SELECT * FROM qp_note WHERE poiID = :poiID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all notes by warrantID
    function get_notes_by_warrant($warrantID)
    {
        global $conn;
        //query the database to select all data from the qp_note table by warrantID
        $sql = 'SELECT * FROM qp_note WHERE warrantID = :warrantID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':warrantID', $warrantID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }


    //create a function to retrieve all notes by jobID
    function get_notes_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_notes table by jobID
        $sql = 'SELECT * FROM qp_note WHERE jobID = :jobID ORDER BY createdDate';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new note to fine
    function add_fine_note($content, $fineID)
    {
        global $conn;
        $sql = "INSERT INTO qp_note (content, fineID, createdDate) VALUES (:content, :fineID, now())";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':fineID', $fineID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new note to person of interest
    function add_poi_note($content, $poiID)
    {
        global $conn;
        $sql = "INSERT INTO qp_note (content, poiID, createdDate) VALUES (:content, :poiID, now())";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':poiID', $poiID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new note to warrant
    function add_warrant_note($content, $warrantID)
    {
        global $conn;
        $sql = "INSERT INTO qp_note (content, warrantID, createdDate) VALUES (:content, :warrantID, now())";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':warrantID', $warrantID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to add a new note to job
    function add_job_note($content, $jobID)
    {
        global $conn;
        $sql = "INSERT INTO qp_note (content, jobID, createdDate) VALUES (:content, :jobID, now())";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':jobID', $jobID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

	//create a function to delete an existing note
	function delete_note($noteID)
	{
		global $conn;
		$sql = "DELETE FROM qp_note WHERE noteID = :noteID";
		//Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
		$statement = $conn->prepare($sql);
		$statement->bindValue(':noteID', $noteID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
?>