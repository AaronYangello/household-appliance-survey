<?php

include('lib/common.php');

$query = "SELECT COUNT(RF.EmailAddress) AS HouseholdsCount\n"
        . "FROM (SELECT EmailAddress, count(ApplianceNumber) AS ApplianceCount FROM \n"
        . "Refrigerator GROUP BY EmailAddress) AS RF\n"
        . "WHERE RF.ApplianceCount > 1";

$result = mysqli_query($db, $query);
include('lib/show_queries.php');

if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get total household with extra fridge/freezer...<br>" . __FILE__ ." line:". __LINE__ );
}

$query = "WITH Top10StateHouseholdCounts AS(\n"
        . "Select Result.State, SUM(Result.HouseholdsCount) AS HouseholdsCount FROM\n"
        . "(SELECT RF.State, COUNT(RF.EmailAddress) AS HouseholdsCount\n"
        . "FROM (SELECT R.State, RF.EmailAddress, count(ApplianceNumber) AS ApplianceCount\n"
        . "FROM Refrigerator AS RF\n"
        . "INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "INNER JOIN Region as R ON H.PostalCode = R.PostalCode\n"
        . "GROUP BY RF.EmailAddress) AS RF\n"
        . "WHERE RF.ApplianceCount > 1\n"
        . "GROUP BY RF.State, RF.ApplianceCount\n"
        . "ORDER BY RF.State ASC) AS Result\n"
        . "GROUP BY Result.State\n"
        . "ORDER BY Result.HouseholdsCount DESC),\n"

        . "Top10StateApplianceCounts AS(\n"
        . "SELECT Result.State, SUM(Result.ApplianceCount) AS ApplianceCount FROM\n"
        . "(SELECT R.State, COUNT(RF.ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "INNER JOIN Region as R ON H.PostalCode = R.PostalCode\n"
        . "WHERE RF.EmailAddress IN\n"
        . "    (SELECT RF.EmailAddress FROM\n"
        . "        (SELECT R.State, RF.EmailAddress, count(ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "        INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "        INNER JOIN Region as R ON H.PostalCode = R.PostalCode \n"
        . "        GROUP BY RF.EmailAddress) AS RF\n"
        . "    WHERE RF.ApplianceCount > 1\n"
        . "    GROUP BY RF.State, RF.EmailAddress\n"
        . "    ORDER BY Count(RF.EmailAddress) DESC)\n"
        . "GROUP BY RF.EmailAddress) AS Result\n"
        . "GROUP BY Result.State),\n"

        . "Top10StatesChestRefrigerators AS(\n"
        . "SELECT Result.State, SUM(Result.ApplianceCount) AS ApplianceCount FROM \n"
        . "(SELECT R.State, COUNT(RF.ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "INNER JOIN Region as R ON H.PostalCode = R.PostalCode\n"
        . "WHERE RF.RefrigeratorType LIKE '%chest%' AND RF.EmailAddress IN\n"
        . "    (SELECT RF.EmailAddress FROM\n"
        . "        (SELECT R.State, RF.EmailAddress, count(ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "        INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "        INNER JOIN Region as R ON H.PostalCode = R.PostalCode \n"
        . "        GROUP BY RF.EmailAddress) AS RF\n"
        . "    WHERE RF.ApplianceCount > 1\n"
        . "    GROUP BY RF.State, RF.EmailAddress\n"
        . "    ORDER BY Count(RF.EmailAddress) DESC) \n"
        . "GROUP BY RF.EmailAddress) AS Result\n"
        . "GROUP BY Result.State),\n"

        . "Top10StatesUprightRefrigerators AS( \n"
        . "SELECT Result.State, SUM(Result.ApplianceCount) AS ApplianceCount FROM \n"
        . "(SELECT R.State, COUNT(RF.ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "INNER JOIN Region as R ON H.PostalCode = R.PostalCode\n"
        . "WHERE RF.RefrigeratorType LIKE '%upright%' AND RF.EmailAddress IN\n"
        . "    (SELECT RF.EmailAddress FROM\n"
        . "        (SELECT R.State, RF.EmailAddress, count(ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "        INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "        INNER JOIN Region as R ON H.PostalCode = R.PostalCode \n"
        . "        GROUP BY RF.EmailAddress) AS RF\n"
        . "    WHERE RF.ApplianceCount > 1\n"
        . "    GROUP BY RF.State, RF.EmailAddress\n"
        . "    ORDER BY Count(RF.EmailAddress) DESC) \n"
        . "GROUP BY RF.EmailAddress) AS Result\n"
        . "GROUP BY Result.State),\n"

        . "Top10StatesOtherRefrigerators AS(\n"
        . "SELECT Result.State, SUM(Result.ApplianceCount) AS ApplianceCount FROM \n"
        . "(SELECT R.State, COUNT(RF.ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "INNER JOIN Region as R ON H.PostalCode = R.PostalCode\n"
        . "WHERE RF.RefrigeratorType NOT LIKE '%chest%' AND RF.RefrigeratorType NOT LIKE '%upright%' AND RF.EmailAddress IN\n"
        . "    (SELECT RF.EmailAddress FROM\n"
        . "        (SELECT R.State, RF.EmailAddress, count(ApplianceNumber) AS ApplianceCount FROM Refrigerator AS RF\n"
        . "        INNER JOIN Household as H ON H.EmailAddress = RF.EmailAddress\n"
        . "        INNER JOIN Region as R ON H.PostalCode = R.PostalCode \n"
        . "        GROUP BY RF.EmailAddress) AS RF\n"
        . "    WHERE RF.ApplianceCount > 1\n"
        . "    GROUP BY RF.State, RF.EmailAddress\n"
        . "    ORDER BY Count(RF.EmailAddress) DESC) \n"
        . "GROUP BY RF.EmailAddress) AS Result\n"
        . "GROUP BY Result.State)\n"
        
        . "Select HC.State, HC.HouseholdsCount, \n"
        . "COALESCE(ROUND(ChestInfo.ApplianceCount * 100 / AC.ApplianceCount,0),0) AS HouseholdsWithChestFreezerTypePercentage, \n"
        . "COALESCE(ROUND(UprightInfo.ApplianceCount * 100 / AC.ApplianceCount,0),0) AS \n"
        . "HouseholdsWithUprightFreezerTypePercentage, \n"
        . "COALESCE(ROUND(OtherFridgeInfo.ApplianceCount * 100 / AC.ApplianceCount ,0),0) AS HouseholdsWithOtherTypesPercentage \n"
        . "FROM Top10StateHouseholdCounts AS HC\n"
        . "LEFT JOIN Top10StateApplianceCounts AS AC ON HC.State = AC.State\n"
        . "LEFT JOIN Top10StatesChestRefrigerators AS ChestInfo ON HC.State = ChestInfo.State\n"
        . "LEFT JOIN Top10StatesUprightRefrigerators AS UprightInfo ON HC.State = UprightInfo.State\n"
        . "LEFT JOIN Top10StatesOtherRefrigerators AS OtherFridgeInfo ON HC.State = OtherFridgeInfo.State\n"
        . "ORDER BY HC.HouseholdsCount DESC LIMIT 10";

$result2 = mysqli_query($db, $query);
include('lib/show_queries.php');

if ( !is_bool($result2) && (mysqli_num_rows($result2) > 0) ) {
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get top 10 states with fridge/freezers " . __FILE__ ." line:". __LINE__ );
}

?>

<?php include("lib/header.php"); ?>
<title>Extra fridge/freezer Report</title>
</head>
	
    <body class="bg-white">

        <div class="m-3"></div>

        <div class="text-center mx-auto">
            <h1>Extra fridge/freezer Report</h1>
        </div>

        <div class="m-5"></div>

        <div class="text-center text-justify mx-auto">
            <p class="mx-auto text-center">Total households with extra fridge/freezer:  <?php print $row['HouseholdsCount'];?> </p>
        </div>

        <div class="m-3"></div>

        <table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
            <thead class="thead-dark">
            <tr>
                <th>State</th>
                <th>Households Count</th>
                <th>Chest type fridge/freezer percentage</th>
                <th>Upright type fridge/freezer percentage</th>
                <th>Other type fridge/freezer percentage</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($result2 as $data): ?>
                    <tr>
                        <td><?php echo $data["State"] ?></td>
                        <td><?php echo $data["HouseholdsCount"] ?></td>
                        <td><?php echo $data["HouseholdsWithChestFreezerTypePercentage"] ?>%</td>
                        <td><?php echo $data["HouseholdsWithUprightFreezerTypePercentage"] ?>%</td>
                        <td><?php echo $data["HouseholdsWithOtherTypesPercentage"] ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </body>
</html>