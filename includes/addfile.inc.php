<?php
	if (isset($_POST['submit'])) {
	 	include_once 'mydbhandler.inc.php';

	 //upload attachment
		$fileToDb = 0;
		$file = $_FILES['file'];
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg','jpeg','png', 'pdf','doc','txt','docx');

		if (in_array($fileActualExt, $allowed)) 
			{
				if ($fileError === 0) {
					$fileNameNew = uniqid('',true).".".$fileActualExt;
					$fileDestination = '../uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$fileToDb = $fileNameNew;
				}
				else {
				header("Location:/pages/guest/guest.php?failed");	
				}
		}
		else{
			header("Location:/pages/guest/guest.php?errorfiletype");		
		}
		//end of upload

		$filedesc = mysqli_real_escape_string($conn, $_POST['filedesc']);
		$filename = mysqli_real_escape_string($conn, $_POST['filename']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$section = mysqli_real_escape_string($conn, $_POST['section']);

		if (empty($filename)) {
		header("Location: ../index.php?error=emptyfields&fsection=".$filename);
		exit();
		} else {
		$sql = "SELECT * FROM $section";
		$result = $conn->query($sql);
			if($result-> num_rows > 0){
			while($row = $result-> fetch_assoc()){
				if ($filename == $row['table_name']) {
					header("Location: ../index.php?error=existingfilename=".$filename);
					exit();
					}
				}		
			}
		}
		$sql = "INSERT INTO $section (cs_filename, cs_filedesc, cs_author, cs_date, cs_file, cs_section)
				VALUES(?,?,?,?,?,?);";

		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL error";
		} else {
			mysqli_stmt_bind_param($stmt, "ssssss", $filename, $filedesc, $author, $date, $fileToDb, $section);
			mysqli_stmt_execute($stmt);
		}
		header("Location:../index.php?submitting=success");
	}
	else {
		header("Location:../index.php?submitting=failed");
	}

?>