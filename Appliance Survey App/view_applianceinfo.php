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
			
		
		
		
							<div class="subtitle">You have add the following appliances to your household:</div>   
                            
							
                
                
                    
					
			</div>
		<table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
				<thead class="thead-dark">					
									<tr>
									<th scope="col"> Appliance#</th>
									<th scope="col"> Type</th>
									<th scope="col"> Manufacturer</th>
									<th scope="col"> Model</th>
																					
									<tr>
				</thead>
									
				<tbody>			
					
		
		
		
		<?php                                             
                           																												
									
									for ($y = 1; $y <= $_SESSION['appliance_count2']; $y++) 	
										{
										echo "<tr><td>" . $y ."</td><td>". $_SESSION['appliance_type2'][$y] . "</td><td>" . $_SESSION['Manufacturer2'][$y] . "</td><td>" . $_SESSION['Modelname2'][$y]. "</td><tr>";								
				
										}
									
									
					
							
									
									
											?>
				</tbody>
				</table>

			<div class="navbar-brand d-flex justify-content-center mx-auto text-white">
				<ul> 
					<div class="mx-auto">
					<li><a style="color:gray; margin-bottom:5px; text-decoration: none;" class="mx-auto border border-dark btn btn-outline-dark" href="enter_applianceinfo.php">Add another appliance</a></li>  
                    <div class="mx-auto">
					<li><a style="color:gray; margin-bottom:5px; text-decoration: none;" class="mx-auto border border-dark btn btn-outline-dark" href="wrap_up.php">Finish adding and Submit</a></li>                       
					
				</ul>
			</div>

		
		

		
<?php
	echo "<p>appliance count is: ";
	echo $_SESSION['appliance_count2'] ;
	
		?>
		
	<?php		
		
	for ($y = 1; $y <= $_SESSION['appliance_count2']; $y++) 
	{
 if ($_SESSION['appliance_type2'][$y] == "Washer")	
 {
  echo "<p>Appliance #$y type added:<br>";
  echo $_SESSION['appliance_type2'][$y];
  
  echo "<p>Appliance #$y loading type is: <br>";
  echo $_SESSION['Washerloadingtype2'][$y];
 }
 
 
 else if ($_SESSION['appliance_type2'][$y] == "Dryer")	
 {
  echo "<p>Appliance #$y type added:<br>";
  echo $_SESSION['appliance_type2'][$y];
  
  echo "<p>Appliance #$y loading type is: <br>";
  echo $_SESSION['Heatsourcetype2'][$y];
 }
 
 else if ($_SESSION['appliance_type2'][$y] == "TV")	
 {
  echo "<p>Appliance #$y type added:<br>";
  echo $_SESSION['appliance_type2'][$y];
  
  echo "<p>Appliance #$y Display type is: <br>";
  echo $_SESSION['Displaytype2'][$y];
  
  echo "<p>Appliance #$y Display size is: <br>";
  echo $_SESSION['DisplaySize2'][$y];
  
  echo "<p>Appliance #$y Resolution is: <br>";
  echo $_SESSION['Resolution2'][$y];
  
  
 }
 
 else if ($_SESSION['appliance_type2'][$y] == "Refrigerator/Freezer")	
 {
  echo "<p>Appliance #$y type added:<br>";
  echo $_SESSION['appliance_type2'][$y];
  
  echo "<p>Appliance #$y Refrigerator type is: <br>";
  echo $_SESSION['Refrigeratortype2'][$y];
 }
 
 
 else if ($_SESSION['appliance_type2'][$y] == "Cooker")	
 {
	 echo "<p>Appliance #$y type added:<br>";
	 echo $_SESSION['appliance_type2'][$y];
	 
	 echo "<p>Appliance #$y Cooker type is:<br>";
	 echo $_SESSION['Cooker_type2'][$y];
  
	 
	if ($_SESSION['Cooker_type2'][$y] == "Oven") 
	{
		
  
		echo "<p>Appliance #$y Oven heat source type is: <br>";
		echo $_SESSION['Oven_Heat_Source2'][$y];

		echo "<p>Appliance #$y Oven type added:<br>";
		echo $_SESSION['OvenType2'][$y];	
	}
	
	else if ($_SESSION['Cooker_type2'][$y] == "Cooktop") 
	{
		
		echo "<p>Appliance #$y Cooktop heat source type is: <br>";
		echo $_SESSION['Cooktop_Heat_Source2'][$y];
		
		
	}
	
	else if ($_SESSION['Cooker_type2'][$y] == "Both") 
	{
		echo "<p>Appliance #$y Oven heat source type is: <br>";
		echo $_SESSION['Oven_Heat_Source2'][$y];	
		
		echo "<p>Appliance #$y Oven type added:<br>";
		echo $_SESSION['OvenType2'][$y];
  						
		echo "<p>Appliance #$y Cooktop heat source type is: <br>";
		echo $_SESSION['Cooktop_Heat_Source2'][$y];
		
		
	}
	 
  
 
 }
 
 
 
  
  
  
  
  
  
  
  
  echo "<p>Appliance #$y Manufacturer type added:<br>";
  echo $_SESSION['Manufacturer2'][$y];
  
  echo "<p>Appliance #$y Model nameis: <br>";
  echo $_SESSION['Modelname2'][$y];
 
	}	
		
		
		
		
	?>
	</body>
</html>