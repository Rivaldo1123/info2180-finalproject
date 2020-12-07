<?php 
	include "utils.php";
	require_once "config.php";

	// init session
	session_start();

	$current_user = $_SESSION['id'];

	// Get prarms
	$filter = "";
	if(isset($_GET['filter'])) {
		$filter = sanitizeData($_GET["filter"]);
	}

	// check to see if post is set, if any then store the post data to sql
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$title = sanitizeData($_POST['title']);
		$description = sanitizeData($_POST['description']);
		$assigned = sanitizeData($_POST['assigned']);
		$type = sanitizeData($_POST['type']);
		$priority = sanitizeData($_POST['priority']);
		$date = date('y-m-d h:i:s', time());
		$status = "open"; // set status to open by default

		if (isValid($title) && isValid($description) && isValid($assigned) && isValid($type)&& isValid($priority)) {
			// Save data newt_open_window(left, top, width, height)
			$sql = "INSERT INTO Issues( title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES 
							('$title', '$description', '$type', '$priority', '$status', '$assigned', '$current_user', '$date', '$date')";
		 	$stmt = $pdo->prepare($sql);
		 	$stmt->execute();
		 	echo 'Issue added successfully';
		}

	}
 ?>
<div class="inline-header">
	<h1>Issues</h1>
	<a href="#" onclick="new_issue_link()" class="btn btn-success clear-fix">Create New Issue</a>
</div>

<div class="inline-filter">
	<h5>Filter by:</h5>
	<a href="#" onclick="home_link()" class="ml-2 <?php echo  $filter == "all" ? "btn btn-primary" : "dark-text"; ?>">All</a>
	<a href="#" onclick="openIssues()" class="ml-2 dark-text <?php echo  $filter == "open" ? "btn btn-primary text-white" : "dark-text"; ?>">Open</a>
	<a href="#" onclick="myTickets()" class="ml-2 dark-text <?php echo  $filter == "myTickets" ? "btn btn-primary text-white" : "dark-text"; ?>">My Ticket</a>
</div>

<?php

// Fetch the data from sql
$sql = "SELECT * FROM `Issues`";

if ($filter == "open") {
	$sql = "SELECT * FROM `Issues` WHERE status = 'open' ";
} elseif ($filter == "myTickets") {
	$sql = "SELECT * FROM `Issues` WHERE assigned_to = '$current_user'";
}

$stmt = $pdo->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table">
	<thead>
		<th>Title</th>
		<th>Type</th>
		<th>Status</th>
		<th>Assigned To</th>
		<th>Created</th>
	</thead>
	<tbody>
		<?php foreach ($results as $row): ?>
			<?php 
				$assigned_to = $row['assigned_to'];
				$sql = "SELECT Users.firstname, Users.lastname FROM Users INNER JOIN Issues on Users.id = '$assigned_to'";
				$stmp = $pdo->prepare($sql);
				$stmp->execute(); 
				$user = $stmp->fetch();   
			?>
		  <tr>
			  <td>
			  	<strong>#<?= $row['id'] ?></strong>
			  	<a href="#" onclick="show(event, <?= $row['id'] ?>);"><?= $row['title'] ?></a>
			  </td>
			  <td><?= ucfirst($row['type']) ?></td>
			  <td class="badge <?= $row['status'] ?> custom-td"><?= strtoupper($row['status']) ?></td>
			  <td><?= combine_name($user) ?></td>
			  <td><?= date('Y-m-d',	strtotime($row['created'])) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
