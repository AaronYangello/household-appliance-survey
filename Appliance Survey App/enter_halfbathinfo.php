<?php

include('lib/common.php');
// written by GTusername4

$has_form_error = false;
$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (
		is_numeric($_POST["num_sink"]) && is_numeric($_POST["Commodes"])
		&& is_numeric($_POST["Bidet"])
	) {
		$totalvalue = intval($_POST["num_sink"]) + intval($_POST["Commodes"]) + intval($_POST["Bidet"]);
		if ($totalvalue > 0) {
			print "<tr>";


			$_SESSION['Bathroom_count'] = $_SESSION['Bathroom_count'] + 1;


			$_SESSION['bathroom_type2'][($_SESSION['Bathroom_count'])] = $_POST["options"];


			if ($_POST["options"] == "Half") {

				$_SESSION['PrimaryAvail2'][($_SESSION['Bathroom_count'])] = "0";

			}


			$_SESSION['num_sink2'][($_SESSION['Bathroom_count'])] = $_POST["num_sink"];
			$_SESSION['Commodes2'][($_SESSION['Bathroom_count'])] = $_POST["Commodes"];
			$_SESSION['Bidet2'][($_SESSION['Bathroom_count'])] = $_POST["Bidet"];
			$_SESSION['Name2'][($_SESSION['Bathroom_count'])] = $_POST["OptionalName"];

			header(REFRESH_TIME . 'url=view_bathinfo.php');


		} else {
			$has_form_error = true;
			$error_msg = "Please make sure the number you enter is valid and have at least one sink, commode, and/or bidet";
		}


	} else {
		$has_form_error = true;
		$error_msg = "Please make sure the number you enter is valid and have at least one sink, commode, and/or bidet";
	}
}

?>
<?php include("lib/header.php"); ?>


</head>

<body class="bg-white">
	<div class="container">
		<div class="m-3"></div>
		<?php
        $timeline_index = 2;
        include("lib/forms-timeline.php");
        ?>
		<?php




        ?>



		<div class="household_section">
			<div class="subtitle  d-flex justify-content-center">Please provide the details regarding the bathroom.
			</div>

			<div class="card-body mx-2">

				<div class="nav_bar d-flex justify-content-center mx-auto">
					<ul>
						<li><a style="color:gray; text-decoration: none;"
								class="mx-1 border border-dark btn btn-outline-dark" href="enter_fullbathinfo.php">Enter
								Fullbath</a></li>
						<li><a style="color:gray; text-decoration: none;"
								class="mx-1 border border-dark btn btn-outline-dark" href="enter_halfbathinfo.php">Enter
								Halfbath</a></li>
						<li><a style="color:gray; text-decoration: none;"
								class="mx-1 border border-dark btn btn-outline-dark" href="view_bathinfo.php">View
								Bathrooms Info</a></li>
					</ul>
				</div>

				<div class="card-body mx-2">

					<div class="card justify-content-center mx-auto" style="width: 75%">
						<div class="card-header">
							<h1>Bathroom form</h1>
						</div>

						<div class="card-body mx-5">
							<div class="w-50">
								<form name="houseinfo" action="enter_halfbathinfo.php" method="post">
									<table>

										<tr>
											<td class="bath_type">Bathtype</td>
											<td>


												<input type="radio" name="options" value="Half" autocomplete="off" <?php
													if ($current_filename=="enter_fullbathinfo.php") { ?> disabled
												<?php } ?> checked> Half





										</tr>

										</tr>
										<td class="num_sink">Sinks</td>
										<td>
											<input type="number" name="num_sink" value="0" />
											</tr>
											</tr>
										<td class="num_commodes">Commodes</td>
										<td>
											<input type="number" name="Commodes" value="0" />


											</tr>
											</tr>
										<td class="num_bidet">Bidet</td>
										<td>
											<input type="number" name="Bidet" value="0" />
											</tr>
											</tr>
										<td class="num_bathtubs">OptionalName</td>
										<td>
											<input type="text" name="OptionalName" />
											</tr>








									</table>

									<div class="invalid-feedback is-invalid">
										<p>test</p>
									</div>

									<div
										style="color:<?php if ($has_form_error) {
											echo "red";
										} else {
											echo "white";
										} ?>">
										<?php echo $error_msg ?>
									</div>

									<input type="Submit">

								</form>
							</div>

						</div>
					</div>










</body>

</html>