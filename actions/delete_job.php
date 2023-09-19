<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Used in viewuserquotas.inc.php

//include
include_once '../php-includes/connect.inc.php'; 

if (isset($_GET['JOB_NO'])) {    
   
   $VarJob_No = $_GET['JOB_NO']; 
   $VarCustomer_ID = $_GET['CustomerID'];
   $VarCusName = $_GET['CustomerName'];

   }
   


        $stmt = $db->prepare("DELETE FROM `quota_jobs` WHERE `job_no` = ?");
        $stmt->bind_param('i', $VarJob_No);
        $stmt->execute();       
        $stmt->close();
      
        
       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=ViewUserQuotas&CustomerID='.$VarCustomer_ID.'&CustomerName='.$VarCusName); 
        
        
 
      // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    ?>
