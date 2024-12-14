<?php
include('lib/common.php');

$prequery = "SELECT @numHouses := (SELECT COUNT(EmailAddress) FROM Household); ";

mysqli_query($db, $prequery);

$query = "WITH AllBathrooms AS ( "
. " SELECT EmailAddress, Sinks, Bidets, Commodes FROM HalfBath "
. " UNION ALL "
. " SELECT EmailAddress, Sinks, Bidets, Commodes FROM FullBath "
. " ) "
. " SELECT "
. " MIN(BathroomCount) AS MinNumBathrooms, "
. " ROUND(SUM(BathroomCount)/@numHouses, 1) AS AvgNumBathrooms, "
. " MAX(BathroomCount) AS MaxNumBathrooms, "
. " MIN(CommodesCount) AS MinNumCommodes, "
. " ROUND(SUM(CommodesCount)/@numHouses, 1) AS AvgNumCommodes, "
. " MAX(CommodesCount) AS MaxNumCommodes, "
. " MIN(SinksCount) AS MinNumSinks, "
. " ROUND(SUM(SinksCount)/@numHouses, 1) AS AvgNumSinks, "
. " MAX(SinksCount) AS MaxNumSinks, "
. " MIN(BidetsCount) AS MinNumBidets, "
. " ROUND(SUM(BidetsCount)/@numHouses, 1) AS AvgNumBidets, "
. " MAX(BidetsCount) AS MaxNumBidets "
. " FROM ( "
. " SELECT b.EmailAddress, "
. " COUNT(b.EmailAddress) AS BathroomCount, "
. " COALESCE(SUM(b.Commodes),0) AS CommodesCount, "
. " COALESCE(SUM(b.Sinks),0) AS SinksCount, "
. " COALESCE(SUM(b.Bidets),0) AS BidetsCount "
. " FROM AllBathrooms b "
. " INNER JOIN Household h ON h.EmailAddress = b.EmailAddress "
. " GROUP BY b.EmailAddress "
. " ) AS t; ";

$result = mysqli_query($db, $query);

if (!is_bool($result) && (mysqli_num_rows($result) > 0)) {
    $result_row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}

$query2 = "SELECT "
. " MIN(BathroomCount) AS MinNumHalfBathrooms, "
. " ROUND(SUM(BathroomCount)/@numHouses, 1) AS AvgNumHalfBathrooms, "
. " MAX(BathroomCount) AS MaxNumHalfBathrooms "
. " FROM ( "
. " SELECT b.EmailAddress, COUNT(b.EmailAddress) AS BathroomCount "
. " FROM HalfBath b "
. " INNER JOIN Household h ON h.EmailAddress = b.EmailAddress "
. " GROUP BY b.EmailAddress "
. " ) as t; ";

$result2 = mysqli_query($db, $query2);

if (!is_bool($result2) && (mysqli_num_rows($result2) > 0)) {
    $result2_row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}

$query3 = "SELECT"
    . " MIN(BathroomCount) AS MinNumFullBathrooms,"
    . " ROUND(SUM(BathroomCount)/@numHouses, 1) AS AvgNumFullBathrooms,"
    . " MAX(BathroomCount) AS MaxNumFullBathrooms,"
    . " MIN(TubShowerCount) AS MinNumTubShowers,"
    . " ROUND(SUM(TubShowerCount)/@numHouses, 1) AS AvgNumTubShowers,"
    . " MAX(TubShowerCount) AS MaxNumTubShowers,"
    . " MIN(ShowerCount) AS MinNumShowers,"
    . " ROUND(SUM(ShowerCount)/@numHouses, 1) AS AvgNumShowers,"
    . " MAX(ShowerCount) AS MaxNumShowers,"
    . " MIN(BathtubCount) AS MinNumBathtubs,"
    . " ROUND(SUM(BathtubCount)/@numHouses, 1) AS AvgNumBathtubs,"
    . " MAX(BathtubCount) AS MaxNumBathtubs"
    . " FROM ("
    . " SELECT b.EmailAddress,"
    . " COUNT(b.EmailAddress) AS BathroomCount,"
    . " COALESCE(SUM(TubShowerCount),0) AS TubShowerCount,"
    . " COALESCE(SUM(ShowerCount),0) AS ShowerCount,"
    . " COALESCE(SUM(BathtubCount),0) AS BathtubCount"
    . " FROM FullBath b"
    . " INNER JOIN Household h ON h.EmailAddress = b.EmailAddress"
    . " GROUP BY b.EmailAddress"
    . " ) AS t;";

$result3 = mysqli_query($db, $query3);

if (!is_bool($result3) && (mysqli_num_rows($result3) > 0)) {
    $result3_row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}

$query4 = "WITH AllBathrooms AS ("
    . " SELECT EmailAddress, Sinks, Bidets, Commodes FROM HalfBath"
    . " UNION ALL"
    . " SELECT EmailAddress, Sinks, Bidets, Commodes FROM FullBath"
    . " )"
    . " SELECT PostalCode, NumBidets FROM("
    . " SELECT r.PostalCode AS PostalCode, SUM(Bidets) as NumBidets"
    . " FROM AllBathrooms b"
    . " INNER JOIN Household h ON h.EmailAddress = b.EmailAddress"
    . " INNER JOIN Region r ON r.PostalCode = h.PostalCode"
    . " GROUP BY r.PostalCode) AS t"
    . " ORDER BY NumBidets DESC"
    . " LIMIT 1;";

$result4 = mysqli_query($db, $query4);

if (!is_bool($result4) && (mysqli_num_rows($result4) > 0)) {
    $result4_row = mysqli_fetch_array($result4, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}

$query5 = "WITH AllBathrooms AS ("
    . " SELECT EmailAddress, Sinks, Bidets, Commodes FROM HalfBath"
    . " UNION ALL"
    . " SELECT EmailAddress, Sinks, Bidets, Commodes FROM FullBath"
    . " )"
    . " SELECT State, NumBidets FROM("
    . " SELECT r.State AS State, SUM(Bidets) as NumBidets"
    . " FROM AllBathrooms b"
    . " INNER JOIN Household h ON h.EmailAddress = b.EmailAddress"
    . " INNER JOIN Region r ON r.PostalCode = h.PostalCode"
    . " GROUP BY r.State"
    . " ) AS t"
    . " ORDER BY NumBidets DESC"
    . " LIMIT 1;";

$result5 = mysqli_query($db, $query5);

if (!is_bool($result5) && (mysqli_num_rows($result5) > 0)) {
    $result5_row = mysqli_fetch_array($result5, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}

$query6 = "WITH AllBathrooms AS ("
. "     SELECT EmailAddress, Sinks, Bidets, Commodes FROM HalfBath"
. "     UNION ALL"
. "     SELECT EmailAddress, Sinks, Bidets, Commodes FROM FullBath"
. "   )"
. "   SELECT COUNT(t.BathroomCount) AS NumSinglePrimaryBathHouses"
. "   FROM("
. "     SELECT EmailAddress, COUNT(EmailAddress) AS BathroomCount"
. "     FROM AllBathrooms"
. "     GROUP BY EmailAddress"
. "   ) AS t"
. "   INNER JOIN FullBath f ON f.EmailAddress = t.EmailAddress"
. "   WHERE f.IsPrimary = true";
  

$result6 = mysqli_query($db, $query6);

if (!is_bool($result6) && (mysqli_num_rows($result6) > 0)) {
    $result6_row = mysqli_fetch_array($result6, MYSQLI_ASSOC);
} else {
    array_push($error_msg, "Query ERROR: Failed to get data for bathroom stats report" . __FILE__ . " line:" . __LINE__);
}
?>

<?php include("lib/header.php"); ?>
<title>Bathroom Statistics Report</title>
</head>

<body class="bg-white">
    <div class="container">
        <div class="m-3"></div>
        <div class="text-center mx-auto">
            <h1>Bathroom Statistics Report</h1>
        </div>
        <div class="m-5"></div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">All Bathrooms per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result_row)){
                                        echo "<li>Minimum: <b>" . $result_row["MinNumBathrooms"] . "</b></li>"
                                            . "<li>Average: <b>" . $result_row["AvgNumBathrooms"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result_row["MaxNumBathrooms"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Half Bathrooms per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result2_row)){
                                        echo "<li>Minimum: <b>" . $result2_row["MinNumHalfBathrooms"] . "</b></li>"
                                            . "<li>Average: <b>" . $result2_row["AvgNumHalfBathrooms"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result2_row["MaxNumHalfBathrooms"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Full Bathrooms per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result3_row)){
                                        echo "<li>Minimum: <b>" . $result3_row["MinNumFullBathrooms"] . "</b></li>"
                                            . "<li>Average: <b>" . $result3_row["AvgNumFullBathrooms"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result3_row["MaxNumFullBathrooms"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Commodes per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result_row)){
                                        echo "<li>Minimum: <b>" . $result_row["MinNumCommodes"] . "</b></li>"
                                            . "<li>Average: <b>" . $result_row["AvgNumCommodes"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result_row["MaxNumCommodes"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Sinks per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result_row)){
                                        echo "<li>Minimum: <b>" . $result_row["MinNumSinks"] . "</b></li>"
                                            . "<li>Average: <b>" . $result_row["AvgNumSinks"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result_row["MaxNumSinks"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Bidets per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                            <?php
                                    if(isset($result_row)){
                                        echo "<li>Minimum: <b>" . $result_row["MinNumBidets"] . "</b></li>"
                                            . "<li>Average: <b>" . $result_row["AvgNumBidets"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result_row["MaxNumBidets"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Tub/Showers per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result3_row)){
                                        echo "<li>Minimum: <b>" . $result3_row["MinNumTubShowers"] . "</b></li>"
                                            . "<li>Average: <b>" . $result3_row["AvgNumTubShowers"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result3_row["MaxNumTubShowers"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Bathtubs per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result3_row)){
                                        echo "<li>Minimum: <b>" . $result3_row["MinNumBathtubs"] . "</b></li>"
                                            . "<li>Average: <b>" . $result3_row["AvgNumBathtubs"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result3_row["MaxNumBathtubs"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Showers per Household</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result3_row)){
                                        echo "<li>Minimum: <b>" . $result3_row["MinNumShowers"] . "</b></li>"
                                            . "<li>Average: <b>" . $result3_row["AvgNumShowers"] . "</b></li>"
                                            . "<li>Maximum: <b>" . $result3_row["MaxNumShowers"] . "</b></li>";
                                    } else {
                                        echo "<li>Minimum: <b>No result</b></li>"
                                            . "<li>Average: <b>No result</b></li>"
                                            . "<li>Maximum: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">State with the Most Bidets</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result5_row)){
                                        echo "<li>State: <b>" . $result5_row["State"] . "</b></li>"
                                            . "<li>Number of Bidets: <b>" . $result5_row["NumBidets"] . "</b></li>";
                                    } else {
                                        echo "<li>State: <b>No result</b></li>"
                                            . "<li>Number of Bidets: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Postal Code with the Most Bidets</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result4_row)){
                                        echo "<li>Postal Code: <b>" . $result4_row["PostalCode"] . "</b></li>"
                                            . "<li>Number of Bidets: <b>" . $result4_row["NumBidets"] . "</b></li>";
                                    } else {
                                        echo "<li>Postal Code: <b>No result</b></li>"
                                            . "<li>Number of Bidets: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Households with Single, Primary Bathroom</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php
                                    if(isset($result6_row)){
                                        echo "<li>Households: <b>" . $result6_row["NumSinglePrimaryBathHouses"] . "</b></li>";
                                    } else {
                                        echo "<li>Households: <b>No result</b></li>";
                                    }
                                ?>
                            </ul>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>