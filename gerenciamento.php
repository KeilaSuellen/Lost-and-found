<?php
require 'includes/bd.php'; // Certifique-se que o caminho está correto para sua conexão PDO
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Consulta os usuários no banco
$stmt = $pdo->query("SELECT id, usuario, nivel FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>Gerenciamento</title>
</head>

<body>
    <header>
        <nav id="navbar">
            <img src="img/logo2.png" id="logo" width="110" />
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>

            <ul id="nav-list">
                <li class="nav-item"><a href="index.php">Menu Principal</a></li>
                <li class="nav-item"><a href="registroobj.php">Cadastro de Objetos</a></li>
                <li class="nav-item"><a href="devolucao.php">Devolução de Objetos</a></li>
                <li class="nav-item"><a href="relatorio.html">Relatório</a></li>
                <li class="nav-item"><a href="status.html">Status</a></li>
                <li class="nav-item"><a href="gerenciamento.php" class="active">Gerenciamento de Usuário</a></li>
                <li class="nav-item"><a href="logout.php" class="split">Sair</a></li>
            </ul>
        </nav>
    </header>

    <h1>Listagem de usuários</h1>
    <?php if ($_SESSION['usuario'] === 'administrador'): ?>
        <button onclick="window.location.href='cadastro.php'">Adicionar novo usuário</button>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Permissão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nivel']); ?></td>
                    <td>
                        <?php if ($_SESSION['nivel'] === 'administrador'): ?>
                            <button class="botao-retirar" onclick="confirmarAcao('cadastro.php?id=<?= $usuario['id'] ?>')">Editar</button>
                            <button class="botao-retirar botao-excluir" data-id="<?= $usuario['id'] ?>" data-nome="<?= htmlspecialchars($usuario['usuario']) ?>">
                                Excluir
                            </button>
                            <script>
                                function confirmarAcao(url) {
                                    if (confirm("Você tem certeza que deseja continuar?")) {
                                        window.location.href = url;
                                    }
                                }
                            </script>
                        <?php else: ?>
                            <span style="color: gray;">Somente leitura</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="modal-excluir" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Tem certeza que deseja excluir o usuário <strong id="nome-usuario"></strong>?</p>
            <form method="POST" action="excluir_usuario.php">
                <input type="hidden" name="id" id="id-usuario">
                <button type="submit">Sim, excluir</button>
                <button type="button" onclick="fecharModal()">Cancelar</button>
            </form>
        </div>
    </div>
</body>

</html>