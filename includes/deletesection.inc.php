<?php
	if (isset($_POST['submit'])) {
	include_once 'mydbhandler.inc.php';
	$tname = $_GET['tn'];
	
	$sql = "DROP TABLE $tname";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL error";
	} else {
		mysqli_stmt_bind_param($stmt, "s", $feedback);
		mysqli_stmt_execute($stmt);
	}
	header("Location:../pages/sections.pages.php?section=deleted");
	} 
?>