<?php
	//create a function for user messages
	function user_message()
	{
		//display a user message if there is an error
		if(isset($_SESSION['error']))
		{ 
			echo '<div class="alert alert-danger alert-dismissible" role="alert">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span></button>';
			echo '<strong>' . $_SESSION['error'] . '</strong>';
			echo '</div>';
			//unset the session named 'error' else it will show each time you visit the page
			unset($_SESSION['error']);
		}
		//display a user message if action is successful
		elseif(isset($_SESSION['success'])) 
		{
            echo '<div class="alert alert-success alert-dismissible" role="alert">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span></button>';
			echo '<strong>' . $_SESSION['success'] . '</strong>';
			echo '</div>';
			//unset the session named 'success' else it will show each time you visit the page
			unset($_SESSION['success']);
		}
	}
?>