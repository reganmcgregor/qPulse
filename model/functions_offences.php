<?php

	//create a function to retrieve a single offence
	function get_offence()
	{
		global $conn;

		//retrieve the offenceID from the URL
		$offenceID = $_GET['offenceID'];

		$sql = 'SELECT * FROM qp_offence WHERE offenceID = :offenceID';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':offenceID', $offenceID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve a single offence penalty
	function get_offence_penalty($offenceID)
	{
		global $conn;

		$sql = 'SELECT qp_offence.penalty FROM qp_offence WHERE offenceID = :offenceID';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':offenceID', $offenceID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve all offences
	function get_offences()
	{
		global $conn;
		//query the database to select all data from the qp_offence table
		$sql = 'SELECT * FROM qp_offence ORDER BY act, section';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve all offences by type
    function get_offences_by_type($type)
    {
        global $conn;
        //query the database to select all data from the qp_offence table by type
        $sql = 'SELECT * FROM qp_offence WHERE type = :type ORDER BY act, section';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':type', $type);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

	//create a function to retrieve data for the qp_offence dropdown menu
	function get_offence_dropdown()
	{
		global $conn;
        //query the database to select all data from the qp_offence table
		$sql = 'SELECT * FROM qp_offence ORDER BY act, section';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve data for the qp_offence dropdown menu by type
    function get_offence_dropdown_by_type($type)
    {
        global $conn;
        //query the database to select all data from the qp_offence table by type
        $sql = 'SELECT * FROM qp_offence WHERE type = :type ORDER BY act, section';
        //use a prepared statement to enhance security
        $statement = $conn->prepare($sql);
        $statement->bindValue(':type', $type);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

	//create a function to add a new offence
	function add_offence($name, $act, $section, $description, $type, $penalty)
	{
		global $conn;
		$sql = "INSERT INTO qp_offence (name, act, section, description, type, penalty) VALUES (:name, :act, :section, :description, :type, :penalty)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':act', $act);
        $statement->bindValue(':section', $section);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':type', $type);
		$statement->bindValue(':penalty', $penalty);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}

	//create a function to update an existing offence
	function update_offence($offenceID, $name, $act, $section, $description, $type, $penalty)
	{
		global $conn;
		$sql = "UPDATE qp_offence SET name = :name, act = :act, section = :section, description = :description, type = :type, penalty = :penalty WHERE offenceID = :offenceID";
		$statement = $conn->prepare($sql);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':act', $act);
        $statement->bindValue(':section', $section);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':penalty', $penalty);
        $statement->bindValue(':offenceID', $offenceID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}
?>