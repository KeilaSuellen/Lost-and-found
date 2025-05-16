<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <img src="img/logo.png" alt="Logo" width="90" height="90">
            <header>Login</header>
        </div>

        <?php if (isset($erro)): ?>
            <p style="color:red;"><?php echo $erro; ?></p>
        <?php endif; ?>
    
        <form action="login.php" method="post">
            <div class="input-box">
                <input type="text" name="usuario" class="input-field" placeholder="Nome de Usuario" autocomplete="off" required>
                <input type="password" name="senha" class="input-field" placeholder="Senha" autocomplete="off" required>
            </div>

            <div class="forgot">
                <section>
                    <a href="#">Esqueceu a senha?</a>
                </section>
            </div>
            <button type="submit" class="submit-btn">Entrar</button>
        </form>
    </div>
</div>
