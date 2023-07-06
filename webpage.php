<!DOCTYPE html>
<html lang="en">    
<head>
<meta charset="UTF-8">    
<title>grocery table data insertion</title>
</head>
<body>
<form action="code.php" method="post">
    <p><br><label for="Itemname">item name:</label>
        <input type="text" name="itemname" id="itemname"></br></p>
	<p><br><label rowspan = "2">item type:</label>
        <input type="radio" name="itemtype" value = "fruit"/>fruit    
		<input type="radio" name="itemtype" value = "vegetable"/>vegetable</br></p>
	<p><br><label for="itemdescription">item description:</label>
        <input type="text" name="itemdescription" id="itemdescription"></br></p>
	<p><br><label for="price_per_unit">price per unit:</label>
        <input type="text" name="priceperunit" id="priceperunit"></br></p>
	<p><br><label for="quantity">quantity:</label>
        <input type="text" name="quantity" id="quantity"></br></p>
	</br><input type="submit" value="Submit"></br>
</form>
</body>
</html>
