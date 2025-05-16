<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Mensagem de sucesso
$msg_sucesso = '';
$link_objeto = '';
if (isset($_SESSION['msg_sucesso'])) {
    $msg_sucesso = $_SESSION['msg_sucesso'];

    if (isset($_SESSION['id_novo_objeto'])) {
        $id_novo = $_SESSION['id_novo_objeto'];
        $link_objeto = "detalhes_objeto.php?id=$id_novo";
    }

    unset($_SESSION['msg_sucesso'], $_SESSION['id_novo_objeto']);
}

// Geração de novo ID
$pdo = new PDO('mysql:host=localhost;dbname=lost_and_found', 'root', '');
$ano = date('Y');
$ultimo_id = $pdo->query("SELECT MAX(id_objeto) as max_id FROM objetos WHERE id_objeto LIKE '%/$ano'")
                 ->fetch(PDO::FETCH_ASSOC)['max_id'];

$num = $ultimo_id ? intval(explode('/', $ultimo_id)[0]) + 1 : 1;
$id_objeto = $num . '/' . $ano;
// Título da página
$titulo = "Cadastro de Objetos";
?>

<?php include 'includes/header.php'; ?>
<?php include 'views/registroobj_content.php'; ?>
<?php include 'includes/script.php'; ?>