<?php if (isset($erro)): ?>
  <div style="color:red; text-align:center;"><?php echo $erro; ?></div>
<?php endif; ?>
  
    <div class="login-container">
      <div class="login-box">
        <div class="login-header">
          <img src="img/logo2.png" alt="Logo" width="90" height="90" />
          <h1 id="title"><?= $titulo ?></h1>
        </div>

        <form action="cadastro.php<?= $modoEdicao ? '?id=' . $id : '' ?>" method="POST">
          <?php if ($modoEdicao): ?>
            <input type="hidden" name="id" value="<?= $usuarioExistente['id'] ?>">
        <?php endif; ?>
        <div class="input-box">
          <input
            type="text"
            name="usuario"
            class="input-field"
            placeholder="Usuário"
            required
            value="<?= $modoEdicao ? htmlspecialchars($usuarioExistente['usuario']) : '' ?>"
          />
          <input
            type="password"
            name="senha"
            class="input-field"
            placeholder="Senha"
            autocomplete="off"
            required
            <?= $modoEdicao ? htmlspecialchars($usuarioExistente['senha']) : '' ?>
          />
          <input
            type="password"
            name="confirmarSenha"
            class="input-field"
            placeholder="Confirmar senha"
            required
            <?= $modoEdicao ? htmlspecialchars($usuarioExistente['senha']) : '' ?>
          />
        </div>

        <div class="form-group">
          <select id="nivel" name="nivel" required>
            <option value="">Nivel de acesso</option>
            <option value="usuario"<?=($modoEdicao && $usuarioExistente['nivel'] == 'usuario') ? 'selected' : '' ?>>Usuário</option>
            <option value="administrador" <?=($modoEdicao && $usuarioExistente['nivel'] == 'administrador') ? 'selected' : '' ?>>Administrador</option>
          </select>
        </div>

        <button type="submit" class="submit-btn"><?= $modoEdicao ? 'Salvar Alterações' : 'Cadastrar' ?></button>
        </form>
      </div>
    </div>
    