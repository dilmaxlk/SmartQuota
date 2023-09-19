<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in businessdetails.inc.php
include_once '../php-includes/connect.inc.php'; 



function update_biz_details(){
 
global $db;
  
   if (isset($_POST['btn_submit_biz_details'])) {
        

    //-------------Add Company Details------------------
       
    if (isset($_POST['txt_biz_name'])) {
        $var_txt_biz_name = $_POST['txt_biz_name'];
    }

    if (isset($_POST['txt_biz_address'])) {
        $var_txt_biz_address = $_POST['txt_biz_address'];
    }

     if (isset($_POST['txt_biz_tphone'])) {
        $var_txt_biz_tphone = $_POST['txt_biz_tphone'];
    }
       
 
     if (isset($_POST['txt_biz_hotline'])) {
        $var_txt_biz_hotline = $_POST['txt_biz_hotline'];
    }
   
    
    if (isset($_POST['txt_biz_email'])) {
        $var_txt_biz_email = $_POST['txt_biz_email'];
    }

    if (isset($_POST['txt_biz_website'])) {
        $var_txt_biz_website = $_POST['txt_biz_website'];
    }
    
    
    if (isset($_POST['txt_logo_file_name'])) {
        $var_txt_logo_file_name = $_POST['txt_logo_file_name'];
    }    

            
//   Add Company logo
    	if(isset($_FILES['UploadFileField'])){

            
		// Creates the Variables needed to upload the file
		$UploadName = $_FILES['UploadFileField']['name'];
                //Add numbers to upload image then multipal users can upload same image....
		$UploadName = mt_rand(100000, 999999).$UploadName;
                //Add tempary name to image...
		$UploadTmp = $_FILES['UploadFileField']['tmp_name'];
                
                //Add file type, user only able to add Jpg or Png files to the system.. first we add files types to this array and refer them on the code..
                $allowed = array('image/png', 'image/jpeg');
                if(($_FILES['UploadFileField']['type'] !== $allowed[0]) AND ($_FILES['UploadFileField']['type'] !== $allowed[1]) ){
                    
                    //If image file not equal to JPG or PNG or no image select, this defult image will add..
                    $UploadName = $var_txt_logo_file_name;

                    
                } else {
                    
                //File size
		$FileSize = $_FILES['UploadFileField']['size'];
		
		// Removes Unwanted Spaces and characters from the files names of the files being uploaded
		$UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);
		// Upload File Size Limit 1MB
		if(($FileSize > 1048576)){
			
			die("
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Image file is too big, please click [Try Again] and reupload a image, less than 1MB, upload only PNG and JPG image files.!!',
                                     footer: '<a href=\"index.php?page=BusinessDetails\">Try Again</a>',
                                     showConfirmButton: false,
                                  })  
                                  
                             </script>     
                            "
                            );                                
			
		}
		// Checks a File has been Selected and Uploads them into a Directory on your Server
		if(!$UploadTmp){
                    //If not add defult image name to database
                    //$UploadName = You can add any image here.
		}
                else{
                        //else upload the file...
			move_uploaded_file($UploadTmp, "Upload/$UploadName");

    
		}
                
               } 
             
      
        }
                

     if (isset($_POST['txt_quota_P_paymentdetails'])) {
        $var_txt_quota_P_paymentdetails = $_POST['txt_quota_P_paymentdetails'];
    }
    
    
    //Used a prepared statment to update business details to the database..
    $stmt = $db->prepare("UPDATE biz_details SET biz_name=?, biz_address=?, biz_tel=?, biz_hotline=?, biz_email=?, biz_website=?, biz_logo=?, biz_payment_details=? WHERE `id`=1" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('ssssssss', $var_txt_biz_name, $var_txt_biz_address, $var_txt_biz_tphone, $var_txt_biz_hotline, $var_txt_biz_email, $var_txt_biz_website, $UploadName, $var_txt_quota_P_paymentdetails);
    $stmt->execute();
    $stmt->close(); 
    
    

    
   }
    
    }  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>