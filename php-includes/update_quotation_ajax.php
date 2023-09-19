<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

    // Call in editquota.inc.php
    include_once '../php-includes/connect.inc.php';

    if (isset($_POST['txt_quota_id'])) {
        $var_txt_quota_id = mysqli_real_escape_string($db, $_POST['txt_quota_id']);

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


        if (isset($_POST['txt_quota_invoice_id'])) {
            $var_txt_quota_invoice_id = mysqli_real_escape_string($db, $_POST['txt_quota_invoice_id']);
        }

        if (isset($_POST['txt_quota_invoice_date'])) {
            $var_txt_quota_invoice_date = mysqli_real_escape_string($db, $_POST['txt_quota_invoice_date']);
        }

        if (isset($_POST['txt_quota_inv_status'])) {
            $var_txt_quota_inv_status = mysqli_real_escape_string($db, $_POST['txt_quota_inv_status']);
        }


        // Used a prepared statement to update quotation to the database.
        $stmt = $db->prepare("UPDATE qjm_quotations SET quo_id=?, quo_customer_id=?, quo_subject=?, quo_date_created=?, quo_stage=?, quo_valid_untill=?, quo_proposal_text=?, quo_customer_notes=?, quo_admin_notes=?, quo_tax_rate=?, quo_tax_rate_des=?, quo_othercost=?, quo_othercost_des=?, quo_invoice_id=?, quo_invoice_date=?, quo_payment_status=? WHERE quo_id=?");
        // i - integer / d - double / s - string / b - BLOB
        $stmt->bind_param('iisssssssdsdsissi', $var_txt_quota_id, $var_txt_quota_customer_id, $var_txt_quota_subject, $var_txt_quota_cre_date, $var_txt_quota_stage, $var_txt_quota_valid_until, $var_txt_quota_p_text, $var_txt_quota_cus_notes, $var_txt_quota_adm_notes, $var_txt_quota_tax_rate, $var_txt_quota_tax_des, $var_txt_quota_othercost, $var_txt_quota_othercost_des, $var_txt_quota_invoice_id, $var_txt_quota_invoice_date, $var_txt_quota_inv_status, $var_txt_quota_id);
        $stmt->execute();
        $stmt->close();

        //Update Quotation Items
        $sql = "SELECT * FROM qjm_quotation_Items WHERE quo_quotation_id= $var_txt_quota_id";
        $query = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $quo_item_id = $row['quo_item_id'];

            $up_desc = $_POST['upd_de_' . $quo_item_id];
            $up_qty = $_POST['upd_q_' . $quo_item_id];
            $up_price = $_POST['upd_p_' . $quo_item_id];
            $up_discount = $_POST['upd_d_' . $quo_item_id];
            $up_total = $_POST['upd_t_' . $quo_item_id];

            // Used a prepared statement to update the database.
            $stmt_quota_items = $db->prepare("UPDATE qjm_quotation_Items SET quo_item_description=?, quo_item_qty=?, quo_item_unit_price=?, quo_item_discount=?, quo_item_total=? WHERE quo_item_id=?");
            // i - integer / d - double / s - string / b - BLOB
            $stmt_quota_items->bind_param('sdiddi', $up_desc, $up_qty, $up_price, $up_discount, $up_total, $quo_item_id);
            $stmt_quota_items->execute();
            $stmt_quota_items->close();
        }
    }


    if (isset($_POST['form_submit_traker'])) {

        //-------------Inset Quotation Items------------------

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
                $stmt_add_items = $db->prepare("INSERT INTO qjm_quotation_Items (quo_quotation_id, quo_item_description, quo_item_qty, quo_item_unit_price, quo_item_discount, quo_item_total) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt_add_items->bind_param("isdidd", $var_txt_quota_id, $desc, $qty, $price, $discount, $total);
                $stmt_add_items->execute();
            }
        }
        $stmt_add_items->close();
    }
} else {
    // If the session isn't met, the user will be redirected to the login page
    header('Location: ../login.php');
}
?>
