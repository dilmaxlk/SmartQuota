<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

// Select the user and assign permission...        
    $stmt_1127_hide_users_menu_permission = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1127");
    $stmt_1127_hide_users_menu_permission->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff1127);
    $stmt_1127_hide_users_menu_permission->execute();

    while ($stmt_1127_hide_users_menu_permission->fetch()) {
        
    }
    ?>



    <?php
    // If page name is set on URL, Nav bar will forcus on the to the page....
    if (isset($_GET['page'])) {
        $setpage = $_GET['page'];

        if ($setpage == "AddUser") {
            $active7 = "active";
        }

        if ($setpage == "ViewAllUsers") {
            $active8 = "active";
        }

        if ($setpage == "AddCustomers") {
            $active9 = "active";
        }

        if ($setpage == "ViewAllCustomers") {
            $active9_ViewAllCustomers = "active";
        }

        if ($setpage == "BusinessDetails") {
            $active10_BusinessDetails = "active";
        }
    }
    ?>



    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user1.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">

    <?php
    $stmt = $db->prepare("SELECT id, firstname, lastname FROM `cp_users` WHERE id= {$_SESSION['user_id']}");
    $stmt->bind_result($id, $FirstName, $LastName);
    $stmt->execute();
    while ($stmt->fetch()) {
        
    }
    ?>
                    <p><?php echo $FirstName; ?></p>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="dash.php">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                    <?php
                    if ($cp_userpermission_OnOff1127 == 0) {

                        $style1127 = "display: none;";
                    }
                    ?> 
                <li style="<?php echo $active9_ViewAllCustomers . $active10_BusinessDetails ?>" class="treeview <?php echo $active9 . $active9_ViewAllCustomers . $active10_BusinessDetails; ?>">
                    <a href="#">
                        <i class="fa fa-user-plus"></i>
                        <span>Start Here <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $active9; ?>"><a href="index.php?page=AddCustomers"><i class="fa fa-angle-double-right"></i>Add Customer</a></li>
                        <li class="<?php echo $active9_ViewAllCustomers; ?>"><a href="index.php?page=ViewAllCustomers&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Customers</a></li>
                        <li class="<?php echo $active10_BusinessDetails; ?>"><a href="index.php?page=BusinessDetails"><i class="fa fa-angle-double-right"></i>Business Details</a></li>

                    </ul>
                </li>

                <li>
                    <a href="index.php?page=Reports">
                        <i class="fa fa-file-text"></i> <span>Reports</span>
                    </a>
                </li>

                <li style="<?php echo $style1127 ?>" class="treeview <?php echo $active7 . $active8; ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $active7; ?>"><a href="index.php?page=AddUser"><i class="fa fa-angle-double-right"></i>Add User</a></li>
                        <li class="<?php echo $active8; ?>"><a href="index.php?page=ViewAllUsers&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Users</a></li>
                    </ul>
                </li>
                
            <li class="">
              <a href="index.php?page=Help">
                <i class="fa fa-info-circle"></i> <span>Help</span>
              </a>
            </li>                
                

                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                    </a>
                </li>

        </section>

        <!-- /.sidebar -->
    </aside>
    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
?>