'user strict'


window.onload = function() {
    main();
}


// Main function
function main() {
    addUserFormValidation(first_name, last_name, password, email);
}


// As a note for writing if statements,
// check for incorrect values first 
function loginFormValidation(email, password) {
    // checks to see if values are correct then return true or false if the incorrect
    // eg. 
    var error = false;
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

    if (nullOrBlank(email) || !email.match(emailRegex)) {
        error = true;
    }

    if (password);
}

function addUserFormValidation(first_name, last_name, password, email) {
    // checks to see if values are correct then return true or false if the incorrect
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;

    if (first_name != '' && last_name != '' && password != '' && email != '') {
        if (emailRegex.test(email)) {
            return true
        }
    }
    return false
}

function newIssueFormValidation() {
    // checks to see if values are correct then return true or false if the incorrect
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;
    var assigned_to = document.getElementById('assigned_to').value;
    var type = document.getElementById('type').value;
    var priority = document.getElementById('priority').value;

    if (title == '' && description == '' && assigned_to == '' && type == '' && priority == '') {
        return false
    }
    return true;
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