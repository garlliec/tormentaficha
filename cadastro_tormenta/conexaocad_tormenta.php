<?php
$host = 'localhost';
$dbname = 'tormentasite_db';
$user = 'root';
$pass = '';

// Criar conexão
$conn = new mysqli($host, $user, $pass, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}
?>
