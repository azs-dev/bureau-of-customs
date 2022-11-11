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
	<h2 class="ml-15">ALL FILES</h2>
	<div class="container m-13">
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th width="40%">Title</th>
		      <th width="35%">Section</th>
		      <th width="20%">Date</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	$sql = "SELECT table_name FROM information_schema.tables where table_schema='customs_db';";
		  	$result = $conn->query($sql);
			if($result-> num_rows > 0){
        	while($row = $result-> fetch_assoc()){ 
			$variable = $row['table_name'];
			$sql2 = "SELECT * FROM $variable";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					while ($row2 = $result2 -> fetch_assoc()) {
						echo "<tr class='clickable-row' data-href='allfilesview.pages.php?sn=".$row2['cs_section']."&fn=".$row2['cs_filename']."'>
							<td>".$row2['cs_filename']."</td>
						  <td>".$row2['cs_section']."</td>
						  <td>".$row2['cs_date']."</td></tr>"; /*this opens view modal*/
					}
				}
			}
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
</div>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>