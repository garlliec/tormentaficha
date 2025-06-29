<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexao_db.php");
include("tormenta_Lib_User.php");

$conn = conexao();

// Validações básicas
if (!isset($_POST['email_user']) || !isset($_POST['senha_user'])) {
    echo "<script>
        window.alert('Por favor preencha todos os campos');
        window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>";
    exit;
};


// $username = $_POST['username'];
$username = $_POST['username'];
$email_user = $_POST['email_user'];
$senha = $_POST['senha_user'];
$id_user = Drf_Email_to_User($conn, $email_user);

// if (! UsernameExists($conn, $username)) {
//     die("<script>
//         window.alert('Usuário não encontrado. Faça Cadastro.');
//         window.location.href='../login_tormenta/login_tormenta.html';
//     </script>");
// };



// if ($id_user == 0) { // TODO: handle error correcly
//     // email doesn't exist in the database
//     die("<script>
//         window.alert('Email nao pertence a esse usuario. Faça Cadastro.');
//         window.location.href='../login_tormenta/login_tormenta.html';
//     </script>");
// };


// User_owns_Email($conn, $id_user $email_user)
// if (! $deference["email_user"] == $email_user) {
if (! User_owns_Email($conn, $id_user, $email_user) || $id_user == 0) {
    die("<script>
        window.alert('Email nao pertence a esse usuario. Faça Cadastro.');
        window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
};

$sql = "SELECT * FROM `Usuarios` WHERE id_user = \"" . $id_user . "\";";
$result = mysqli_query($conn, $sql);
$deference = mysqli_fetch_array($result);




if (! ValidateUserPassword($conn, $id_user, $senha)) {
    die("<script>
        window.alert('Senha incorreta.');
        window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
    // exit;
};

$bundle = base64_encode($username . "+" . $deference['email_user'] . "+" . $deference['senha_hash']); // TODO: replace with session token
// $bundle = base64_encode($deference['username'] . "+" . $deference['email_user'] . "+" . $deference['senha_hash']); // TODO: replace with session token

setcookie('bundle', $bundle, time() + 60 * 60 * 24 * 5); // 5 dias

echo "<script>
        window.alert('Login realizado com sucesso! Bem-vindo, ".
        htmlspecialchars($deference['username']) ." :D');
        window.location.href='../aventureiros_tormenta/aventureiros_tormenta.html';
    </script>";
exit;


header('Location: ../login_tormenta/login_tormenta.html');

?>
