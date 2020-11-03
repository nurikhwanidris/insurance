<!-- Get data from link -->
<?php

include('../core/dbconn.php');

// Fetch data
$sql = "SELECT * FROM insurance WHERE ic = '" . $_GET['ic'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
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
                <form action="receipt.php" class="md-form form-sm" method="POST">
                    <div class="card my-4">
                        <div class="card-header text-center">
                            Create Receipt
                        </div>
                        <div class="card-body">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" class="md-form form-sm " method="POST">
                                <div class="col-md-12">
                                    <p class="lead">Client's Personal Details</p>
                                    <small class="text-muted">Everything else is already pre-filled.</small>
                                </div>
                                <div class="col row">
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="name" id="name" class="form-control" value="<?= $row['name']; ?>" required>
                                            <label for="name">Client's Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="ic" id="ic" class="form-control" value="<?= $row['ic']; ?>" required>
                                            <label for="ic">NRIC Number without '-'</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col row">
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="amountTxt" id="ic" class="form-control" required>
                                            <label for="ic">Amount in text</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" class="text form-control" name="amountDigits">
                                            <label for="">Amount in digits</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col row">
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="paymentFor" id="paymentFor" class="form-control">
                                            <label for="paymentFor">Being Payment</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <select name="paymentType" id="paymentType" class="md-form form-control">
                                                <option value="">Select Payment Method</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="Debit Card">Debit Card</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Online Banking">Online Banking</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col row">
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="dateIssued" id="" class="form-control">
                                            <label for="">dd/mm/yyyy</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="issuedBy" id="" class="form-control">
                                            <label for="">Issued By</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col row">
                                    <div class="col-md-6 mb-0">
                                        <div class="md-form">
                                            <input type="text" name="designation" id="" class="form-control">
                                            <label for="">Designation</label>
                                        </div>
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
                </form>
            </div>
        </div>
    </div>
</body>

</html>