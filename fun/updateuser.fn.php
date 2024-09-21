<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     

  
//Call in edituser.inc.php

include_once '../php-includes/connect.inc.php'; 

function updateuser(){
 
global $db;
  
    
    if (isset($_POST['txt_AU_AutoID'])) {
        $var_AU_AutoID = $_POST['txt_AU_AutoID'];
    }

    if (isset($_POST['txt_AU_username'])) {
        $var_AU_username = $_POST['txt_AU_username'];
    }

        

//---------Password------------------------------        
        
    if(empty($_POST['txt_AU_pass'])){
 
        
        $stmt_select_pass = $db->prepare("SELECT id, password FROM `cp_users` WHERE id = '$var_AU_AutoID' ");
        $stmt_select_pass->bind_result($Uid, $password);
        $stmt_select_pass->execute();

        while ($stmt_select_pass->fetch()){ 
            
          $var_AU_Pass = $password; 
            
        } 
 
        
    } else {
        
        $var_AU_Pass = sha1($_POST['txt_AU_pass']);
    }
    
 
//---------Password: END------------------------------  
          
         
    
    if (isset($_POST['txt_AU_Fname'])) {
    $var_AU_Fname = $_POST['txt_AU_Fname'];
    }
    
    if (isset($_POST['txt_AU_LName'])) {
    $var_AU_Lname = $_POST['txt_AU_LName'];
    }
    
  
 
       //Used a prepared statment to update users to the database..
    $stmt_update_user = $db->prepare("UPDATE cp_users SET id=?, username=?, password=?, firstname=?, lastname=? WHERE `id`='$var_AU_AutoID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_update_user->bind_param('issss', $var_AU_AutoID, $var_AU_username, $var_AU_Pass, $var_AU_Fname, $var_AU_Lname);
    $stmt_update_user->execute();
    $stmt_update_user->close(); 
    

    
    return($stmt);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>