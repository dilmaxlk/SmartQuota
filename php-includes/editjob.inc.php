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
                    Edit this JOB
                    <small>You can edit job form here...</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

        <?php
        //Loding indocator, link with loading_indicator.fn.php
        $loadNow = Loading_indicator();
        echo $loadNow;
        ?> 


                <!-- Default box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a JOB</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

        <?php
        $Job_NO = $_GET['job_no'];

        // Select JOBS   
        $sql = "SELECT * FROM quota_jobs WHERE job_no= $Job_NO";
        $query_select_job = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_array($query_select_job, MYSQLI_ASSOC)) {
            ?>

                            <!-- Job Details -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">JOB Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form id="myForm" >   
                                        <!-- text input -->
            <?php $JOB_id = $_GET['job_no']; ?>

                                        <div class="form-group">
                                            <label>JOB No</label>
                                            <input type="text" name="txt_job_no" value="<?php echo $JOB_id; ?>" class="form-control" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Customer ID</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>                       
                                                <input type="text" name="txt_job_customer_id" value="<?php echo $_GET['Job_customer_id']; ?>" class="form-control" required readonly >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Quotation ID</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input type="text" name="txt_job_quota_id" value="<?php echo $_GET['Job_quota_id']; ?>" class="form-control" required readonly>
                                            </div>

                                        </div>                    

                                        <div class="form-group">
                                            <label>Job Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input type="text" name="txt_job_name" value="<?php echo $row['job_Name'] ?>" class="form-control">
                                            </div>

                                        </div>                    


                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input type="text" name="txt_job_location" value="<?php echo $row['job_location'] ?>" class="form-control" >
                                            </div>

                                        </div> 


                                        <div class="form-group">
                                            <label>Job Date (M:D:Y)</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>       

                                                <input type="date" name="txt_job_date"  value="<?php echo $row['job_date'] ?>" class="form-control" >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Job Start Time</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input type="text" name="txt_job_start_time" value="<?php echo $row['job_start_time'] ?>" class="form-control" >
                                            </div>

                                        </div>                     

                                        <div class="form-group">
                                            <label>Job End Time</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input type="text" name="txt_job_end_time" value="<?php echo $row['job_end_time'] ?>" class="form-control" >
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Job Details</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>                       
                                                <textarea class="form-control" name="txt_job_details" rows="4"><?php echo $row['job_details'] ?></textarea></div>
                                        </div>      


                                        <div class="form-group">
                                            <label>Job Employee Details</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>                       
                                                <textarea class="form-control" name="txt_job_Emp_details" rows="4"><?php echo $row['job_employee_details'] ?></textarea></div>
                                        </div> 

                                        <div class="form-group">
                                            <label>Job Materials Required</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>                       
                                                <textarea class="form-control" name="txt_job_mat_req" rows="4"><?php echo $row['materials_required'] ?></textarea></div>
                                        </div>                     

                                        <div class="form-group">
                                            <label>Job Tools Required</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>                       
                                                <textarea class="form-control" name="txt_job_tools_req" rows="4"><?php echo $row['tools_required'] ?></textarea></div>
                                        </div>                     

                                        <div class="form-group">
                                            <label>Special Instructions</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>                       
                                                <textarea class="form-control" name="txt_job_sp_ins" rows="4"><?php echo $row['special_instructions'] ?></textarea></div>
                                        </div>                     



                                        <div class="form-group">
                                            <label>Payment Instructions</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>       
                                                <select name="txt_job_pay_inst" class="form-control">
                                                    <option><?php echo $row['payment_instructions'] ?></option>
                                                    <option>Invoice Fully Paid</option>
                                                    <option>Invoice Not Paid</option>
                                                    <option>Invoice Percentage, Paid</option>
                                                    <option>Collect the full payment at the location</option>
                                                    <option>Collect the Balance Percentage payment at the location</option>
                                                    <option>Do not collect the payment at the location</option>
                                                </select>
                                            </div>
                                        </div>       



                                        <div class="form-group">
                                            <label>JOB Status</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>       
                                                <select name="txt_job_status" class="form-control">
                                                    <option><?php echo $row['job_status'] ?></option>
                                                    <option>Pending</option>
                                                    <option>Completed</option>
                                                </select>
                                            </div>
                                        </div>                      



            <?php
        }
        ?>
                                </form>


                                <button style="margin-top: 20px;" type="submit" id="submitButton" class="btn btn-success">Submit this JOB</button> <!-- Add a submit button -->
                                <a style="margin-top: 20px;" href="output/print_job.php?job_no=<?php echo $JOB_id; ?>&quo_customer_id=<?php echo $_GET['Job_customer_id']; ?>" target="_blank" class="btn btn-danger">Print JOB</a> 
                                <br>
                                <a style="margin-top: 20px;" href="index.php?page=ViewAllCustomers&PageNo=<?php echo $_GET['PageNo']; ?>" class="btn  btn-danger">View All Customers </a> <span id="result"></span>  




                            </div>

                        </div>


                        <script>

                            // Ajax Submit jquary code
                            $(document).ready(function () {
                                $('#submitButton').click(function (e) {
                                    e.preventDefault(); // Prevent default form submission behavior

                                    // Get form data
                                    var formData = $('#myForm').serialize();

                                    // Send AJAX request
                                    $.ajax({
                                        url: 'php-includes/update_job_ajax.php',
                                        type: 'POST',
                                        data: formData,
                                        success: function (response) {

                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'JOB successfully Updated!',

                                            })


                                        },
                                        error: function (xhr, status, error) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Something went wrong! Try again or Check your internet connection or Server status.',

                                            })
                                        }
                                    });
                                });
                            });

                        </script>



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