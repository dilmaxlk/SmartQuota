<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt_1141_add_quotation_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1141");
    $stmt_1141_add_quotation_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
    $stmt_1141_add_quotation_permission->execute();

    while ($stmt_1141_add_quotation_permission->fetch()) {
        
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
                    Add Quotation
                    <small>You can add a new quotation to the system form here...</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

        <?php
        //Loding indocator, link with loading_indicator.fn.php
        $loadNow = Loading_indicator();
        echo $loadNow;
        ?> 


                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a Quotation</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">



                        <!-- Quotation Details -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Quotation Details</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form id="myForm" >   
        <?php $Quota_id = $_GET['QuotaID']; ?>

                                    <div class="form-group">
                                        <label>Quotation ID</label>
                                        <input type="text" name="txt_quota_id" value="<?php echo $Quota_id; ?>" class="form-control" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Customer ID</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>                       
                                            <input type="text" name="txt_quota_customer_id" value="<?php echo $_GET['CustomerID']; ?>" class="form-control" required readonly >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Subject</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="text" name="txt_quota_subject" class="form-control" required>
                                        </div>

                                    </div>                    

                                    <div class="form-group">
                                        <label>Quotation Created Date (M:D:Y)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>       

                                            <input type="date" name="txt_quota_cre_date"  class="form-control" >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>Stage</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>       
                                            <select name="txt_quota_stage" class="form-control">
                                                <option>Draft</option>
                                                <option>Delivered</option>
                                                <option>On Hold</option>
                                                <option>Pending</option>
                                                <option>Lost</option>
                                                <option>Dead</option>
                                            </select>
                                        </div>
                                    </div>                  


                                    <div class="form-group">
                                        <label>Valid Until (M:D:Y)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>       

                                            <input type="date" name="txt_quota_valid_until"  class="form-control" >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>Proposal Text</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <textarea class="form-control" name="txt_quota_p_text" rows="4"></textarea></div>
                                    </div> 

                                    <div class="form-group">
                                        <label>Customer Notes</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <textarea class="form-control" name="txt_quota_cus_notes" rows="4"></textarea></div>
                                    </div>    

                                    <div class="form-group">
                                        <label>Admin Notes</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>                       
                                            <textarea class="form-control" name="txt_quota_adm_notes" rows="4"></textarea></div>
                                    </div>                           

                                    <div class="form-group">
                                        <label>Tax %</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" placeholder="TAX Percentage (Rate)" name="txt_quota_tax_rate" value="<?php echo $quo_tax_rate; ?>" class="form-control">
                                            <input type="text" placeholder="TAX Description" name="txt_quota_tax_des" value="<?php echo $quo_tax_rate_des; ?>" class="form-control" >
                                        </div>

                                    </div>  


                                    <div class="form-group">
                                        <label>Other Cost</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="number" placeholder="Cost Amount" name="txt_quota_othercost" value="<?php echo $quo_othercost; ?>" class="form-control" >
                                            <input type="text" placeholder="Cost Description" name="txt_quota_othercost_des" value="<?php echo $quo_othercost_des; ?>" class="form-control" >
                                        </div>

                                    </div>                     



                                </form>

                                <button style="margin-top: 20px;" class="btn btn-primary btn-lg" id="addFieldset">+ Add List Items </button>
                                <button style="margin-top: 20px;" type="submit" id="submitButton" class="btn btn-success">Submit</button> <!-- Add a submit button -->
                                <a style="margin-top: 20px;" href="index.php?page=ViewAllCustomers&PageNo=<?php echo $_GET['PageNo']; ?>" class="btn  btn-danger">View All Customers </a> <span id="result"></span>  


                                <script>

                                    //  If the user click [+ Add List Items] button this js code will run.

                                    // If the user clicks [+ Add List Items] button, this JavaScript code will run.
                                    $(document).ready(function () {
                                        let fieldsetCount = 0;

                                        $("#addFieldset").click(function (e) {
                                            e.preventDefault();
                                            fieldsetCount++;
                                            const fieldset = $("<fieldset>").html(`
                    <fieldset class="form-inline hideCls">
                    <hr>
                      <div style="background-color: #999999; padding: 10px; border-radius: 10px;">
                        <button type="button" id="deleteButton${fieldsetCount}" class="btn btn-danger pull-right">
                          <span class="fa fa-trash"></span>
                        </button> 
                       <div class="form-group">
                        <p>Description</p>
                        <input type="hidden" name="form_submit_traker">
                        <input type="text" placeholder="Description" class="form-control" aria-describedby="sizing-addon2" name="desc${fieldsetCount}" required>
                      </div>
                      <div class="form-group">
                        <p>Quantity</p>
                        <input type="text" placeholder="Qty" id="qty${fieldsetCount}" class="form-control qty" name="qty${fieldsetCount}" required>
                      </div>
                      <div class="form-group">
                        <p>Unit Price</p>
                        <input type="text" value="0" placeholder="Unit Price" id="price${fieldsetCount}" class="form-control price" name="price${fieldsetCount}">
                      </div>
                      <div class="form-group">
                        <p>Discount %</p>
                        <input type="text" value="0" placeholder="Discount %" id="dis${fieldsetCount}" class="form-control discount" name="discount${fieldsetCount}">
                      </div>
                      <div class="form-group">
                        <p>Total</p>
                        <input type="text" placeholder="Total" class="form-control total" id="total${fieldsetCount}" name="total${fieldsetCount}" readonly>
                      </div>
                    </fieldset>
                  `);

                                            $("#myForm").append(fieldset);

                                            $(`#deleteButton${fieldsetCount}`).click(function () {
                                                $(this).closest('fieldset').remove();
                                            });


                                        });

                                        $(document).on('input', '.qty, .price, .discount', function () {
                                            var fieldset = $(this).closest('fieldset');
                                            var qty = parseFloat(fieldset.find('.qty').val());
                                            var price = parseFloat(fieldset.find('.price').val());
                                            var discount = parseFloat(fieldset.find('.discount').val());
                                            var total = (qty * price) - ((qty * price * discount) / 100);
                                            fieldset.find('.total').val(total.toFixed(2));
                                        });
                                    });






                                    // Ajax Submit jquary code
                                    $(document).ready(function () {
                                        $('#submitButton').click(function (e) {
                                            e.preventDefault(); // Prevent default form submission behavior

                                            // Get form data
                                            var formData = $('#myForm').serialize();

                                            // Send AJAX request
                                            $.ajax({
                                                url: 'php-includes/add_quotation_ajax.php',
                                                type: 'POST',
                                                data: formData,
                                                success: function (response) {

                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: 'Quotation successfully Added!',

                                                    })

                                                    setTimeout(function () {
                                                        window.location.href = "index.php?page=ViewUserQuotas&CustomerID=<?php echo $_GET['CustomerID']; ?>&CustomerName=<?php echo $_GET['CustomerName']; ?>";
                                                    }, 3000);

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


                            </div>

                        </div>






                        </section><!-- /.content -->

        <?php
    }  //User access permission
    ?>
                </div><!-- /.content-wrapper -->

                    <?php
                    // If session isn't meet, user will redirect to login page
                } else {
                    header('Location: login.php');
                }
                ?>