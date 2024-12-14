<?php

	include('lib/common.php');
	include('lib/functions.php');

	$result = [];
	$has_error = false;
	$error_msg = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$postalCodeText = htmlentities($_POST['postalCode']);
		$postalCodeCheckQuery = "SELECT postalcode FROM Region WHERE postalcode = '$postalCodeText'";
		$postalCodeCheckResult = mysqli_query($db, $postalCodeCheckQuery);

        $count = mysqli_num_rows($postalCodeCheckResult);

		if(empty($postalCodeCheckResult) || $count == 0)
		{
            $has_error = true;
            $error_msg = "Invalid postal code entered. Please enter a valid postal code.";
        }
		else
		{
			$searchRadius = htmlentities($_POST['searchRadius']);
			$query = "WITH PostalCodesInRadius AS (
				WITH InputRegion AS (
				SELECT PostalCode, City, Latitude AS inputlat, Longitude AS inputlong
				FROM Region
				WHERE PostalCode = '$postalCodeText')
				SELECT City, PostalCode, d
				FROM(
				SELECT City, PostalCode, 3598.75 * c AS d
				FROM(
				SELECT City, PostalCode, 2*atan2(SQRT(a),SQRT(1-a)) AS c
				FROM(
				SELECT LatLongDelta.City AS City, LatLongDelta.PostalCode AS PostalCode,
				(POWER(SIN((deltalat)/2),2) +
				COS(InputRegion.inputlat*PI()/180)*
				COS(radlat)*
				POWER(SIN((deltalong)/2),2)) AS a
				FROM InputRegion, (
				SELECT Region.City AS City,
				Region.PostalCode AS PostalCode,
				(Region.Latitude*PI()/180) AS radlat,
				(Region.Latitude-InputRegion.inputlat)*PI()/180 AS deltalat,
				(Region.Longitude*PI()/180) AS radlong,
				(Region.Longitude-InputRegion.inputlong)*PI()/180 AS deltalong
				FROM Region, InputRegion
				) LatLongDelta
				) HaversineC
				) HaversineD
				) HaversineResult
				WHERE d <= $searchRadius ORDER BY d
				),
				
				HouseholdQuery AS (
				SELECT COUNT(EmailAddress) housecount, CAST(SUM(Occupants) AS DECIMAL) allOccupants, CAST(AVG(Occupants) AS DECIMAL)
				occupantavg, AVG(Bedrooms) bedroomavg
				FROM Household, PostalCodesInRadius
				WHERE Household.PostalCode IN (PostalCodesInRadius.PostalCode)),
				
				BathroomQuery AS (
				WITH BathroomUnion AS (
				SELECT EmailAddress, Commodes FROM FullBath
				UNION ALL
				SELECT EmailAddress, Commodes FROM HalfBath)
				SELECT COUNT(BathroomUnion.EmailAddress) AS bathroomCount, SUM(Commodes) AS commodeCount
				FROM BathroomUnion
				JOIN Household ON Household.EmailAddress = BathroomUnion.EmailAddress,
				PostalCodesInRadius
				WHERE Household.PostalCode IN (PostalCodesInRadius.PostalCode)),
				
				ApplianceCount AS (
				WITH ApplianceUnion AS (
				SELECT EmailAddress FROM Refrigerator
				UNION ALL
				SELECT EmailAddress FROM Washer
				UNION ALL
				SELECT EmailAddress FROM Dryer
				UNION ALL
				SELECT EmailAddress FROM Cooker
				UNION ALL
				SELECT EmailAddress FROM Tv)
				SELECT COUNT(ApplianceUnion.EmailAddress) AS appliancecount
				FROM ApplianceUnion
				JOIN Household ON Household.EmailAddress = ApplianceUnion.EmailAddress,
				PostalCodesInRadius
				WHERE Household.PostalCode IN (PostalCodesInRadius.PostalCode)),
				
				CookerHeatSource AS (
				WITH CookerUnion AS (
				SELECT EmailAddress, HeatSource FROM Cooktop
				UNION ALL
				SELECT EmailAddress, HeatSource FROM OvenHeatSource)
				SELECT HeatSource, COUNT(HeatSource) AS heatSourceCount
				FROM CookerUnion
				JOIN Household ON Household.EmailAddress = CookerUnion.EmailAddress,
				PostalCodesInRadius
				WHERE Household.PostalCode IN (PostalCodesInRadius.PostalCode)
				GROUP BY HeatSource
				ORDER BY heatSourceCount
				LIMIT 1),
				
				DryerHeatSource AS (
				SELECT HeatSource, COUNT(HeatSource) AS heatSourceCount
				FROM Dryer
				JOIN Household ON Household.EmailAddress = Dryer.EmailAddress,
				PostalCodesInRadius
				WHERE Household.PostalCode IN (PostalCodesInRadius.PostalCode)
				GROUP BY HeatSource
				ORDER BY heatSourceCount
				LIMIT 1)
				SELECT '$postalCodeText ' AS postalCode, $searchRadius AS searchRadius,
				ROUND(BathroomQuery.bathroomCount/HouseholdQuery.houseCount,1) AS bathroomsPerHousehold,
				ROUND(HouseholdQuery.bedroomAvg, 1) AS bedroomsPerHousehold,
				ROUND(HouseholdQuery.occupantAvg) AS occupantsPerHousehold,
				CONCAT('1:',CAST(ROUND((HouseholdQuery.allOccupants/BathroomQuery.commodecount),2) AS CHAR(50))) AS commodesPerOccupant,
				ROUND(ApplianceCount.appliancecount/HouseholdQuery.housecount,1) AS appliancesPerHousehold,
				CookerHeatSource.HeatSource AS CookerHeatSource,
				DryerHeatSource.HeatSource AS DryerHeatSource
				FROM HouseholdQuery, BathroomQuery, ApplianceCount, CookerHeatSource, DryerHeatSource";
		
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
<body  class="bg-white">
	<div class="m-3"></div>
    <div class="text-center mx-auto">
        <h1>Household Search by Radius</h1>
	</div>
	<div class="col justify-content-center text-center">
		<div class="card-body mx-5">
			<div class="col justify-content-center text-center">
				<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
					<div class="form-group form-check-inline my-3">
						<label for="postalCode">Please enter a postal code:</label>
						<input type="text" name="postalCode" class="form-control <?php if($has_error) echo "is-invalid"?>" id="postalCode" placeholder="Postal Code (e.g., 08080)">
						<div class="invalid-feedback"><?php echo $error_msg ?></div>
						<select class="form-control" name="searchRadius" id="radius">
							<option value="0">0 miles</option>
							<option value="5">5 miles</option>
							<option value="10">10 miles</option>
							<option value="25">25 miles</option>
							<option value="50">50 miles</option>
							<option value="100">100 miles</option>
							<option value="250">250 miles</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<div>
		<?php foreach ($result as $row): ?>
		<table class="table bg-light table-bordered table-hover mx-auto" style="width: 50%">
		  <tr>
			<td>Postal Code Input</td>
			<td><?php echo $row["postalCode"]?></td>
		  </tr>
		  <tr>
			<td>Search Radius</td>
			<td><?php echo $row["searchRadius"]?></td>
		  </tr>
		  <tr>
			<td>Bathrooms Per Household</td>
			<td><?php echo $row["bathroomsPerHousehold"]?></td>
		  </tr>
		  <tr>
			<td>Bedroom Per Household</td>
			<td><?php echo $row["bedroomsPerHousehold"]?></td>
		  </tr>
		  <tr>
			<td>Occupants Per Household</td>
			<td><?php echo $row["occupantsPerHousehold"]?></td>
		  </tr>
		  <tr>
			<td>Commodes Per Occupant</td>
			<td><?php echo $row["commodesPerOccupant"]?></td>
		  </tr>
		  <tr>
			<td>Appliances Per Household</td>
			<td><?php echo $row["appliancesPerHousehold"]?></td>
		  </tr>
		  <tr>
			<td>Most Popular Cooker Heat Source</td>
			<td><?php echo $row["CookerHeatSource"]?></td>
		  </tr>
		  <tr>
			<td>Most Popular Dryer Heat Source</td>
			<td><?php echo $row["DryerHeatSource"]?></td>
		  </tr>
		  <?php endforeach; ?>
		</table>
	</div>
</body>
</html>
