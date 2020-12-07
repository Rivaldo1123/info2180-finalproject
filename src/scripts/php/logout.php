<?php
	session_start();
	unset($_SESSION["id"]);
	$_SESSION["loggedin"] = false;
	unset($_SESSION["loggedin"]);
?>