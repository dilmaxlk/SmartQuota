<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt_1147_biz_details_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1147");
    $stmt_1147_biz_details_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1147_biz_details_permission->execute();

    while ($stmt_1147_biz_details_permission->fetch()) {
        
    }

//linked with update_biz_details.fn.php
    $Update_biz_details = update_biz_details();
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
                    Business Details
                    <small>You can Add your business details.</small>
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Business Details</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- general form elements disabled -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Business Details</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <form id="form_update_biz_details" role="form" action="" method="post" enctype="multipart/form-data" >



                                    <?php
                                    $stmt_Select_Biz_details = $db->prepare("SELECT biz_name, biz_address, biz_tel, biz_hotline, biz_email, biz_website, biz_logo, biz_payment_details FROM `biz_details` WHERE `id`= 1 ");
                                    $stmt_Select_Biz_details->bind_result($biz_name, $biz_address, $biz_tel, $biz_hotline, $biz_email, $biz_website, $biz_logo, $biz_payment_details);
                                    $stmt_Select_Biz_details->execute();

                                    while ($stmt_Select_Biz_details->fetch()) {
                                        
                                    }
                                    ?>


                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>                       
                                            <input type="text" name="txt_biz_name" value="<?php echo $biz_name; ?>" class="form-control" required>
                                        </div>
                                    </div>
      
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input type="text" name="txt_biz_address" value="<?php echo $biz_address; ?>" class="form-control" required>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label>Telelphone</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" name="txt_biz_tphone" value="<?php echo $biz_tel; ?>" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Hotline</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" name="txt_biz_hotline" value="<?php echo $biz_hotline; ?>" class="form-control" required>
                                        </div>

                                    </div>                    



                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="email" name="txt_biz_email" value="<?php echo $biz_email; ?>" class="form-control">
                                        </div>

                                    </div>          

                                    <div class="form-group">
                                        <label>Website</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="text" placeholder="www.youwebsite.com" value="<?php echo $biz_website; ?>" name="txt_biz_website" class="form-control">
                                        </div>

                                    </div>  


                                    <div class="form-group">
                                        <label>Payment Details (Bank Details)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <textarea class="form-control" name="txt_quota_P_paymentdetails" rows="15"><?php echo $biz_payment_details; ?></textarea></div>
                                    </div>                                    


                                    <div class="form-group">
                                        <img  src="Upload/<?php echo $biz_logo; ?>"  class="img-responsive " alt="company logo" id="Uploadimg" name="Uploadimg" style=" margin: 0; width:300px;height:120px; border-radius: 10px;">
                                        <label class="control-label"  for="UploadFileField" >Upload New Logo</label>
                                        <input type="hidden" id="logo_file_name" name="txt_logo_file_name" value="<?php echo $biz_logo; ?>">
                                        <input type="file" class="btn btn-default" name="UploadFileField" id="UploadFileField">
                                        <p>Please Upload JPG image or PNG image file less than 1MB. Size 300 x 120px</p>

                                    </div>             


                                    <div class="box-footer">

                                        <div class= "col-lg-6 col-md-12 col-xs-1">
                                            <input  style="margin-top: 5px;" class="btn  btn-success"  type="submit" id="btn_submit_biz_details" name="btn_submit_biz_details" value="Update Details">                

                                        </div>


                                    </div><!-- /.box-footer-->   

                                </form>      
                            </div><!-- /.box-body -->


                        </div><!-- /.box -->

                        </section><!-- /.content -->
        <?php
    } //User access permission
    ?>
                </div><!-- /.content-wrapper -->

    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
?>