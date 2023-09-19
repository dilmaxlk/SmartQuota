<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Used in viewuserquotas.inc.php

//include
include_once '../php-includes/connect.inc.php'; 

if (isset($_GET['QuotationID'])) {  
   $Var_QuotationID = $_GET['QuotationID'];
   $VarCustomer_ID = $_GET['CustomerID'];
   $VarCusName = $_GET['CustomerName'];
   
   
   
   }
   
        $stmt_del_quotation = $db->prepare("DELETE FROM `qjm_quotations` WHERE `quo_id` = ?");
        $stmt_del_quotation->bind_param('i', $Var_QuotationID);
        $stmt_del_quotation->execute();       
        $stmt_del_quotation->close();
        
        
        $stmt_del_quotation_items = $db->prepare("DELETE FROM `qjm_quotation_Items` WHERE `quo_quotation_id` = ?");
        $stmt_del_quotation_items->bind_param('i', $Var_QuotationID);
        $stmt_del_quotation_items->execute();       
        $stmt_del_quotation_items->close();
      
        
       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=ViewUserQuotas&CustomerID='.$VarCustomer_ID.'&CustomerName='.$VarCusName); 
        
        
 
      // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    ?>
