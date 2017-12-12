<?php //Database creation and checks.
error_reporting(E_ALL); //This will report the errors if something happens.
ini_set('display_errors', 1);
	$DB_server = "localhost";
	$DB_user = "YOUR-IVY-TECH-USERNAME"; //Change to YOUR ivytech screen name
	$DB_Name = "YOUR-IVY-TECH-USERNAME_AJAX_DB"; //change your to YOUR ivytech screen name and add "_AJAX_DB"
	$DB_Conn = new mysqli($DB_server, $DB_user, $DB_user, $DB_Name);
	echo 'Start DB work<br />';
	if($DB_Conn->connect_error){
		$DB_Conn= new mysqli($DB_server, $DB_user, $DB_user);
		$SQL = "CREATE DATABASE $DB_Name";
		if($DB_Conn->query($SQL) === True){
			echo "Database $DB_Name successfully created.<br />";
		} else {
			die("Connection failed: " . $DB_Conn->connect_error);
		}
	} else {
		echo "Database connected. <br /><br />";
	}
	//Fix Zipcodes
	echo '<br />Zip Code.<br />';
	require("objects/zipDumping.php");
	$zipfixer = new zipCodes;
	$DB_Conn->query($zipfixer->killTable);
	if ($DB_Conn->query($zipfixer->createTable) === true){
		$results = $DB_Conn->query("DESCRIBE $zipfixer->DB_table");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo '<br />';
		}
		$DBData = $zipfixer->dataOut();
		foreach($DBData as $insert){
			$DB_Conn->query($insert);
		}
		$results = $DB_Conn->query("SELECT * FROM $zipfixer->DB_table LIMIT 5");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
	} else {
		echo "Error creating Table: " . $DB_Conn->error;
	}
	//Fix Products
	echo '<br />Product Creation<br />';
	require("objects/productDumping.php");
	$productfixer = new product;
	$DB_Conn->query($productfixer->killTable);
	if ($DB_Conn->query($productfixer->createTable) === true){
		$results = $DB_Conn->query("DESCRIBE $productfixer->DB_table");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
		$DBData = $productfixer->dataOut();
		$DB_Conn->query($DBData);
		$results = $DB_Conn->query("SELECT * FROM $productfixer->DB_table LIMIT 5");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
	} else {
		echo "Error creating Table: " . $DB_Conn->error;
	}
	//Fix Typing
	echo '<br />Typing Creation<br />';
	require("objects/typingDumping.php");
	$typingfixer = new typing;
	$DB_Conn->query($typingfixer->killTable);
	if ($DB_Conn->query($typingfixer->createTable) === true){
		$results = $DB_Conn->query("DESCRIBE $typingfixer->DB_table");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
		$DBData = $typingfixer->dataOut();
		$DB_Conn->query($DBData);
		$results = $DB_Conn->query("SELECT * FROM $typingfixer->DB_table LIMIT 5");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
	} else {
		echo "Error creating Table: " . $DB_Conn->error;
	}
	//AJAX Fixer table
	echo '<br />AJAX basic Creation.<br />';
	require("objects/AJAXDumping.php");
	$AJAXFixer = new ajaxtable;
	$DB_Conn->query($AJAXFixer->killTable);
	if ($DB_Conn->query($AJAXFixer->createTable) === true){
		$results = $DB_Conn->query("DESCRIBE $AJAXFixer->DB_table");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo "$dataP ";
			}
			echo "<br />";
		}
		$DBData = $AJAXFixer->dataOut();
		$DB_Conn->query($DBData);
		$results = $DB_Conn->query("SELECT * FROM $AJAXFixer->DB_table LIMIT 5");
		while($row = $results->fetch_assoc()){
			foreach($row as $dataP){
				echo substr($dataP,0,50);
			}
			echo "<br />";
		}
	} else {
		echo "Error creating Table: " . $DB_Conn->error;
	}
	
	$DB_Conn->close();
?>
	