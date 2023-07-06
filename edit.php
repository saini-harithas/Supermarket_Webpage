<?php 
$page_title = 'Edit grocey';
include('includes/header.html');
echo '<h1>Edit grocery</h1>';

// Check for a valid ID, through GET or POST:
if ( (isset($_GET['id'])) ) { // From edit_grocery.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { 
	echo '<p class="error">This page has been accessed in error.</p>';
	include('includes/footer.html');
	exit();
}

require('./mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = [];


    $it = mysqli_real_escape_string($dbc, trim($_POST['Itemtype']));
    $desc = mysqli_real_escape_string($dbc, trim($_POST['itemdescription']));
		$qu = mysqli_real_escape_string($dbc, trim($_POST['quantity']));
		$pr = mysqli_real_escape_string($dbc, trim($_POST['priceperunit']));


	if (empty($errors)) { // If everything's OK.

			// Make the query:
			$q = "UPDATE grocery SET Itemtype='$it', itemdescription='$desc', priceperunit='$pr', quantity='$qu' WHERE itemname='$id' LIMIT 1";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>Item has been edited.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message.
			}



	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';

	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT * FROM grocery WHERE itemname='$id'";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);

	// Create the form:
	echo '<form action="edit.php" method="post">
    <p><br><label for="Itemname">item name:</label>
        <input type="text" name="itemname" id="itemname" value="' . $row[0] . '"></br></p>
	<p><br><label rowspan = "2">Item type:</label>
        <input type="radio" name="Itemtype" value = "fruit"/>fruit    
		<input type="radio" name="Itemtype" value = "vegetable"/>vegetable</br></p>
	<p><br><label for="itemdescription">item description:</label>
        <input type="text" name="itemdescription" id="itemdescription" value="' . $row[2] . '"></br></p>
	<p><br><label for="price_per_unit">price per unit:</label>
        <input type="text" name="priceperunit" id="priceperunit" value="' . $row[3] . '"></br></p>
	<p><br><label for="quantity">quantity:</label>
        <input type="text" name="quantity" id="quantity" value="' . $row[4] . '"></br></p>
	</br><input type="submit" value="Submit"></br>
    <input type="hidden" name="id" value="' . $id . '">
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);

include('includes/footer.html');
?>