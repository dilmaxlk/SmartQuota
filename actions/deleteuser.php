<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Used in edituser.inc.php

//include
include_once '../php-includes/connect.inc.php'; 

if (isset($_GET['UserID'])) {    
   $VarUserID = $_GET['UserID']; 
   }
   
        $stmt_delete_user = $db->prepare("DELETE FROM `cp_users` WHERE `id` = ?");
        $stmt_delete_user->bind_param('i', $VarUserID);
        $stmt_delete_user->execute(); 

        $stmt_delete_user_permission = $db->prepare("DELETE FROM `cp_userpermission` WHERE `uid` = ?");
        $stmt_delete_user_permission->bind_param('i', $VarUserID);
        $stmt_delete_user_permission->execute(); 
        
        $stmt_delete_user->close();
        $stmt_delete_user_permission->close();       
        
       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=ViewAllUsers&PageNo=1'); 
        
        
 
      // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    ?>
