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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css" />
  <title>Menu Principal</title>
</head>
<body>

  <div class="header">
  <div class="logo-area">
    <img id="logo" src="img/logo2.png" alt="Logo" />
    <span class="site-name">Achados & Perdidos</span>    
  </div>
  </div>

  <h1 id="title">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

  <div class="content">
    <div class="grid">

      <a href="registroobj.php" class="btn-menu">
        <img src="img/box.svg" alt="Cadastro" />
        <p>Cadastro de Objetos</p>
      </a>

      <a href="devolucao.php" class="btn-menu">
        <img src="img/undo.svg" alt="Devolução" />
        <p>Devolução de Objetos</p>
      </a>

      <a href="relatorio.html" class="btn-menu">
        <img src="img/file.svg" alt="Relatório" />
        <p>Relatório</p>
      </a>

      <a href="status.html" class="btn-menu">
        <img src="img/chart.svg" alt="Status" />
        <p>Status</p>
      </a>

      <a href="gerenciamento.php" class="btn-menu">
        <img src="img/user-cog.svg" alt="Gerenciamento" />
        <p>Gerenciamento de Usuário</p>
      </a>

    </div>
  </div>

  <a href="logout.php" class="exit-btn">Sair</a>

</body>
</html>