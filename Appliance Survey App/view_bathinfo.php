<?php

include('lib/common.php');
// written by GTusername4



?>


	</head>
	<?php include("lib/header.php"); ?>
	<title>View Bathrooms info</title>
	<body class="bg-white">
    	<div id="main_container">
        <?php 
		
		$timeline_index=2;
        include("lib/forms-timeline.php"); 
		?>
		
		
		
							<div class="subtitle">You have add the following bathrooms to your household:</div>   
 				
		</div>
				<table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
				<thead class="thead-dark">					
									<tr>
									<th scope="col"> Bathroom#</th>
									<th scope="col"> Type</th>
									<th scope="col"> Primary</th>
																								
									<tr>
				</thead>
									
				<tbody>			
					
		
		
		

			<?php								
			for ($y = 1; $y <= $_SESSION['Bathroom_count']; $y++) 	
			{
				
				$isPrimary="";
				if ($_SESSION['PrimaryAvail2'][$y] == "1")
				{
					$isPrimary="Yes";
					$_SESSION['PrimaryAvail'] = "Yes";	
					
				}

				echo "<tr><td>" . $y ."</td><td>". $_SESSION['bathroom_type2'][$y] . "</td><td>" . $isPrimary . "</td><tr>";
				
			}

?>				
											
											
				</tbody>
				</table>

			<div class="navbar-brand d-flex justify-content-center mx-auto text-white">
				<ul> 
					<li><a style="color:gray; text-decoration: none;" class="mx-auto border border-dark btn btn-outline-dark" href="enter_bathinfo.php">Add another bathroom</a></li>  
                    <div class="card-body mx-1">
					<li><a style="color:gray; text-decoration: none;" class="mx-auto border border-dark btn btn-outline-dark" href="enter_applianceinfo.php">Go to Appliance</a></li>                       
				</ul>
			</div>

				
			
				 
		
	
		
	<?php
	echo "<p>Bathroom count is: ";
	echo $_SESSION['Bathroom_count'] ;
	
		?>
	
	<?php	
	
	
	for ($y = 1; $y <= $_SESSION['Bathroom_count']; $y++) 
	{
 if ($_SESSION['bathroom_type2'][$y] == "Half")	
 {
  echo "<p>Bath #ID $y type added:<br>";
  echo $_SESSION['bathroom_type2'][$y];
  
  echo "<p>Bath #ID $y primary type is: <br>";
  echo $_SESSION['PrimaryAvail2'][$y];
 
  echo "<p>Bath #ID $y #of sinks added:<br>";
  echo $_SESSION['num_sink2'][$y];
  
  echo "<p>Bath #ID $y # of Commodes added:<br>";
  echo $_SESSION['Commodes2'][$y];
  
  echo "<p>Bath #ID $y  # of Bidets added:<br>";
  echo $_SESSION['Bidet2'][$y];
 }
 
 else if ($_SESSION['bathroom_type2'][$y] == "Full")
 {
  echo "<p>Bath #ID $y type added:<br>";
  echo $_SESSION['bathroom_type2'][$y];
  
  echo "<p>Bath #ID $y primary type is: <br>";
  echo $_SESSION['PrimaryAvail2'][$y];
 
  echo "<p>Bath #ID $y #of sinks added:<br>";
  echo $_SESSION['num_sink2'][$y];
  
  echo "<p>Bath #ID $y # of Commodes added:<br>";
  echo $_SESSION['Commodes2'][$y];
  
  echo "<p>Bath #ID $y  # of Bidets added:<br>";
  echo $_SESSION['Bidet2'][$y];
  
  echo "<p>Bath #ID $y #of Bathtubs added:<br>";
  echo $_SESSION['Bathtubs2'][$y];
  
  echo "<p>Bath #ID $y # of Showers added:<br>";
  echo $_SESSION['Showers2'][$y];
  
  echo "<p>Bath #ID $y  # of Tub/Showers added:<br>";
  echo $_SESSION['Tub/Showers2'][$y];
  
 }
  
  
  
 
  
  
	}
	

	
  
  ?>	

	
		
	
	</body>
</html>