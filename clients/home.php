<?php
// DB Cnn
include('../core/dbconn.php');

// Get client from database
$sql = "SELECT * FROM insurance";
$result = mysqli_query($conn, $sql);

// Get payment status from receipt
$receipt = "SELECT status FROM receipt";
$resultReceipt = mysqli_query($conn, $receipt);

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
    <div class="container">
        <!-- Message / Alert -->
        <div class="row">

        </div>
        <!-- Main Content -->
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card my-4">
                    <div class="card-header text-center">
                        List of Clients for Insurance
                    </div>
                    <div class="card-body">
                        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th class="th-sm">
                                        Client's Name
                                    </th>
                                    <th class="th-sm">
                                        NRIC
                                    </th>
                                    <th class="th-sm">
                                        Nominee Name
                                    </th>
                                    <th class="th-sm">
                                        Nominee NRIC
                                    </th>
                                    <th class="th-sm">
                                        Nominee Relationship
                                    </th>
                                    <th class="th-sm text-center">
                                        Total
                                    </th>
                                    <th class="th-sm text-center">
                                        Balance Left
                                    </th>
                                    <th class="th-sm">
                                        Inserted At
                                    </th>
                                    <th class="th-sm text-center">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td class="text-center"><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['ic']; ?></td>
                                        <td><?= $row['nomineeName']; ?></td>
                                        <td><?= $row['nomineeIC']; ?></td>
                                        <td><?= $row['nomineeRelationship']; ?></td>
                                        <td class="text-center">
                                            <?= $row['total']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $row['balance']; ?>
                                        </td>
                                        <td><?= $row['CreatedAt']; ?></td>
                                        <td class="text-center">
                                            <?php if (empty($row['status'])) { ?>
                                                <a href="/insurance/clients/create?ic=<?= $row['ic']; ?>&status=pending">
                                                    <button class="btn btn-sm btn-primary">Create</button>
                                                </a>
                                            <?php } elseif ($row['status'] == 2) { ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=partial">
                                                    <button class="btn btn-sm btn-warning">Update</button>
                                                </a>
                                            <?php } elseif ($row['status'] == 3) { ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=cancelled">
                                                    <button class="btn btn-sm btn-danger">Cancelled</button>
                                                </a>
                                            <?php } elseif ($row['status'] == 1) { ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=paid">
                                                    <button class="btn btn-sm btn-success">Paid</button>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>

</html>