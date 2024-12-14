<?php

include('lib/common.php');
// written by GTusername4



?>

<?php include("lib/header.php"); ?>
	

	</head>
	
	<body class="bg-white">
    	<div class="container">
        <div class="m-3"></div>
         <?php 
		$timeline_index=3;
        include("lib/forms-timeline.php"); 
		 ?>
		
			<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Add Appliance</h1>
			</div>
			<div class="card-body mx-5">
	
		
		
			
			 <div class="household_section">
							
							<div class="subtitle">Please select the type of Appliance you would like to add:</div>   
							
							
							<div class="nav_bar">
				<ul> 
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Refrigerator.php" >Refrigerator/freezer</a></li>  
                    <li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Cooker.php" >Cooker</a></li> 
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Washer.php" >Washer </a></li>    
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_Dryer.php" >Dryer</a></li>    
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_TV.php" >TV</a></li>    					
					
				</ul>
			</div>
							
                            
							<form name="houseinfo" action="enter_applianceinfo.php" method="get">
								<table>
									
									
										
									
									
							
								</table>
								
						
							
							</form>
						</div>
						
				
							</form>
	

	


		
	
	</body>
</html>