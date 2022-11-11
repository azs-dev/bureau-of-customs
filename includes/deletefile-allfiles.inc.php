<?php
	if (isset($_POST['submit'])) {
	include_once 'mydbhandler.inc.php';
	$fname = $_GET['fn'];
	$sname = $_GET['sn'];
	$id = $_GET['id'];
	
	$sql = "DELETE FROM $sname WHERE cs_filename='$fname' AND cs_id='$id';";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL error";
	} else {
		mysqli_stmt_bind_param($stmt, "s", $feedback);
		mysqli_stmt_execute($stmt);
	}
	header("Location:../pages/allfiles.pages.php");
	} 

?>
