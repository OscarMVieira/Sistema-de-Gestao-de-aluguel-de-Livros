<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital - Login</title>
    <link rel="stylesheet" href="../../public/css/autenticacao.css">
    <link rel="stylesheet" href="../../public/css/footerAutenticacao.css">
</head>
<body>
    <header>
        <div class="logo">BIBLIOTECA DIGITAL</div>
    </header>

    <div class="form-container">
        <h2>Login</h2>
        
        

    

        <form action="processar_login.php" method="POST">
            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="link-footer">
            Ainda não tens conta? <a href="paginaRegisto.php">Registo</a>
        </div>
    </div>

    <footer class="auth-footer">
    <div class="footer-divider"></div>
    <div class="footer-links">
        <a href="#">Condições de Uso</a>
        <a href="#">Aviso de Privacidade</a>
        <a href="#">Ajuda</a>
    </div>
    <div class="footer-copyright">
        © 1996-2026, Biblioteca Digital, Inc. ou suas afiliadas
    </div>
</footer>
</body>
</html>