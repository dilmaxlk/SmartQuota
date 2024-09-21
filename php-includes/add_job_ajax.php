<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//Used in addjob.inc.php

    include_once '../php-includes/connect.inc.php';

    if (isset($_POST['txt_job_no'])) {

        global $db;

        if (isset($_POST['txt_job_no'])) {
            $var_txt_job_no = mysqli_real_escape_string($db, $_POST['txt_job_no']);
        }

        if (isset($_POST['txt_job_customer_id'])) {
            $var_txt_job_customer_id = mysqli_real_escape_string($db, $_POST['txt_job_customer_id']);
        }


        if (isset($_POST['txt_job_quota_id'])) {
            $var_txt_job_quota_id = mysqli_real_escape_string($db, $_POST['txt_job_quota_id']);
        }



        if (isset($_POST['txt_job_name'])) {
            $var_txt_job_name = mysqli_real_escape_string($db, $_POST['txt_job_name']);
        }


        if (isset($_POST['txt_job_location'])) {
            $var_txt_job_location = mysqli_real_escape_string($db, $_POST['txt_job_location']);
        }





        if (isset($_POST['txt_job_date'])) {
            $var_txt_job_date = mysqli_real_escape_string($db, $_POST['txt_job_date']);
        }


        if (isset($_POST['txt_job_start_time'])) {
            $var_txt_job_start_time = $_POST['txt_job_start_time'];
        }

        if (isset($_POST['txt_job_end_time'])) {
            $var_txt_job_end_time = $_POST['txt_job_end_time'];
        }






        if (isset($_POST['txt_job_details'])) {
            $var_txt_job_details = $_POST['txt_job_details'];
        }


        if (isset($_POST['txt_job_Emp_details'])) {
            $var_txt_job_Emp_details = $_POST['txt_job_Emp_details'];
        }






        if (isset($_POST['txt_job_mat_req'])) {
            $var_txt_job_mat_req = $_POST['txt_job_mat_req'];
        }

        if (isset($_POST['txt_job_tools_req'])) {
            $var_txt_job_tools_req = $_POST['txt_job_tools_req'];
        }

        if (isset($_POST['txt_job_sp_ins'])) {
            $var_txt_job_sp_ins = $_POST['txt_job_sp_ins'];
        }

        if (isset($_POST['txt_job_pay_inst'])) {
            $var_txt_job_pay_inst = $_POST['txt_job_pay_inst'];
        }



        //Used a prepared statment to add student to the database..)
        $stmt = $db->prepare("INSERT INTO `quota_jobs` (job_no, customer_id, quotation_id, job_Name, job_location, job_date, job_start_time, job_end_time, job_details, job_employee_details, materials_required, tools_required, special_instructions, payment_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //i - integer / d - double / s - string / b - BLOB
        $stmt->bind_param('iiisssssssssss', $var_txt_job_no, $var_txt_job_customer_id, $var_txt_job_quota_id, $var_txt_job_name, $var_txt_job_location, $var_txt_job_date, $var_txt_job_start_time, $var_txt_job_end_time, $var_txt_job_details, $var_txt_job_Emp_details, $var_txt_job_mat_req, $var_txt_job_tools_req, $var_txt_job_sp_ins, $var_txt_job_pay_inst);
        $stmt->execute();
        $stmt->close();
    }




// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>