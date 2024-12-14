<?php

include('lib/common.php');
// written by GTusername4


?>


	</head>
	
	<body>
    	<div id="main_container">
        <?php 
		
		include("lib/status_menu.php"); ?>
		<?php 
			
			echo "<h1>Enter Household info</h1>"; 
			echo "<hr>";
			
			
		?>
			<div class="center_content">	
				<div class="center_left">
					<div class="title_name"></div>          
					<div class="features">   
						
                        <div class="household_section">
							<div class="subtitle">Please enter your email address:</div>   
                            
							<form name="householdform" action="enter_household.php" method="get">
								<table>
									
									<tr>
										<td class="item_label">Email</td>
										<td>
											<input type="text" name="emailaddress" value="<?php if ($row['birthdate']) { print $row['birthdate']; } ?>" />
										
									</tr>
										
									</tr>

								

							
									
							
								</table>
								
								<input type="Submit">
							
							</form>
						</div>
                        
                        
                    
					
                        
					 </div> 	
				</div> 
                
                
                    
					
			</div>
				

               
				 
		</div>
	<?php
												$query2 = "SELECT email FROM user ";
												$result2 = mysqli_query($db, $query2);
												 include('lib/show_queries.php');
												$email_valid = true;
												 
                                                if (is_bool($result2) && (mysqli_num_rows($result2) == 0) ) {
                                                    array_push($error_msg,  "Query ERROR: Failed to get User email... <br>" . __FILE__ ." line:". __LINE__ );
                                                }                                              
                           																						
												while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
										print "<tr>";
										
										print "</tr>";
										if ($row['email'] == $_GET["emailaddress"] )
			{				
										print "<tr>";
										echo "<p> Email already exist </p>";
										print "<td>" . $row['email'] . "</td>";
										print "</tr>";
										$email_valid = false;
										
										
			}
									}
									if ($email_valid == true && !empty($_GET["emailaddress"]))
									{
										print "<tr>";
										$_SESSION['email'] = $_GET["emailaddress"];
										echo "<p> Email has been validated, navigate to next page </p>";
										header(REFRESH_TIME . 'url=enter_houseinfo.php');
										print "<tr>";
									}
									
									
											?>
	
	</body>
</html>