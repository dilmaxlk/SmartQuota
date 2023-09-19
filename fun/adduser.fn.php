<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in adduser.inc.php

include_once '../php-includes/connect.inc.php'; 


function adduser(){
    

 
    if(isset($_POST['btn_submit'])){
        
    
          
   //-------------Add User------------------
    
    if (isset($_POST['txt_AU_AutoID'])) {
        $var_AU_AutoID = $_POST['txt_AU_AutoID'];
    }
    

    if (isset($_POST['txt_AU_username'])) {
        $var_AU_username = $_POST['txt_AU_username'];
    }
    
    if (isset($_POST['txt_AU_pass'])) {
        $var_AU_Pass = sha1($_POST['txt_AU_pass']);
    }
    
    if (isset($_POST['txt_AU_Fname'])) {
    $var_AU_Fname = $_POST['txt_AU_Fname'];
    }
    
    if (isset($_POST['txt_AU_LName'])) {
    $var_AU_Lname = $_POST['txt_AU_LName'];
    }
    
 
    
       global $db;
   
    //Used a prepared statment to add user defult permissions to the database..
    $stmt_add_user_permission = $db->prepare("INSERT INTO `cp_userpermission` (permission_id, uid, OnOff) VALUES (1121, '$var_AU_AutoID', 1), (1123, '$var_AU_AutoID', 0), (1124, '$var_AU_AutoID', 0), (1125, '$var_AU_AutoID', 0), (1128, '$var_AU_AutoID', 0), (1127, '$var_AU_AutoID', 0), (1140, '$var_AU_AutoID', 0), (1141, '$var_AU_AutoID', 0), (1142, '$var_AU_AutoID', 0), (1143, '$var_AU_AutoID', 0), (1144, '$var_AU_AutoID', 0), (1146, '$var_AU_AutoID', 0), (1145, '$var_AU_AutoID', 0), (1147, '$var_AU_AutoID', 0)");
    $stmt_add_user_permission->execute();
    $stmt_add_user_permission->close(); 
    
    
       //Used a prepared statment to add user to the database..
    $stmt_add_user = $db->prepare("INSERT INTO `cp_users` (id, username, password, firstname, lastname) VALUES (?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_add_user->bind_param('issss', $var_AU_AutoID, $var_AU_username, $var_AU_Pass, $var_AU_Fname, $var_AU_Lname);
    $stmt_add_user->execute();
    $stmt_add_user->close(); 
      
    
      }
     
   }
    
  
  
        // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
    
?>