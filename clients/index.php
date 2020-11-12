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
    <div class="container-fluid">
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
                                        Client
                                    </th>
                                    <th class="th-sm">
                                        NRIC
                                    </th>
                                    <th class="th-sm">
                                        Nominee
                                    </th>
                                    <th class="th-sm">
                                        Nominee NRIC
                                    </th>
                                    <th class="th-sm">
                                        Relationship
                                    </th>
                                    <th class="th-sm text-center">
                                        Type
                                    </th>
                                    <th class="th-sm text-center">
                                        Balance
                                    </th>
                                    <th class="th-sm">
                                        Inserted
                                    </th>
                                    <th class="th-sm text-center">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                    <?php
                                    $name = strtolower($row['name']);
                                    $nomineeName = strtolower($row['nomineeName']);
                                    $nomineeRelationship = strtolower($row['nomineeRelationship']);
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $row['id']; ?></td>
                                        <td class="align-middle"><?= ucwords($name); ?></td>
                                        <td class="align-middle"><?= $row['ic']; ?></td>
                                        <td class="align-middle"><?= ucwords($nomineeName); ?></td>
                                        <td class="align-middle"><?= $row['nomineeIC']; ?></td>
                                        <td class="align-middle"><?= ucwords($nomineeRelationship); ?></td>
                                        <td class="text-center align-middle">
                                            <?= $row['total']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $row['balance']; ?>
                                        </td>
                                        <td class="align-middle"><?= $row['CreatedAt']; ?></td>
                                        <td class="text-center align-middle">
                                            <?php if (empty($row['status'])) : ?>
                                                <a href="/insurance/clients/create?ic=<?= $row['ic']; ?>&status=pending" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-plus"></i>&nbsp;Create
                                                </a>
                                            <?php elseif ($row['balance'] == 0) : ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=paid" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>&nbsp;Paid
                                                </a>
                                            <?php elseif ($row['status'] == 3) : ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=cancelled" class="btn btn-sm btn-danger">
                                                    Cancelled
                                                </a>
                                            <?php elseif ($row['status'] == 2) : ?>
                                                <a href="/insurance/clients/status?ic=<?= $row['ic']; ?>&status=partial" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-hourglass-half"></i>&nbsp;Update
                                                </a>
                                            <?php endif; ?>
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