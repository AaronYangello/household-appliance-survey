<?php

include('lib/common.php');

$state = "";

if(isset($_GET['state'])){
    $state = $_GET['state'];
 }

$query = "SELECT T.DisplayType, T.MaximumResolution, ROUND(AVG(T.DisplaySize), 1) as AvgTVDiplaySize \n"
    . "FROM Tv as T\n"
    . "INNER JOIN Household as H ON H.EmailAddress = T.EmailAddress \n"
    . "INNER JOIN Region as R ON H.PostalCode=R.PostalCode \n"
    . "WHERE R.State='$state'\n"
    . "GROUP BY T.DisplayType, T.MaximumResolution ORDER BY AvgTVDiplaySize DESC";

$result = mysqli_query($db, $query);
include('lib/show_queries.php');

if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get average TV display size by state " . __FILE__ ." line:". __LINE__ );
}

?>

<?php include("lib/header.php"); ?>
<title>TV Drill Down Report</title>
</head>
	
    <body class="bg-white">

        <div class="m-3"></div>

        <div class="text-center mx-auto">
            <h1>State <?php echo $state ?> - TV Display Drilldown Report</h1>
        </div>

        <div class="m-5"></div>

        <table class="table bg-light table-bordered table-hover mx-auto" style="width: 75%">
            <thead class="thead-dark">
            <tr>
                <th>Display Type</th>
                <th>Maximum Resolution</th>
                <th>Average TV Display Size</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $data): ?>
                    <tr>
                        <td><?php echo $data["DisplayType"] ?></td>
                        <td><?php echo $data["MaximumResolution"] ?></td>
                        <td><?php echo $data["AvgTVDiplaySize"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="col justify-content-center text-center">
		    <a class="btn btn-light btn-outline-secondary" href=average_display_tv_states_report.php>Return to average display tv states report</a>
	    </div>

        <div class="m-3"></div>

    </body>
</html>