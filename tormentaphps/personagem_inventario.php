<?php

include("conexao_db.php");

$conn = conexao();



// CREATE TABLE `Inventario` (
//   `id_inventario` INT AUTO_INCREMENT NOT NULL,
//   PRIMARY KEY (id_inventario),
//
//   `peso_maximo` FLOAT NOT NULL DEFAULT '0.0',
//   `volume_maximo` FLOAT NOT NULL DEFAULT '0.0',
//   `nome_item` VARCHAR(60) NOT NULL
//
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

$info = [
	-1 => [ // id_inventario = -1
		"peso_maximo" => 100.0,
		"volume_maximo" => 1.0,
		"nome_item" => "AAAAAAAAAAA"
	]
]; // dummy data

// TODO: GET/AUTH PLAYER INFO
// TODO: ALLOW/DISALLOW PLAYER TO CHARACTER


if (isset($_GET["id_inventario"])) {
	// echo ":D " . $_GET["id_inventario"];
} else {
	die("[\">:(\"]");
};


if ($_GET["id_inventario"] == -1) {
	echo(json_encode($info));
} else {
	die("[\":/\"]");
};

// TODO: PROCEED WITH PROCESSING REQUEST
// TODO: GET FROM DATABASE
// TODO: PROCESS RESULT FROM DATABASE


?>
