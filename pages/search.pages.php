<?php
		if (!isset($_POST['submit-search'])) {
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
	<div class="container m-13 w3-animate-opacity">
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
		if (isset($_POST['submit-search'])) {
			$search = mysqli_real_escape_string($conn, $_POST['search']);
			$sql2 = "SELECT * FROM $variable WHERE cs_filename LIKE '%$search%' OR cs_author LIKE '%$search%' OR cs_section LIKE '%$search%'";
			$result2 = mysqli_query($conn, $sql2);
			$queryResult = mysqli_num_rows($result2);
			
			if ($queryResult > 0) {
				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo "<tr class='clickable-row' data-href='allfilesview.pages.php?sn=".$row2['cs_section']."&fn=".$row2['cs_filename']."'>
						<td>".$row2['cs_filename']."</td>
					  <td>".$row2['cs_section']."</td>
					  <td>".$row2['cs_date']."</td></tr>";
				}
			} else{
				echo "<p style='color: red; font-size: 25px; font-weight: bold;' class='mt-12 w3-animate-top'>No results!</p>";
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
	<a class="btn btn-secondary" href="../index.php">BACK</a>
</div>
</body>
</html>
