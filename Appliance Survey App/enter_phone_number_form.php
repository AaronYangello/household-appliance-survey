<?php

include('lib/common.php');

$has_db_error = false;
$has_form_error = false;
$error_msg = "";
$area_error_msg = "";
$number_error_msg = "";
$type_error_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredPhoneNumber = (mysqli_real_escape_string($db, $_POST['enter-phone-num-option']) == "yes" ? true : false);
    if($enteredPhoneNumber) {
        $enteredAreaCode = mysqli_real_escape_string($db, $_POST['areaCode']);
        $enteredNumber = mysqli_real_escape_string($db, $_POST['number']);
        #remove - from number
        $enteredNumber = str_replace('-', '', $enteredNumber);
        $enteredPhoneType = mysqli_real_escape_string($db, $_POST['phoneType']);
        echo '<script>console.log("'.$enteredAreaCode.'-'.$enteredNumber. '@'. $enteredPhoneType .'"); </script>';
        
        # forms validation
        if (empty($enteredAreaCode)) {
            $has_form_error = true;
            $area_error_msg = "Please enter a area code.";
        }
        
        if(empty($enteredNumber)) {
            $has_form_error = true;
            $number_error_msg = "Please enter a number.";
        }

        if(empty($enteredPhoneType)) {
            $has_form_error = true;
            $type_error_msg = "Please select a phone type.";
            
        } 

        #only enter if no form errors were found.
        if(!$has_form_error) {
            $query = "SELECT AreaCode, Number FROM PhoneNumber WHERE AreaCode='$enteredAreaCode' AND Number='$enteredNumber'";

            $result = mysqli_query($db, $query);
            $count = mysqli_num_rows($result);

            if (!empty($result) && ($count > 0)) {
                $has_db_error = true;
                $error_msg = "This phone number exists. Please try again! Area Code: " . $enteredAreaCode . " Number: " . $enteredNumber ;
            } else {
                $_SESSION['EnteredPhoneNumber'] = $enteredPhoneNumber;
                $_SESSION['AreaCode'] = $enteredAreaCode;
                $_SESSION['Number'] = $enteredNumber;
                $_SESSION['PhoneType'] = $enteredPhoneType;
                header(REFRESH_TIME . 'url=enter_houseinfo.php');
            }
        }
        
    } else {
        $_SESSION['EnteredPhoneNumber'] = $enteredPhoneNumber;
        header(REFRESH_TIME . 'url=enter_houseinfo.php');
    }
}

?>

<?php include("lib/header.php"); ?>
<title>Enter phone number form</title>
</head>
	<body class="bg-white">
        <div class="m-3"></div>

        <?php 
            $timeline_index=1;
            include("lib/forms-timeline.php"); 
        ?>

        <div class="card justify-content-center mx-auto" style="width: 75%">
            <div class="card-header">
                <h1>Enter phone number form</h1>
            </div>
            <div class="card-body mx-5">

                <div class="<?php if($has_db_error) echo "alert alert-danger"?>" role="alert">
                    <?php echo $error_msg ?>
                </div>

                <div class="btn-group align-items-center">
                    <label for="areaCode" style="font-size:14px">Would you like to enter phone number:</label>

                    <div class="m-2"></div>

                    <input type="radio" form="phone-number-form" oncl class="btn-check" name="enter-phone-num-option" id="options1" value="yes" autocomplete="off" checked />
                    <label class="btn btn-primary" name="enter-phone-num-option" for="options1">yes</label>

                    <input type="radio" form="phone-number-form" class="btn-check" name="enter-phone-num-option" id="options2" value="no" autocomplete="off" />
                    <label class="btn btn-primary" name="enter-phone-num-option" for="options2">no</label>
                </div>

                <form id="phone-number-form"action="#" action="phone_number_form.php" method="post"> 

                    <div class="m-3"></div>

                    <div class="mb-1">
                        <p style="font-size:14px">Please enter your phone number.</p>
                    </div>

                    <div class="form-group row align-items-center">
                        <label class="col-sm-1 <?php if($has_form_error) echo "is-invalid"?>" for="areaCode" style="font-size:13px;width:11%">Area Code:</label>
                        <input class="form-control col-sm-2" style="width: 10%;line-height:10px" name="areaCode" type="tel" placeholder="000" pattern="[0-9]{3}"/>
                        <div class="invalid-feedback"><?php echo $area_error_msg ?></div>
                    </div>

                    <div class="m-1"></div>

                    <div class="form-group row align-items-center">
                        <label class="col-sm-1 <?php if($has_form_error) echo "is-invalid"?>" for="number" style="font-size:13px;width:11%">Number:</label>
                        <input class="form-control col-sm-2" style="width: 20%;line-height:10px" name="number" type="tel" placeholder="123-4567" pattern="[0-9]{3}-[0-9]{4}"/>
                        <div class="invalid-feedback"><?php echo $number_error_msg ?></div>
                    </div>

                    <div class="m-1"></div>

                    <div class="form-group row align-items-center">
                        <label class="col-sm-1" for="phoneType" style="font-size:13px;width:11%">Phone Type:</label>
                        <select class="custom-select col-sm-2 <?php if($has_form_error) echo "is-invalid"?>" name="phoneType" id="phoneType" field="phoneType">
                            <option>mobile</option>
                            <option>home</option>
                            <option>work</option>
                        </select>
                        <div class="invalid-feedback"><?php echo $type_error_msg ?></div>
                    </div>

                    <div class="m-1"></div>
                </form>

                <div class="form-group row align-items-center">
                    <div class="col"></div>
                    <button type="submit" form="phone-number-form" class="btn btn-primary col-sm-1">Next</button>
                </div>

            </div>
        </div>

        <script>

            document.getElementById('options1').addEventListener('click', formDisplay);
            document.getElementById('options2').addEventListener('click', formDisplay);
                  
             /* function */
            function formDisplay(){
                console.log('Horray! Someone wrote "' + this.value + '"!');
                const form = document.getElementById('phone-number-form');

                if (this.value === 'yes') {
                    // 👇️ this SHOWS the form
                    form.style.display = 'block';
                } else {
                    // 👇️ this HIDES the form
                    form.style.display = 'none';
                }
            }

        </script>


    </body>
</html>