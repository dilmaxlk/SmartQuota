<?php


 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     
   
        
//Call in vieweditcustomer.inc.php
        

include_once '../../php-includes/connect.inc.php'; 

function updatecustomer(){
    
       global $db;
       
   //-------------Update Customer------------------
       
 if (isset($_POST['txt_cus_AutoID'])) {
        $var_Cus_auto_id = mysqli_real_escape_string($db, $_POST['txt_cus_AutoID']);
    }

    if (isset($_POST['txt_cus_name'])) {
        $var_Cus_name =  mysqli_real_escape_string($db, $_POST['txt_cus_name']);
    }
    
    if (isset($_POST['txt_cus_address'])) {
    $var_Cus_address = mysqli_real_escape_string($db, $_POST['txt_cus_address']);
    }
      
    
    if (isset($_POST['txt_cus_phone'])) {
    $var_Cus_phone = mysqli_real_escape_string($db, $_POST['txt_cus_phone']);
    }

    if (isset($_POST['txt_cus_email'])) {
    $var_Cus_email = mysqli_real_escape_string($db, $_POST['txt_cus_email']);
    }
      

       //Used a prepared statment to update customer details to the database..
    $stmt = $db->prepare("UPDATE qas_customer SET cus_name=?, cus_address=?, cus_phone=?, cus_email=? WHERE `cus_id`='$var_Cus_auto_id'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('ssss', $var_Cus_name, $var_Cus_address, $var_Cus_phone, $var_Cus_email);
    $stmt->execute();
    $stmt->close(); 
    
    return($stmt);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>