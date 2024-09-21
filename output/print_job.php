<?php
//Use in editquota.inc.php
//includes Files
include_once '../php-includes/connect.inc.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>JOB Details | JOB No: <?php echo $_GET['job_no']; ?></title>
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
    <body >
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-4">
                        <h2 class="page-header">

<?php
$stmt_get_biz_details = $db->prepare("SELECT * FROM `biz_details` WHERE id= 1");
$stmt_get_biz_details->bind_result($id, $biz_name, $biz_address, $biz_tel, $biz_hotline, $biz_email, $biz_website, $biz_logo, $biz_payment_details);
$stmt_get_biz_details->execute();

while ($stmt_get_biz_details->fetch()) {
    
}

$stmt_get_biz_details->close();

date_default_timezone_set('Asia/Colombo');
?>

                            <img src="../Upload/<?php echo $biz_logo; ?>" width="150px" height="50px" alt="Logo"/><br>
                            <?php echo $biz_name; ?>


                        </h2>

                            <?php ?>

                        <h1>JOB No: <?php echo $_GET['job_no']; ?></h1>
                    </div><!-- /.col -->

                    <div class="col-xs-4">

                    </div>

                    <div class="col-xs-4">
                        <small class="pull-right">Date: <?php echo date("Y-m-d | H:i"); ?></small>
                    </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong style="text-decoration: underline;"><?php echo $biz_name; ?></strong><br>
<?php echo $biz_address; ?><br>
                            Phone: <?php echo $biz_tel; ?><br>
                            Email: <?php echo $biz_email; ?>
                        </address>
                    </div><!-- /.col -->


<?php
$GET_Cus_id = $_GET['quo_customer_id'];

$stmt_get_cus_details = $db->prepare("SELECT cus_name, cus_address, cus_phone, cus_email FROM `qas_customer` WHERE cus_id= $GET_Cus_id");
$stmt_get_cus_details->bind_result($cus_name, $cus_address, $cus_phone, $cus_email);
$stmt_get_cus_details->execute();

while ($stmt_get_cus_details->fetch()) {
    
}
$stmt_get_cus_details->close();
?>          


                    <div class="col-sm-4 invoice-col">
                        <strong style="text-decoration: underline;"> Customer Details</strong>
                        <address>
                            <strong><?php echo $cus_name; ?></strong><br>
                    <?php echo $cus_address; ?><br>
                            Phone: <?php echo $cus_phone; ?><br>
                            Email: <?php echo $cus_email; ?>
                        </address>
                    </div><!-- /.col -->

<?php
$GET_Job_No = $_GET['job_no'];

$stmt_get_job_details = $db->prepare("SELECT * FROM `quota_jobs` WHERE job_no= $GET_Job_No");
$stmt_get_job_details->bind_result($id, $job_no, $customer_id, $quotation_id, $job_Name, $job_location, $job_date, $job_start_time, $job_end_time, $job_details, $job_employee_details, $materials_required, $tools_required, $special_instructions, $payment_instructions, $job_status);
$stmt_get_job_details->execute();

while ($stmt_get_job_details->fetch()) {
    
}
$stmt_get_job_details->close();
?>         


                    <div class="col-sm-4 invoice-col" style=" padding-bottom: 20px;">          
                        <b>JOB Name:</b> <?php echo $job_Name; ?><br>
                        <b>JOB Location:</b> <?php echo $job_location; ?> <br>
                        <b>JOB Date:</b> <?php echo $job_date; ?> <br>
                        <b>Time: From</b> <?php echo $job_start_time; ?> <b>To </b><?php echo $job_end_time; ?><br>
                        <b>Payment Instructions: </b> <?php echo $payment_instructions; ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <hr>

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Job Details:</p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $job_details; ?></p>

                        <p class="lead">Job Employee Details: </p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $job_employee_details; ?></p>
                    </div><!-- /.col -->


                    <div class="col-xs-6">
                        <p class="lead">Job Materials Required:</p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $materials_required; ?></p>

                        <p class="lead">Job Tools Required:</p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $tools_required; ?></p>
                    </div><!-- /.col -->



                </div><!-- /.row -->


                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-12">
                        <p class="lead">Special Instructions:</p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $special_instructions; ?></p>
                    </div><!-- /.col -->


                </div><!-- /.col -->

                <hr>

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Customer Signature</p>
                    </div><!-- /.col -->

                    <div class="col-xs-6">
                        <p class="lead">Signature</p>
                    </div><!-- /.col -->
                </div><!-- /.col -->         
                <hr>

                </div><!-- /.row -->

            </section><!-- /.content -->
        </div><!-- ./wrapper -->
        <script src="../../dist/js/app.min.js"></script>

    </body>
</html>
