<?php
	//create a function to retrieve all job codes
	function get_job_codes()
	{
		global $conn;
		//query the database to select all data from the job_code table
		$sql = 'SELECT * FROM qp_job_code ORDER BY code';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve a single job code
	function get_job_code()
	{
		global $conn;

		//retrieve the jobCodeID from the URL
		$jobCodeID = $_GET['jobCodeID'];

		$sql = 'SELECT * FROM qp_job_code WHERE jobCodeID = :jobCodeID';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':jobCodeID', $jobCodeID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve data for the job code dropdown menu
	function get_job_code_dropdown()
	{
		global $conn;

		$sql = 'SELECT * FROM qp_job_code ORDER BY code';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//create a function to add a new job code
	function add_job_code($code, $category, $description)
	{
		global $conn;
		$sql = "INSERT INTO qp_job_code (code, category, description) VALUES (:code, :category, :description)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':code', $code);
		$statement->bindValue(':category', $category);
		$statement->bindValue(':description', $description);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

	//create a function to update an existing job code
	function update_job_code($jobCodeID, $code, $category, $description)
	{
		global $conn;
		$sql = "UPDATE qp_job_code SET code = :code, category = :category, description = :description WHERE jobCodeID = :jobCodeID";
		$statement = $conn->prepare($sql);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':jobCodeID', $jobCodeID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}
?>