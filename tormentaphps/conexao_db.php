<?php
if (!function_exists("conexao")) {
	function conexao() {
		$host = '192.168.122.175';
		$user = 'user';
		$pass = 'qwe';
		$dbname = 'tormentasite_db';

		$conn = mysqli_connect("$host", "$user", "$pass", "$dbname");
		return $conn;
	}
}
?>
