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
        <title>Invoice | <?php echo $_GET['quo_invoice_id']; ?></title>
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
                    <div class="col-xs-12">
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
                            <small class="pull-right">Date: <?php echo date("Y-m-d | H:i"); ?></small>
                        </h2>

                            <?php ?>
                    </div><!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong><?php echo $biz_name; ?></strong><br>
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
                        To
                        <address>
                            <strong><?php echo $cus_name; ?></strong><br>
                    <?php echo $cus_address; ?><br>
                            Phone: <?php echo $cus_phone; ?><br>
                            Email: <?php echo $cus_email; ?>
                        </address>
                    </div><!-- /.col -->

                    <?php
                    $GET_Quota_id = $_GET['quo_id'];

                    $stmt_get_quota_details = $db->prepare("SELECT * FROM `qjm_quotations` WHERE quo_id= $GET_Quota_id");
                    $stmt_get_quota_details->bind_result($quo_id, $quo_customer_id, $quo_subject, $quo_date_created, $quo_stage, $quo_valid_untill, $quo_proposal_text, $quo_customer_notes, $quo_admin_notes, $quo_tax_rate, $quo_tax_rate_des, $quo_othercost, $quo_othercost_des, $inv_id, $quo_invoice_date, $quo_payment_status);
                    $stmt_get_quota_details->execute();

                    while ($stmt_get_quota_details->fetch()) {
                        
                    }
                    $stmt_get_quota_details->close();
                    ?>         


                    <div class="col-sm-4 invoice-col" style=" padding-bottom: 20px;">
                        <h3>Invoice ID: <?php echo $_GET['quo_invoice_id']; ?></h3>  
                        <h4>Quotation ID: <?php echo $_GET['quo_id']; ?></h4>
                        <b>Subject:</b> <?php echo $quo_subject; ?><br>
                        <b>Invoice Date:</b> <?php echo $quo_invoice_date; ?> <br>
                        <b>Payment Status:</b> <?php echo $quo_payment_status; ?> <br>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Discount %</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

<?php
$stmt_get_quota_item_details = $db->prepare("SELECT * FROM `qjm_quotation_Items` WHERE quo_quotation_id= $GET_Quota_id");
$stmt_get_quota_item_details->bind_result($quo_item_id, $quo_quotation_id, $quo_item_description, $quo_item_qty, $quo_item_unit_price, $quo_item_discount, $quo_item_total);
$stmt_get_quota_item_details->execute();

while ($stmt_get_quota_item_details->fetch()) {
    ?>                 


                                    <tr>
                                        <td><?php echo $quo_item_qty; ?></td>
                                        <td><?php echo $quo_item_description; ?></td>
                                        <td><?php echo number_format($quo_item_unit_price, 2, '.', ''); ?></td>
                                        <td><?php echo $quo_item_discount; ?></td>
                                        <td><?php echo number_format($quo_item_total, 2, '.', ''); ?></td>
                                    </tr>


                                    <?php
                                }

                                $stmt_get_quota_item_details->close();
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Payment Details:</p>
                        <p class="text-muted well well-sm no-shadow" style="white-space: pre-wrap;"><?php echo $biz_payment_details; ?></p>
                    </div><!-- /.col -->
                    <div class="col-xs-6">

<?php
$stmt_subtotal = $db->prepare("SELECT SUM(quo_item_total) FROM qjm_quotation_Items WHERE quo_quotation_id= $GET_Quota_id");
$stmt_subtotal->bind_result($Quota_subtotal);
$stmt_subtotal->execute();

while ($stmt_subtotal->fetch()) {
    
}
$stmt_subtotal->close();
?>




                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><?php echo number_format($Quota_subtotal, 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                    <th>Tax (<?php echo $quo_tax_rate; ?>%) <br> TAX Description: <?php echo $quo_tax_rate_des; ?></th>
                                    <td><?php
                        $taxAmount = ($Quota_subtotal * $quo_tax_rate) / 100;

                        echo number_format($taxAmount, 2, '.', '');
                        ?></td>
                                </tr>
                                <tr>
                                    <th>Other Cost:
                                        <br>
                                        Cost Description: <?php echo $quo_othercost_des; ?>
                                    </th>

                                    <td><?php echo number_format($quo_othercost, 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                    <th ><h3>Total:</h3></th>
                                    <td><h3><?php
                        $netTotal = $Quota_subtotal + $taxAmount + $quo_othercost;

                        echo number_format($netTotal, 2, '.', '');
                        ?></h3></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </section><!-- /.content -->
        </div><!-- ./wrapper -->
        <script src="../../dist/js/app.min.js"></script>
    </body>
</html>
