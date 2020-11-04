<?php

//DB Conn
include('../core/dbconn.php');

// Get data from POST.
$ic = mysqli_real_escape_string($conn, $_POST['ic']);
$name = strtolower(mysqli_real_escape_string($conn, $_POST['name']));
$amountTxt = strtolower(mysqli_real_escape_string($conn, $_POST['amountTxt']));
$amountDigits = mysqli_real_escape_string($conn, $_POST['amountDigits']);
$paymentFor = strtolower(mysqli_real_escape_string($conn, $_POST['paymentFor']));
$paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);
$dateIssued = mysqli_real_escape_string($conn, $_POST['dateIssued']);
$issuedBy = strtolower(mysqli_real_escape_string($conn, $_POST['issuedBy']));
$designation = strtolower(mysqli_real_escape_string($conn, $_POST['designation']));


// Get ID for receipt
$sql = "SELECT id FROM receipt ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$id = str_pad($row['id'] + 1, 4, '00000', STR_PAD_LEFT);

// Save to database
if (isset($_POST['submit'])) {
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    $amountTxt = ucwords(mysqli_real_escape_string($conn, $_POST['amountTxt']));
    $amountDigits = mysqli_real_escape_string($conn, $_POST['amountDigits']);
    $paymentFor = ucwords(mysqli_real_escape_string($conn, $_POST['paymentFor']));
    $paymentType = ucwords(mysqli_real_escape_string($conn, $_POST['paymentType']));
    $dateIssued = mysqli_real_escape_string($conn, $_POST['dateIssued']);
    $issuedBy = ucwords(mysqli_real_escape_string($conn, $_POST['issuedBy']));

    $sql = "INSERT INTO receipt (clientIC, amountTxt, amountDigits, paymentType, paymentFor, issuedAt, issuedBy, status) VALUES ('$ic','$amountTxt','$amountDigits','$paymentFor','$paymentType','$dateIssued','$issuedBy','Paid')";

    if ($result = mysqli_query($conn, $sql)) {
        $alert = "alert-success";
        $message = "Receipt successfully saved";
    } else {
        $alert = "alert-danger";
        $message = "Error : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
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
        <div class="row my-4">
            <div class="col-md-12 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <div class="col-md-2 mx-auto">
                            <img src="img/logo-black.png" alt="" style="width: auto; height:80px;">
                        </div>
                        <h5 class="my-3 p-3">Official Receipt</h5>
                        <div class="row px-3">
                            <div class="col-md-8">
                                <p class="border-bottom">Mr/Mrs/Ms : <b><?= ucwords($name); ?></b></p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="border-bottom ">Received the Sum of : <b><?= ucwords($amountTxt); ?></b></p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p class="border"><b>RM<?= $amountDigits; ?></b></p>
                                    </div>
                                </div>
                                <p class="border-bottom">Payment by : <b><?= $paymentType; ?></b></p>
                                <p class="border-bottom">Being Payment of : <b><?= ucwords($paymentFor); ?></b></p>
                                <div class="row px-3">
                                    <div class="col-md-12 p-0">
                                        <p><small>N.B : Validity of this receipt subject to clearing cheque.</small><br><small>This is computer generated receipt. It does not require any signature.</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mx-auto">
                                <div class="row">
                                    <p class="m-0">Receipt No : <b> ET<?= date('Ym') . '-' . $id; ?></b></p>
                                    <p class="m-0"><small>CO. REG. 1074485-W KPL/LN: 7644 | MA4686</small></p>
                                    <p class="m-0"><small>GST001952911360 | MOF : K22173423761661323</small></p>
                                    <p class="m-0"><small>No. 243 B, Tingkat 2,</small></p>
                                    <p class="m-0"><small>Jalan Bandar 13,</small></p>
                                    <p class="m-0"><small>Taman Melawati,</small></p>
                                    <p class="m-0"><small>53100 Kuala Lumpur</small></p>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <p class="">
                                            <small class="border-bottom">Date : <b><?= $dateIssued; ?></b></small><br>
                                            <small class="border-bottom">Issued By : <b><?= ucwords($issuedBy); ?></b></small><br>
                                            <small class="border-bottom">Designation : <b><?= ucwords($designation); ?></small></b>
                                        </p>
                                    </div>
                                    <div class="col p-0">
                                        <img src="img/chop.png" alt="" class="img" style="height: 80px; width:auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['submit'])) { ?>
            <div class="row my-4 d-print-none">
                <div class="alert <?= $alert; ?> mx-auto" role="alert">
                    <?= $message; ?>
                </div>
            </div>
        <?php } ?>
        <div class="row my-4 d-print-none mx-auto">
            <button class="btn btn-sm btn-default" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
            <a href="view?ic=<?= $ic; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> Edit</a>
            <a href="index" class="btn btn-sm btn-primary">Back</a>
        </div>
    </div>
</body>

</html>