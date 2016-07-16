<?php

    //create a function to retrieve a single officer
    function get_officer()
    {
        global $conn;

        //retrieve the badgeID from the URL
        $badgeID = $_GET['badgeID'];

        //query the database to select all data from the qp_officer table and some data from qp_station by badgeID
        $sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) WHERE qp_officer.badgeID = :badgeID ORDER BY firstName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve a single officer
    function get_officer_by_badgeID($badgeID)
    {
        global $conn;

        //query the database to select all data from the qp_officer table and some data from qp_station by badgeID
        $sql = 'SELECT qp_officer.* FROM qp_officer WHERE qp_officer.badgeID = :badgeID ORDER BY firstName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve a single officers station
    function get_officer_station($badgeID)
    {
        global $conn;
        //query the database to select all data from the qp_officer table and some data from qp_station by badgeID
        $sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) WHERE qp_officer.badgeID = :badgeID ORDER BY firstName';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->execute();
        //use the fetch() method to retrieve a single row
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve all officers
	function get_officers()
	{
		global $conn;
        //query the database to select all data from the qp_officer table and some data from qp_station
		$sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) ORDER BY duty DESC, lastName ASC, firstName ASC ';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve all officers by role
    function get_officers_by_role($role)
    {
        global $conn;
        //query the database to select all data from the qp_officer table and some data from qp_station by role
        $sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) WHERE role = :role ORDER BY duty DESC, lastName ASC, firstName ASC';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all officers by duty
    function get_officers_by_duty($duty)
    {
        global $conn;
        //query the database to select all data from the qp_officer table and some data from qp_station by futy
        $sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) WHERE duty = :duty ORDER BY lastName ASC, firstName ASC';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':duty', $duty);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all officers by role and duty
    function get_officers_by_role_and_duty($role, $duty)
    {
        global $conn;
        //query the database to select all data from the qp_officer table and some data from qp_station by role and duty
        $sql = 'SELECT qp_officer.*, qp_station.name FROM qp_officer INNER JOIN qp_station USING(stationID) WHERE role = :role AND duty = :duty ORDER BY lastName ASC, firstName ASC';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':duty', $duty);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve all officers by job
    function get_officers_by_job($jobID)
    {
        global $conn;
        //query the database to select all data from the qp_job_officer and qp_officer table and some data from qp_station by jobID
        $sql = 'SELECT qp_job_officer.*, qp_officer.*, qp_station.name FROM qp_job_officer INNER JOIN qp_officer USING (badgeID) INNER JOIN qp_station USING(stationID) WHERE jobID = :jobID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':jobID', $jobID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve data for the officer dropdown menu
    function get_officer_dropdown()
    {
        global $conn;

        $sql = 'SELECT * FROM qp_officer ORDER BY badgeID';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    //create a function to retrieve the total number of matching duty
    function count_officers()
    {
        global $conn;
        $sql = 'SELECT * FROM qp_officer WHERE duty = 1';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
        $count = $statement->rowCount();
        return $count;
    }

    //create a function to retrieve the total number of matching email
	function count_email($email)
	{
		global $conn;
		$sql = 'SELECT * FROM qp_officer WHERE email = :email';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();	
		return $count;
	}


    //create a function to add a new officer
    function add_officer($password, $salt, $firstName, $lastName, $dob, $gender, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $email, $rank, $role, $stationID, $duty)
    {
        global $conn;
        $sql = "INSERT INTO qp_officer (password, salt, firstName, lastName, dob, gender, street, streetType, suburb, state, postcode, phone, mobile, email, rank, role, stationID, duty) VALUES (:password, :salt, :firstName, :lastName, :dob, :gender, :street, :streetType, :suburb, :state, :postcode, :phone, :mobile, :email, :rank, :role, :stationID, :duty)";
        $statement = $conn->prepare($sql);
        //Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.
        $statement->bindValue(':password', $password);
        $statement->bindValue(':salt', $salt);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':dob', $dob);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':streetType', $streetType);
        $statement->bindValue(':suburb', $suburb);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postcode', $postcode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':mobile', $mobile);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':rank', $rank);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':stationID', $stationID);
        $statement->bindValue(':duty', $duty);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update officers duty
    function update_duty($badgeID, $duty)
    {
        global $conn;
        $sql = "UPDATE qp_officer SET duty = :duty WHERE badgeID = :badgeID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':badgeID', $badgeID);
        $statement->bindValue(':duty', $duty);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    //create a function to update an existing officer
    function update_officer($badgeID, $firstName, $lastName, $dob, $gender, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $email, $rank, $role, $stationID)
    {
        global $conn;
        $sql = "UPDATE qp_officer SET firstName = :firstName, lastName = :lastName, dob = :dob, gender = :gender, street = :street, streetType = :streetType, suburb = :suburb, state = :state, postcode = :postcode, phone = :phone, mobile = :mobile, email = :email, rank = :rank, role = :role, stationID = :stationID WHERE badgeID = :badgeID";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':dob', $dob);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':streetType', $streetType);
        $statement->bindValue(':dob', $dob);
        $statement->bindValue(':suburb', $suburb);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postcode', $postcode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':mobile', $mobile);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':rank', $rank);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':stationID', $stationID);
        $statement->bindValue(':badgeID', $badgeID);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve salt
	function retrieve_salt($badgeID)
	{
		global $conn;
		$sql = 'SELECT * FROM qp_officer WHERE badgeID = :badgeID';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':badgeID', $badgeID);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}

	//create a function to login
	function login($badgeID, $password)
	{
		global $conn;
		$sql = 'SELECT * FROM qp_officer WHERE badgeID = :badgeID AND password = :password';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':badgeID', $badgeID);
		$statement->bindValue(':password', $password);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();	
		return $count;
	}
?>