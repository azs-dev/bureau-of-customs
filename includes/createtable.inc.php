<?php
	if (isset($_POST['submit'])) {
	 include_once 'mydbhandler.inc.php';

	$secname = mysqli_real_escape_string($conn, $_POST['sectionname']);

	if (empty($secname)) {
		header("Location: ../index.php?error=emptyfields&fsection=".$secname);
		exit();
	} else {
		$sql = "SELECT table_name FROM information_schema.tables where table_schema='customs_db';";
		$result = $conn->query($sql);
			if($result-> num_rows > 0){
			while($row = $result-> fetch_assoc()){
				if ($secname == $row['table_name']) {
					header("Location: ../index.php?error=existingsectioname=".$secname);
					exit();
				}
			}		
		}
	}
		
	$sql ="CREATE TABLE `customs_db`. $secname  ( 
	`cs_id` INT NOT NULL AUTO_INCREMENT,
	`cs_filename` VARCHAR(255) NOT NULL,
	`cs_filedesc` TEXT NOT NULL,  
	`cs_author` VARCHAR(255) NOT NULL, 
	`cs_date` DATE NOT NULL, 
	`cs_file` VARCHAR(255) NOT NULL, 
	`cs_section` VARCHAR(255) NOT NULL,
	 PRIMARY KEY (`cs_id`)) ENGINE = InnoDB;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL error";
	} else {
		mysqli_stmt_execute($stmt);
	}		 
	header("Location:../index.php?createsection=success");



	/*$sql ="CREATE TABLE `customs_db`. $secname  ( 
		`cs_id` INT NOT NULL AUTO_INCREMENT,
		`cs_filename` VARCHAR(255) NOT NULL, 
		`cs_author` VARCHAR(255) NOT NULL, 
		`cs_date` DATE NOT NULL, 
		`cs_file` VARCHAR(255) NOT NULL, 
		`cs_section` VARCHAR(255) NOT NULL,
		 PRIMARY KEY (`cs_id`)) ENGINE = InnoDB;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL error";
	} else {
		mysqli_stmt_execute($stmt);
	}		 
	header("Location:../index.php?createsection=success");*/

	}
	else{
		header("Location:../index.php?createsection=failed");
	}
?>