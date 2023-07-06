<?php 
$page_title = 'View the grocery';
include('includes/header.html');
echo '<h1>view grocery items</h1>';

require('./mysqli_connect.php');

// Number of records to show per page:
$display = 5;
// Determine how many pages there are...
if (isset($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(itemname) FROM grocery";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'in';

// Determine the sorting order:
switch ($sort) {
	case 'in':
		$order_by = 'itemname ASC';
		break;
	case 'it':
		$order_by = 'itemtype ASC';
		break;
	case 'quan':
		$order_by = 'quantity ASC';
		break;
	default:
		$order_by = 'itemname ASC';
		$sort = 'in';
		break;
}

// Define the query:
$q = "SELECT * FROM grocery ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query($dbc, $q); // Run the query.

// Table header:
echo '<table width="60%">
<thead>
<tr>
	<th align="left"><strong>Edit</strong></th>
	<th align="left"><strong>Delete</strong></th>
	<th align="left"><strong><a href="edit_grocery.php?sort=in">Item Name</a></strong></th>
	<th align="left"><strong><a href="edit_grocery.php?sort=it">Item type</a></strong></th>
	<th align="left"><strong>Description</strong></th>
	<th align="left"><strong><a href="edit_grocery.php?sort=quan">quantity</a></strong></th>
	<th align="left"><strong>price</strong></th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit.php?id=' . $row['itemname'] . '">Edit</a></td>
		<td align="left"><a href="delete.php?id=' . $row['itemname'] . '">Delete</a></td>
		<td align="left">' . $row['itemname'] . '</td>
		<td align="left">' . $row['Itemtype'] . '</td>
		<td align="left">' . $row['itemdescription'] . '</td>
		<td align="left">' . $row['quantity'] . '</td>
		<td align="left">' . $row['priceperunit'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {

	echo '<br><p>';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="edit_grocery.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="edit_grocery.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="edit_grocery.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} // End of links section.

include('includes/footer.html');
?>