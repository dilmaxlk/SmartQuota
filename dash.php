<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//includes Files
    include_once 'php-includes/connect.inc.php';
    include_once 'php-includes/header.inc.php';
    include_once 'php-includes/topnav.inc.php';
    include_once 'php-includes/get-var.inc.php';
    include_once 'php-includes/sidebarleft.inc.php';

    $stmt_1121_dash_Permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1121");
    $stmt_1121_dash_Permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1121_dash_Permission->execute();

    while ($stmt_1121_dash_Permission->fetch()) {
        
    }
    ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <?php
    $stmt2 = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}");
    $stmt2->bind_result($id, $FirstName, $LastName);
    $stmt2->execute();

    while ($stmt2->fetch()) {
        
    }

    if ($cp_userpermission_OnOff == 0) {
        $Message = "<h1>";
        $Message .= "Welcome $FirstName...!!";
        $Message .= "</h1>";
        echo $Message;
    } else {
        ?>
                <h1>

                    Dashboard

                <?php
                $stmt = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}");
                $stmt->bind_result($id, $FirstName, $LastName);
                $stmt->execute();

                while ($stmt->fetch()) {
                    ?>

                        <small>Hi.. <?php echo $FirstName ?>, Welcome to SmartQuota Quotation Management System</small>


                        <?php
                    }
                    ?>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                            <!-- TOTAL CUSTOMERS --> 
                            <div class="col-md-6 col-sm-6 col-xs-12">

        <?php
        // Get total Customers
        $stmt = $db->prepare("SELECT COUNT(cus_id) FROM qas_customer");
        $stmt->bind_result($TotalCustomers);
        $stmt->execute();

        while ($stmt->fetch()) {
            
        }
        ?> 


                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Customers</span>
                                        <span class="info-box-number"><?php echo $TotalCustomers; ?></span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->



                            <!-- TOTAL Quotation Value -->    
                            <div class="col-md-6 col-sm-6 col-xs-12">

        <?php
        // Get total sum of payments...
        $stmt_select_quo_Value = $db->prepare("SELECT SUM(quo_item_total) FROM qjm_quotation_Items");
        $stmt_select_quo_Value->bind_result($Total_quo_Value);
        $stmt_select_quo_Value->execute();

        while ($stmt_select_quo_Value->fetch()) {
            $Total_quo_Value = number_format($Total_quo_Value, 2, '.', '');
        }
        ?>
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Quotation Value</span>
                                        <span class="info-box-number">Rs. <?php echo $Total_quo_Value; ?></span>
                                        <span class="info-box-text">Ex. TAX and Other Cost</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->



                            <!-- TOTAL Quotations -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
        <?php
        // Get total QSA Jobs
        $stmt_total_quo = $db->prepare("SELECT COUNT(quo_id) FROM qjm_quotations");
        $stmt_total_quo->bind_result($Total_Quotations);
        $stmt_total_quo->execute();

        while ($stmt_total_quo->fetch()) {
            
        }
        ?>
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="icon ion-document"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Quotations</span>
                                        <span class="info-box-number"><?php echo $Total_Quotations; ?></span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->





                            <div class="clearfix visible-sm-block"></div>

                            <!-- Total Paid Invoices -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
        <?php
        $Invoice_paid_status = "Invoice Paid";

        // Get total sum of Total QSA Job Deposits...
        $stmt_total_paid_invoices = $db->prepare("SELECT SUM(qjm_quotation_Items.quo_item_total) FROM qjm_quotation_Items INNER JOIN qjm_quotations ON qjm_quotation_Items.quo_quotation_id = qjm_quotations.quo_id WHERE qjm_quotations.quo_payment_status LIKE '%$Invoice_paid_status%'");
        $stmt_total_paid_invoices->bind_result($Total_total_invoice_paid);
        $stmt_total_paid_invoices->execute();

        while ($stmt_total_paid_invoices->fetch()) {
            $Total_total_invoice_paid = number_format($Total_total_invoice_paid, 2, '.', '');
        }
        ?>                                                

                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Paid Invoices</span>
                                        <span class="info-box-number">Rs. <?php echo $Total_total_invoice_paid; ?></span>
                                        <span class="info-box-text">Ex. TAX and Other Cost</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->


                            <!-- Total Users -->
                            <div class="col-md-6 col-sm-6 col-xs-12">

        <?php
        // Get total Total System Users
        $stmt9 = $db->prepare("SELECT COUNT(id) FROM cp_users");
        $stmt9->bind_result($TotalSystemusers);
        $stmt9->execute();

        while ($stmt9->fetch()) {
            
        }
        ?>

                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total System Users</span>
                                        <span class="info-box-number"><?php echo $TotalSystemusers; ?></span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->






                            <!-- Total Payment Pending Invoices  -->
                            <div class="col-md-6 col-sm-6 col-xs-12">

        <?php
        $Invoice_pending_status = "Payment Pending";

        // Get total sum of Total QSA Job Deposits...
        $stmt_total_pending_invoices = $db->prepare("SELECT SUM(qjm_quotation_Items.quo_item_total) FROM qjm_quotation_Items INNER JOIN qjm_quotations ON qjm_quotation_Items.quo_quotation_id = qjm_quotations.quo_id WHERE qjm_quotations.quo_payment_status LIKE '%$Invoice_pending_status%'");
        $stmt_total_pending_invoices->bind_result($Total_invoice_pending);
        $stmt_total_pending_invoices->execute();

        while ($stmt_total_pending_invoices->fetch()) {
            $Total_invoice_pending = number_format($Total_invoice_pending, 2, '.', '');
        }
        ?>


                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Payment Pending Invoices </span>
                                        <span class="info-box-number">Rs. <?php echo $Total_invoice_pending; ?></span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->

                        </div><!-- /.col -->

                    </div><!-- /.row -->

                    <div class="row"> 

                        <!-- Add Your Content Here -->

                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-8">
                            <!-- MAP & BOX PANE -->


                            <div class="row">

                                <!-- Add Your Content Here -->


                            </div><!-- /.row -->


                        </div><!-- /.col -->

                    </div><!-- /.row -->
            </section><!-- /.content -->
    <?php } ?>  
    </div><!-- /.content-wrapper -->



    <?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}

include_once 'php-includes/footer.inc.php';
?>