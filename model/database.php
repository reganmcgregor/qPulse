<?php
	//database connection details
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'qPulse';

    //connect to database with a try/catch statement
	try
	{
		$conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
	}
    //the PDOException class represents the error raised by PDO
    //the PDO error is stored in the variable $e
	catch(PDOException $e)
	{
        //the PDO error is returned as a string via the getMessage() function
		$error_message = $e->getMessage();
        //if the connection is not successful display the error message via database_error.php
		include('../view/database_error.php');
		exit();
	}
?>