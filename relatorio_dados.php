<?php
require 'includes/bd.php';

header('Content-Type: application/json');


try{
    $stmt = $pdo->query("SELECT id_objeto, nome_objeto, tipo_objeto, descricao_objeto, data_cadastro, data_devolucao, status_objeto, operador, observacoes FROM objetos");
    $objetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($objetos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar dados: ' . $e->getMessage()]);
}
?>