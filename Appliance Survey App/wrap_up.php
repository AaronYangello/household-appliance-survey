<?php

include('lib/common.php');
// written by GTusername4

	
	
	
	
	
	
	

?>

<?php include("lib/header.php"); ?>
	</head>

	

	
	<?php
	

		
		
			
		
	
	
	
	
	
	   if (!empty($_SESSION['email']) && !empty($_SESSION['Hometype'])) {
		   
             echo "<p></p>";
            $query2 = "INSERT INTO Household (EmailAddress, SquareFootage, Occupants, Bedrooms, HomeType, PostalCode) VALUES ('{$_SESSION['email']}', '{$_SESSION['SquareFootage']}', '{$_SESSION['Occupants']}', '{$_SESSION['Bedrooms']}', '{$_SESSION['Hometype']}', '{$_SESSION['PostalCode']}')";				               
            $queryID2 = mysqli_query($db, $query2);
			
			

            //if (is_numeric($query) && (mysqli_num_rows($query) > 0) ) {
          

            
        }
		else 
		{
			echo "<p>Adding Failed  </p>";
		}
		
		
		if ($_SESSION['EnteredPhoneNumber'] == "1")
		{	
			
			$query1 = "INSERT INTO PhoneNumber (AreaCode, Number, PhoneType, EmailAddress) VALUES ('{$_SESSION['AreaCode']}', '{$_SESSION['Number']}', '{$_SESSION['PhoneType']}', '{$_SESSION['email']}')";				               
			$queryID1 = mysqli_query($db, $query1);
		}
	
			
			
			

for ($y = 1; $y <= $_SESSION['appliance_count2']; $y++)
	{
		if ($_SESSION['appliance_type2'][$y] == "Washer")
		{
			$query5 = "INSERT INTO Washer (ApplianceNumber, EmailAddress, ModelName, LoadingType, ManufacturerName) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Modelname2'][$y]}', '{$_SESSION['Washerloadingtype2'][$y]}', '{$_SESSION['Manufacturer2'][$y]}')";				               
			$queryID5 = mysqli_query($db, $query5);
			
		}
			
		else if ($_SESSION['appliance_type2'][$y] == "Dryer")
		{
			$query5 = "INSERT INTO Dryer (ApplianceNumber, EmailAddress, HeatSource, ModelName, ManufacturerName) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Heatsourcetype2'][$y]}', '{$_SESSION['Modelname2'][$y]}', '{$_SESSION['Manufacturer2'][$y]}')";				               
			$queryID5 = mysqli_query($db, $query5);
			
		}

		else if ($_SESSION['appliance_type2'][$y] == "TV")
		{
			$query5 = "INSERT INTO Tv (ApplianceNumber, EmailAddress, ModelName, DisplayType, DisplaySize, MaximumResolution, ManufacturerName) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Modelname2'][$y]}', '{$_SESSION['Displaytype2'][$y]}', '{$_SESSION['DisplaySize2'][$y]}', '{$_SESSION['Resolution2'][$y]}', '{$_SESSION['Manufacturer2'][$y]}')";				               
			$queryID5 = mysqli_query($db, $query5);
			
		}
		
		else if ($_SESSION['appliance_type2'][$y] == "Refrigerator/Freezer")
		{
			$query5 = "INSERT INTO Refrigerator (ApplianceNumber, EmailAddress, ModelName, RefrigeratorType, ManufacturerName) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Modelname2'][$y]}', '{$_SESSION['Refrigeratortype2'][$y]}', '{$_SESSION['Manufacturer2'][$y]}')";				               
			$queryID5 = mysqli_query($db, $query5);
			
		}
											
		else if ($_SESSION['appliance_type2'][$y] == "Cooker") 
		{
			$query5 = "INSERT INTO Cooker (ApplianceNumber, EmailAddress, ModelName, ManufacturerName) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Modelname2'][$y]}', '{$_SESSION['Manufacturer2'][$y]}')";				               
			$queryID5 = mysqli_query($db, $query5);
			
			if ($_SESSION['Cooker_type2'][$y] == "Oven")
			{								
				$query6 = "INSERT INTO Oven (ApplianceNumber, EmailAddress, OvenType) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['OvenType2'][$y]}')";				               
				$queryID6 = mysqli_query($db, $query6);
				$query7 = "INSERT INTO OvenHeatSource (ApplianceNumber, EmailAddress, HeatSource) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Oven_Heat_Source2'][$y]}')";				               
				$queryID7 = mysqli_query($db, $query7);
				
			}
			else if ($_SESSION['Cooker_type2'][$y] == "Cooktop")
			{
				$query6 = "INSERT INTO Cooktop (ApplianceNumber, EmailAddress, HeatSource) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Cooktop_Heat_Source2'][$y]}')";				               
				$queryID6 = mysqli_query($db, $query6);
			}
			else if ($_SESSION['Cooker_type2'][$y] == "Both")
			{
				$query6 = "INSERT INTO Oven (ApplianceNumber, EmailAddress, OvenType) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['OvenType2'][$y]}')";				               
				$queryID6 = mysqli_query($db, $query6);
				$query7 = "INSERT INTO OvenHeatSource (ApplianceNumber, EmailAddress, HeatSource) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Oven_Heat_Source2'][$y]}')";				               
				$queryID7 = mysqli_query($db, $query7);
				$query8 = "INSERT INTO Cooktop (ApplianceNumber, EmailAddress, HeatSource) VALUES ('{$y}', '{$_SESSION['email']}', '{$_SESSION['Cooktop_Heat_Source2'][$y]}')";				               
				$queryID8 = mysqli_query($db, $query8);
			}
			
		}
			
			
	}

		
		
		for ($y = 1; $y <= $_SESSION['Bathroom_count']; $y++) 
			{
				
				if ($_SESSION['bathroom_type2'][$y] == "Full")
					{
 
  
						$query4 = "INSERT INTO FullBath (BathroomNumber, Sinks, Bidets, Commodes, IsPrimary, TubShowerCount, ShowerCount, BathtubCount, EmailAddress) VALUES ('{$y}', '{$_SESSION['num_sink2'][$y]}', '{$_SESSION['Bidet2'][$y]}', '{$_SESSION['Commodes2'][$y]}', '{$_SESSION['PrimaryAvail2'][$y]}', '{$_SESSION['Tub/Showers2'][$y]}', '{$_SESSION['Showers2'][$y]}', '{$_SESSION['Bathtubs2'][$y]}', '{$_SESSION['email']}')";				               
						$queryID4 = mysqli_query($db, $query4);
  
					}
 
				if ($_SESSION['bathroom_type2'][$y] == "Half")	
					{
  
  
						$query3 = "INSERT INTO HalfBath (BathroomNumber, Sinks, Bidets, Commodes, Name, EmailAddress) VALUES ('{$y}', '{$_SESSION['num_sink2'][$y]}', '{$_SESSION['Bidet2'][$y]}', '{$_SESSION['Commodes2'][$y]}', '{$_SESSION['Name2'][$y]}', '{$_SESSION['email']}')";				               
						$queryID3 = mysqli_query($db, $query3);
      
					}
   
			}
		
		
		
		
		
		
		
			
	?>
	<body  class="bg-white">
    	<div class="container">
        <div class="m-3"></div>
        <?php 
		$timeline_index=4;
        include("lib/forms-timeline.php"); 
		?>
			<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Submission Complete!</h1>
			</div>
			
			
			
		
		
		
							<div class="subtitle">Thank you for providing information to Hemkraft!</div>   
                            
							
                
                
                    
					
			
					
		
		
		
	
			

			<div class="navbar-brand text-white">
				<ul> 
					<li><a href="MainMenu.php">Return to the main menu</a></li>  
                                    
					
				</ul>
			</div>

		 
				 
		</div>
	






	


		
		
	
	</body>
</html>