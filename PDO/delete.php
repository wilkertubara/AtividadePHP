<?php

$conn = new PDO("mysql:dbname=eventos;host=localhost", "root", "");

//SQL
//$conn = new PDO("sqlsrv:Database=feira;server=localhost\SQLEXPRESS;ConnectionPool=0", "sa", "root");

$stmt = $conn->prepare("DELETE FROM agenda WHERE id = :ID");

$id = $_GET['id']??'';

$stmt->bindParam(":ID", $id);

$stmt->execute();

echo "Delete OK!";

?>
