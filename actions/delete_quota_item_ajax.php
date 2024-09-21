<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Used in editquota.inc.php

//include
include_once '../php-includes/connect.inc.php'; 

if (isset($_POST['quo_item_id'])) {    
   $VarQuotaItem_ID = $_POST['quo_item_id']; 
    
   }
   
        $stmt = $db->prepare("DELETE FROM `qjm_quotation_Items` WHERE `quo_item_id` = ?");
        $stmt->bind_param('i', $VarQuotaItem_ID);
        $stmt->execute();       
        $stmt->close();
      
              
 
      // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    ?>
