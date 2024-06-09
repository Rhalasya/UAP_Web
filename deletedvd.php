<?php
require 'rental/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM data_dvd WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $id); // Bind the id parameter as an integer
$stmt->execute();

header("Location: indexdvd.php");
?>
