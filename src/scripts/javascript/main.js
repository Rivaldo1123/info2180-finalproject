'use strict'


window.onload = function() {
	main();
}

// Main function
function main() {
}
 
/**
 * Validate login form and update page UI
 */
function logIn(event) {
	event.preventDefault();
	var email_error_block = find_element_by_id("email_error_block");
	var password_error_block = find_element_by_id("password_error_block");
	var error = false;

	if (nullOrBlank(find_element_by_id("email").value)) {
		updateUI(email_error_block, "Email can't be blank");
		error = true;
	} else {
		updateUI(email_error_block, "");
	}

	if (nullOrBlank(find_element_by_id("password").value)) {
		updateUI(password_error_block, "password can't be blank");
		error = true;	
	} else {
		updateUI(password_error_block, "");
	}
  
	if (error) {
		return false;
	}

	var form_data = new FormData();
	form_data.append("email", email);
	form_data.append("password", password);

	passData(event, "./src/scripts/php/login.php", form_data, find_element_by_id("content"));
	// fetchPageData(event, "login", "");
}

function validateNewUserForm(event) {
	event.preventDefault();
	var firstname = find_element_by_id("firstname").value;
	var lastname = find_element_by_id("lastname").value;
	var password = find_element_by_id("password").value;
	var email = find_element_by_id("email").value;

	var form_data = new FormData();
	form_data.append("firstname", firstname);
	form_data.append("lastname", lastname);
	form_data.append("password", password);
	form_data.append("email", email);

	passData(event, "./src/scripts/php/new_user.php", form_data, find_element_by_id("content"));
}

function validateNewIssueForm(event) {
	event.preventDefault();
	var title = find_element_by_id("title").value;
	var description = find_element_by_id("description").value;
	var assigned = find_element_by_id("assigned").value;
	var type = find_element_by_id("type").value;
	var priority = find_element_by_id("priority").value;

	var form_data = new FormData();
	form_data.append("title", title);
	form_data.append("description", description);
	form_data.append("assigned", assigned);
	form_data.append("type", type);
	form_data.append("priority", priority);

	passData(event, "./src/scripts/php/home.php", form_data, find_element_by_id("content"));
}


/**
 * Setup nav link onclick action
 */

function fetchPageData(event, page_name, params_page) {
	var prefix = "./src/scripts/php/";
	var suffix = ".php";
	var page_link = prefix + page_name + suffix;

	if (params_page != "") {
		page_link = page_link + params_page;
	}
	fetchData(event, page_link, find_element_by_id("content"));
}

/**
 * find a html element by id
 * @param {id} id of the element to find
 * @return return element
 */
function find_element_by_id(id) {
	return document.getElementById(id);
}


/*
	Passes form data to redirected_path for processing
*/
function passData(event, to, form_data, set_to) {
	event.preventDefault();
	fetch(to, { method: 'POST', body: form_data })
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

/**
 * Checks to see if a string is null or blank
 * @param {string} word to check.
 * @return true or false
*/
function nullOrBlank(arg) {
	return (arg == "" || arg == null); 
} 

/**
 * Get show page for individual issue
*/
function show(event, issue_id) {
	var params = { issue_id: issue_id };
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "show", "?" + url_params);
}

/**
 * log out user and redirected them to sign in
 * @param {element} element for content to be set
 * @param {string} promise string to be sent to element
 */
function logOut() {
	if (confirm("Are you sure?")) {
		fetchPageData(event, "logout", "");
		fetchPageData(event, "login", "");
		find_element_by_id("side_bar").remove();
	}
}

function home_link() {
	var params = { filter: "all"};
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "home", "?" + url_params);
}

function openIssues() {
	var params = { filter: "open"};
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "home", "?" + url_params);
}

function myTickets() {
	var params = { filter: "myTickets"};
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "home", "?" + url_params);
}

function new_user_link() {
	fetchPageData(event, "new_user", "");
}

function new_issue_link() {
	fetchPageData(event, "new_issue", "");	
}

function markAsClosed(event, issue_id, status) {
	var params = { issue_id: issue_id, set_status_to: status };
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "show", "?" + url_params);
}

function markInProgress(event, issue_id, status) {
	var params = { issue_id: issue_id, set_status_to: status };
	var url_params = new URLSearchParams(Object.entries(params));

	fetchPageData(event, "show", "?" + url_params);
}