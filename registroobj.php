<?php
require 'includes/bd.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$modoEdicao = false;
$objeto = null;
$id_objeto = '';

if(isset($_GET['id'])) {
    $modoEdicao = true;
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM objetos WHERE id_objeto = ?");
    $stmt->execute([$id]);
    $objeto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$objeto) {
        header('Location: painel_objetos.php');
        exit();
    }
        $id_objeto = $objeto['id_objeto'];
}

// Mensagem de sucesso
$msg_sucesso = '';
if (isset($_SESSION['msg_sucesso'])) {
    $msg_sucesso = $_SESSION['msg_sucesso'];

    if (isset($_SESSION['id_novo_objeto'])) {
        $id_novo = $_SESSION['id_novo_objeto'];
    }

    unset($_SESSION['msg_sucesso'], $_SESSION['id_novo_objeto']);
}

// Geração de novo ID
$ano = date('Y');
$ultimo_id = $pdo->query("SELECT MAX(id_objeto) as max_id FROM objetos WHERE id_objeto LIKE '%/$ano'")
                 ->fetch(PDO::FETCH_ASSOC)['max_id'];

$num = $ultimo_id ? intval(explode('/', $ultimo_id)[0]) + 1 : 1;
$id_objeto = $num . '/' . $ano;

$titulo = $modoEdicao ? "Editar Objeto" : "Cadastro de Objetos";
?>

<?php include 'includes/header.php'; ?>
<?php include 'views/registroobj_content.php'; ?>
<?php include 'includes/script.php'; ?>