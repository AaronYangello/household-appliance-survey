<?php

include('lib/common.php');
// written by GTusername4

if (!empty($_POST["Manufacturer"]))
	{
	$_SESSION['appliance_count2'] = $_SESSION['appliance_count2'] + 1;		
		
		
	
	$_SESSION['Refrigeratortype'] = $_POST["Refrigeratortype"];	
	
	if ($_POST["Refrigeratortype"] == "Bottom freezer")
										{
										
										$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
										$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "Bottom freezer";
									}
	else if ($_POST["Refrigeratortype"] == "French door")
	{
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
		$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "French door";
				
	}
	
	else if ($_POST["Refrigeratortype"] == "side-by-side")
	{
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
		$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "side-by-side";
				
	}
	
	else if ($_POST["Refrigeratortype"] == "top freezer")
	{
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
		$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "top freezer";
				
	}
	
	else if ($_POST["Refrigeratortype"] == "chest freezer")
	{
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
		$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "chest freezer";
				
	}
	
	else if ($_POST["Refrigeratortype"] == "upright freezer")
	{
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Refrigerator/Freezer";	
		$_SESSION['Refrigeratortype2'][($_SESSION['appliance_count2'])] = "upright freezer";
				
	}
	
	
	
	
	
	
	$_SESSION['Manufacturer2'][($_SESSION['appliance_count2'])] = $_POST["Manufacturer"];
	
	
	if (!empty($_POST["Modelname"]))
			{
			$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = $_POST["Modelname"];	
				
			}
	else if (empty($_POST["Modelname"]))
			{
				$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = "";	
			}
			header(REFRESH_TIME . 'url=view_applianceinfo.php');
	}

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
		<?php 
			
		
			
		?>
		
			<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Enter Refrigerator/Freezer form:</h1>
			</div>
			<div class="card-body mx-5">
			
			 <div class="household_section">
							<div class="subtitle">Please provide the details regarding the Refrigerator/Freezer.</div>   
							
							
							
			</div>
							
                            
							<form name="applianceinfo" action="enter_Refrigerator.php" method="post">
								<table>
								
										<td class="item_label">Refrigerator type:</td>
										<td>
											<select name="Refrigeratortype">
												<option value="Bottom freezer">Bottom freezer</option>
												<option value="French door">French door</option>
												<option value="side-by-side">side-by-side</option>
												<option value="top freezer">top freezer</option>
												<option value="chest freezer">chest freezer</option>
												<option value="upright freezer">upright freezer</option>
											</select>
										</td>
										
										
								
									
							
									
							
								</table>
								
								<table>
								
										<td class="item_label">Manufacturer:</td>
										<td>
											<select name="Manufacturer">
												
											<?php
												$query4 = "SELECT ManufacturerName FROM manufacturer ";
												$result4 = mysqli_query($db, $query4);
												 
												
												 
                                                if (is_bool($result4) && (mysqli_num_rows($result4) == 0) ) {
                                                    array_push($error_msg,  "Query ERROR: Failed to get manufacturer... <br>" . __FILE__ ." line:". __LINE__ );
                                                }                                              
                           																						
												while ($row = mysqli_fetch_array($result4, MYSQLI_ASSOC))
													{
														echo "<option>".$row['ManufacturerName']."</option>";

													}
								
								?>		
												
												
												
											</select>
											
											
										</td>
										
										
								
									
							
									
							
								</table>
								
								<table>
									
									<tr>
										<td class="item_label">Model name:</td>
										<td>
											<input type="text" name="Modelname" />
										
									</tr>
										
									</tr>

								

							
									
							
								</table>
								
								
								
							<button type="submit" class="btn btn-primary col-sm-1">Add</button>
							
							</form>
						</div>

							</form>
							<ul style="list-style-type:none;" class="mx-auto justify-content-center"> 
								<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_applianceinfo.php" >Back to Add Appliance</a></li>  
								<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="view_applianceinfo.php">View appliance listing</a></li>             
							</ul>


	
	
	
											
			


		
	
	</body>
</html>