  <header>
  <nav id="navbar">
    <img src="img/logo2.png" id="logo" width="110" />
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>

    <ul id="nav-list">
      <li class="nav-item"><a href="index.php">Menu Principal</a></li>
      <li class="nav-item"><a href="registroobj.php"  class="active">Cadastro de Objetos</a></li>
      <li class="nav-item"><a href="devolucao.php">Devolução de Objetos</a></li>
      <li class="nav-item"><a href="relatorio.html">Relatório</a></li>
      <li class="nav-item"><a href="status.html">Status</a></li>
      <li class="nav-item"><a href="#">Gerenciamento de Usuário</a></li>
      <li class="nav-item"><a href="logout.php" class="split">Sair</a></li>
    </ul>  
  </nav>
</header>
  
<h1 class="form-title">Cadastro de Objetos</h1>
<p class="form-subtitle">Preencha os campos abaixo para cadastrar um novo objeto encontrado.</p>

<?php if (!empty($msg_sucesso)): ?>
  <div class="alert">
    <?= $msg_sucesso ?>
    <?php if (!empty($link_objeto)): ?>
      <a href="<?= $link_objeto ?>" style="display:inline-block; margin-left:10px;">Ver objeto</a>
    <?php endif; ?>
  </div>
<?php endif; ?>

<form action="salvar_objeto.php" method="POST" enctype="multipart/form-data">
  <label for="id_objeto">ID do Objeto:</label>
  <input type="text" id="id_objeto" name="id_objeto" value="<?= $id_objeto ?>" readonly />

  <label for="nome_objeto">Nome do Objeto:</label>
  <input type="text" id="nome_objeto" name="nome_objeto" required />

  <label for="foto">Foto do Objeto:</label>
  <input type="file" id="foto" name="foto" accept="image/*" required />

  <label for="descricao">Descrição:</label>
  <textarea id="descricao" name="descricao" required></textarea>

  <label for="categoria">Categoria:</label>
  <select id="categoria" name="categoria">
    <option value="eletronicos">Eletrônicos</option>
    <option value="roupas">Roupas</option>
    <option value="livros">Livros</option>
    <option value="ferramentas">Ferramentas</option>
    <option value="outros">Outros</option>
  </select>

  <div class="form-row">
    <div class="form-group">
      <label for="quem_encontrou">Quem Encontrou:</label>
      <input type="text" id="quem_encontrou" name="quem_encontrou" required />
    </div>

    <div class="form-group">
      <label for="empresa">Empresa:</label>
      <input type="text" id="empresa" name="empresa" required />
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="local_encontrado">Local onde foi encontrado:</label>
      <input type="text" id="local_encontrado" name="local_encontrado" required />
    </div>

    <div class="form-group">
      <label for="data_cadastro">Data do Cadastro:</label>
      <input type="date" id="data_cadastro" name="data_cadastro" required />
    </div>
  </div>

  <div class="form-footer">
    <button type="submit">Cadastrar</button>
  </div>
</form>
