<?php

	include('lib/common.php');

	$manufacturer = $_GET['manufacturer'];

	$query = "WITH AllAppliances AS (
		SELECT 'Refrigerator' AS appliancetype, COALESCE(COUNT(*), 0) appCount  FROM Refrigerator WHERE ManufacturerName = '$manufacturer'
		UNION ALL
		SELECT 'Washer' AS appliancetype, COALESCE(COUNT(*), 0) appCount  FROM Washer WHERE ManufacturerName = '$manufacturer'
		UNION ALL
		SELECT 'Dryer' AS appliancetype, COALESCE(COUNT(*), 0) appCount  FROM Dryer WHERE ManufacturerName = '$manufacturer'
		UNION ALL
		SELECT 'TV' AS appliancetype, COALESCE(COUNT(*), 0) appCount  FROM Tv WHERE ManufacturerName = '$manufacturer'
		UNION ALL
		SELECT 'Cooker' AS appliancetype, COALESCE(COUNT(*), 0) appCount  FROM Cooker WHERE ManufacturerName = '$manufacturer'
	)
	
	SELECT appliancetype, appCount
	FROM AllAppliances
	GROUP BY appliancetype
    ORDER BY appCount DESC";

	$result = mysqli_query($db, $query);
?>
<?php include("lib/header.php"); ?>
<title>Manufacturer Drilldown Report</title>
</head>
<body class="bg-white">
	<div class="text-center mx-auto">
        <h1><?php echo $manufacturer ?> Report</h1>
	</div>
	<div>
		<table class="table bg-light table-bordered table-hover mx-auto" style="width: 30%">
			<thead class="thead-dark">
				<tr>
					<th>Appliance</th>
					<th>Count</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($result as $data): ?>
				<tr>
					<td><?php echo $data["appliancetype"] ?></td>
					<td><?php echo $data["appCount"] ?></td>
				</tr>
            <?php endforeach; ?>
			<tr>
			</tbody>
		</table>
	</div>
	<div class="col justify-content-center text-center">
		<a class="btn btn-light btn-outline-secondary" href=top_manufacturers.php>Return to manufacturer report</a>
	</div>
</body>
</html>
