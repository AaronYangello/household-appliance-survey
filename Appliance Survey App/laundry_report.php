<?php
include('lib/common.php');

$query = "WITH MostCommonWasherType AS("
        . " SELECT State, LoadingType"
        . " FROM ("
        . " SELECT State, LoadingType, ROW_NUMBER() OVER(PARTITION BY State ORDER BY LoadingTypeCount desc) as RowNum"
        . " FROM ("
        . " SELECT r.State as State, w.LoadingType as LoadingType, COUNT(w. LoadingType) as LoadingTypeCount"
        . " FROM Household h"
        . " INNER JOIN Region r ON r.PostalCode = h.PostalCode"
        . " INNER JOIN Washer w ON w.EmailAddress = h.EmailAddress"
        . " GROUP BY w.LoadingType, r.State"
        . " ) AS t"
        . " ) AS a"
        . " WHERE RowNum = 1),"
        . " MostCommonDryerHeatSource AS("
        . " SELECT State, HeatSource"
        . " FROM ("
        . " SELECT State, HeatSource, ROW_NUMBER() OVER(PARTITION BY State ORDER BY DryerHeatSourceCount desc) as RowNum"
        . " FROM ("
        . " SELECT r.State as State, d.HeatSource as HeatSource, COUNT(d.HeatSource) as DryerHeatSourceCount"
        . " FROM Household h"
        . " INNER JOIN Region r ON r.PostalCode = h.PostalCode"
        . " INNER JOIN Dryer d ON d.EmailAddress = h.EmailAddress"
        . " GROUP BY d.HeatSource, r.State"
        . " ) AS t"
        . " ) AS a"
        . " WHERE RowNum = 1)"
        . " SELECT w.State, w.LoadingType, d.HeatSource"
        . " FROM MostCommonWasherType w"
        . " INNER JOIN MostCommonDryerHeatSource d ON d.State = w.State;";

$result = mysqli_query($db, $query);

if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get data for laundry center report" . __FILE__ ." line:". __LINE__ );
}

$query2 = "SELECT r.State, COUNT(w.EmailAddress) as OnlyWasherCount"
. " FROM Washer w"
. " INNER JOIN Household h ON h.EmailAddress = w.EmailAddress"
. " INNER JOIN Region r ON r.PostalCode = h.PostalCode"
. " WHERE w.EmailAddress NOT IN (SELECT EmailAddress FROM Dryer)"
. " GROUP BY r.State"
. " ORDER BY OnlyWasherCount DESC;";

$result2 = mysqli_query($db, $query2);

if ( !is_bool($result2) && (mysqli_num_rows($result2) > 0) ) {
    $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get data for laundry center report" . __FILE__ ." line:". __LINE__ );
}

?>

<?php include("lib/header.php"); ?>
<title>Laundry Center Report</title>
</head>


<body class="bg-white">
    <div class="m-3"></div>
    <div class="text-center mx-auto">
        <h1>Laundry Center Report</h1>
    </div>
    <div class="m-5"></div>
    <div><h3 class="text-center">Most Common Washer Type and Dryer Heat Source per State</h3></div>
    <table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
        <thead class="thead-dark">
            <tr>
                <th>State</th>
                <th>Washer Type</th>
                <th>Dryer Heat Source</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $data): ?>
            <tr>
                <td><?php echo $data["State"] ?></td>
                <td><?php echo $data["LoadingType"] ?></td>
                <td><?php echo $data["HeatSource"] ?></td>
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

    </br><hr>
    <div><h3 class="text-center">Households with Washer but no Dryer per State</h3></div>
    <table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
        <thead class="thead-dark">
            <tr>
                <th>State</th>
                <th>Number of Households</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result2 as $data): ?>
            <tr>
                <td><?php echo $data["State"] ?></td>
                <td><?php echo $data["OnlyWasherCount"] ?></td>
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>