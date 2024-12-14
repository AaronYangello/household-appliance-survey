<?php
include('lib/common.php');

$has_error = false;
$error_msg = "";
$show_modal = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['is-modal'] == 'false') {
        $postal_code = mysqli_real_escape_string($db, $_POST['postal-code']);
        if (empty($postal_code)) {
            $has_error = true;
            $error_msg = "Please enter a postal code.";
        } else {
            $query = "SELECT PostalCode, City, State FROM Region WHERE PostalCode='$postal_code'";

            $result = mysqli_query($db, $query);
            $count = mysqli_num_rows($result);

            if (!empty($result) && ($count > 0)) {
                $show_modal = true;
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $city = $row['City'];
                $state = $row['State'];
            } else {
                $has_error = true;
                $error_msg = "This postal code does not exist. Please try again: " . $postal_code;
            }
        }
    } else if ($_POST['is-modal'] == 'true') {
        $_SESSION['PostalCode'] = $_POST['confirmed-postal-code'];
        header(REFRESH_TIME . 'url=enter_phone_number_form.php');
    }
}
?>


<?php include("lib/header.php"); ?>
<title>Enter Postal Code</title>
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
                <h1>Enter Postal Code</h1>
            </div>
            <div class="card-body mx-5">
                <div class="w-50">
                    <form action="enter_postal_code.php" method="post">
                        <div class="form-group my-3">
                            <label for="postal-code">Please enter your five digit postal code:</label>
                            <input type="text" name="postal-code" class="form-control <?php if ($has_error)
                            echo "is-invalid" ?>" id="postal-code" placeholder="12345">
                            <div class="invalid-feedback">
                                <?php echo $error_msg ?>
                            </div>
                        </div>
                        <input type="hidden" name="is-modal" value="false">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirm-postal-code-modal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="confirm-postal-code-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirm-postal-code-modal-label">Confirm Postal Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">You entered the following postal code:</p>
                        <div class="my-1">
                            <p class="text-center fw-bold">
                                <?php echo $postal_code ?>
                            </p>
                            <p class="text-center">
                                <?php echo "$city, $state" ?>
                            </p>
                        </div>
                        <p class="text-center">Is this correct?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="enter_postal_code.php" method="post">
                            <input type="hidden" name="is-modal" value="true">
                            <input type="hidden" name="confirmed-postal-code" value="<?php echo $postal_code; ?>">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(window).on('load', function () {
                $('#confirm-postal-code-modal').modal(
            <?php
            if ($show_modal)
                    echo "'show'";
                else
                    echo "'hide'";
            ?>);
        });
        </script>
</body>

</html>