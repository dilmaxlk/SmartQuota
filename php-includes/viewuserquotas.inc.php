<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt_1143_view_qANDj_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1143");
    $stmt_1143_view_qANDj_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1143_view_qANDj_permission->execute();

    while ($stmt_1143_view_qANDj_permission->fetch()) {
        
    }



    $Customer_ID = $_GET['CustomerID'];

// Select Quotations   
    $sql = "SELECT * FROM qjm_quotations WHERE quo_customer_id= $Customer_ID";
    $query = mysqli_query($db, $sql);
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
                    All Quotation of the Customer: <?php echo $_GET['CustomerName']; ?>
                    <small></small>
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Quotation List</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
        <?php ?>
                        <form name="myform" action="" method="post">
                            <div class="box-body table-responsive no-padding">
                                <table id="vas_table" class="table table-hover table-bordered table-responsive">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Quotation ID</th>
                                            <th>Quotation Subj.</th>
                                            <th>Created Date</th>
                                            <th>Valid Untill</th>
                                            <th>Stage</th>
                                            <th>Invoice Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>

        <?php
        $PNo = $_GET["PageNo"];

        // Loop to generate database values to table...       
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            ?>


                                            <tr>

                                                <td>


                                                    <a href="index.php?page=EditQuota&quo_id=<?php echo $row['quo_id']; ?>&quo_customer_id=<?php echo $row['quo_customer_id']; ?>&quo_invoice_id=<?php echo $row['quo_invoice_id']; ?>" class="btn btn-app ">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>                                 

                                                </td>


                                                <td><?php echo $row['quo_id'] ?></td>
                                                <td><?php echo $row['quo_subject'] ?></td>
                                                <td><?php echo $row['quo_date_created'] ?>
                                                <td><?php echo $row['quo_valid_untill'] ?>
                                                <td><?php echo $row['quo_stage'] ?> 
                                                <td><?php echo $row['quo_payment_status'] ?>  

            <?php
// Select the user and assign permission...          
            $stmt_1145_del_btn_QandJ_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1145");
            $stmt_1145_del_btn_QandJ_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
            $stmt_1145_del_btn_QandJ_permission->execute();

            while ($stmt_1145_del_btn_QandJ_permission->fetch()) {
                
            }
            ?>                            

                                                    <button <?php
                                                    if ($cp_userpermission_OnOff == 0) {
                                                        echo "disabled";
                                                    } else {
                                                        
                                                    }
                                                    ?> style="margin-right: 20px;" type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#<?php echo $row['quo_id']; ?>"><span class="fa fa-trash"></span></button> 








                                                </td>



                                            </tr>



                                            <!-- Modal Window for Delete Quotation-->
                                        <div class="modal fade modal-danger" id="<?php echo $row['quo_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Delete Quotation</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to delete this Quotation... ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a  href="actions/delete_quotation.php?QuotationID=<?php echo $row['quo_id']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>&CustomerName=<?php echo $_GET['CustomerName']; ?>" class='btn btn-success btn-flat'>Yes, Delete</a>
                                                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                      
                                    <?php } ?>

                                    </tbody>


                                </table> 
                            </div>
                        </form> 
                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 





                        <div class= "col-lg-6 col-md-12 col-xs-1">
                            <a style="margin-top: 5px;" href="index.php?page=ViewAllCustomers&PageNo=<?php echo $_GET['PageNo']; ?>" class="btn  btn-danger">View All Customers </a> <span id="result"></span>  
                        </div>                 

                        </tbody>

                        </table>            
                        </form>  



                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section><!-- /.Quotation List -->




            <!------------------------------------JOB LIST----------------------------------------------------        -->


            <section class="content">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">JOB List</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>



                    <div class="box-body">




                        <?php
                        // Select JOBS   
                        $sql = "SELECT * FROM quota_jobs WHERE customer_id= $Customer_ID";
                        $query_select_jobs = mysqli_query($db, $sql);
                        ?>
                        <form name="myform" action="" method="post">
                            <div class="box-body table-responsive no-padding">
                                <table id="vas_table" class="table table-hover table-bordered table-responsive">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>JOB No</th>
                                            <th>JOB Name</th>
                                            <th>JOB Date</th>
                                            <th>JOB Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

        <?php
        $PNo = $_GET["PageNo"];

        // Loop to generate database values to table...       
        while ($row = mysqli_fetch_array($query_select_jobs, MYSQLI_ASSOC)) {
            ?>


                                            <tr>

                                                <td>


                                                    <a href="index.php?page=EditJOB&job_no=<?php echo $row['job_no']; ?>&Job_customer_id=<?php echo $row['customer_id']; ?>&Job_quota_id=<?php echo $row['quotation_id']; ?>" class="btn btn-app ">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>                                 

                                                </td>


                                                <td><?php echo $row['job_no'] ?></td>
                                                <td><?php echo $row['job_Name'] ?></td>
                                                <td><?php echo $row['job_date'] ?>  
                                                <td><?php echo $row['job_status'] ?>

            <?php
// Select the user and assign permission...          
            $stmt_1145_del_btn_QandJ_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1145");
            $stmt_1145_del_btn_QandJ_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
            $stmt_1145_del_btn_QandJ_permission->execute();

            while ($stmt_1145_del_btn_QandJ_permission->fetch()) {
                
            }
            ?>                            

                                                    <button <?php
                                                    if ($cp_userpermission_OnOff == 0) {
                                                        echo "disabled";
                                                    } else {
                                                        
                                                    }
                                                    ?> style="margin-right: 20px;" type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#<?php echo $row['job_no']; ?>"><span class="fa fa-trash"></span></button> 


                                                </td>
                                            </tr>

                                            <!-- Modal Window for Delete JOB-->
                                        <div class="modal fade modal-danger" id="<?php echo $row['job_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Delete JOB</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to delete this JOB... ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a  href="actions/delete_job.php?JOB_NO=<?php echo $row['job_no']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>&CustomerName=<?php echo $_GET['CustomerName']; ?>" class='btn btn-success btn-flat'>Yes, Delete</a>
                                                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                      
        <?php } ?>

                                    </tbody>


                                </table> 
                            </div>
                        </form> 
                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 





                        <div class= "col-lg-6 col-md-12 col-xs-1">
                            <a style="margin-top: 5px;" href="index.php?page=ViewAllCustomers&PageNo=<?php echo $_GET['PageNo']; ?>" class="btn  btn-danger">View All Customers </a> <span id="result"></span>  
                        </div>                 



                        </tbody>


                        </table>            
                        </form>  



                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section><!-- /.JOB List -->

        <?php
        $db->close();
        mysqli_close($db);
    } //User access permission
    ?> 

    </div><!-- /.col -->

    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}


    