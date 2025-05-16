<?php
require 'includes/bd.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? '';

if (!$id) {
    echo json_encode(['erro' => 'ID não fornecido.']);
    exit;
}

$stmt = $pdo->prepare("SELECT nome_objeto, local_encontrado, data_cadastro FROM objetos WHERE id_objeto = ?");
$stmt->execute([$id]);

$objeto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($objeto) {
    echo json_encode([
        'id_objeto' => $id,
        'nome_objeto' => $objeto['nome_objeto'],
        'local_encontrado' => $objeto['local_encontrado'],
        'data_cadastro' => $objeto['data_cadastro']
    ]);
} else {
    echo json_encode([
        'erro' => 'Objeto não encontrado.'
    ]);
}
