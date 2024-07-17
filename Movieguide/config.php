<?php
$serverName = "LAPTOP-NV52G4EE\SQLEXPRESS"; 
$connectionOptions = array(
    "Database" => "master",
    "Uid" => "sa",
    "PWD" => "abewin3451"
);

// Establishes the connection
$conn = sqlsrv_connect( $serverName, $connectionOptions );

if( !$conn ) {
    die( print_r( sqlsrv_errors(), true));
}
?>
