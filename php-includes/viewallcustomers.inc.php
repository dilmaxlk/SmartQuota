<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

    // If the value is set form POST request to $ShowRecords1, that value will update on the database...
    if (isset($_POST["shorec"])) {
        $ShowRecords1 = $_POST["shorec"];

        // Update the database from selected value
        $stmt_update_settings = $db->prepare("UPDATE cp_settings SET showrecords=? WHERE `setting_id`=1 ");
        $stmt_update_settings->bind_param('i', $ShowRecords1);
        $stmt_update_settings->execute();
    }
    ?>


    <?php
    global $db;

    //Select the database "setting" value and Set that value to $ShowRecords1 to genarate the records...
    $stmt_Select_setting = $db->prepare("SELECT showrecords FROM `cp_settings` WHERE `setting_id`=1 ");
    $stmt_Select_setting->bind_result($ShowRecords1);
    $stmt_Select_setting->execute();

    while ($stmt_Select_setting->fetch()) {
        
    }


// This first query is just to get the total count of rows
    $sql = "SELECT COUNT(id) FROM qas_customer";
    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($query);

// Here we have the total row count
    $rows = $row[0];

// This is the number of results we want displayed per page, $ShowRecords1 select form database "setting" table...
    $page_rows = $ShowRecords1;

// This tells us the page number of our last page
    $last = ceil($rows / $page_rows);

// This makes sure $last cannot be less than 1
    if ($last < 1) {
        $last = 1;
    }

// Establish the $pagenum variable (Page Numbers)
    $pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
    if (isset($_GET['PageNo'])) {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['PageNo']);
    }

// This makes sure the page number isn't below 1, or more than our $last page
    if ($pagenum < 1) {
        $pagenum = 1;
    } else if ($pagenum > $last) {
        $pagenum = $last;
    }

// This sets the range of rows to query for the chosen $pagenum
    $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

// This is your query again , it is for grabbing just one page worth of rows by applying $limit
    $sql = "SELECT id, cus_id, cus_name, cus_phone FROM qas_customer ORDER BY cus_reg_date DESC $limit";

    $query = mysqli_query($db, $sql);

// This shows the user what page they are on, and the total number of pages
    $textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

// Establish the $paginationCtrls variable
    $paginationCtrls = '<ul class="pagination pagination-sm no-margin">';
    //If there is more than 1 page worth of results
    if ($last != 1) {
        /* First we check if we are on page one. If we are then we don't need a link to 
          the previous page or the first page so we do nothing. If we aren't then we
          generate links to the first page, and to the previous page. */
        if ($pagenum > 1) {
            $previous = $pagenum - 1;
            $paginationCtrls .= '<li><a href="index.php?page=ViewAllCustomers&PageNo=1">&laquo;&laquo;</a></li>'
                    . '<li><a href="index.php?page=ViewAllCustomers&PageNo=' . $previous . '">&laquo;</a></li>';

            // Render clickable number links that should appear on the left of the target page number
            for ($i = $pagenum - 2; $i < $pagenum; $i++) {
                if ($i > 0) {
                    $paginationCtrls .= '<li><a href="index.php?page=ViewAllCustomers&PageNo=' . $i . '">' . $i . '</a></li>';
                }
            }
        }

        // Render the target page number, but without it being a link
        $paginationCtrls .= '<li class="active" ><a href="#">' . $pagenum . '</a></li> ';

        // Render clickable number links that should appear on the right of the target page number
        for ($i = $pagenum + 1; $i <= $last; $i++) {
            $paginationCtrls .= '<li><a href="index.php?page=ViewAllCustomers&PageNo=' . $i . '">' . $i . '</a></li>';
            if ($i >= $pagenum + 2) {
                break;
            }
        }
        // This does the same as above, only checking if we are on the last page, and then generating the "Next"
        if ($pagenum != $last) {
            $next = $pagenum + 1;
            $paginationCtrls .= '<li><a href="index.php?page=ViewAllCustomers&PageNo=' . $next . '">&raquo;</a></li> '
                    . '<li><a href="index.php?page=ViewAllCustomers&PageNo=' . $last . '">&raquo;&raquo;</a></li>'
                    . '</ul>';
        }
    }
    ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h1>
                View All Customers
                <small></small>
            </h1>          

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Customer List</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>



                <div class="box-body">         
                    <div><?php echo $textline2; ?></div>   
                    <form class="form-inline" method="POST" action="">  

                        <div class="form-group">
                            <input style="margin-bottom: 10px;" class="btn btn-sm btn-success" type="submit" value="Show" onclick="" name="submit" />                   
                            <div class="input-group">                     
                                <select style="margin-bottom: 10px;" name="shorec" class="form-control input-sm">

    <?php
    //Select the database setting value
    $stmt = $db->prepare("SELECT showrecords FROM `cp_settings` WHERE `setting_id`=1 ");
    $stmt->bind_result($ShowRecords1);
    $stmt->execute();

    while ($stmt->fetch()) {
        ?>
                                        <option><?php echo $ShowRecords1; ?></option> 

        <?php
    }
    ?>


                                    <option>5</option>
                                    <option>10</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>250</option>
                                </select>


                            </div>

                        </div>


                    </form> 

                    <!-- Search Form -->       

                    <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                        <input type="hidden" name="page" value="ViewAllCustomers">
                        <input style="margin-top: 10px; width: 220px" class="form-control" type="text" name="SearchKey" value="" placeholder="Customer ID or Name"/>
                        <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                        <a style="margin-top: 10px;" href="index.php?page=ViewAllCustomers&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                    </form>




    <?php
    if (!isset($_GET["SearchKey"])) {
        ?>
                        <form name="myform" action="" method="post">
                            <div class="box-body table-responsive no-padding">
                                <table id="vas_table" class="table table-hover table-bordered table-responsive">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Contact</th>

                                        </tr>
                                    </thead>
                                    <tbody>

        <?php
        $PNo = $_GET["PageNo"];

        // Loop to generate database values to table...       
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            ?>

                                            <tr>
                                                <td>
                            <?php $RNuber = rand(1000, 10000); ?>
                                                    <a href="index.php?page=AddQuotation&CustomerID=<?php echo $row['cus_id']; ?>&CustomerName=<?php echo $row['cus_name']; ?>&QuotaID=<?php echo $RNuber; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                        <i class="fa fa-file-o"></i> Add a Quotation
                                                    </a>                          

            <?php $RNuber = rand(1000, 10000); ?>
                                                    <a href="index.php?page=AddJob&CustomerID=<?php echo $row['cus_id']; ?>&JOB_ID=<?php echo $RNuber; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                        <i class="fa fa-cogs"></i> Add a JOB
                                                    </a> 

                                                    <a href="index.php?page=ViewUserQuotas&CustomerID=<?php echo $row['cus_id']; ?>&CustomerName=<?php echo $row['cus_name']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                        <i class="fa fa-eye"></i> View Quota & JOBs
                                                    </a> 

                                                    <a href="index.php?page=ViewEditCustomer&CustomerID=<?php echo $row['cus_id']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                        <i class="fa fa-edit"></i> View | Edit
                                                    </a>                                 




                                                </td>

                                                <td><?php echo $row['cus_id'] ?></td>
                                                <td><?php echo $row['cus_name'] ?></td>
                                                <td><?php echo $row['cus_phone'] ?>                                             
                                                </td>



                                            </tr>



                                            <!-- Modal Window for Delete User-->
                                        <div class="modal fade modal-danger" id="<?php echo $row['cus_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to delete this Customer... ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a  href="actions/delete_customer.php?CustomerID=<?php echo $row['cus_id']; ?>" class='btn btn-success btn-flat'>Yes, Delete</a>
                                                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                      
        <?php } ?>

                                    </tbody>


                                </table> 
                            </div>
                        </form> 
                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 




        <?php
    } else {


        $SearchKey = $_GET["SearchKey"];

        $sql_select_customers = "SELECT id, cus_id, cus_name, cus_phone FROM qas_customer WHERE cus_name LIKE '%{$SearchKey}%' OR cus_id LIKE '%{$SearchKey}%' ";
        $query_select_customers = mysqli_query($db, $sql_select_customers);
        ?>

                        <!-- Search Result Table -->                                    
                        <form name="myform2" action="" method="post">               
                            <table id="vas_table2" class="table table-hover table-bordered table-responsive">


                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>

        <?php
        $PNo = $_GET["PageNo"];

        // Loop to generate database values to table...       
        while ($row = mysqli_fetch_array($query_select_customers, MYSQLI_ASSOC)) {
            ?>


                                        <tr>
                                            <td>

                                                <a href="index.php?page=AddQSAJob&CustomerID=<?php echo $row['cus_id']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                    <i class="fa fa-plus-circle"></i> Add QSA Job
                                                </a>                          

                                                <a href="index.php?page=ViewCustomerQSAJobs&CustomerID=<?php echo $row['cus_id']; ?>&CusName=<?php echo $row['cus_name']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                    <i class="fa fa-edit"></i> View QSA Job
                                                </a> 

                                                <a href="index.php?page=ViewEditCustomer&CustomerID=<?php echo $row['cus_id']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                                    <i class="fa fa-edit"></i> View | Edit
                                                </a>  
                                            </td>

                                            <td><?php echo $row['cus_id'] ?></td>
                                            <td><?php echo $row['cus_name'] ?></td>
                                            <td><?php echo $row['cus_phone'] ?>


                                                <button style="margin-right: 20px;" type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#<?php echo $row['cus_id']; ?>"><span class="fa fa-trash"></span></button> 
                                            </td>
                                        </tr>



                                        <!-- Modal Window for Delete User-->
                                    <div class="modal fade modal-danger" id="<?php echo $row['cus_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Do you want to delete this Customer... ?
                                                </div>
                                                <div class="modal-footer">
                                                    <a  href="actions/delete_customer.php?CustomerID=<?php echo $row['cus_id']; ?>" class='btn btn-success btn-flat'>Yes, Delete</a>
                                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                       

        <?php } ?>

                                </tbody>


                            </table>            
                        </form>  


        <?php
    }
    ?>     
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.content -->



    <?php
    $db->close();
    mysqli_close($db);
    ?> 

    </div><!-- /.col -->

    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}


    