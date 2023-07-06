<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('./mysqli_connect.php'); // Connect to the db.
$value1 = $_POST["itemname"];
$value2 = $_POST["Itemtype"];
$value3 = $_POST["itemdescription"];
$value4 = $_POST["priceperunit"];
$value5 = $_POST["quantity"];
echo $value1;
echo "  ";
echo $value2;
echo " ";
echo $value3;
echo " ";
echo $value4;
echo " ";
echo $value5;


$sql = "insert into grocery (itemname,itemtype,itemdescription,priceperunit,quantity) values ('$value1', '$value2', '$value3','$value4','$value5')";
if ($dbc->query($sql) === TRUE) {
    echo "<br>Inserted successfully<br>";
} else {
    echo "<br>Error creating table: " . $dbc->error;
if ($itemtype == Null) {
		$itemtypeError = 'please select a radio button';}
}
$dbc->close();
}

?>
<form action="code.php" method="post">
    <p><br><label for="Itemname">item name:</label>
        <input type="text" name="itemname" id="itemname"></br></p>
	<p><br><label rowspan = "2">item type:</label>
        <input type="radio" name="Itemtype" value = "fruit"/>fruit    
		<input type="radio" name="Itemtype" value = "vegetable"/>vegetable</br></p>
	<p><br><label for="itemdescription">item description:</label>
        <input type="text" name="itemdescription" id="itemdescription"></br></p>
	<p><br><label for="price_per_unit">price per unit:</label>
        <input type="text" name="priceperunit" id="priceperunit"></br></p>
	<p><br><label for="quantity">quantity:</label>
        <input type="text" name="quantity" id="quantity"></br></p>
	</br><input type="submit" value="Submit"></br>
</form>
<?php include('includes/footer.html'); ?>
