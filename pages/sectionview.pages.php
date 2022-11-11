<?php
		if (!isset($_GET['tn'])) {
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
	$tn = $_GET['tn']; /* tn stands for table name */
	echo "<h2 class='ml-15'>Files under ".$tn."</h2>"
	?>
	<div class="container m-13 w3-animate-opacity">
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th width="30%">Title</th>
		      <th width="30%">Section</th>
		      <th width="20%">Date Added</th>
		      <th width="10%">Id</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	$tname = $_GET['tn'];
			$sql = "SELECT * FROM $tname";
			$result = mysqli_query($conn,$sql);
			if ($result->num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
						echo "<tr class='clickable-row' data-href='fileview.pages.php?sn=".$row['cs_section']."&fn=".$row['cs_filename']."'>
							<td>".$row['cs_filename']."</td>
						  <td>".$row['cs_section']."</td>
						  <td>".$row['cs_date']."</td>
						  <td>".$row['cs_id']."</td></tr>"; 
					}
				}
			else
			{
				echo '<tbody></table><h4 class="ml-12">This section is empty</h4>';
			}
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
	    		$(".clickable-row").click(function() {
	        		window.location = $(this).data("href");
	    		});
			});
		</script>	
		  </tbody>
		</table>
	</div>
</div>
<div class="ml-15">
	<a class="btn btn-secondary btn-md" href="sections.pages.php">Back</a>
	<button type="button" class="btn btn-danger ml-12" data-toggle="modal" data-target="#confirmModal">Delete</button>
		<!--confirm modal-->
			<div class="modal fade" id="confirmModal" role="dialog">
				<div class="modal-dialog">
				<div class="modal-content">
					<!-- add section information BODY-->
				<?php echo '<form method="POST" action="../includes/deletesection.inc.php?tn='.$tname.'">'; ?>
					<div class="modal-body">
						<div class="form-group">
							<h5>Are you sure you want to delete this section?</h5>

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