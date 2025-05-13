<?php
//login
session_start();
//conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=projeto', 'usuario', 'senha');
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica dados do formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        // Inicia a sessão e armazena os dados do usuário
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['nivel'] = $user['nivel'];
        header("Location: index.php");
        exit;
    } else {
        echo "Usuário ou senha inválidos.";
    }
}

?>