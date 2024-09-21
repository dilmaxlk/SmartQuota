<?php
// Database Connection
$dbconnect = array(
    'server' => 'localhost',        //Server Name Ex: localhost or IP address
    'dbuser' => 'xxxxxx',    // database user name
    'dbpass' => 'xxxxxx', // database user password
    'dbname' => 'xxxxxx'       // database name
);

$db = new mysqli (
        $dbconnect ['server'],
        $dbconnect ['dbuser'],
        $dbconnect ['dbpass'],
        $dbconnect ['dbname']     
        
        );

if ($db->connect_errno>0){
    echo "Database Connect Error";
    exit;
}  else {
    //echo "Success";
    
}



?>