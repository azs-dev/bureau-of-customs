<?php
		if (!isset($_GET['sn'], $_GET['fn'])) {
			header("Location: ../index.php?noaccess");
		}
?>
<!DOCTYPE html>
<html>
<!--Head-->
<head>
	<?php
	 include("../elements/head.php");	
	 include_once '../includes/mydbhandler.inc.php';
	 ?>
	 <link rel="stylesheet" type="text/css" href="../css/style.css">
	 <link rel="icon" type="image/png" href="../images/logo.png"/>
	<nav class="circle navbar navbar-dark navbar-static-top" style="background-color: #337ab7;">
	<a href="../index.php">
			<img class="navbar-seal" src="../images/logo.png">
	</a>
	  <a class="navbar-brand mr-auto" href="../index.php">
	  	Bureau of Customs
	  </a>	  
	</nav>
</head>
<!--End of Head-->
<body>
	<?php
	$sn = $_GET['sn']; /* sn for section name */
	$fn = $_GET['fn']; /* fn for file name */
	echo "<h2 class='ml-15'>".$fn."</h2>"
	?>
	<div class="container m-14 filev w3-animate-opacity">
		<div class="table-responsive">
		  	<?php
		  	$fname = $_GET['fn'];
		  	$sname = $_GET['sn'];
			$sql = "SELECT * FROM $sname WHERE cs_filename='$fname'";
			$sql2 = "SELECT * FROM $sname WHERE cs_filename='$fname' AND cs_file!='0'";
			$result = mysqli_query($conn,$sql);
			$result2 = mysqli_query($conn,$sql2);
			if ($result->num_rows > 0) {
				$row = $result -> fetch_assoc(); {
					}
				}
		?>
		<div class="form-group">
			<h4>File Name</h4>
			<?php 
			echo '<input type="text" class="form-control" name="filename" value='.$row['cs_filename'].' readonly>';
			?>
		</div>
		<div class="form-group">
			<h4>File Description</h4>
			<?php echo '<textarea rows="3" class="form-control" name="filedesc" readonly style="resize: none;">'.$row['cs_filedesc'].'</textarea>'; ?>
		</div>
		<div class="form-group">
			<h4>Author / Writer*</h4>
			<?php
			echo '<input type="text" class="form-control" name="author" value='.$row['cs_author'].' readonly>';
			?>
		</div>
		<div class="form-group">
			<h4>Date</h4>
			<?php
			echo '<input type="text" class="form-control mb-12" name="date" value='.$row['cs_date'].' readonly>';
			?>
		</div>
		<div class="form-group">
			<h4>Section</h4>
			<?php
			echo '<input type="text" class="form-control mb-12" name="date" value='.$row['cs_section'].' readonly>';
			?>
		</div>
		<?php
		if($result2-> num_rows > 0){
			if($row2 = $result2-> fetch_assoc()){
		echo '<div class="form-group mb-12">
			<h4>Attachment</h4>
			<p><a href="../uploads/'.$row2['cs_file'].'" download>DOWNLOAD ATTACHMENT</a></p>
			</div>';
			}
		}
		?>
	</div>
</div>
<div class="ml-15">
	<a class="btn btn-secondary" href="allfiles.pages.php">Back</a>
	<button class="btn btn-danger ml-12" data-toggle="modal" data-target="#confirmModal">Delete</button>
		<div class="modal fade" id="confirmModal" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<!-- add section information BODY-->
			<?php echo '<form method="POST" action="../includes/deletefile-allfiles.inc.php?fn='.$fname.'&sn='.$sname.'&id='.$row['cs_id'].'">'; ?>
			<div class="modal-body">
				<div class="form-group">
					<h5>Are you sure you want to delete this file?</h5>
				</div>
			</div>
			<!--modal footer-->
			<div class="modal-footer">
				<button type="submit" name="submit" value="submit" class="btn btn-danger btn-md">Yes</button>
				<button class="btn btn-secondary btn-md" data-dismiss="modal">No</button>
			</div>
			<!--end of modal footer-->
		</form>
		</div>
		</div>
	<!-- end of add section modal -->
		</div>

</div>
</body>
</html>