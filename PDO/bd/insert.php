<?php

$conn = new PDO("mysql:dbname=eventos;host=localhost", "root", "");#conexão com banco

$stmt = $conn->prepare("INSERT INTO agenda (evento, artista, dt) VALUES(:EVENTO,  :ARTISTA, :DT)");

$evento = $_GET["eventos"]??"";
$artista = $_GET["artista"]??"";
$dt = $_GET["dt"]??"";

$stmt->bindParam(":EVENTO", $evento);
$stmt->bindParam(":ARTISTA", $artista);
$stmt->bindParam(":DT", $dt);

$stmt->execute();

echo "Inserido OK!";

?>