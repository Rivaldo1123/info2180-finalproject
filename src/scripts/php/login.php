<?php 
	include "utils.php";
	require_once "config.php";

	// init session
	session_start();
 ?>

<?php	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>

<div class="sidebar" id="side_bar">
	<nav>
	  <ul>
	    <li><img src="./src/images/home.png" alt="Home logo" height="25" width="25"><a href="#" onclick="home_link();" id="home_link">Home</a></li>
	    <li><img src="./src/images/newuser.png" alt="Add User logo" height="25" width="25"><a href="#" onclick="new_user_link();" id="add_user_link">Add User</a></li>
	    <li><img src="./src/images/add.png" alt="New Issue logo" height="25" width="25"><a href="#" onclick="new_issue_link();" id="new_issue_link">New Issue</a></li>
	    <li><img src="./src/images/logout.png" alt="Logout logo" height="25" width="25"><a href="#" onclick="logOut();" id="logout_link">Logout</a></li>
	  </ul>
	</nav>
</div><!--/.sidebar-->

<?php else: ?>

<?php 
	// Handle login 
	$error_message = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$email = sanitizeData($_POST["email"]);
		$password = sanitizeData($_POST["password"]);

		if (isValid($email) and isValid($password)) {
			$sql = "SELECT id, email, password_hash FROM Users WHERE email = '$email'";
		
			if ($stmp = $pdo->prepare($sql)) {			
				if ($stmp->execute()) {
					// lets see if the user exists now
					$row = $stmp->fetch();
					$id = $row["id"];
					$password_hash = $row["password_hash"];

					// verify login credentials
					if (password_verify($password, $password_hash)) {
						// ok password is correct, so we can now store the session
						session_start();

						// lets remember some stuff about the user in the session
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $id;
					} else {
						// password or email incorrect 
						$error_message = "Incorrect email or password";
					}
				}
			}
		}
	}
?>

<div class="container mt-5">
	<div class="error-box">
		<span id="error-text" class="text-danger">
			<?= $error_message; ?>
		</span>
	</div>

	<form action="" method="post" id="form" onsubmit="return logIn();">
	  <div class="form-group">
	    <label>Email Address</label>
	    <input type="text" name="email" class="form-control" id="email">
	    <span id="email_error_block" class="text-danger"></span>
	  </div>    
	  <div class="form-group">
	    <label>Password</label>
	    <input type="password" name="password" class="form-control" id="password">
	    <span id="password_error_block" class="text-danger"></span>
	  </div>
	  <div class="form-group">
	    <input type="submit" class="btn btn-primary" value="Login">
	  </div>
	</form>
</div>

<?php endif; ?>

<main>
	<div class="container" id="content">
	</div><!--/.container-->
</main>