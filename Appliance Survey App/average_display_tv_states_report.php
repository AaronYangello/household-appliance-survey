<?php

include('lib/common.php');

$query = "SELECT R.State, ROUND(AVG(T.DisplaySize), 1) as AvgTVDisplaySize FROM Tv as T\n"
    . "INNER JOIN Household as H ON H.EmailAddress=T.EmailAddress \n"
    . "RIGHT JOIN Region as R ON H.PostalCode=R.PostalCode \n"
    . "GROUP BY R.State ORDER BY R.State ASC";

$result = mysqli_query($db, $query);
include('lib/show_queries.php');

if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    array_push($error_msg,  "Query ERROR: Failed to get average TV display size by state " . __FILE__ ." line:". __LINE__ );
}

?>

<?php include("lib/header.php"); ?>
<title>Average TV Display Size By State Report</title>
</head>
	
    <body class="bg-white">

        <div class="m-3"></div>

        <div class="text-center mx-auto">
            <h1>Average TV Display Size By State Report</h1>
        </div>

        <div class="m-5"></div>

        <table class="table bg-light table-bordered table-hover mx-auto" style="width: 50%">
            <thead class="thead-dark">
            <tr>
                <th>State</th>
                <th>TV Average Display Size</th>
                <th>Drilldown Report</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $data): ?>
                    <tr>
                        <td><?php echo $data["State"] ?></td>
                        <td>
                            <?php 
                                $averageTvDisplay = $data["AvgTVDisplaySize"];
                                if(is_null($averageTvDisplay) || empty($averageTvDisplay)) {
                                    echo "Not Applicable";
                                } else {
                                    echo $averageTvDisplay;
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                $averageTvDisplay = $data["AvgTVDisplaySize"];
                                if(is_null($averageTvDisplay) || empty($averageTvDisplay)) {
                                    echo "<a class=\"btn disabled\" href=\"#\">Drilldown</a>";
                                } else {
                                    $row_state = $data["State"];
                                    echo "<a class=\"btn\" href=\"tv_drilldown_report.php?state=$row_state\">Drilldown</a>";
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </body>
</html>