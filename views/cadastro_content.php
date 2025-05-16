
<?php if (isset($erro)): ?>
  <div style="color:red; text-align:center;"><?php echo $erro; ?></div>
<?php endif; ?>
  
    <div class="login-container">
      <div class="login-box">
        <div class="login-header">
          <img src="img/logo.png" alt="Logo" width="90" height="90" />
          <header>Novo Cadastro</header>
        </div>

        <form action="cadastro.php" method="POST">
        <div class="input-box">
          <input
            type="text"
            name="usuario"
            class="input-field"
            placeholder="Usuário"
            required
          />
          <input
            type="password"
            name="senha"
            class="input-field"
            placeholder="Senha"
            autocomplete="off"
            required
          />
          <input
            type="password"
            name="confirmarSenha"
            class="input-field"
            placeholder="Confirmar senha"
            required
          />
        </div>

        <div class="form-group">
          <select id="nivel" name="nivel" required>
            <option value="">Nivel de acesso</option>
            <option value="usuario">Usuário</option>
            <option value="administrador">Administrador</option>
          </select>
        </div>

        <button type="submit" class="submit-btn">Cadastrar Usuário</button>
        </form>
      </div>
    </div>