<?php

include('lib/common.php');
// written by GTusername4

if (!empty($_POST["options"])) {

	$_SESSION['appliance_count2'] = $_SESSION['appliance_count2'] + 1;

	if ($_POST["options"] == "Oven") {
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Cooker";
		$_SESSION['Cooker_type2'][($_SESSION['appliance_count2'])] = "Oven";
		$_SESSION['Oven_Heat_Source2'][($_SESSION['appliance_count2'])] = $_POST["Oven_Heat_Source"];
		$_SESSION['OvenType2'][($_SESSION['appliance_count2'])] = $_POST["OvenType"];
		$_SESSION['Manufacturer2'][($_SESSION['appliance_count2'])] = $_POST["Manufacturer"];
		$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = $_POST["Modelname"];

	} else if ($_POST["options"] == "Cooktop") {
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Cooker";
		$_SESSION['Cooker_type2'][($_SESSION['appliance_count2'])] = "Cooktop";
		$_SESSION['Cooktop_Heat_Source2'][($_SESSION['appliance_count2'])] = $_POST["Cooktop_Heat_Source"];
		$_SESSION['Manufacturer2'][($_SESSION['appliance_count2'])] = $_POST["Manufacturer"];
		$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = $_POST["Modelname"];
	} else if ($_POST["options"] == "Both") {
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Cooker";
		$_SESSION['Cooker_type2'][($_SESSION['appliance_count2'])] = "Both";
		$_SESSION['Oven_Heat_Source2'][($_SESSION['appliance_count2'])] = $_POST["Oven_Heat_Source"];
		$_SESSION['OvenType2'][($_SESSION['appliance_count2'])] = $_POST["OvenType"];
		$_SESSION['Cooktop_Heat_Source2'][($_SESSION['appliance_count2'])] = $_POST["Cooktop_Heat_Source"];
		$_SESSION['Manufacturer2'][($_SESSION['appliance_count2'])] = $_POST["Manufacturer"];
		$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = $_POST["Modelname"];
	}

	header(REFRESH_TIME . 'url=view_applianceinfo.php');

} 


?>

<?php include("lib/header.php"); ?>
</head>

<body class="bg-white">
	<div class="container">
		<div class="m-3"></div>
		<?php
        $timeline_index = 3;
        include("lib/forms-timeline.php");
        ?>
		<div class="card justify-content-center mx-auto" style="width: 75%">
			<div class="card-header">
				<h1>Add Cooker with Cooktop:</h1>
			</div>
			<div class="card-body mx-5">
				<div class="w-50">




					<div class="subtitle">Please provide the details regarding the Cooker Cooktop.</div>






					<form name="applianceinfo" action="enter_Cooker_cooktop.php" method="post">
						<table>

							<tr>
								<td class="Cooker_type">Cooker type</td>
								<td>


									<input type="radio" name="options" value="Cooktop" autocomplete="off" <?php if
										($current_filename=="enter_halfbathinfo.php") { ?> disabled
									<?php } ?> checked> Cooktop





							</tr>



							<td class="item_label">Manufacturer:</td>
							<td>
								<select name="Manufacturer">


									<?php
                                                $query4 = "SELECT ManufacturerName FROM manufacturer ";
                                                $result4 = mysqli_query($db, $query4);



                                                if (is_bool($result4) && (mysqli_num_rows($result4) == 0)) {
	                                                array_push($error_msg, "Query ERROR: Failed to get Manufacturer Name... <br>" . __FILE__ . " line:" . __LINE__);
                                                }

                                                while ($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
	                                                $count = $count + 1;
	                                                echo "<option>" . $row['ManufacturerName'] . "</option>";

                                                }

                                                ?>



								</select>
							</td>








							<tr>
								<td class="item_label">Model name:</td>
								<td>
									<input type="text" name="Modelname" />

							</tr>

							</tr>








							<tr>
								<td class="Heat_Source">Heat Source</td>
								<td>


									<input type="radio" name="Cooktop_Heat_Source" value="Gas" autocomplete="off"
										checked> Gas
									<input type="radio" name="Cooktop_Heat_Source" value="Electric" autocomplete="off"
										checked> Electric
									<input type="radio" name="Cooktop_Heat_Source" value="Radiant Electric"
										autocomplete="off" checked> Radiant Electric
									<input type="radio" name="Cooktop_Heat_Source" value="Induction" autocomplete="off"
										checked> Induction





							</tr>








						</table>





						<div class="m-1"></div>						
						<button type="submit" class="btn btn-primary">Add</button>
						<div class="m-3"></div>

					</form>
				</div>

				</form>





				<ul style="list-style-type:none;" class="mx-auto justify-content-center"> 
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_applianceinfo.php" >Back to Add Appliance</a></li>  
					<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="view_applianceinfo.php">View appliance listing</a></li>             
				</ul>




</body>

</html>