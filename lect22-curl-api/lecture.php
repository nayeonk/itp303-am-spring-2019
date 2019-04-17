<?php

/********************
 *
 * json_encode():	PHP Array => JSON String
 *
 ********************/

$php_array = [
	"first_name" => "Michael",
	"last_name" => "Scott",
	"age" => 40,
	"phone" => [
		"cell" => "123-123-1234",
		"home" => "456-456-4567"
	],
];

echo $php_array["first_name"];
echo "<hr>";
echo $php_array["phone"]["cell"];
echo "<hr>";

// Convert php array to JSON string
echo json_encode($php_array);


/********************
 *
 * json_decode():	JSON String => PHP Array / PHP Object
 *
 ********************/

$json = 
'{
	"first_name": "Michael",
	"last_name": "Scott",
	"age": 40,
	"phone": {
		"cell": "123-123-1234",
		"home": "456-456-4567"
	}
}';

// Convert JSON string to php array - true means convert JSON string to php array. false means convert JSON string to php object.
$decoded_array = json_decode($json, true);
echo "<hr>";
var_dump($decoded_array);
echo "<hr>";
echo $decoded_array["first_name"];
echo $decoded_array["phone"]["cell"];

$decoded_object = json_decode($json, false);
echo "<hr>";
var_dump($decoded_object);
echo "<hr>";
// with objects, arrow notation to get properties/values
echo $decoded_object->first_name;
echo "<hr>";
echo $decoded_object->phone->cell;


/********************
 *
 * cURL & iTunes API
 *
 ********************/


// What's the endpoint?
define("ITUNES_API_ENDPOINT", "https://itunes.apple.com/search");

// Initiate curl
$curl = curl_init();

// Set curl options
curl_setopt($curl, CURLOPT_URL, ITUNES_API_ENDPOINT . "?term=beatles&limit=5");
// Returns the response as a string instead of printing it out.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Verifies the authenticity of the peer's SSL certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Submit the request via curl. Make the HTTP request
$response = curl_exec($curl);
echo "<hr>";
var_dump($response);

// Convert JSON string to PHP array
$response = json_decode($response, true);
echo "<hr>";
var_dump($response);
echo "<hr>";
echo $response["resultCount"];
echo "<hr>";
echo $response["results"][0]["artistName"];

// close curl
curl_close($curl);


?>
















