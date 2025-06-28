<?php

include("conexao_db.php");

$conn = conexao();

$info = [
	-1 => [ // id_inventario = -1
		"peso_maximo" => 100.0,
		"volume_maximo" => 1.0,
		"nome_item" => "AAAAAAAAAAA"
	]
]; // dummy data

// TODO: GET/AUTH PLAYER INFO
// TODO: ALLOW/DISALLOW PLAYER TO CHARACTER


if (!isset($_GET["id_inventario"]))
	die("[\">:(\"]");



if (!$_GET["id_inventario"] == -1) {
	die("[\":/\"]");
} else {
	echo(json_encode($info));
};

// TODO: PROCEED WITH PROCESSING REQUEST
// TODO: GET FROM DATABASE
// TODO: PROCESS RESULT FROM DATABASE


?>
