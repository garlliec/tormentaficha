<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("conexao_db.php");

$conn = conexao();

// Validações básicas
if ((!isset($_POST['username'])) || (!isset($_POST['email_user'])) || (!isset($_POST['senha_user']))) {
    echo "<script>
    window.alert('Por favor preencha todos os campos');
    window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>";
    exit;
}


// Pega os dados do formulário
$username = $_POST['username'];

// Verifica se o usuario já está cadastrado
$sql = "SELECT username FROM Usuarios WHERE username = \"" . $username . "\";"
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    die("<script>
    window.alert('Este usuario já está cadastrado. Faça login.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
}



$email = $_POST['email_user'];

// Verifica se o e-mail já está cadastrado
$sql = "SELECT email_user FROM Usuarios WHERE email_user = \"" . $email . "\";";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    die("<script>
    window.alert('Este e-mail já está cadastrado. Faça login.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
}


$senha_hash = password_hash($_POST['senha_user'], PASSWORD_DEFAULT);

// Insere no banco
$sql = "INSERT INTO Usuarios (username, email_user, senha_hash) VALUES (\"" . $username . "\", \"" . $email . "\", \"" . $senha_hash . "\")";
$result = mysqli_query($conn, $sql);

if (mysqli_error($conn))
    // redireciona para o login
    die("<script>
    window.alert('Erro ao cadastrar. Tente novamente.');
    window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>");



echo "<script>
    window.aleru(Cadastro realizado com sucesso!');
    </script>";U
header('Location: ../login_tormenta/login_tormenta.html');
?>
