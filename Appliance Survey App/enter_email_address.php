<?php
include('lib/common.php');

$has_error = false;
$error_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredEmail = mysqli_real_escape_string($db, $_POST['email']);
    if (empty($enteredEmail)) {
        $has_error = true;
        $error_msg = "Please enter an email address.";
    } else {
        $query = "SELECT EmailAddress FROM Household WHERE EmailAddress='$enteredEmail'";

        $result = mysqli_query($db, $query);
        $count = mysqli_num_rows($result);

        if (!empty($result) && ($count > 0)) {
            $has_error = true;
            $error_msg = "This email already exists. Please try again: " . $enteredEmail;
        } else {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['email'] = $enteredEmail;
            header(REFRESH_TIME . 'url=enter_postal_code.php');
        }
    }
}
?>

<?php include("lib/header.php"); ?>
<title>Enter Email Address</title>
</head>

<body class="bg-white">
    <div class="container">
    <div class="m-3"></div>

        <?php 
            $timeline_index=1;
            include("lib/forms-timeline.php"); 
        ?>
        
        <div class="card justify-content-center mx-auto" style="width: 75%">
            <div class="card-header">
                <h1>Enter Email Address</h1>
            </div>
            <div class="card-body mx-5">
                <div class="w-50">
                    <form action="enter_email_address.php" method="post">
                        <div class="form-group my-3">
                            <label for="email">Please enter your email address:</label>
                            <input type="text" name="email" class="form-control <?php if($has_error) echo "is-invalid"?>" id="email"
                                placeholder="example@email.com">
                            <div class="invalid-feedback"><?php echo $error_msg ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
    </div>
</body>

</html>