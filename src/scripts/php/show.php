<?php 
	include "utils.php";
	require_once "config.php";

	// init session
	session_start();

	$current_user = $_SESSION['id'];

	// find issue by params["issue_id"]
	$issue_id = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$issue_id = sanitizeData($_GET['issue_id']);

		// check if change status is set if it is then change the status to the set params value
		if (isset($_GET['set_status_to'])) {

			$status = sanitizeData($_GET['set_status_to']);
			$date = date('y-m-d h:i:s');
			$sql = "UPDATE Issues SET status = '$status', updated = '$date'  WHERE Issues.id = '$issue_id'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			echo "Issue updated successfully";
		}

		// get issue
		$sql = "SELECT * FROM `Issues` WHERE Issues.id = '$issue_id'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$issue = $stmt->fetch();
	}

	function getUserById($id, $pdo) {
		$sql = "SELECT Users.firstname, Users.lastname FROM Users INNER JOIN Issues on Users.id = '$id'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(); 
		$user = $stmt->fetch();
		return combine_name($user);   
	}
?>

<div class="header">
	<h1><?= $issue['title'] ?></h1>
	<h4>Issue #<?= $issue['id'] ?></h4>
</div>

<div class="issue">	
	<div class="issue-information">
		<?= $issue['description'] ?>

		<div class="icon-text mt-5">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
			</svg>
			<div class="text">
				<p class="text-muted m-0">
					Issue created on <?= date('F w, Y', strtotime($issue['created'])) ?> at <?= date('h:i A', strtotime($issue['created'])) ?> by <?= getUserById($issue['created_by'], $pdo) ?>	
				</p>
			</div>
		</div>
	
		<div class="icon-text mt-1">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
			</svg>
			<div class="text">
				<p class="text-muted m-0">
					Last updated on <?= date('F w, Y', strtotime($issue['updated'])) ?> at <?= date('H:i A', strtotime($issue['created'])) ?>
				</p>			
			</div>
		</div>
	</div>

	<div class="issue-side-bar">
		<div class="additional-info">
			<p><strong>Assigned To:</strong><br><?= getUserById($issue['assigned_to'], $pdo) ?></p>
			<p><strong>Type:</strong><br><?= $issue['type'] ?></p>
			<p><strong>Priority:</strong><br><?= $issue['priority'] ?></p>
			<p><strong>Status:</strong><br><?= $issue['status'] ?></p>
		</div>
		<div class="actions">
			<?php if ($issue['status'] != "closed"): ?>
				<a href="#" onclick="markAsClosed(event, <?= $issue['id'] ?>,'closed');" class="btn btn-primary">Mark as Closed</a>
			<?php endif; ?>

			<?php if ($issue['status'] != "progress" and $issue['status'] != "closed"): ?>
				<a href="#" onclick="markInProgress(event, <?= $issue['id'] ?>,'progress');" class="btn btn-success">Mark In Progress</a>
			<?php endif; ?>		
		</div>
	</div>
</div>