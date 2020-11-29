'user strict'

 
window.onload = function() {
	main();
}


// Main function
function main() {

}


// As a note for writing if statements,
// check for incorrect values first 
function loginFormValidation(email, password) {
	// checks to see if values are correct then return true or false if the incorrect
	// eg. 
	var error = false;

	if ( nullOrBlank(email) || !email.match("add regex here for email")) {
		error = true; 
	}


	.. if (password) .. etc. 
}

function addUserFormValidation(first_name, last_name, password, email) {
	// checks to see if values are correct then return true or false if the incorrect
}

function newIssueFormValidation() {
	// checks to see if values are correct then return true or false if the incorrect
}
 

/**
 * Checks to see if a string is null or blank
 * @param {string} from link to fetch data  
 * @param {element} set_to to set the returned data to
 * @return return function if the wrong status code is recieved
*/
function fetchData(event, from, set_to) {
	event.preventDefault();

	fetch(from) 
		.then(function(response) {
			if (response.status !== 200) {
				console.error(`Something went wrong. Status Code: ${response.status}`);
				// todo : write code to show user an error message, like a popup
				return;
			}

			// Get data and update ui
			response.text().then(function(promise) {
				updateUI(set_to, promise);
			});
		})
		.catch(function(error) {
			console.error(`Fetching error: ${error}`);
		});
	
}


/**
 * Sets an element innerHTML
 * @param {element} element for content to be set
 * @param {string} promise string to be sent to element
*/
function updateUI(element, promise) {
	element.innerHTML = promise;
}



/**** Utility Functions: Useful Functions ****/


/**
 * Checks to see if a string is null or blank
 * @param {string} word to check.
 * @return true or false
*/
function nullOrBlank(arg) {
	return (arg == "" || arg == null); 
}