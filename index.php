<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//includes Files
    include_once 'php-includes/connect.inc.php'; 
    include_once 'php-includes/header.inc.php'; 
    include_once 'php-includes/topnav.inc.php'; 
    include_once 'php-includes/get-var.inc.php'; 
    include_once 'php-includes/sidebarleft.inc.php'; 
// Function Files
    include_once 'fun/adduser.fn.php'; 
    include_once 'fun/updateuser.fn.php'; 
    include_once 'fun/addcustomers.fn.php'; 
    include_once 'fun/updatecustomer.fn.php'; 
    include_once 'fun/loading_indicator.fn.php';  
    include_once 'fun/update_biz_details.fn.php'; 


    if ($page == "AddUser") {
        require_once 'php-includes/adduser.inc.php'; 
    } else {
        if ($page == "ViewAllUsers") {
            require_once 'php-includes/viewallusers.inc.php'; 
        } else {
            if ($page == "EditUser") {
                require_once 'php-includes/edituser.inc.php'; 
            } else {
                if ($page == "AssignPermissions") {
                    require_once 'php-includes/assignpermissions.inc.php'; 
                } else {
                    if ($page == "AddCustomers") {
                        require_once 'php-includes/addcustomers.inc.php'; 
                    } else {
                        if ($page == "ViewAllCustomers") {
                            require_once 'php-includes/viewallcustomers.inc.php'; 
                        } else {
                            if ($page == "ViewEditCustomer") {
                                require_once 'php-includes/vieweditcustomer.inc.php'; 
                            } else {
                                if ($page == "Reports") {
                                    require_once 'php-includes/reports.inc.php'; 
                                } else {
                                    if ($page == "AddQuotation") {
                                        require_once 'php-includes/addquotation.inc.php'; 
                                    } else {
                                        if ($page == "ViewUserQuotas") {
                                            require_once 'php-includes/viewuserquotas.inc.php'; 
                                        } else {
                                            if ($page == "EditQuota") {
                                                require_once 'php-includes/editquota.inc.php'; 
                                            } else {
                                                if ($page == "BusinessDetails") {
                                                    require_once 'php-includes/businessdetails.inc.php'; 
                                                } else {
                                                    if ($page == "AddJob") {
                                                        require_once 'php-includes/addjob.inc.php'; 
                                                    } else {
                                                        if ($page == "EditJOB") {
                                                            require_once 'php-includes/editjob.inc.php'; 
                                                        } else {
                                                         if ($page == "Help") {
                                                            require_once 'php-includes/help.inc.php';
                                                         }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
// If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
?>





<?php

include_once 'php-includes/footer.inc.php'; //
?>