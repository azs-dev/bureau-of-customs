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
	<h2 class="ml-15">SECTIONS</h2>
	<div class="container m-13 w3-animate-opacity">
		<div class="table-responsive" style="width: 650px;">
		<table class="table table-hover table-striped table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th>Section Name</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	$sql = "SELECT table_name FROM information_schema.tables where table_schema='customs_db';";
		  	$result = $conn->query($sql);
			if($result-> num_rows > 0){
        	while($row = $result-> fetch_assoc()){ 
				echo "<tr class='clickable-row' data-href='sectionview.pages.php?tn=".$row['table_name']."'><td>".$row['table_name']."</td></tr>";
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
<div class="container-fluid">
	<div class="row">
	<div class="ml-15">
		<a class="btn btn-secondary" href="../index.php">Home</a>
	</div>
	<div class="ml-12">
		<a class="btn btn-secondary" href="allfiles.pages.php">All Files</a>
	</div>
	</div>
</div>
</body>
</html>