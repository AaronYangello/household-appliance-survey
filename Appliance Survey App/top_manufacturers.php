<?php

	include('lib/common.php');
	include('lib/functions.php');

	$query = "WITH AllAppliances AS (
		SELECT ManufacturerName FROM Refrigerator
		UNION ALL
		SELECT ManufacturerName FROM Washer
		UNION ALL
		SELECT ManufacturerName FROM Dryer
		UNION ALL
		SELECT ManufacturerName FROM Tv
		UNION ALL
		SELECT ManufacturerName FROM Cooker
	)
	
	SELECT ManufacturerName, COUNT(AllAppliances.ManufacturerName) manCount 
	FROM AllAppliances GROUP BY AllAppliances.ManufacturerName ORDER BY manCount DESC
	LIMIT 25";

	$result = mysqli_query($db, $query);
?>
</head>

<?php include("lib/header.php"); ?>
<title>Top Manufacturers Report</title>
<body class="bg-white">
	<div class="text-center mx-auto">
        <h1>Top Manufacturers Report</h1>
	</div>
	<div>
		<table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
			<thead class="thead-dark">
			<tr>
				<th>Manufacturer</th>
				<th>Appliance Count</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($result as $data): ?>
				<tr>
					<?php debug_to_console(htmlspecialchars($data["ManufacturerName"])) ?>
					<td><a href=manufacturer_drilldown_report.php?manufacturer=<?php echo urlencode(htmlspecialchars($data["ManufacturerName"])) ?>><?php echo $data["ManufacturerName"] ?></a></td>
					<td><?php echo $data["manCount"] ?></td>
				</tr>
            <?php endforeach; ?>
			<tr>
			</tbody>
		</table>
	</div>
</body>
</html>
