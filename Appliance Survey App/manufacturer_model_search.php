<?php

	include('lib/common.php');
	include("lib/functions.php");

	$result = [];
	$has_error = false;
	$error_msg = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST['searchText']) || ctype_space($_POST['searchText']))
		{
            $has_error = true;
            $error_msg = "Invalid search text. Please search for something other than whitespace.";
        }
		else
		{
			$searchText = htmlentities($_POST['searchText']);

			$query = "WITH AllAppliances AS (
				SELECT ManufacturerName, ModelName FROM Refrigerator
				UNION ALL
				SELECT ManufacturerName, ModelName FROM Washer
				UNION ALL
				SELECT ManufacturerName, ModelName FROM Dryer
				UNION ALL
				SELECT ManufacturerName, ModelName FROM Tv
				UNION ALL
				SELECT ManufacturerName, ModelName FROM Cooker
			)
			
			SELECT DISTINCT ManufacturerName, ModelName FROM AllAppliances 
			WHERE LOWER(ManufacturerName) LIKE LOWER('%$searchText%')
			OR LOWER(ModelName) LIKE LOWER('%$searchText%')
			ORDER BY ManufacturerName ASC";
		
			$result = mysqli_query($db, $query);
		}
	}
?>
<?php include("lib/header.php"); ?>
<title>Averages by Search Radius</title>
<style>
	table, th, td {
	  border:1px solid black;
	}
</style>
</head>
<body class="bg-white">
    <div class="text-center mx-auto">
        <h1>Manufacturer/Model Search</h1>
	</div>
	<div class="col justify-content-center text-center">
		<div class="card-body mx-5">
			<div class="w-100">
				<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
					<div class="form-group my-3">
						<label for="searchText">Please enter search text:</label>
						<input type="text" name="searchText" class="form-control <?php if($has_error) echo "is-invalid"?>" id="manModelSearch" placeholder="Search text">
						<div class="invalid-feedback"><?php echo $error_msg ?></div>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<div>
		<table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
			<thead>
			<tr>
				<th>Manufacturer</th>
				<th>Model</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $data): ?>
					<?php $manufacturerStyle = getBackgroundColor($data["ManufacturerName"], $_POST['searchText'])?>
					<?php $modelStyle = getBackgroundColor($data["ModelName"], $_POST['searchText'])?>

					<tr>
						<td style=<?php echo $manufacturerStyle;?>><?php echo $data["ManufacturerName"]?></td>
						<td style=<?php echo $modelStyle;?>><?php echo $data["ModelName"]?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
