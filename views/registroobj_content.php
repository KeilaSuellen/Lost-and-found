   <header>
     <nav id="navbar">
       <img src="img/logo2.png" id="logo" width="110" />
       <button class="menu-toggle" onclick="toggleMenu()">☰</button>
       <?php if (!$modoEdicao): ?>
       <ul id="nav-list">
         <li class="nav-item"><a href="index.php">Menu Principal</a></li>
         <li class="nav-item"><a href="registroobj.php" class="active">Cadastro de Objetos</a></li>
         <li class="nav-item"><a href="devolucao.php">Devolução de Objetos</a></li>
         <li class="nav-item"><a href="relatorio.html">Relatório</a></li>
         <li class="nav-item"><a href="status.html">Status</a></li>
         <li class="nav-item"><a href="gerenciamento.php">Gerenciamento de Usuário</a></li>
         <li class="nav-item"><a href="logout.php" class="split">Sair</a></li>
       </ul>
        <?php endif; ?>
     </nav>
   </header>


 <div class="form-wrapper">

   <h1 class="form-title"><?= $modoEdicao ? 'Editar Formulario' : 'Cadastro de Objeto Encontrado' ?></h1>
   <p class="form-subtitle">
     <?= $modoEdicao
        ? 'Apenas os campos <strong>Nome</strong>, <strong>Descrição</strong>, <strong>Categoria</strong> e <strong>Foto</strong> podem ser editados.'
        : 'Preencha os campos abaixo para cadastrar um novo objeto encontrado.' ?>
   </p>

   <?php if (!empty($msg_sucesso)): ?>
     <div class="alert">
       <?= $msg_sucesso ?>
       <?php if (!empty($link_objeto)): ?>
         <a href="<?= $link_objeto ?>" style="display:inline-block; margin-left:10px;">Ver objeto</a>
       <?php endif; ?>
     </div>
   <?php endif; ?>

   <?php if (!$modoEdicao): ?>
     <div class="top-buttons">
       <a href="painel_objetos.php" class="botao-form">🔎 Ver Registros</a>
     </div>
   <?php endif; ?>

   <form action="<?= $modoEdicao ? 'atualizar_objeto.php' : 'salvar_objeto.php' ?>" method="POST" enctype="multipart/form-data">
     <label for="id_objeto">ID do Objeto:</label>
     <input type="text" id="id_objeto" name="id_objeto" value="<?= $id_objeto ?>"
       <?= $modoEdicao ? 'readonly' : '' ?> />

     <label for="nome_objeto">Nome do Objeto:</label>
     <input type="text" id="nome_objeto" name="nome_objeto" required
       value="<?= $modoEdicao ? htmlspecialchars($objeto['nome_objeto']) : '' ?>" />

     <label for="foto">Foto do Objeto:</label>
     <input type="file" id="foto" name="foto" accept="image/*" />

     <label for="descricao">Descrição:</label>
     <textarea id="descricao" name="descricao" required><?= $modoEdicao ? htmlspecialchars($objeto['descricao']) : '' ?></textarea>

     <label for="categoria">Categoria:</label>
     <select id="categoria" name="categoria">
       <option value="eletronicos" <?= $modoEdicao && $objeto['categoria'] == 'eletronicos' ? 'selected' : '' ?>>Eletrônicos</option>
       <option value="documentos" <?= $modoEdicao && $objeto['categoria'] == 'documentos' ? 'selected' : '' ?>>Documentos</option>
       <option value="roupas" <?= $modoEdicao && $objeto['categoria'] == 'roupas' ? 'selected' : '' ?>>Roupas e acessórios</option>
       <option value="chaves" <?= $modoEdicao && $objeto['categoria'] == 'chaves' ? 'selected' : '' ?>>Chaves</option>
       <option value="livros" <?= $modoEdicao && $objeto['categoria'] == 'livros' ? 'selected' : '' ?>>Livros e Papelaria</option>
       <option value="ferramentas" <?= $modoEdicao && $objeto['categoria'] == 'ferramentas' ? 'selected' : '' ?>>Ferramentas</option>
       <option value="calcados" <?= $modoEdicao && $objeto['categoria'] == 'calcados' ? 'selected' : '' ?>>Calçados</option>
       <option value="outros" <?= $modoEdicao && $objeto['categoria'] == 'outros' ? 'selected' : '' ?>>Outros</option>
     </select>


     <div class="form-row">
       <div class="form-group">
         <label for="quem_encontrou">Quem Encontrou:</label>
         <input type="text" id="quem_encontrou" name="quem_encontrou" required value="<?= $modoEdicao ? htmlspecialchars($objeto['quem_encontrou']) : '' ?>"
           <?= $modoEdicao ? 'readonly' : '' ?> />
       </div>

       <div class="form-group">
         <label for="empresa">Empresa:</label>
         <input type="text" id="empresa" name="empresa" required value="<?= $modoEdicao ? htmlspecialchars($objeto['empresa']) : '' ?>"
           <?= $modoEdicao ? 'readonly' : '' ?> />
       </div>
     </div>

     <div class="form-row">
       <div class="form-group">
         <label for="local_encontrado">Local onde foi encontrado:</label>
         <input type="text" id="local_encontrado" name="local_encontrado" required value="<?= $modoEdicao ? htmlspecialchars($objeto['local_encontrado']) : '' ?>"
           <?= $modoEdicao ? 'readonly' : '' ?> />
       </div>

       <div class="form-group">
         <label for="data_cadastro">Data do Cadastro:</label>
         <input type="date" id="data_cadastro" name="data_cadastro" required value="<?= $modoEdicao ? $objeto['data_cadastro'] : '' ?>"
           <?= $modoEdicao ? 'readonly' : '' ?> />
       </div>
     </div>

     <div class="form-footer">
       <button type="submit"><?= $modoEdicao ? 'Salvar Alterações' : 'Cadastrar' ?></button>
     </div>
   </form>
 </div>