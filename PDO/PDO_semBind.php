<?php

$conn = new PDO("mysql:dbname=feira;host=localhost", "root", "root");

$stmt = $conn->prepare("SELECT * FROM fruta");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {

	foreach ($row as $key => $value) {

		echo "<strong>".$key."</strong>".$value."<br/>";

	}

	echo "========================================<br>";

}

?>