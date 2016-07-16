<?php

    //create a function to retrieve a single person of interest
    function get_poi()
    {
        global $conn;

        //retrieve the poiID from the URL
        $poiID = $_GET['poiID'];

        //query the database to select all data from the qp_poi table
        $sql = 'SELECT * FROM qp_poi WHERE poiID = :poiID ORDER BY firstName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve a single person of interest by poiID
    function get_poi_by_poiID($poiID)
    {
        global $conn;

        //query the database to select all data from the qp_poi table
        $sql = 'SELECT * FROM qp_poi WHERE poiID = :poiID ORDER BY firstName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve all persons of interest
	function get_pois()
	{
		global $conn;
		//query the database to select all data from the qp_poi table
		$sql = 'SELECT * FROM qp_poi ORDER BY lastName ASC, firstName ASC ';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve all persons of interest by jobID
    function get_pois_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_job_poi table and some data from qp_poi by poiID
        $sql = 'SELECT qp_job_poi.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName FROM qp_job_poi INNER JOIN qp_poi USING (poiID) WHERE jobID = :jobID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve person of interest's job relationship by poiID and jobID
    function get_poi_relationship()
    {
        global $conn;

        //retrieve the poID and jobID from the URL
        $poiID = $_GET['poiID'];
        $jobID = $_GET['jobID'];

        //query the database to select all data from the qp_job_poi table and some data from qp_poi by poiID and jobID
        $sql = 'SELECT qp_job_poi.*, qp_poi.firstName AS poiFirstName, qp_poi.lastName AS poiLastName FROM qp_job_poi INNER JOIN qp_poi USING (poiID) WHERE poiID = :poiID AND jobID = :jobID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':poiID', $poiID);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve data for the person of interest dropdown menu
    function get_poi_dropdown()
    {
        global $conn;

        $sql = 'SELECT * FROM qp_poi ORDER BY lastName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

	//create a function to add a new person of interest
	function add_poi($firstName, $lastName, $dob, $gender, $ethnicity, $eyes, $height, $weight, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $photo)
	{
		global $conn;
		$sql = "INSERT INTO qp_poi (firstName, lastName, dob, gender, ethnicity, eyes, height, weight, street, streetType, suburb, state, postcode, phone, mobile, photo) VALUES (:firstName, :lastName, :dob, :gender, :ethnicity, :eyes, :height, :weight, :street, :streetType, :suburb, :state, :postcode, :phone, :mobile, :photo)";
		$statement = $conn->prepare($sql);
		//Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':firstName', $firstName);
		$statement->bindValue(':lastName', $lastName);
		$statement->bindValue(':dob', $dob);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':ethnicity', $ethnicity);
        $statement->bindValue(':eyes', $eyes);
        $statement->bindValue(':height', $height);
        $statement->bindValue(':weight', $weight);
		$statement->bindValue(':street', $street);
		$statement->bindValue(':streetType', $streetType);
        $statement->bindValue(':suburb', $suburb);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postcode', $postcode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':mobile', $mobile);
        $statement->bindValue(':photo', $photo);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

    //create a function to update an existing person of interest
    function update_poi($poiID, $firstName, $lastName, $dob, $gender, $ethnicity, $eyes, $height, $weight, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile)
    {
        global $conn;
        $sql = "UPDATE qp_poi SET firstName = :firstName, lastName = :lastName, dob = :dob, gender = :gender, ethnicity = :ethnicity, eyes = :eyes, height = :height, weight = :weight, street = :street, streetType = :streetType, suburb = :suburb, state = :state, postcode = :postcode, phone = :phone, mobile = :mobile WHERE poiID = :poiID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':dob', $dob);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':ethnicity', $ethnicity);
        $statement->bindValue(':eyes', $eyes);
        $statement->bindValue(':height', $height);
        $statement->bindValue(':weight', $weight);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':streetType', $streetType);
        $statement->bindValue(':suburb', $suburb);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postcode', $postcode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':mobile', $mobile);
        $statement->bindValue(':poiID', $poiID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
?>