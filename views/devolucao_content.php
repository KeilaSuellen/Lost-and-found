  <header>
  <nav id="navbar">
    <img src="img/logo2.png" id="logo" width="110" />
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>

    <ul id="nav-list">
      <li class="nav-item"><a href="index.php">Menu Principal</a></li>
      <li class="nav-item"><a href="registroobj.php" >Cadastro de Objetos</a></li>
      <li class="nav-item"><a href="devolucao.php"  class="active">Devolução de Objetos</a></li>
      <li class="nav-item"><a href="relatorio.html">Relatório</a></li>
      <li class="nav-item"><a href="status.html">Status</a></li>
      <li class="nav-item"><a href="#">Gerenciamento de Usuário</a></li>
      <li class="nav-item"><a href="logout.php" class="split">Sair</a></li>
    </ul>  
  </nav>
</header>

<?php if (!empty($_SESSION['msg_sucesso'])): ?>
    <div class="mensagem-sucesso">
        <?= $_SESSION['msg_sucesso']; unset($_SESSION['msg_sucesso']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['erro'])): ?>
    <div class="mensagem-erro">
        <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
    </div>
<?php endif; ?>


<h1 class="form-title" >Devolução de Objetos</h1>
<p class="form-subtitle">Preencha os campos abaixo para registrar a devolução de um objeto.</p>
<p class="form-subtitle">Certifique-se de que todas as informações estão corretas.</p>

  <button type="button" class="botao-imprimir" onclick="imprimirComprovante()">Imprimir Comprovante</button>

<form action="salvar_devolucao.php" method="POST">
    <label for="id_objeto">ID do Objeto:</label>
    <input type="text" id="id_objeto" name="id_objeto" required />

    <label for="retirado_por">Nome de quem retirou:</label>
    <input type="text" id="retirado_por" name="retirado_por" required />
    
    <label for="documento">Documento:</label>
    <input type="text" id="documento" name="documento" required />
    
    <label for="empresa">Empresa:</label>
    <input type="text" id="empresa" name="empresa" required />
    
    <label for="data_devolucao">Data da Devolução:</label>
    <input type="date" id="data_devolucao" name="data_devolucao" required />    

    <label for="observacoes">Observações (opcional):</label>
    <textarea id="observacoes" name="observacoes"></textarea>

    <div class="form-footer">
        <button type="submit">Registrar Devolução</button>
    </div>
</form>

  </script>