<?php 

$page_title = 'Edit a User';
include ('manage.html');
echo '<h1>Edit a User</h1>';

// Check for a valID user ID, through GET or POST:
if ( (isset($_GET['ID'])) && (is_numeric($_GET['ID'])) ) { // From view_to2446992_Karate_Student_App.php
	$ID = $_GET['ID'];
} elseif ( (isset($_POST['ID'])) && (is_numeric($_POST['ID'])) ) { // Form submission.
	$ID = $_POST['ID'];
} else { // No valID ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('connector.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['FirstName'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($database, trim($_POST['FirstName']));
	}
	
	// Check for a last name:
	if (empty($_POST['LastName'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($database, trim($_POST['LastName']));
	}

	// Check for an EmailAddress address:
	if (empty($_POST['EmailAddressAddress'])) {
		$errors[] = 'You forgot to enter your EmailAddress address.';
	} else {
		$e = mysqli_real_escape_string($database, trim($_POST['EmailAddressAddress']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique EmailAddress address:
		$q = "SELECT ID FROM to2446992_Karate_Student_App WHERE EmailAddress='$e' AND user_ID != $ID";
		$r = @mysqli_query($database, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE to2446992_Karate_Student_App SET FirstName='$fn', LastName='$ln', EmailAddress='$e' WHERE user_ID=$ID LIMIT 1";
			$r = @mysqli_query ($database, $q);
			if (mysqli_affected_rows($database) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The user has been edited.</p>';	
				
			} else { // If it dID not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($database) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The EmailAddress address has already been registered.</p>';
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT FirstName, LastName, EmailAddress FROM to2446992_Karate_Student_App WHERE ID=$ID";		
$r = @mysqli_query ($database, $q);

if (mysqli_num_rows($r) == 1) { // ValID user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit_user.php" method="post">
<p>First Name: <input type="text" name="FirstName" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>Last Name: <input type="text" name="LastName" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>EmailAddress Address: <input type="text" name="EmailAddress" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hIDden" name="ID" value="' . $ID . '" />
</form>';

} else { // Not a valID user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($database);
		
include ('includes/footer.html');
?>