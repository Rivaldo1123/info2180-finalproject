<?php 
  include "utils.php";
  require_once "config.php";
?>

<h1>New Issue</h1>

<form id="f1" action="" method="post" onsubmit="return validateNewIssueForm(event);">
  <div class="field">
    <label for= "title">Title</label>
    <input type="text" id="title" name="title" required>
    <span id="title_error_block text-danger"></span>
  </div>
  <div class="field">
    <label for="description">Description</label>
    <textarea name="description" rows="5" cols="" id="description"></textarea>
    <span id="description_error_block text-danger"></span>
  </div>
  <div class="field">
    <label for="assigned">Assigned To</label>
    <select id="assigned" name="assigned"> 
      <!-- Get users from db -->
      <?php 
        $sql = "SELECT Users.firstname, Users.lastname, Users.id FROM Users";
        $stmt = $pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>s
      <?php foreach ($users as $user): ?>
        <option value="<?= $user['id'] ?>"><?= combine_name($user) ?></option>
      <?php endforeach; ?>
    </select>
    <span id="description_error_block text-danger"></span>
  </div>
  <!--This requires PHP & SQL to do-->
  <div class="field">
    <label for="type">Type</label>
    <select id="type" name="type" required>
        <option value="bug">Bug</option>
        <option value="proposal">Proposal</option>
        <option value="task">Task</option>
    </select>
  </div>
  <div class="field">
    <label for="priority">Priority</label>
    <select id="priority" name="priority" required>
        <option value="minor">Minor</option>
        <option value="major">Major</option>
        <option value="critical">Critical</option>
    </select>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
  </div>
</form>