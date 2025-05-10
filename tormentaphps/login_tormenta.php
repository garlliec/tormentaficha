<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("conexao_db.php");

$conn = conexao();

// Validações básicas
if (!isset($_POST['email_user']) || !isset($_POST['senha_user'])) {
    echo "<script>
    window.alert('Por favor preencha todos os campos');
    window.location.href='../cadastro_tormenta/cadastro_tormenta.html';
    </script>";
    exit;
}

echo "a";
$senha = $_POST['senha_user'];

// Pega os dados do formulário
$email_user = $_POST['email_user'];
$sql = "SELECT email_user FROM usuarios WHERE email_user = \"" . $email_user . "\";";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("<script>
    window.alert('Usuário não encontrado. Faça Cadastro.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>");
}



// Insere no banco
$sql = "SELECT * FROM usuarios WHERE email_user = \"" . $email_user . "\";";
$result = mysqli_query($conn, $sql);
$deference = mysqli_fetch_array($result);


// $a = var_dump(password_verify($senha, $deference['senha_hash']));

    // window.location.href='../login_tormenta/login_tormenta.html';
if (!password_verify($senha, $deference['senha_hash'])) {
    echo "<script>
    window.alert('Senha incorreta.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>";
    exit;
}

$bundle = base64_encode($user['username'] . "+" . $user['email_user']);
setcookie('bundle', $bundle, time() + 60 * 60 * 24 * 5); // 5 dias

echo "<script>
    window.alert('Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($deference['username']) . " :D');
    window.location.href='../aventureiros_tormenta/aventureiros_tormenta.html';
    </script>";
exit;


header('Location: ../login_tormenta/login_tormenta.html');

?>
