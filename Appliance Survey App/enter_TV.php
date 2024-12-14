<?php

include('lib/common.php');
// written by GTusername4
if (!empty($_POST["Manufacturer"]) && is_numeric($_POST["DisplaySize"])) {
	$_SESSION['appliance_count2'] = $_SESSION['appliance_count2'] + 1;

	if ($_POST["Displaytype"] == "Tube") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Displaytype2'][($_SESSION['appliance_count2'])] = "tube";

	} else if ($_POST["Displaytype"] == "DLP") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Displaytype2'][($_SESSION['appliance_count2'])] = "DLP";
	} else if ($_POST["Displaytype"] == "Plasma") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Displaytype2'][($_SESSION['appliance_count2'])] = "plasma";
	} else if ($_POST["Displaytype"] == "LCD") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Displaytype2'][($_SESSION['appliance_count2'])] = "LCD";
	} else if ($_POST["Displaytype"] == "LED") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Displaytype2'][($_SESSION['appliance_count2'])] = "LED";
	}


	if ($_POST["Resolution"] == "480i") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "480i";
	} else if ($_POST["Resolution"] == "576i") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "576i";
	} else if ($_POST["Resolution"] == "720p") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "720p";
	} else if ($_POST["Resolution"] == "1080i") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "1080i";
	} else if ($_POST["Resolution"] == "1080p") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "1080p";
	} else if ($_POST["Resolution"] == "1440p") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "1440p";
	} else if ($_POST["Resolution"] == "2160p") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "2160p (4K)";
	} else if ($_POST["Resolution"] == "4320p") {

		$_SESSION['appliance_type2'][($_SESSION['appliance_count2'])] = "TV";
		$_SESSION['Resolution2'][($_SESSION['appliance_count2'])] = "4320p (8K)";
	}

	$_SESSION['DisplaySize2'][($_SESSION['appliance_count2'])] = $_POST["DisplaySize"];

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
				<h1>Enter TV form:</h1>
			</div>
			<div class="card-body mx-5">

				<div class="household_section">
					<div class="subtitle">Please provide the details regarding the TV.</div>



				</div>


				<form name="TVinfo" action="enter_TV.php" method="post">
					<table>

						<td class="item_label">Display type:</td>
						<td>
							<select name="Displaytype">
								<option value="Tube">Tube</option>
								<option value="DLP">DLP</option>
								<option value="Plasma">Plasma</option>
								<option value="LCD">LCD</option>
								<option value="LED">LED</option>

							</select>
						</td>







					</table>

					<table>

						<td class="item_label">Max Resolution:</td>
						<td>
							<select name="Resolution">
								<option value="480i">480i</option>
								<option value="576i">576i</option>
								<option value="720p">720p</option>
								<option value="1080i">1080i</option>
								<option value="1080p">1080p</option>
								<option value="1440p">1440p</option>
								<option value="2160p">2160p(4k)</option>
								<option value="4320p">4320p(4k)</option>

							</select>
						</td>







					</table>

					<table>

						<tr>
							<td class="item_label">Display Size:</td>
							<td>
								<input  type="number" step="any" name="DisplaySize" />

						</tr>

						</tr>






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