<?php

include('lib/common.php');
// written by GTusername4

if (!empty($_POST["Manufacturer"])) {
	$_SESSION['appliance_count2'] = $_SESSION['appliance_count2'] + 1;


	if ($_POST["Washerloadingtype"] == "top") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Washer";
		$_SESSION['Washerloadingtype2'][($_SESSION['appliance_count2'])] = "top";
	} else if ($_POST["Washerloadingtype"] == "front") {
		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "Washer";
		$_SESSION['Washerloadingtype2'][($_SESSION['appliance_count2'])] = "front";

	}



	$_SESSION['Manufacturer2'][($_SESSION['appliance_count2'])] = $_POST["Manufacturer"];

	if (!empty($_POST["Modelname"])) {
		$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = $_POST["Modelname"];

	} else if (empty($_POST["Modelname"])) {
		$_SESSION['Modelname2'][($_SESSION['appliance_count2'])] = "";
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
				<h1>Enter Washer form:</h1>
			</div>
			<div class="card-body mx-5">

				<div class="household_section">
					<div class="subtitle">Please provide the details regarding the Washer.</div>



				</div>


				<form name="applianceinfo" action="enter_Washer.php" method="post">
					<table>

						<td class="item_label">Washer loading type:</td>
						<td>
							<select name="Washerloadingtype">
								<option value="top">Top Load</option>
								<option value="front">Front Load</option>

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

					</table>

					<table>

						<tr>
							<td class="item_label">Model name:</td>
							<td>
								<input type="text" name="Modelname" />

						</tr>

						</tr>

					</table>

					<div class="m-1"></div>						
					<button type="submit" class="btn btn-primary">Add</button>
					<div class="m-3"></div>

				</form>
			</div>

			<ul style="list-style-type:none;" class="mx-auto justify-content-center"> 
				<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="enter_applianceinfo.php" >Back to Add Appliance</a></li>  
				<li><a style="color:gray; text-decoration: none;" class="mx-1 border border-dark btn btn-outline-dark" href="view_applianceinfo.php">View appliance listing</a></li>             
			</ul>




</body>

</html>