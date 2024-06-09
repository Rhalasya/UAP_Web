<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "penjualan_kaset_dvd";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
    echo "EROR";
    die("MATI");
}

?>