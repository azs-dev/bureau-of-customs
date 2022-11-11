<!DOCTYPE html>
<html>
<!--Head-->
<head>
	<?php
	 include("elements/head.php");
	 include_once 'includes/mydbhandler.inc.php';
	 ?>
	 <link rel="icon" type="image/png" href="images/logo.png"/>	
</head>
<!--End of Head-->
<body>
	<img id="indexlogo" src="images/logo.png">
	<div class="searchbar">
	<form action="pages/search.pages.php" method="POST">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<input class="form-control input-md col-md-3" type="text" name="search" placeholder="Search" required="required">
			<button class="btn btn-primary btn-md col-md-1" name="submit-search" type="submit">
				<span class="glyphicon glyphicon-search"></span> Search
			</button>
			<div class="col-md-4"></div>
		</div>
		</div>
	</form>
	</div>
	<div class="container">
	<!--SEPARATE AND DELETE BUTTON TWO COLUMNS-->
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-2">
			<button type="button" class="btn btn-secondary btn-md btn-block" data-toggle="modal" data-target="#addfileModal">ADD FILE</button>
			<!--add file modal-->
				<div class="modal fade" id="addfileModal" role="dialog">
					<div class="modal-dialog">
					<div class="modal-content">
						<!--modal content HEADER-->
						<div class="modal-header">
							<h3 class="modal-title">Add File</h3>
							<button type="button btn-md" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- ADD FILE INFORMATION BODY -->
						<form action="includes/addfile.inc.php" method="POST" enctype="multipart/form-data">
							<div class="modal-body">											
								<div class="form-group">
									<h4>File Name*</h4>
									<input type="text" class="form-control" name="filename" required="required">
								</div>
								<div class="form-group">
									<h4>File Desc</h4>
									<input type="text" class="form-control" name="filedesc">
								</div>
								<div class="form-group">
									<h4>Author / Writer*</h4>
									<input type="text" class="form-control" name="author" required="required">
								</div>
								<div class="form-group">
									<h4>Date*</h4>
									<input type="date" class="form-control mb-12" name="date">
								</div>
								<div class="form-group mb-12">
									<h4>Add Attachment</h4>
									<input type="file" name="file">
								</div>
								<div class="form-group">
									<h4>Select Section:</h4>
									<select class="form-control mb-12" name="section" required="required">
									<!-- added sections here-->
									<option selected>--Select--</option>
									<?php
									$sql = "SELECT table_name FROM information_schema.tables where table_schema='customs_db';";
									$result = $conn->query($sql);
									    if($result-> num_rows > 0){
        								while($row = $result-> fetch_assoc()){ 
									echo '<option value='.$row['table_name'].'>'.$row['table_name'].'</option>';
										}
									}
									?>
									<!-- https://stackoverflow.com/questions/8334493/get-table-names-using-select-statement-in-mysql -->
									</select>
								</div>
							</div>
							<!--modal footer-->
							<div class="modal-footer">
								<button type="submit" name="submit" value="submit" class="btn btn-success btn-md">Submit</button>
							</div>
							<!--end of modal footer-->
						</form>
					</div>
					</div>
				</div>
			<!--end of add file modal-->
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-secondary btn-md btn-block" data-toggle="modal" data-target="#addsectionModal">CREATE SECTION</button>
			<!-- add section modal -->
			<div class="modal fade" id="addsectionModal" role="dialog">
				<div class="modal-dialog">
				<div class="modal-content">
					<!--modal content HEADER-->
					<div class="modal-header">
						<h3 class="modal-title">Add Section</h3>
						<button type="button btn-md" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- add section information BODY-->
				<form action="includes/createtable.inc.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<h4>Section Name*</h4>
							<input type="text" class="form-control" name="sectionname" required="required">
						</div>
					</div>
					<!--modal footer-->
					<div class="modal-footer">
						<button type="submit" name="submit" value="submit" class="btn btn-success btn-md">Create</button>
					</div>
					<!--end of modal footer-->
				</form>
				</div>
				</div>
			<!-- end of add section modal -->
		</div>
	</div>
				<div class="col-md-2">
				<a class="btn btn-secondary btn-md btn-block" href="pages/sections.pages.php">DIRECTORY</a>
				<!--<button type="button" class="btn btn-secondary btn-md btn-block">DIRECTORY</button>-->
		</div>
		<div class="col-md-3"></div>
	</div>
	</div> 
	<?php
		$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if (strpos($fullUrl, "existingsectioname") == true) {
			echo "<p style='text-align: center; color: red; font-size: 25px;' class='mt-14 w3-animate-zoom'>Section name already exists!</p>";
			exit();
		}
		elseif (strpos($fullUrl, "submitting=success") == true) {
			echo "<p style='text-align: center; color: green; font-size: 25px;' class='mt-14 w3-animate-zoom'>File added!</p>";
			exit();
		}
		elseif (strpos($fullUrl, "createsection=success") == true) {
			echo "<p style='text-align: center; color: green; font-size: 25px;' class='mt-14 w3-animate-zoom'>Section created!</p>";
			exit();
		}

		elseif (strpos($fullUrl, "noaccess") == true) {
			echo "<p style='text-align: center; color: red; font-size: 25px;' class='mt-14 w3-animate-zoom'>No access!</p>";
			exit();
		}											
	?>
</body>
</html>