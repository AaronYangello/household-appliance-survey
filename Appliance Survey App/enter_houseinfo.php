<?php

include('lib/common.php');

$has_form_error = false;
$error_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST["SquareFootage"]) && is_numeric($_POST["SquareFootage"]) && !empty($_POST["Occupants"])&& is_numeric($_POST["Occupants"]) && is_numeric($_POST["Bedrooms"]))
	{
		$_SESSION['Hometype'] = $_POST["Hometype"];
		$_SESSION['SquareFootage'] = $_POST["SquareFootage"];
		$_SESSION['Occupants'] = $_POST["Occupants"];
		$_SESSION['Bedrooms'] = $_POST["Bedrooms"];
		$_SESSION['PrimaryAvail'] = "No";
		$_SESSION['Bathroom_count'] = 0;
		$_SESSION['appliance_count2']= 0;

		header(REFRESH_TIME . 'url=enter_bathinfo.php');

	}
	else 
	{
		$has_form_error = true;
		$error_msg="Please make sure you enter the whole numeric value, number of SquareFootage and Occupants greater than 0.";
	}
}

?>
<?php include("lib/header.php"); ?>
<title>Enter Household info</title>
	</head>
	
	<body class="bg-white">
    	<div id="container">
		<div class="m-3"></div>
		
        <?php 
            $timeline_index=1;
            include("lib/forms-timeline.php"); 
        ?>
			
			
			<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Enter Household form:</h1>
			</div>
			<div class="card-body mx-5">




			
                       
							<div class="subtitle">Please enter the following details for your household:</div>   
                            
							<form name="houseinfo" action="enter_houseinfo.php" method="post">
								<table>
									
									<tr>
										
										<td class="item_label">Home type:</td>
										<td>
											<select name="Hometype">
												<option value="house">house</option>
												<option value="apartment">apartment</option>
												<option value="townhome">townhome</option>
												<option value="condominium">condominium</option>
												<option value="mobile home">mobile home</option>
											</select>
										</td>																																									
									</tr>
									<tr>
										<td class="item_label">Square Footage</td>
										<td>
											<input type="text" name="SquareFootage"  />
								
										<td>
										
									</tr>
									<tr>
										<td class="item_label">Occupants:</td>
										<td>
											<input type="text" name="Occupants"  />
								
										<td>
										
									</tr>
									<tr>
										<td class="item_label">Bedrooms:</td>
										<td>
											<input type="text" name="Bedrooms" />
								
										<td>
										
									</tr>
									

							
									
							
								</table>

								<div
									style="color:<?php if ($has_form_error) {
										echo "red";
									} else {
										echo "white";
									} ?>">
									<?php echo $error_msg ?>
								</div>

								<button type="submit" class="btn btn-primary col-sm-1">Next</button>
								
							
							</form>
						
                        
                        
                    
					
                        
					 </div> 	
				</div> 
                
                
                    
					
			</div>
				


		</div>	
	
											
											
	
	</body>
</html>