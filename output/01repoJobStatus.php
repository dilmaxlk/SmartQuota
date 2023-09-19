<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//Used in reports.inc.php        

    include_once '../php-includes/connect.inc.php';

    if (isset($_GET['JobStatus'])) {
        $Status = $_GET['JobStatus'];
        ?>




        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Report: Job Status</title>
                <!-- Tell the browser to be responsive to screen width -->
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                <!-- Bootstrap 3.3.5 -->
                <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
                <!-- Font Awesome -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
                <!-- Ionicons -->
                <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
                <!-- Theme style -->
                <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
            </head>

            <!-- If you want to open printer window on load of the page, use onload="window.print();" code on body tag-->
            <!-- onload="window.print();" -->
            <body>
                <div class="wrapper">
                    <!-- Main content -->
                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">

                                <h2 class="page-header">
                                    <i class="fa fa-file-text-o"></i> Report: Job Status | Status: <?php echo $Status; ?>
                                    <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table id="vas_table" class="table table-hover table-bordered table-responsive">

        <?php
        $stmt = $db->prepare("SELECT qas_customer.cus_id, qas_customer.cus_name, qas_customer.cus_address, quota_jobs.job_status, quota_jobs.job_no FROM `qas_customer` INNER JOIN `quota_jobs` ON qas_customer.cus_id = quota_jobs.customer_id WHERE quota_jobs.job_status LIKE '{$Status}%'");
        $stmt->bind_result($cus_id, $cus_name, $cus_address, $qas_job_status, $qas_job_id);
        $stmt->execute();
        ?>
                                    <thead>
                                        <tr>
                                            <th>Job No</th>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Address</th>

                                        </tr>
                                    </thead>
                                    <tbody>


        <?php
        while ($stmt->fetch()) {
            ?>


                                            <tr>


                                                <td><?php echo $qas_job_id; ?></td>
                                                <td><?php echo $cus_id; ?></td>
                                                <td><?php echo $cus_name; ?></td>
                                                <td><?php echo $cus_address; ?></td>




                                            </tr>
            <?php
        }
        ?>

                                    </tbody>



                                </table> 


                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">      
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </section><!-- /.content -->
                </div><!-- ./wrapper -->
        <?php
    }
    ?>
            <script src="../dist/js/app.min.js"></script>
        </body>
    </html>

    <?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>