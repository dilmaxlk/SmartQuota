<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt_1140_Add_Customers = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1140");
    $stmt_1140_Add_Customers->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1140_Add_Customers->execute();

    while ($stmt_1140_Add_Customers->fetch()) {
        
    }

//linked with addcustomers.fn.php
    $ADD_CUSTOMERS = addcustomers();
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <?php
    if ($cp_userpermission_OnOff == 0) {
        $Message .= "<h1>Access Denied</h1>";
        echo $Message;
    } else {
        ?> 





                <h1>
                    Add Customer
                    <small>You can Add your customers.</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a Customer</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Customer Details</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <form id="form_addcustomer" role="form" action="" method="post" enctype="multipart/form-data" >
        <?php
        $RNuber = rand(1000, 10000);
        ?>

                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" name="txt_cus_AutoID" value="<?php echo $RNuber; ?>" class="form-control"  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>                       
                                            <input type="text" name="txt_cus_name" value="" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input type="text" name="txt_cus_address" class="form-control" required>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" name="txt_cus_phone" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="email" name="txt_cus_email" class="form-control">
                                        </div>

                                    </div>          



                                    <div class="box-footer">

                                        <div class= "col-lg-6 col-md-12 col-xs-1">
                                            <input  style="margin-top: 5px;" class="btn  btn-success"  type="submit" id="btn_submit_cus" name="btn_customer_submit" value="Add Customer">                

                                        </div>


                                    </div><!-- /.box-footer-->   

                                </form> <!-- /form -->     
                            </div><!-- /.box-body -->


                        </div><!-- /.box -->

                        </section><!-- /.content -->
        <?php
    }
    ?>
                </div><!-- /.content-wrapper -->

    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
?>