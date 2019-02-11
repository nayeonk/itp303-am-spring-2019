let regExpObj;

// Two ways to create regex object
// i means case insensitive
// g means global - finds multiple occurences
regExpObj = /regexppattern/ig;

regExpObj = new RegExp('regexpattern', 'ig');

let pattern = /\d/;

// Constructor way useful for dealing with regex that is a variable
regExpObj = new RegExp(pattern, 'ig');
// Cant' do this - it'll always search for "pattern"
regExpObj = /pattern/ig;

let searchTerm = new RegExp(/\d\d/, 'ig');

let text = document.querySelector("#sample-str").innerHTML.trim();

console.log(text);

// .test() is a REGEXP method
console.log( searchTerm.test(text) ); // returns TRUE if there's a match, FALSE if no match.

//.match() is a STRING method will return an array of all the matches
console.log( text.match(searchTerm) );


document.querySelector("#replace-form").onsubmit = function() {

	let findInput = document.querySelector("#find").value;

	let replaceInput = document.querySelector("#replace").value;

	let oldString = document.querySelector("#sample-str").innerHTML.trim();

	// .replace(pattern, what you want instead)
	// return a string with replacements you asked for
	// let newString = oldString.replace(findInput,replaceInput);

	// Create regex object
	let regEx = new RegExp(findInput, 'gi');
	let newString = oldString.replace(regEx,replaceInput);


	console.log(oldString);
	console.log(newString);

	// Get the old string, set it to the newly replaced string.
	document.querySelector("#sample-str").innerHTML = newString;

	return false;
}


document.querySelector("#username-form").onsubmit = function() {

	/*
		- Username cannot be emtpy
		- Username cannot contain uppercase letters.
	*/

	let usernameInput = document.querySelector("#username").value.trim();
	if(/^$/.test(usernameInput)) {
		// username is empty'
		document.querySelector("#username-error").innerHTML = "Cannot be empty";
	}
	else if(/[A-Z]/.test(usernameInput)) {
		document.querySelector("#username-error").innerHTML = "Cannot contain uppercase letters";
	}
	else {
		document.querySelector("#username-error").innerHTML = "Valid username";
	}

	return false;
}

document.querySelector("#phone-form").onsubmit = function() {
	let phoneInput = document.querySelector("#phone").value.trim();

	if(/^$/.test(phoneInput)) {
		// phone is empty'
		document.querySelector("#phone-error").innerHTML = "Cannot be empty";
	}
	else if( /^(\d{10}|\d{3}-\d{3}-\d{4}|\(\d{3}\)\s?\d{3}-\d{4})$/.test(phoneInput) == false ) {
		document.querySelector("#phone-error").innerHTML = "Invalid format.";
	}
	else {
		// valid
		document.querySelector("#phone-error").innerHTML = "Valid phone number";

	}

	return false;
}

document.querySelector("#email-form").onsubmit = function() {
	let  emailInput = document.querySelector("#email").value.trim();

	if(/^$/.test(emailInput)) {
		// phone is empty'
		document.querySelector("#email-error").innerHTML = "Cannot be empty";
	}
	else if( /\w+@\w+\.(com|edu|net)/.test(emailInput) == false ) {
		document.querySelector("#email-error").innerHTML = "Invalid format.";
	}
	else {
		// valid
		document.querySelector("#email-error").innerHTML = "Valid email";

	}

	return false;
}