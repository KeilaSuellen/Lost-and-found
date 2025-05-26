<?php
require 'includes/bd.php';
session_start();

$msg_sucesso = '';
$nova_pagina = '';

$id_objeto = $_POST['id_objeto'] ?? '';

if($id_objeto){
    $stmt = $pdo->prepare("UPDATE objetos SET nome_objeto=?, descricao=?, categoria=?, ... WHERE id_objeto=?");
    $stmt->execute([
        $_POST['nome_objeto'], $_POST['descricao'], $_POST['categoria'], $id_objeto]);
}else{
    $stmt = $pdo->prepare("SELECT MAX(id_objeto) as max_id FROM objetos WHERE id_objeto LIKE '%/$ano'");
    $stmt->execute();
}

if (isset($_SESSION['msg_sucesso'])) {
    $msg_sucesso = $_SESSION['msg_sucesso'];
    $id_gerado = $_SESSION['id_novo_objeto'] ?? '';
    unset($_SESSION['msg_sucesso'], $_SESSION['id_novo_objeto']);

    //link para a nova página
    $nova_pagina = "<a href='registroobj.php?id=$id_gerado'>Clique aqui para ver o objeto cadastrado</a>";
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}



// Cria pasta de fotos se não existir
if (!is_dir('fotos')) {
    mkdir('fotos', 0777, true);
}

$foto = $_FILES['foto'];
$tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

if ($foto['error'] == 0 && in_array($foto['type'], $tipos_permitidos)) {
    $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nome_arquivo = uniqid() . '.' . $extensao;
    $caminho = 'fotos/' . $nome_arquivo;
    move_uploaded_file($foto['tmp_name'], $caminho);
} else {
    echo "Erro ao fazer upload da foto.";
    exit();
}

// Dados do formulário
$id_objeto = $_POST['id_objeto'];
$nome = htmlspecialchars($_POST['nome_objeto'] ?? '');
$descricao = htmlspecialchars($_POST['descricao'] ?? '');
$categoria = $_POST['categoria'] ?? '';
$local = htmlspecialchars($_POST['local_encontrado'] ?? '');
$data = $_POST['data_cadastro'] ?? '';
$quem_encontrou = htmlspecialchars($_POST['quem_encontrou'] ?? '');
$empresa = htmlspecialchars($_POST['empresa'] ?? '');
$registrado_por = $_SESSION['usuario_id'];

// Salva no banco
$stmt = $pdo->prepare("INSERT INTO objetos (id_objeto, nome_objeto, descricao, categoria, local_encontrado, data_cadastro, foto, quem_encontrou, empresa, registrado_por) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sucesso = $stmt->execute([
    $id_objeto, $nome, $descricao, $categoria, $local, $data,
    $nome_arquivo, $quem_encontrou, $empresa, $registrado_por
]);

if ($sucesso){
    $_SESSION['msg_sucesso'] = "Objeto registrado com sucesso!";
    $_SESSION['id_novo_objeto'] = $id_objeto;
    header('Location: registroobj.php');
    exit();
} else {
    echo "Erro ao registrar objeto: " . $stmt->errorInfo()[2];
}
