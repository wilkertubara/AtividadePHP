<?php

$conn = new PDO("mysql:dbname=feira;host=localhost", "root", "root");

//SQL
//$conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPool=0", "sa", "root");

$stmt = $conn->prepare("UPDATE feirante SET nome = :NOME, localizacao = :LOCALIZACAO WHERE id = :ID");

$nome = "João";
$localizacao = "Bloco B";
$id = 2;

$stmt->bindParam(":NOME", $nome);
$stmt->bindParam(":LOCALIZACAO", $localizacao);
$stmt->bindParam(":ID", $id);

$stmt->execute();

echo "Alterado OK!";

?>