# info2180-finalproject

This is the Final Project for:
Dexter Small, 620114071
Candice Beckford, 620108447
Samara Soares, 620128064
Raman Lewis, 620117907



# Please Read Before starting to editing files on this branch! 

This guide is to ensure code formatting styles are standard and followed by all developers. 


# Formatting Rules

Variable names

What not to do
```javascript
var firstName = "";
var middleName = "";
```

Use this
```javascript
var first_name = "";
var middle_name = "";
````

Function names should be formatted like this.
```javascript
function addUser() {
}
```

# How to write comments for a function

Please try your best to be descriptive as possible when describing a function. 
 
```javascript
/**
 * Say what the functions does, eg.. This function calculates the total of two numbers
 * @param {number} a number to add.
 * @param {string} b number to add.
 * @return The sum of the two parameters.
*/
function calculateTwoNumbers(a, b) {
	return a + b;
}
```

# How to Write an If Statement

For the purpose of cleaner code please reduce the amount of times else statements are used.
When writing if statements, alway handle false cases first.
If else statments then to get longer due to nesting and make code harder to understand. 

Here is an example of what not to do

```javascript
function checkIfNameIsJohn() {
	if (name == "John") {
		return true;
	} else {
		return false;
	}
}
```

A better way to approach this

```javascript
function checkIfNameIsJohn() {
	if (name != "John") {
		return false;
	}

	return true;
} 
```



