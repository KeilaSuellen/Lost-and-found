<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

try {
    require 'includes/bd.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Coleta os dados
    $id_objeto = $_POST['id_objeto'] ?? '';
    $retirado_por = $_POST['retirado_por'] ?? '';
    $documento = $_POST['documento'] ?? '';
    $empresa = $_POST['empresa'] ?? '';
    $data_devolucao = $_POST['data_devolucao'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    $registrado_por = $_SESSION['usuario_id'] ?? null;

    // Validação básica
    if (!$id_objeto || !$retirado_por || !$documento || !$empresa || !$data_devolucao) {
        $_SESSION['erro'] = "Preencha todos os campos obrigatórios.";
        header("Location: devolucao.php");
        exit();
    }

    // Verifica se o objeto existe
    $check = $pdo->prepare("SELECT status FROM objetos WHERE id_objeto = ?");
    $check->execute([$id_objeto]);
    $obj = $check->fetch(PDO::FETCH_ASSOC);

    if (!$obj) {
        $_SESSION['erro'] = "ID do objeto não encontrado.";
        header("Location: devolucao.php");
        exit();
    }

    if ($obj['status'] === 'Devolvido') {
        $_SESSION['erro'] = "Este objeto já foi devolvido.";
        header("Location: devolucao.php");
        exit();
    }

    // Inserção na tabela de devoluções
    $stmt = $pdo->prepare("INSERT INTO devolucoes (id_objeto, retirado_por, documento, empresa, data_devolucao, observacoes, registrado_por) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_objeto, $retirado_por, $documento, $empresa, $data_devolucao, $observacoes, $registrado_por]);

    // Atualiza status do objeto
    $update = $pdo->prepare("UPDATE objetos SET status = 'Devolvido' WHERE id_objeto = ?");
    $update->execute([$id_objeto]);

    $_SESSION['msg_sucesso'] = "Devolução registrada com sucesso!";
    $_SESSION['id_devolvido'] = $id_objeto;
    header("Location: devolucao.php");
    exit();

} catch (PDOException $e) {
    $_SESSION['erro'] = "Erro no banco de dados: " . $e->getMessage();
    header("Location: devolucao.php");
    exit();
}
?>
