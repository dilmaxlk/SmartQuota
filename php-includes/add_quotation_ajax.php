<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//Used in addquotation.inc.php

    include_once '../php-includes/connect.inc.php';

    if (isset($_POST['txt_quota_id'])) {

        global $db;

        if (isset($_POST['txt_quota_id'])) {
            $var_txt_quota_id = mysqli_real_escape_string($db, $_POST['txt_quota_id']);
        }

        if (isset($_POST['txt_quota_customer_id'])) {
            $var_txt_quota_customer_id = mysqli_real_escape_string($db, $_POST['txt_quota_customer_id']);
        }


        if (isset($_POST['txt_quota_subject'])) {
            $var_txt_quota_subject = mysqli_real_escape_string($db, $_POST['txt_quota_subject']);
        }

        if (isset($_POST['txt_quota_stage'])) {
            $var_txt_quota_stage = mysqli_real_escape_string($db, $_POST['txt_quota_stage']);
        }


        if (isset($_POST['txt_quota_cre_date'])) {
            $var_txt_quota_cre_date = mysqli_real_escape_string($db, $_POST['txt_quota_cre_date']);
        }

        if (isset($_POST['txt_quota_valid_until'])) {
            $var_txt_quota_valid_until = mysqli_real_escape_string($db, $_POST['txt_quota_valid_until']);
        }


        if (isset($_POST['txt_quota_p_text'])) {
            $var_txt_quota_p_text = $_POST['txt_quota_p_text'];
        }

        if (isset($_POST['txt_quota_cus_notes'])) {
            $var_txt_quota_cus_notes = $_POST['txt_quota_cus_notes'];
        }

        if (isset($_POST['txt_quota_adm_notes'])) {
            $var_txt_quota_adm_notes = $_POST['txt_quota_adm_notes'];
        }


        if (isset($_POST['txt_quota_tax_rate'])) {
            $var_txt_quota_tax_rate = mysqli_real_escape_string($db, $_POST['txt_quota_tax_rate']);
        }

        if (isset($_POST['txt_quota_tax_des'])) {
            $var_txt_quota_tax_des = mysqli_real_escape_string($db, $_POST['txt_quota_tax_des']);
        }

        if (isset($_POST['txt_quota_othercost'])) {
            $var_txt_quota_othercost = mysqli_real_escape_string($db, $_POST['txt_quota_othercost']);
        }

        if (isset($_POST['txt_quota_othercost_des'])) {
            $var_txt_quota_othercost_des = mysqli_real_escape_string($db, $_POST['txt_quota_othercost_des']);
        }

        $Invoice_Id = rand(1000, 10000);

        //Used a prepared statment to add quotation to the database..
        $stmt_add_quota = $db->prepare("INSERT INTO `qjm_quotations` (quo_id, quo_customer_id, quo_subject, quo_date_created, quo_stage, quo_valid_untill, quo_proposal_text, quo_customer_notes, quo_admin_notes, quo_tax_rate, quo_tax_rate_des, quo_othercost, quo_othercost_des, quo_invoice_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //i - integer / d - double / s - string / b - BLOB
        $stmt_add_quota->bind_param('iisssssssdsdsi', $var_txt_quota_id, $var_txt_quota_customer_id, $var_txt_quota_subject, $var_txt_quota_cre_date, $var_txt_quota_stage, $var_txt_quota_valid_until, $var_txt_quota_p_text, $var_txt_quota_cus_notes, $var_txt_quota_adm_notes, $var_txt_quota_tax_rate, $var_txt_quota_tax_des, $var_txt_quota_othercost, $var_txt_quota_othercost_des, $Invoice_Id);
        $stmt_add_quota->execute();
        $stmt_add_quota->close();

        //-------------Quotation Items------------------

        $items = $_POST;

// Insert each item into the database
        foreach ($items as $key => $value) {
            // Skip non-item fields (e.g., submit button)
            if (strpos($key, 'qty') !== false) {
                $qty = $_POST[$key];
                $desc = $_POST['desc' . substr($key, 3)];
                $price = $_POST['price' . substr($key, 3)];
                $discount = $_POST['discount' . substr($key, 3)];
                $total = $_POST['total' . substr($key, 3)];

                // Prepare and execute the SQL statement
                $stmt = $db->prepare("INSERT INTO qjm_quotation_Items (quo_quotation_id, quo_item_description, quo_item_qty, quo_item_unit_price, quo_item_discount, quo_item_total) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isdidd", $var_txt_quota_id, $desc, $qty, $price, $discount, $total);
                $stmt->execute();
                $stmt->close();
            }
        }
    }




// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>