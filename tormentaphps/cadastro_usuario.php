<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("conexao_db.php");
$conn = conexao();

include("tormenta_Lib_User.php");


// Validações básicas
if ((!isset($_POST['username'])) || (!isset($_POST['email_user'])) || (!isset($_POST['senha_user']))) {
    echo "<script>
        window.alert('Por favor preencha todos os campos');
        window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>";
    exit;
}

$username = $_POST['username'];
$email = $_POST['email_user'];
$password = $_POST['senha_user'];


if (UsernameExists($conn, $username)) {
    die("<script>
        window.alert('Este usuario já está cadastrado. Faça login.');
        window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
};

if (EmailExists($conn, $email)) {
    die("<script>
        window.alert('Este e-mail já está cadastrado. Faça login.');
        window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
};


$create_result = CreateUser($conn, $username, $email, $password);

if ($create_result < 0)
    // redireciona para o login
    die("<script>
        window.alert('Erro ao cadastrar. Tente novamente.');
        window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>");


echo "<script>
        window.alert('Cadastro realizado com sucesso! :D');
    </script>";

header('Location: ../login_tormenta/login_tormenta.html');
?>
