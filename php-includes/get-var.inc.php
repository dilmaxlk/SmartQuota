<?php

//Application Route (index.php?page=???) 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "error";
}
?>
