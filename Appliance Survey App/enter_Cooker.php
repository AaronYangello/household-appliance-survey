<?php

include('lib/common.php');
// written by GTusername4



?>

<?php include("lib/header.php"); ?>
	</head>
	
	<body  class="bg-white">
    	<div class="container">
        <div class="m-3"></div>
        <?php 
		$timeline_index=3;
        include("lib/forms-timeline.php"); 
		?>
		
			<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Enter Cooker form:</h1>
			</div>
			<div class="card-body mx-5">
			
			 <div class="household_section">
							<div class="subtitle">Please provide the details regarding the Cooker Type.</div>   
							
							
							
			</div>
			<div class="nav_bar">
				<ul> 
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Cooker_oven.php">Oven</a></li>  
                    <li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Cooker_cooktop.php">Cooktop</a></li>
				    <li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Cooker_both.php">Both Oven and Cooktop</a></li>   					
					
				</ul>
			</div>				
                            
							
							
					



	
			<div class="m-5"></div>								
			
							<ul style="list-style-type:none;" class="mx-auto justify-content-center"> 
								<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_applianceinfo.php" >Back to Add Appliance</a></li>  
								<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="view_applianceinfo.php">View appliance listing</a></li>             
							</ul>

		<?php
	if (!empty($_GET["Manufacturer"]))
	{
	$_SESSION['Manufacturer'] = $_GET["Manufacturer"];
	$_SESSION['CookerType'] = $_GET["options"];	
	if (!empty($_GET["Modelname"]))
			{
			$_SESSION['Modelname'] = $_GET["Modelname"];	
				
			}
	else if (empty($_GET["Modelname"]))
			{
				$_SESSION['Modelname'] = "";	
			}
		
	}
			
	?>
	
	
	</body>
</html>