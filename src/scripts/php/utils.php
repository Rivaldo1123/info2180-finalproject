<?php 
	// Useful Global functions

	// Sanitize data from input, so we don't get any malicious code
	function sanitizeData($data_to_sanitize) {
		return trim(htmlspecialchars(strip_tags($data_to_sanitize)));
	}

	// checks to see if a value is valid, valid means is not blank or not a number
	function isValid($value) {
		if ($value == "" or $value == null) {
			return false;
		} 
		return true;
	}

	function combine_name($user) {
		return "{$user['firstname']} {$user['lastname']}";
	}

?>