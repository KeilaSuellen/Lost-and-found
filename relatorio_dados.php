<?php
require 'includes/bd.php';

header('Content-Type: application/json');

try {
    $sql = "
            SELECT 
            o.id_objeto,
            o.nome_objeto,
            o.categoria,
            o.descricao,
            o.data_cadastro,
            d.data_devolucao,
            o.status,
            u.usuario AS operador,
            d.observacoes
        FROM objetos o
        LEFT JOIN usuarios u ON o.registrado_por = u.id
        LEFT JOIN devolucoes d ON o.id_objeto = d.id_objeto
        ORDER BY CAST(SUBSTRING_INDEX(o.id_objeto, '/', 1) AS UNSIGNED) ASC
    ";

    $stmt = $pdo->query($sql);
    $objetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // estatisticas
    $total  = count($objetos);
    $disponivel = 0;
    $devolvido = 0;
    $arquivado = 0;
    
    foreach ($objetos as $objeto) {
        $status = strtolower($objeto['status']);
        if ($status === 'disponível') {
            $disponivel++;
        } elseif ($status === 'devolvido') {
            $devolvido++;
        } elseif ($status === 'arquivado') {
            $arquivado++;
        }
    }
    
    echo json_encode([
        'objetos' => $objetos,
        'estatisticas' => [
            'total' => $total,
            'disponivel' => $disponivel,
            'devolvido' => $devolvido,
            'arquivado' => $arquivado
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar dados: ' . $e->getMessage()]);
}

