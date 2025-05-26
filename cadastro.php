<?php
require 'includes/bd.php';
session_start();

$erro = ''; 
$modoEdicao = false;
$usuarioExistente = null;

if (isset($_GET['id'])) {
    $modoEdicao = true;
    $id = $_GET['id'];

    // Busca o usuário para edição
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioExistente) {
        header("Location: gerenciamento.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmarSenha'] ?? '';
    $nivel = $_POST['nivel'] ?? '';

    if ($modoEdicao) {
        // Atualizar usuário (com ou sem senha nova)
        if (!empty($senha)) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET usuario = ?, senha = ?, nivel = ? WHERE id = ?");
            $stmt->execute([$usuario, $senhaHash, $nivel, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET usuario = ?, nivel = ? WHERE id = ?");
            $stmt->execute([$usuario, $nivel, $id]);
        }

        header("Location: gerenciamento.php");
        exit;

    } else {
        // Cadastro de novo usuário
        if ($senha !== $confirmarSenha) {
            $erro = "As senhas não coincidem.";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);

            if ($stmt->rowCount() > 0) {
                $erro = "Usuário já existe.";
            } else {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, nivel) VALUES (?, ?, ?)");
                $stmt->execute([$usuario, $senhaHash, $nivel]);
                header("Location: login.php");
                exit;
            }
        }
    }
}

$titulo = $modoEdicao ? 'Editar Usuário' : 'Novo Cadastro';

// Inclui o formulário com base no modo
$conteudo = 'views/cadastro_content.php';
include 'includes/layout_cadastro.php';
?>
