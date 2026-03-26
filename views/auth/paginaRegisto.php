<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital - Registo</title>
    <link rel="stylesheet" href="../../public/css/autenticacao.css">
    <link rel="stylesheet" href="../../public/css/footerAutenticacao.css">

</head>
<body>
    <header>
        <div class="logo">BIBLIOTECA DIGITAL</div>
    </header>

    <div class="form-container">
        <h2>Novo Registo</h2>
        <form action="processar_registo.php" method="POST">
            <div class="input-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" placeholder="Nome Completo" required>
            </div>
            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <label>CC/NIF</label>
                <input type="text" name="documento" placeholder="CC/NIF" required>
            </div>  

            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>

        <div class="link-footer">
            Já tens conta? <a href="paginaLogin.php">Login</a>
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