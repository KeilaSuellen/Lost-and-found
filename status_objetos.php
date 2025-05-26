<?php
require 'includes/bd.php';

header('Content-Type: application/json');

$stmt = $pdo->query("
      SELECT 
        o.id_objeto,
        o.nome_objeto,
        o.categoria,
        o.descricao,
        o.data_cadastro,
        d.data_devolucao
    FROM objetos o
    LEFT JOIN devolucoes d ON o.id_objeto = d.id_objeto
    ORDER BY CAST(SUBSTRING_INDEX(o.id_objeto, '/', 1) AS UNSIGNED) ASC
");

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$hoje = new DateTime();

foreach ($dados as &$objeto) {
    $dataCadastro = new DateTime($objeto['data_cadastro']);

    $devolucao = $objeto['data_devolucao'];

    if (!is_null($devolucao) && $devolucao !== '0000-00-00' && $devolucao !== '') {
        $objeto['status'] = 'Devolvido';
    } else {
        $diff = $dataCadastro->diff($hoje);
        $meses = ($diff->y * 12) + $diff->m;

        $objeto['status'] = $meses >= 3 ? 'Arquivado' : 'Disponível';
    }

}
echo json_encode($dados);
