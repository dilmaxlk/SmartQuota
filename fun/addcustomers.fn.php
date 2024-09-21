<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in addcustomers.inc.php
ob_start();

include_once '../php-includes/connect.inc.php'; 


function addcustomers(){
    

 
    if(isset($_POST['btn_customer_submit'])){
        
    
   //-------------Add Customer ------------------
    
    if (isset($_POST['txt_cus_AutoID'])) {
        $var_cus_AutoID = $_POST['txt_cus_AutoID'];   
    }   

    if (isset($_POST['txt_cus_name'])) {
        $var_cus_name = $_POST['txt_cus_name'];
    }
    
    if (isset($_POST['txt_cus_address'])) {
        $var_cus_address = $_POST['txt_cus_address'];
    }
    
    
    if (isset($_POST['txt_cus_phone'])) {
    $var_cus_phone = $_POST['txt_cus_phone'];
    }
    
     if (isset($_POST['txt_cus_email'])) {
        $var_cus_email = $_POST['txt_cus_email'];
    }
    
    
    $sign_image_id = "df.png";
   
    $var_cus_reg_date = date("Y.m.d");
   
    
       global $db;


    
       
       //Used a prepared statment to add customers to the database..
    $stmt_add_customer = $db->prepare("INSERT INTO `qas_customer` (cus_id, cus_name, cus_address, cus_phone, cus_email, sign_image_id, cus_reg_date) VALUES (?, ?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_add_customer->bind_param('issssss', $var_cus_AutoID, $var_cus_name, $var_cus_address, $var_cus_phone, $var_cus_email, $sign_image_id, $var_cus_reg_date );
    $stmt_add_customer->execute();
    $stmt_add_customer->close(); 
    
    echo "<script> Swal.fire({ position: 'top-end', icon: 'success', title: 'Customer Added Successfully', showConfirmButton: false, timer: 3000})</script> ";
    

     
     
      }
      

     
   }
    
  
  
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
    
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>