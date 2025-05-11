<?php
if (!function_exists("conexao")) {
	function conexao() {
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$dbname = 'tormentasite_db';

		$conn = mysqli_connect("$host", "$user", "$pass", "$dbname");
		return $conn;
	}
}
?>
