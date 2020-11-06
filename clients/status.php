<?php
include('../core/dbconn.php');

// Get status
$ic = mysqli_real_escape_string($conn, $_GET['ic']);
$status = mysqli_real_escape_string($conn, $_GET['status']);

// From database
$sql = "SELECT insurance.name AS name, insurance.status AS status, insurance.ic AS clientIC, receipt.receiptSerial AS serial, insurance.total AS total, receipt.amountDigits AS paid, receipt.issuedAt AS issuedAt, receipt.issuedBy AS issuedBy FROM insurance LEFT JOIN receipt ON insurance.ic = receipt.clientIC WHERE receipt.clientIC = '$ic'";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Clients</title>
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
    <!-- MDBootstrap Datatables  -->
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
</head>

<body>
    <div class="contianer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card my-4">
                    <div class="card-header text-center">
                        Receipt List
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-stripped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="th-sm text-center">#</th>
                                        <th class="th-sm text-center">Receipt No</th>
                                        <th class="th-sm text-center">Issued At</th>
                                        <th class="th-sm text-center">Issued By</th>
                                        <th class="th-sm text-center">Total</th>
                                        <th class="th-sm text-center">Balance</th>
                                        <th class="th-sm text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $row['serial']; ?></td>
                                            <td class="text-center"><?= $row['issuedAt']; ?></td>
                                            <td class="text-center"><?= $row['issuedBy']; ?></td>
                                            <td class="text-center">RM<?= $row['total'] ?></td>
                                            <td class="text-center">RM<?= $row['total'] - $row['paid']; ?></td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 1) : ?>
                                                    <span class="badge badge-success">Fully Paid</span>
                                                <?php elseif ($row['status'] == 2) : ?>
                                                    <span class="badge badge-warning">Partially Paid</span>
                                                <?php elseif ($row['status'] == 3) : ?>
                                                    <span class="badge badge-danger">Cancelled</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <a href="home" class="btn btn-sm btn-default">Back</a>
                            <a href="create?ic=<?= $ic; ?>" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>