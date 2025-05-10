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
$username = $_POST['username'] ?? '';
$email = $_POST['email_user'] ?? '';
$senha = $_POST['senha_user'] ?? '';

// Validações básicas
if (empty($username) || empty($email) || empty($senha)) {
    echo "Por favor, preencha todos os campos.";
    exit;
}

// Verifica se o e-mail já está cadastrado
$sql = "SELECT * FROM usuarios WHERE email_user = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Este e-mail já está cadastrado. Faça login.";
    exit;
}

// Gera o hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Insere no banco
$sql = "INSERT INTO usuarios (username, email_user, senha_hash) VALUES (:username, :email, :senha_hash)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha_hash', $senha_hash);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
    // Aqui você pode redirecionar para o login
    // header('Location: login_tormenta.html');
    // exit;
} else {
    echo "Erro ao cadastrar. Tente novamente.";
}
?>
