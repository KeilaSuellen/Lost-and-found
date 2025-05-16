<?php
require 'includes/bd.php';

header('Content-Type: application/json');

$stmt = $pdo->query("
    SELECT 
        id_objeto,
        nome_objeto,
        tipo_objeto,
        descricao,
        data_cadastro,
        data_devolucao
    FROM objetos
");

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$hoje = new DateTime();

foreach ($dados as &$objeto) {
    $dataCadastro = new DateTime($objeto['data_cadastro']);

    if (!empty($objeto['data_devolucao'])) {
        $objeto['status'] = 'Devolvido';
    } else {
        $intervalo = $dataCadastro->diff($hoje)->m + ($dataCadastro->diff($hoje)->y * 12);
        $objeto['status'] = $intervalo >= 3 ? 'Arquivado' : 'Disponível';
    }
}

echo json_encode($dados);
