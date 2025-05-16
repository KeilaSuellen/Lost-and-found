<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
// Conexão com o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=lost_and_found', 'root', '');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/header.css" />
  <title>Menu Principal</title>
</head>
<body>

  <div class="header">
    <img src="img/logo.png" alt="Logo" width="90" height="90" />
    <h1>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
  </div>

  <div class="content">
    <div class="grid">

      <a href="registroobj.php" class="btn">
        <img src="img/cadastro.png" alt="Cadastro" />
        <p>Cadastro de Objetos</p>
      </a>

      <a href="devolucao.php" class="btn">
        <img src="img/devolucao.png" alt="Devolução" />
        <p>Devolução de Objetos</p>
      </a>

      <a href="relatorio.php" class="btn">
        <img src="img/relatorio.png" alt="Relatório" />
        <p>Relatório</p>
      </a>

      <a href="status.html" class="btn">
        <img src="img/status.png" alt="Status" />
        <p>Status</p>
      </a>

      <a href="gerenciamento.php" class="btn">
        <img src="img/gerenciamento.png" alt="Gerenciamento" />
        <p>Gerenciamento de Usuário</p>
      </a>

    </div>
  </div>

  <a href="logout.php" class="exit-btn">Sair</a>

</body>
</html>
