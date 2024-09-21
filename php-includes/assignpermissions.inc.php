<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...
    $stmt_1125_assign_per_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1125");
    $stmt_1125_assign_per_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1125_assign_per_permission->execute();

    while ($stmt_1125_assign_per_permission->fetch()) {
        
    }

    $PNo = $_GET['PageNo'];
    $UserName = $_GET['UserName'];
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
                    Assign Permissions
                    <small>You can Assign Permissions to users form here...</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Assign Permissions to <b><?php echo $_GET['UserName']; ?></b></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- general form elements disabled -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Permissions</h3>
                            </div><!-- /.box-header -->

                            <form id="form_addstudent" role="form" action="" method="post" enctype="multipart/form-data" >

                                <?php
                                $TabNo = $_GET['tab'];
                                //Tab will change accouring to URL request, uncomment if you want to add more tabs....
//        if ($TabNo == 1) {
//            $aciveTab1 = "active";
//            $TabID = "tab_1";
//        } else {
//            $aciveTab1 = "";
//            $TabID = "tab_1";
//        }
//
//
//        if ($TabNo == 2) {
//            $aciveTab2 = "active";
//            $TabID2 = "tab_2";
//        } else {
//
//            $aciveTab2 = "";
//            $TabID2 = "tab_2";
//        }

                                if ($TabNo == 3) {
                                    $aciveTab3 = "active";
                                    $TabID3 = "tab_3";
                                } else {

                                    $aciveTab3 = "";
                                    $TabID3 = "tab_3";
                                }

                                if ($TabNo == 4) {
                                    $aciveTab4 = "active";
                                    $TabID4 = "tab_4";
                                } else {

                                    $aciveTab4 = "";
                                    $TabID4 = "tab_4";
                                }


//        if ($TabNo == 5) {
//            $aciveTab5 = "active";
//            $TabID5 = "tab_5";
//        } else {
//
//            $aciveTab5 = "";
//            $TabID5 = "tab_5";
//        }

                                $UserID = $_GET['UserID'];
                                ?>

                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $aciveTab3; ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false">General</a></li>
                                            <li class="<?php echo $aciveTab4; ?>"><a href="#tab_4" data-toggle="tab" aria-expanded="false">Users</a></li>
                                        </ul>
                                        <div class="tab-content">



                                            <div class="tab-pane <?php echo $aciveTab3; ?>" id="<?php echo $TabID3; ?>">
                                                <!-- Start: Assign Permissions: PM 1121 | Main Dashboard -->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1121_dash_Permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1121 ");
                                                $stmt_1121_dash_Permission->bind_result($On_OFF);
                                                $stmt_1121_dash_Permission->execute();

                                                while ($stmt_1121_dash_Permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>Main Dashboard</dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1121&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1121&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1121 -->


                                                <!-- END: Assign Permissions: PM 1140 | Add Customers -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1140_add_customer_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1140 ");
                                                $stmt_1140_add_customer_permission->bind_result($On_OFF);
                                                $stmt_1140_add_customer_permission->execute();

                                                while ($stmt_1140_add_customer_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                


                                                <dl class="dl-horizontal">
                                                    <dt>Add Customers</dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1140&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1140&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1140  -->


                                                <!-- END: Assign Permissions: 1141 PM  | Add Quotation -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1141_add_quotation_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1141 ");
                                                $stmt_1141_add_quotation_permission->bind_result($On_OFF);
                                                $stmt_1141_add_quotation_permission->execute();

                                                while ($stmt_1141_add_quotation_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>


                                                <dl class="dl-horizontal">
                                                    <dt>Add Quotation</dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1141&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1141&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: 1141 PM  -->          


                                                <!-- END: Assign Permissions: 1142 PM  | Add a New JOB  -->



                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1142_add_job_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1142 ");
                                                $stmt_1142_add_job_permission->bind_result($On_OFF);
                                                $stmt_1142_add_job_permission->execute();

                                                while ($stmt_1142_add_job_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>


                                                <dl class="dl-horizontal">
                                                    <dt>Add a New JOB </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1142&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1142&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: 1142 PM  -->                                                  


                                                <!-- END: Assign Permissions: 1143 PM  | View Quota and Jobs -->



                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1143_view_qANDj_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1143 ");
                                                $stmt_1143_view_qANDj_permission->bind_result($On_OFF);
                                                $stmt_1143_view_qANDj_permission->execute();

                                                while ($stmt_1143_view_qANDj_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                

                                                <dl class="dl-horizontal">
                                                    <dt>View|Edit Quota and Jobs </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1143&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1143&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: 1143 PM  -->                                                



                                                <!-- END: Assign Permissions: 1144 PM  | Edit Customer -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1144_edit_customer_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1144 ");
                                                $stmt_1144_edit_customer_permission->bind_result($On_OFF);
                                                $stmt_1144_edit_customer_permission->execute();

                                                while ($stmt_1144_edit_customer_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                



                                                <dl class="dl-horizontal">
                                                    <dt>Edit Customer </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1144&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1144&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM  -->   


                                                <!-- END: Assign Permissions: 1145 PM  | Delete Quotation and JOBs -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1145_del_btn_QandJ_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1145 ");
                                                $stmt_1145_del_btn_QandJ_permission->bind_result($On_OFF);
                                                $stmt_1145_del_btn_QandJ_permission->execute();

                                                while ($stmt_1145_del_btn_QandJ_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                

                                                <dl class="dl-horizontal">
                                                    <dt>Delete Quota and JOBs </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1145&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1145&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM  -->  




                                                <!-- END: Assign Permissions: 1146 PM  | Reports Dashboard -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1146_reports_dash_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1146 ");
                                                $stmt_1146_reports_dash_permission->bind_result($On_OFF);
                                                $stmt_1146_reports_dash_permission->execute();

                                                while ($stmt_1146_reports_dash_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                 



                                                <dl class="dl-horizontal">
                                                    <dt>Reports Dashboard </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1146&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1146&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM  -->  


                                                <!-- END: Assign Permissions: 1147 PM  | Business Details -->


                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1147_biz_details_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1147 ");
                                                $stmt_1147_biz_details_permission->bind_result($On_OFF);
                                                $stmt_1147_biz_details_permission->execute();

                                                while ($stmt_1147_biz_details_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>                                                 



                                                <dl class="dl-horizontal">
                                                    <dt>Business Details </dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1147&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=3" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1147&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=3" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM  -->  

                                            </div><!-- /.tab-pane3 -->


                                            <div class="tab-pane <?php echo $aciveTab4; ?>" id="<?php echo $TabID4; ?>">

                                                <!-- Start: Assign Permissions: PM 1127 | Hide Users in Menu -->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1127_hide_users_menu_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1127 ");
                                                $stmt_1127_hide_users_menu_permission->bind_result($On_OFF);
                                                $stmt_1127_hide_users_menu_permission->execute();

                                                while ($stmt_1127_hide_users_menu_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>Hide Users in Menu</dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1127&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1127&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1127 -->  




                                                <!-- Start: Assign Permissions: PM 1123 | Add User -->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1123_add_user_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1123 ");
                                                $stmt_1123_add_user_permission->bind_result($On_OFF);
                                                $stmt_1123_add_user_permission->execute();

                                                while ($stmt_1123_add_user_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>Add User</dt>
                                                    <dd>

                                                        <a href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1123&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1123&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1123 -->


                                                <!-- Start: Assign Permissions: PM 1124 | View All Users -->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1124_view_all_users_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1124 ");
                                                $stmt_1124_view_all_users_permission->bind_result($On_OFF);
                                                $stmt_1124_view_all_users_permission->execute();

                                                while ($stmt_1124_view_all_users_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>View All Users</dt>
                                                    <dd>

                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1124&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1124&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1124 -->

                                                <!-- Start: Assign Permissions: PM 1125 | Assign Permission-->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1125_assign_per_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1125 ");
                                                $stmt_1125_assign_per_permission->bind_result($On_OFF);
                                                $stmt_1125_assign_per_permission->execute();

                                                while ($stmt_1125_assign_per_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>Assign Permission</dt>
                                                    <dd>

                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1125&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1125&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1125 -->

                                                <!-- Start: Assign Permissions: PM 1128 | Edit User -->
                                                <?php
                                                //This will select the settings value with database (1 or 0) under the setting_id                               
                                                $stmt_1128_edit_user_permission = $db->prepare("SELECT  OnOff FROM `cp_userpermission` WHERE `uid`= $UserID AND `permission_id` = 1128 ");
                                                $stmt_1128_edit_user_permission->bind_result($On_OFF);
                                                $stmt_1128_edit_user_permission->execute();

                                                while ($stmt_1128_edit_user_permission->fetch()) {
                                                    
                                                }



                                                if ($On_OFF == '1') {
                                                    $btn_colour = "btn-danger";
                                                } else {

                                                    $btn_colour = "btn-success";
                                                }
                                                ?>

                                                <dl class="dl-horizontal">
                                                    <dt>Edit User</dt>
                                                    <dd>

                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1128&ONOFF=1&PageNo=<?php echo $PNo; ?>&tab=4" class="btn <?php echo $btn_colour; ?> btn-flat" >ON</a>
                                                        <a  href="actions/assignpermission.php?page=AssignPermissions&UserID=<?php echo $UserID; ?>&UserName=<?php echo $UserName; ?>&PMID=1128&ONOFF=0&PageNo=<?php echo $PNo; ?>&tab=4" class="btn btn-success btn-flat" >OFF</a>       

                                                    </dd>
                                                </dl>


                                                <!-- END: Assign Permissions: PM 1128 -->

                                            </div><!-- /.tab-pane4 -->




                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div>



                                <div class="box-footer">

                                    <div class= "col-lg-6 col-md-12 col-xs-1">
                                        <a style="margin-top: 5px;" href="index.php?page=ViewAllUsers&PageNo=<?php echo $PNo; ?>" class="btn  btn-danger">View All Users </a>

                                    </div>                 


                            </form>      
                        </div><!-- /.box-body -->


                        <!-- /.box -->

                        </section><!-- /.content -->
                        <?php
                    } //User access permission
                    ?>  
                </div><!-- /.content-wrapper -->

                    <?php
                } else {
                    header('Location: login.php');
                }
                ?>