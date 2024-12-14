<?php

include('lib/common.php');
// written by GTusername4



?>

<?php include("lib/header.php"); ?>
<title>Add Bathroom</title>
	</head>
	
	<body>
    	<div id="main_container">
        <?php 
		$timeline_index=2;
        include("lib/forms-timeline.php"); 
		?>
	
			<div class="card justify-content-center mx-auto" style="width: 95%">
			<div class="card-header">
				<h1>Add Bathroom                 </h1>
			</div>
			<div class="card-body mx-5">
				
			
			 <div class="household_section">
							<div class="subtitle">Please provide the details regarding the bathroom.</div>   
							
							
							<div class="nav_bar">
				<ul> 
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_fullbathinfo.php">Enter Fullbath</a></li>  
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_halfbathinfo.php">Enter Halfbath</a></li> 	
				</ul>
			</div>
							
                            
							<form name="houseinfo" action="enter_bathinfo.php" method="get">
								<table>
									
									
										
									
									
							
								</table>
								
						
							
							</form>
						</div>
						
				
							</form>
	
	<?php
									
                           																						
												
									if (!empty($_GET["SquareFootage"]))
									{
										print "<tr>";
										$_SESSION['Hometype'] = $_GET["Hometype"];
										$_SESSION['SquareFootage'] = $_GET["SquareFootage"];
										echo "<p> SquareFootage has been validated, navigate to next page </p>";
										print "<tr>";
										
										
										
										
									}
									
								
											?>
	
		
	
	


		
	
	</body>
</html>