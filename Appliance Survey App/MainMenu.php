<?php

include('lib/common.php');

?>

<?php include("lib/header.php"); ?>
<title>Main Page</title>
</head>
	
	<body class="bg-white">

		<!-- Title -->
		<div class="container theme-showcase py-4" >
			<div class="jumbotron p-5 mb-3 bg-light rounded-3 border">
				<h1>Hemkraft Menu</h1>
				<p>Add in new Household or view reports</p>
			</div>
		</div>

		<!-- links -->
		<div class="container">
			<div class="row">
				<div class="col justify-content-center text-center">
					<a class = "p-4 mb-3 rounded-3 border list-group-item list-group-item-action list-group-item-dark" href="enter_email_address.php">Add in new household</a>
				</div>
				<div class="col justify-content-center text-center">
					<a class = "p-4 mb-3 rounded-3 border list-group-item list-group-item-action list-group-item-dark" href="generate_reports.php">View reports</a>
				</div>
			</div>
		</div>

	</body>
</html>