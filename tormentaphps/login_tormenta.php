<?php
// Configurações do banco
// $host = 'localhost';
// $dbname = 'tormentasite_db';
// $user = 'root';
// $pass = ''; // senha do MySQL, deixe vazia se no XAMPP você não configurou
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexao_db.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Pega os dados do formulário
$email = $_POST['email_user'] ?? '';
$senha = $_POST['senha_user'] ?? '';

if (!isset($email) || !isset($senha)) {
    echo "<script>
    window.alert('Por favor, preencha todos os campos.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>";
    exit;
}

// Busca usuário no banco
$sql = "SELECT * FROM usuarios WHERE email_user = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Verifica a senha
    if (password_verify($senha, $user['senha_hash'])) {
        // Faz um cookie que dura 24 horas, depois disso o usuario sera deslogado:
        setcookie('id_user', $user['id_user'], time()+60*60*24);
        echo "<script>
        window.alert('Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($user['username']) . "');
        window.location.href='../aventureiros_tormenta/aventureiros_tormenta.html';
        </script>";
        exit;
    } else {
        echo "<script>
        window.alert('Senha incorreta.');
        window.location.href='../login_tormenta/login_tormenta.html';
        </script>";
        exit;
    }
} else {
    echo "<script>
    window.alert('Usuário não encontrado.');
    window.location.href='../login_tormenta/login_tormenta.html';
    </script>";
    exit;
}
?>
