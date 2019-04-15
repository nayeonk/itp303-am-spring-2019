<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// How to send backend data to the frontend?
	// var_dump is one way. but it gives too much information so we can't really use it
	//var_dump("Hello World");

	// Echo is used to give back information to the frontend.
	// echo "Hello World";

	// return "Hello World";

	// echo can only display strings, not arrays.
	// echo $php_array;

	// Converts a php assoc array to JSON string
	// echo json_encode($php_array);

	// echo json_encode($_GET["firstName"]);

	// Grab any values sent via POST request using $_POST
	// echo json_encode($_POST["lastName"]);



	// Connect to the DB and get song search results from the DB
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// SQL statement to search for the song user asked for
	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $_GET['term'] . "%' LIMIT 10;";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

	// Need to now send the search results back to the frontend. Going to send all this info in another array.

	$results_array = [];

	while( $row = $results->fetch_assoc() ) {
		// echo $row['name'];
		array_push( $results_array, $row);
	}

	// Send frontend a JSON string version of all the results.
	echo json_encode($results_array);
?>






