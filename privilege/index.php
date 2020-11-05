<?php
// DB Conn
include('../core/dbconn.php');

// Post all data
if (isset($_POST['submit'])) {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $ic = mysqli_escape_string($conn, $_POST['ic']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $occupation = mysqli_escape_string($conn, $_POST['occupation']);
    $age = mysqli_escape_string($conn, $_POST['age']);
    $street1 = mysqli_escape_string($conn, $_POST['street1']);
    $street2 = mysqli_escape_string($conn, $_POST['street2']);
    $postcode = mysqli_escape_string($conn, $_POST['postcode']);
    $state = mysqli_escape_string($conn, $_POST['state']);
    $nomineeName = mysqli_escape_string($conn, $_POST['nomineeName']);
    $nomineeIC = mysqli_escape_string($conn, $_POST['nomineeIC']);
    $nomineeRelationship = mysqli_escape_string($conn, $_POST['nomineeRelationship']);
    $hotelList = mysqli_real_escape_string($conn, $_POST['hotelList']);
    $hotelDate = mysqli_real_escape_string($conn, $_POST['hotelDate']);
    $hotelStay = mysqli_real_escape_string($conn, $_POST['hotelStay']);

    // Default timezone
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $dateTime = date("Y-m-d H:i:s");

    // Check for existing IC
    $sql = "SELECT ic FROM insurance WHERE ic = '$ic'";
    $resultSql = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resultSql) < 1) {
        // Query the data
        $query = "INSERT INTO insurance (name, ic, email, phone, occupation, age, street1, street2, postcode, state, nomineeName, nomineeIC, nomineeRelationship, hotelList, hotelStay, hotelDate, createdAt) 
        VALUES
        ('$name', '$ic', '$email', '$phone', '$occupation', '$age', '$street1','$street2', '$postcode', '$state', '$nomineeName', '$nomineeIC', '$nomineeRelationship', '$hotelList','$hotelStay','$hotelDate', '$dateTime')";

        // Result
        if ($result = mysqli_query($conn, $query)) {
            $alert = "alert-success";
            $message = "<strong>Successful!</strong> An email will be sent to you short after this. <hr> Please check your spam box if you didn't see anything inside your main inbox.";

            // Send email to customer and company
            $to = $email;
            $subject = "Group Personal Accident Special Insurance Plan + 1 Night Hotel - " . $name;
            $text =
                "<html>

        <head>
            <title>Group Personal Accident Special Insurance Plan + 1 Night Hotel</title>
        </head>

        <body>
            <p>Dear, " . $name . "</p><br>
            <p>Thank you for puchasing the insurance with us. Below are your details that you had filled up earlier.</p>
            <br>
            <table>
                <tr>
                    <th style='text-align:left;'>Full Name</th>
                    <td>:</td>
                    <td>" . $name . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>NRIC</th>
                    <td>:</td>
                    <td>" . $ic . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Email</th>
                    <td>:</td>
                    <td>" . $email . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Phone Number</th>
                    <td>:</td>
                    <td>" . $phone . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Occupation</th>
                    <td>:</td>
                    <td>" . $occupation . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Age</th>
                    <td>:</td>
                    <td>" . $age . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Street 1</th>
                    <td>:</td>
                    <td>" . $street1 . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Street 2</th>
                    <td>:</td>
                    <td>" . $street2 . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Postcode</th>
                    <td>:</td>
                    <td>" . $postcode . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>State</th>
                    <td>:</td>
                    <td>" . $state . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Nominee's Name</th>
                    <td>:</td>
                    <td>" . $nomineeName . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Nominee's NRIC</th>
                    <td>:</td>
                    <td>" . $nomineeIC . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Relationship</th>
                    <td>:</td>
                    <td>" . $nomineeRelationship . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Hotel Name</th>
                    <td>:</td>
                    <td>" . $hotelList . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Date Check-in</th>
                    <td>:</td>
                    <td>" . $hotelDate . "</td>
                </tr>
                <tr>
                    <th style='text-align:left;'>Extra Stay</th>
                    <td>:</td>
                    <td>" . $hotelStay . "</td>
                </tr>
            </table><br>
            <p>Please make sure all the details are correct. If you found any error(s), do notify us.</p>
        </body>

        </html>
        ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <no-reply@enrichtravel.my>' . "\r\n";
            $headers .= 'Cc: insurance@enrichtravel.my' . "\r\n";

            mail($to, $subject, $text, $headers);
        } else {
            $alert = "alert-danger";
            $message = "<strong>Error!</strong> Something went wrong. We apologise for that.";
            $message .= " Error! " . mysqli_error($conn);
        }
    } else {
        $alert = "alert-danger";
        $message = "<strong>Error!</strong> The NRIC <b>" . $ic . " </b>already existed in our database.<hr>";
        $message .= "Please get in touch with our rep if you haven't filled up any form from us.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Personal Accident Special Insurance Plan + 1 Night Hotel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php if (isset($message)) { ?>
                <div class="col-md-8 mx-auto my-4">
                    <div class="alert <?= $alert; ?>" role="alert">
                        <?= $message; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card my-4">
                    <div class="card-header text-center">
                        Group Personal Accident Special Insurance Plan + 1 Night Hotel Stay
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="md-form form-sm " method="POST">
                            <div class="col-md-12">
                                <p class="lead">Personal Details</p>
                                <small class="text-muted">Please fills all empty spaces</small>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="ic" id="ic" class="form-control" required>
                                        <label for="ic">NRIC Number without '-'</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="email" id="email" class="form-control" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                        <label for="phone">Your Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="occupation" id="occupation" class="form-control" required>
                                        <label for="occupation">Your Occupation</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="age" id="age" class="form-control" required>
                                        <label for="age">Age</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="street1" id="street1" class="form-control" required>
                                        <label for="street1">Street 1</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="street2" id="street2" class="form-control" required>
                                        <label for="street2">Street 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="postcode" id="postcode" class="form-control" required>
                                        <label for="postcode">Postcode</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <select name="state" id="state" class="md-form form-control">
                                            <option value="">State</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value=Melaka"">Melaka</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Pulau Pinang">Pulau Pinang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                            <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala
                                                Lumpur</option>
                                            <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan
                                            </option>
                                            <option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clear-fix m-4">

                            </div>
                            <div class="col-md-12">
                                <p class="lead">Nominee Details</p>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="nomineeName" id="nomineeName" class="form-control" required>
                                        <label for="nomineeName">Nominee's Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="nomineeIC" id="nomineeIC" class="form-control" required>
                                        <label for="nomineeIC">Nominee NRIC Number without '-'</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="text" name="nomineeRelationship" id="nomineeRelationship" class="form-control" required>
                                        <label for="nomineeRelationship">Relationship</label>
                                    </div>
                                </div>
                            </div>
                            <div class="clear-fix m-4">

                            </div>
                            <div class="col-md-12">
                                <p class="lead">Hotel Stays</p>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <select name="hotelList" id="" class="md-form form-control">
                                            <option value="Not Decided">Not Decided</option>
                                            <option value="Bukit Merah Laketown Resort & Hotel - Perak">Bukit Merah Laketown Resort & Hotel - Perak</option>
                                            <option value=The Shores Hotel & Residence - Melaka"">The Shores Hotel & Residence - Melaka</option>
                                            <option value="The Pines - Melaka">The Pines - Melaka</option>
                                            <option value="Zetter Suites Cameron Highland - Pahang">Zetter Suites Cameron Highland - Pahang</option>
                                            <option value="Flamingo Beach - Penang">Flamingo Beach - Penang</option>
                                            <option value="Hotel Tanjung Vista - Terengganu">Hotel Tanjung Vista - Terengganu</option>
                                            <option value="Ridel Hotel Kota Bahru - Kelantan">Ridel Hotel Kota Bahru - Kelantan</option>
                                            <option value="M-Boutique - Perak">M-Boutique - Perak</option>
                                            <option value="Cititel Express Ipoh - Perak">Cititel Express Ipoh - Perak</option>
                                            <option value="Cititel Express Kota Kinabalu - Sabah">Cititel Express Kota Kinabalu - Sabah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="date" name="hotelDate" id="" class="form-control">
                                        <label for="">Select a suitable date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col row">
                                <div class="col-md-6 mb-0">
                                    <div class="md-form">
                                        <input type="number" name="hotelStay" id="" class="form-control" placeholder="0">
                                        <label for="">Additional Stay/Day</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <p class="text-center"><small>Total is <b>RM470</b></small></p>
                                <hr><br>
                                <div class="row mb-2">
                                    <p>Payment can be made to <br> <b>ENRICH TRAVELOGUE SDN BHD</b> <br> <b>5648 1050
                                            6868 (MAYBANK)</b> <br></p>
                                </div>
                                <div class="row text-justify">
                                    <p class="note note-warning"><strong>Note : </strong>You must pay the premium before
                                        the coverage under this policy is effective.
                                        This insurance will remain ineffective until the premium due has been paid.
                                    </p>
                                </div>
                            </div>
                            <div class="col row mx-auto text-center">
                                <div class="col-md-12 mx-auto ">
                                    <button name="submit" type="submit" class="btn btn-success btn-md">Submit</button>
                                    <button name="reset" type="reset" class="btn btn-danger btn-md">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>