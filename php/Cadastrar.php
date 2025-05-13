<?php
//conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=projeto', 'usuario', 'senha');

// Verifica dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmarSenha'];
$nome = $_POST['nivel'];

//validar senha
if ($senha !== $confirmarSenha) {
    echo "As senhas não coincidem.";
    exit;
}

// Verifica se o usuário já existe
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
if ($stmt->rowCount() > 0) {
    echo "Usuário já existe.";
    exit;
}

// cadastrar o usuário
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, nivel) VALUES (?, ?, ?)");
$stmt->execute([$usuario, $senha_hash, $nivel]);

echo "Usuário cadastrado com sucesso.";
// Redireciona para a página de login
header("Location: login.php");

?>