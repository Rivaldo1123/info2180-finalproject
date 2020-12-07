<?php 
  include "utils.php";
  require_once "config.php";
  
  // check to see if post is set, if any then store the post data to sql
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = sanitizeData($_POST['firstname']);
    $lastname = sanitizeData($_POST['lastname']);
    $password = sanitizeData($_POST['password']);
    $email = sanitizeData($_POST['email']);
    $date = date('Y-m-d', time());
    $hash = password_hash($password, PASSWORD_BCRYPT); 
     
    // check if user email already exist
    if (isValid($firstname) && isValid($lastname) && isValid($password) && isValid($email) && isEmailValid($email) && userIsUnique($email, $pdo)) {
      // Save data newt_open_window(left, top, width, height)
      $sql = "INSERT INTO Users( firstname, lastname, password_hash, email, date_joined) VALUES 
              ('$firstname', '$lastname', '$hash', '$email', '$date')";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      echo 'User added successfully';
    } else {
      echo 'Something went wrong or user already exist';
    }
  }

  function isEmailValid($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    return true;
  }

  function userIsUnique($email, $pdo) {
    $sql = "SELECT Users.email FROM Users where Users.email = '$email'";
    $found_user = $pdo->query($sql);  
    $results = $found_user->fetchAll(PDO::FETCH_ASSOC);
    if (empty($results)) {
      return true;
    }
    return false;
  }
?>


<h1>New User</h1>

<form id="f1" action="" method="post" onsubmit="return validateNewUserForm(event);">
  <div class="field">
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" required>
  </div>
  <div class="field">
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" required>
  </div>
  <div class="field">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
  </div>
  <div class="field">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder=" e.g: JohnDoe@bugme.com" required>
  </div>
  <input type="submit" name="submitButton" class="btn btn-primary"/>
</form>