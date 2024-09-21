<?php
//Show PHP errors
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
?>

<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
                
// Select the user and assign permission...        
$stmt1123 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1123" ); 
$stmt1123->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1123->execute();

while ($stmt1123->fetch()){ 
    
}

//linked with addqsajob.fn.php
//$ADD_QSAJOB = addqsajob();



?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
    if ($cp_userpermission_OnOff == 0){

        //$Message = "<p class=''>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?> 

    
          <h1>
            Edit Quotation
            
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
              <h3 class="box-title">Edit this Quotation</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
    
                        <?php
                        $GET_quo_id = $_GET['quo_id'];

                        $stmt_get_quota = $db->prepare("SELECT * FROM `qjm_quotations` WHERE quo_id= $GET_quo_id");
                        $stmt_get_quota->bind_result($quo_id, $quo_customer_id, $quo_subject, $quo_date_created, $quo_stage, $quo_valid_untill, $quo_proposal_text, $quo_customer_notes, $quo_admin_notes, $quo_tax_rate, $quo_tax_rate_des, $quo_othercost, $quo_othercost_des, $inv_id, $quo_invoice_date, $quo_payment_status);
                        $stmt_get_quota->execute();

                        while ($stmt_get_quota->fetch()) {
                            
                        }
                        
                        $stmt_get_quota->close();
                        ?>       
           
           <!-- Quotation Details -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Quotation Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form id="myForm_update" method="post" >   
                    <!-- text input -->
                                      
                    <div class="form-group">
                      <label>Quotation ID</label>
                      <input type="text" name="txt_quota_id" value="<?php echo $_GET['quo_id']; ?>" class="form-control" required readonly>
                    </div>

                    <div class="form-group">
                      <label>Customer ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </div>                       
                           <input type="text" name="txt_quota_customer_id" value="<?php echo $_GET['quo_customer_id']; ?>" class="form-control" required readonly >
                       </div>
                    </div>
                    
                    <div class="form-group">
                          <label>Subject</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                            <input type="text" name="txt_quota_subject" value="<?php echo $quo_subject; ?>" class="form-control" required>
                       </div>

                    </div>                    

                    <div class="form-group">
                      <label>Quotation Created Date (M:D:Y)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>       

                           <input type="date" name="txt_quota_cre_date" value="<?php echo $quo_date_created; ?>" class="form-control" >
                       </div>
                    </div>
                    
                    
                    <div class="form-group">
                      <label>Stage</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>       
                            <select name="txt_quota_stage" class="form-control">
                                <option ><?php echo $quo_stage; ?></option> 
                               <option>Draft</option>
                               <option>Approved</option>
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

                           <input type="date" name="txt_quota_valid_until" value="<?php echo $quo_valid_untill; ?>"  class="form-control" >
                       </div>
                    </div>

                    
                   <div class="form-group">
                      <label>Proposal Text</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_quota_p_text" rows="4"><?php echo $quo_proposal_text; ?></textarea></div>
                   </div> 
                    
                   <div class="form-group">
                      <label>Customer Notes</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_quota_cus_notes" rows="4"><?php echo $quo_customer_notes; ?></textarea></div>
                   </div>    
                    
                   <div class="form-group">
                      <label>Admin Notes</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_quota_adm_notes" rows="4"><?php echo $quo_admin_notes; ?></textarea></div>
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
                  
                    
                    
                    <div class="form-group" style="background-color: lightblue; padding-left: 10px;">
                          <label>Invoice ID</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                            <input type="number" placeholder="Invoice" name="txt_quota_invoice_id" value="<?php echo $inv_id; ?>" class="form-control" >
                       </div>

                    </div>    
                    
                    
                    <div class="form-group" style="background-color: lightblue; padding-left: 10px;">
                      <label>Invoice Date (M:D:Y)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>       

                           <input type="date" name="txt_quota_invoice_date" value="<?php echo $quo_invoice_date; ?>"  class="form-control" >
                       </div>
                    </div>                    
                    
                    
                     <div class="form-group" style="background-color: lightblue; padding-left: 10px;">
                      <label>Invoice Payment Status</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>       
                            <select name="txt_quota_inv_status" class="form-control">
                               <option><?php echo $quo_payment_status;  ?></option>
                               <option>Payment Pending</option>
                               <option>Invoice Paid</option>
                             </select>
                       </div>
                    </div>                     
                    
                    
 <?php
 // Select Quotation Items
    
    $quo_quotation_id = $_GET['quo_id'];
    
    $sql = "SELECT * FROM qjm_quotation_Items WHERE quo_quotation_id= $quo_quotation_id";
    $query = mysqli_query($db, $sql);
 
 ?>
                    
 <?php
     // Loop to generate database values to table...       
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
 ?>
                    
                
 
       
                        
                        <fieldset class="form-inline hideCls<?php echo $row['quo_item_id']; ?>">
                            <br>
                            <div style="background-color: #999999; padding: 10px; border-radius: 10px;">  
                              <button type="button" id="deleteButton<?php echo $row['quo_item_id']; ?>" class="btn btn-danger pull-right" ><span class="fa fa-trash"></span></button> 
                               <div class="form-group">
                                <p>Description</p>
                                <input type="text" placeholder="Description" class="form-control" id="desc1" value="<?php echo $row['quo_item_description']; ?>" aria-describedby="sizing-addon2" name="upd_de_<?php echo $row['quo_item_id']; ?>" required>
                              </div>
                                                  
              
                              <div class="form-group">
                                <p>Quantity</p>
                                <input type="text" placeholder="Qty" class="form-control" id="qty1<?php echo $row['quo_item_id']; ?>" value="<?php echo $row['quo_item_qty']; ?>"  name="upd_q_<?php echo $row['quo_item_id']; ?>" required>
                              </div>

                              <div class="form-group">  
                               <p>Unit Price</p>
                               <input type="text"  placeholder="Unit Price" value="<?php echo $row['quo_item_unit_price']; ?>" class="form-control" id="price1<?php echo $row['quo_item_id']; ?>"  name="upd_p_<?php echo $row['quo_item_id']; ?>">
                              </div>
                                   
                              <div class="form-group">
                                <p>Discount %</p>
                                <input type="text"  placeholder="Discount %" value="<?php echo $row['quo_item_discount']; ?>"  class="form-control" id="discount1<?php echo $row['quo_item_id']; ?>"  name="upd_d_<?php echo $row['quo_item_id']; ?>">
                              </div>
                                    
                              <div class="form-group">
                                <p>Total</p>
                                <input type="text" placeholder="Total" value="<?php echo $row['quo_item_total']; ?>" class="form-control" id="total1<?php echo $row['quo_item_id']; ?>"  name="upd_t_<?php echo $row['quo_item_id']; ?>" readonly>
                              </div>
                                    
                            </div>         
                           </fieldset>  
                                    
            <script>
                
$("#deleteButton<?php echo $row['quo_item_id']; ?>").on("click", function() {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      var quoItemId = <?php echo $row['quo_item_id']; ?>; // Replace 123 with the actual quo_item_id value

      // Send AJAX request
      $.ajax({
        url: 'actions/delete_quota_item_ajax.php',
        method: 'POST',
        data: {
          quo_item_id: quoItemId
        },
        success: function(response) {
          // Handle the response from the server
          Swal.fire(
            'Deleted!',
            'Your item has been deleted.',
            'success'
          );
          $(".hideCls<?php echo $row['quo_item_id']; ?>").hide(2000);
        },
        error: function(xhr, status, error) {
          // Handle the error
          Swal.fire(
            'Error!',
            'An error occurred while deleting the item.',
            'error'
          );
        }
      });
    }
  });
});

                      
                      //Form Calulation                                              
                        $(document).ready(function() {
                         // Calculate total when any of the input values change
                         $('input').on('input', function() {
                           var quantity = parseFloat($('#qty1<?php echo $row['quo_item_id']; ?>').val());
                           var unitPrice = parseFloat($('#price1<?php echo $row['quo_item_id']; ?>').val());
                           var discountPercentage = parseFloat($('#discount1<?php echo $row['quo_item_id']; ?>').val());

                           // Calculate total amount
                           var total = quantity * unitPrice * (1 - discountPercentage / 100);

                           // Set the calculated total value
                           $('#total1<?php echo $row['quo_item_id']; ?>').val(total.toFixed(2));
                         });
                       });                        
                        
            </script> 
            
            
               <?php
             
                    }
             ?>          
            
                  
                        
                          <button style="margin-top: 20px;" class="btn btn-primary btn-lg" id="addFieldset">+ Add List Items </button>
                           <div id="AddNewItems_fieldSet" ></div>
            <script>
            
            
 

            
$(document).ready(function() {
  let fieldsetCount = 0;

  $("#addFieldset").click(function(e) {
    e.preventDefault();
    fieldsetCount++;
    const fieldset = $("<fieldset>").html(`
      <fieldset class="form-inline">
        <h4>Item ${fieldsetCount}</h4>
        <div style="background-color: #999999; padding: 10px; border-radius: 10px;">
            <button type="button" id="deleteButton_empty${fieldsetCount}" class="btn btn-danger pull-right">
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
        </div>
      </fieldset>
    `);
    

      
      
    $("#AddNewItems_fieldSet").append(fieldset);



     $(`#deleteButton_empty${fieldsetCount}`).click(function() {
        $(this).closest('fieldset').remove();
      });
      
      
  });

  $(document).on('input', '.qty, .price, .discount', function() {
    var fieldset = $(this).closest('fieldset');
    var qty = parseFloat(fieldset.find('.qty').val());
    var price = parseFloat(fieldset.find('.price').val());
    var discount = parseFloat(fieldset.find('.discount').val());
    var total = (qty * price) - ((qty * price * discount) / 100);
    fieldset.find('.total').val(total.toFixed(2));
  });
});

            
            
            
            </script>                    
                     
  
             </form>                      
                   
                    

            
           
                    <button style="margin-top: 20px;" type="submit" name="Submit_update" id="UpdateButton" class="btn btn-success btn-lg">Update Quota</button> <!-- Add a submit button -->
                    <a style="margin-top: 20px;" href="output/print_quota.php?quo_id=<?php echo $_GET['quo_id']; ?>&quo_customer_id=<?php echo $_GET['quo_customer_id']; ?>" target="_blank" class="btn btn-danger">Print Quota</a> 
                    <a style="margin-top: 20px;" href="output/print_invoice.php?quo_id=<?php echo $_GET['quo_id']; ?>&quo_customer_id=<?php echo $_GET['quo_customer_id']; ?>&quo_invoice_id=<?php echo $_GET['quo_invoice_id']; ?>" target="_blank" class="btn btn-danger">Print Invoice</a> 
            
                    <script>
 
                
                      //Form Calulation
//                          function calculateTotal() {
//                                        // Loop through each fieldset
//                                        $('fieldset').each(function() {
//                                          var qty = parseInt($(this).find('input[name^="qty"]').val());
//                                          var unitPrice = parseFloat($(this).find('input[name^="price"]').val());
//                                          var discount = parseFloat($(this).find('input[name^="discount"]').val());
//
//                                          // Calculate the total based on the entered values
//                                          var total = qty * unitPrice * (1 - discount / 100);
//
//                                          // Update the total field
//                                          $(this).find('input[name^="total"]').val(total.toFixed(2));
//                                        });
//                                      }
//
//                                      // Event listener for quantity, unit price, and discount fields
//                                      $(document).on('input', 'input[name^="qty"], input[name^="price"], input[name^="discount"]', function() {
//                                        calculateTotal();
//                                      });




                                              
                         
                                        // Ajax Submit jquary code
                                        $(document).ready(function() {
                                          $('#UpdateButton').click(function(e) {
                                            e.preventDefault(); // Prevent default form submission behavior

                                            // Get form data
                                            var formData = $('#myForm_update').serialize();
                                            
                                            
                                            // Send AJAX request
                                            $.ajax({
                                              url: 'php-includes/update_quotation_ajax.php',
                                              type: 'POST',
                                              data: formData,
                                              success: function(response) {

                                                        Swal.fire({
                                                           icon: 'success',
                                                           title: 'Success',
                                                           text: 'Quotation successfully Updated!',
                                                           
                                                           
                                                         })
                                                         
                                                         
                                                         setTimeout(function() {
                                                            location.reload();
                                                          }, 3000);


                                              },
                                              error: function(xhr, status, error) {
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
<!--                     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
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