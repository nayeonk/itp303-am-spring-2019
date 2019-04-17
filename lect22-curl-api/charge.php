<?php
	if ( !isset($_POST['full-name']) || empty($_POST['full-name'])
		|| !isset($_POST['amount']) || empty($_POST['amount'])
		|| !isset($_POST['card-num']) || empty($_POST['card-num'])
		|| !isset($_POST['exp-month']) || empty($_POST['exp-month'])
		|| !isset($_POST['exp-year']) || empty($_POST['exp-year'])
		|| !isset($_POST['cvc']) || empty($_POST['cvc']) ) {
		$error = "Please fill out all required fields.";
	}
	else {
		// 1. Define the endpoints to the Stripe API
		define("STRIPE_TOKEN_ENDPOINT", "https://api.stripe.com/v1/tokens");
		define("STRIPE_CHARGES_ENDPOINT", "https://api.stripe.com/v1/charges");

		// Stripe uses api keys to authenticate
		define("API_KEY", "sk_test_3OUTh5ZtMnGAVXw0VWBfw915");
		
		// 2. Generate a token with user's credit card and personal info
		$token_info = [
			"card" => [
				"name" => $_POST["full-name"],
				"number" => $_POST["card-num"],
				"exp_month" => $_POST["exp-month"],
				"exp_year" => $_POST["exp-year"],
				"cvc" => $_POST["cvc"]
			]
		];

		// Authentication information - Stripe wants us to pass the API key in the header of the request
		$headers = [
			"Authorization: Bearer " . API_KEY
		];

		// 3. Use curl to send token info to Stripe. Stripe will return a token.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, STRIPE_TOKEN_ENDPOINT);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// POST request requires a little more options
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_info));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$token_response = curl_exec($ch);
		//var_dump($token_response);
		//echo "<hr>";

		// To grab response from Stripe, need to convert JSON string to PHP
		$token_response = json_decode($token_response, true);
		//var_dump($token_response);
		//echo "<hr>";

		//$error = $token_response["error"]["message"];

		// 4. Use curl again to send token and the charge amount to Stripe. Stripe will charge the card and return information about the charge.
		if(isset( $token_response["id"] ) ) {
			// Prep the next request
			$charge_info = [
				"amount" => $_POST["amount"] * 100,
				"currency" => "usd",
				"source" => $token_response["id"]
			];

			curl_setopt($ch, CURLOPT_URL, STRIPE_CHARGES_ENDPOINT);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			// POST request requires a little more options
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($charge_info));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$charge_response = curl_exec($ch);
			var_dump($charge_response);
			echo "<hr>";

			$charge_response = json_decode($charge_response, true);
			var_dump($charge_response);
			echo "<hr>";

			curl_close($ch);	
		}
		else {
			$error = $token_response["error"]["message"];
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation | USC Donations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success">Success! Thank you for your donation. Your order confirmation order is: <?php echo $charge_response["id"]?>.</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="donation_form.php" role="button" class="btn btn-primary">Submit Another Donation</a>
			</div> <!-- .col -->
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>