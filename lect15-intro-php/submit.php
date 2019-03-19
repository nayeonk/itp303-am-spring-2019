<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
	<!-- Display Test Output Here -->
	<?php
		// Write PHP here
		echo "Hello World!";
		// echo is like our print statement. We can write HTML here.
		echo "<strong>Hello World!</strong>";
		echo "<hr>";

		//variables in PHP
		$name = "Tommy";
		$age = 18;

		//echo $name;
		// With PHP we are going to be doing a lot of input validation.
		if(isset($name) && !empty($name)) {
			echo $name;
		}
		else {
			echo "No name";
		}

		echo "<hr>";
		// var_dump is useful to dump out any variables. Tells you the data type and its value.
		var_dump($name);

		// concatenation aka adding strings and variables 
		echo "<hr>";
		echo "My name is " . $name;
		echo "<hr>";
		echo "My name is <em>" . $name . "</em>";

		// Double quotes vs single quotes
		echo "<hr>";
		// single wuotes are display data "As is"
		echo 'Single quotes $name';

		echo "<hr>";
		echo "Double quotes $name";

		// Date/Time
		// Set a timezone
		date_default_timezone_set('America/Los_Angeles');
		// Get current date and time
		echo "<hr>";
		echo date("m-d-y H:i:s T");

		// Arrays
		$courses = ["ITP 303", "ITP 405", "WRIT 340"];

		echo "<hr>";
		echo $courses[0];
		echo "<hr>";

		// For loops in PHP
		for($i=0; $i < sizeof($courses); $i++) {
			echo $courses[$i] . " ";
		}

		// Associative arrays. left hand side is called KEYS. right hand side is called VALUES.
		$courseNames = [
			"ITP 303" => "Full-Stack Web Dev",
			"ITP 405" => "Professional Web Dev",
			"WRIT 340" => "Advanced Writing"
		];
		echo "<hr>";
		echo $courseNames["ITP 303"];
		echo $courseNames["ITP 405"];

		echo "<hr>";
		// Looping through associative arrays, displaying both key and value
		foreach( $courseNames as $key => $val) {
			echo $key . ": " . $val;
			echo "<br>";
		}

		echo "<hr>";
		// Looping through associative arrays, display just value
		foreach( $courseNames as $course) {
			echo $course;
			echo "<br>";
		}

		// Super globals
		echo "<hr>";
		var_dump($_SERVER);

		echo "<hr>";
		echo $_SERVER["HTTP_HOST"];

		// $_POST gets any data that was passed to this page via a POST method
		echo "<hr>";
		var_dump($_POST);
	?>
</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
	<?php
		if( isset($_POST["name"]) && !empty($_POST["name"])) {
			echo $_POST["name"];
		}
		else {
			echo "<div class='text-danger'>Not provided.</div>";
		}
		
	?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->

	<?php
		if( isset($_POST["email"]) && !empty($_POST["email"])) {
			echo $_POST["email"];
		}
		else {
			echo "<div class='text-danger'>Not provided.</div>";
		}
		
	?>
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
	<?php
	if( isset($_POST["subscribe"]) && !empty($_POST["subscribe"])) {
		// Have to loop through subscribe because there cam be multiple values.
		for( $i = 0; $i < sizeof($_POST["subscribe"]); $i++ ) {
			echo $_POST["subscribe"][$i] . ", ";
		}

		// Can do a foreach loop for simplicity. Same as for loop above.
		foreach( $_POST["subscribe"] as $subscribe) {
			echo $subscribe . ", ";
		}
	}
	else {
		echo "<div class='text-danger'>Not provided.</div>";
	}
		
	?>			

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>