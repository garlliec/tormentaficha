<?php
// Configurações do banco
$host = 'localhost';
$dbname = 'tormentasite_db';
$user = 'root';
$pass = ''; // senha do MySQL, deixe vazia se no XAMPP você não configurou

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Pega os dados do formulário
$email = $_POST['email_user'] ?? '';
$senha = $_POST['senha_user'] ?? '';

if (empty($email) || empty($senha)) {
    echo "Por favor, preencha todos os campos.";
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
        echo "Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($user['username']);
        // Aqui você pode iniciar uma sessão:
        // session_start();
        // $_SESSION['usuario_id'] = $user['id_usuario'];
        // redirecionar para página protegida
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}
?>
