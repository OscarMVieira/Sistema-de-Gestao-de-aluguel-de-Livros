<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital - Registo</title>
    <link rel="stylesheet" href="../../public/css/autenticacao.css">
    <link rel="stylesheet" href="../../public/css/footerAutenticacao.css">
    <style>
        #passwordFeedback {
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">BIBLIOTECA DIGITAL</div>
    </header>

    <div class="formContainer">
        <h2>Novo Registo</h2>
        <form action="processarRegisto.php" method="POST">
            <div class="inputGroup">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="inputGroup">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="inputGroup">
                <label>Password</label>
                <!--garante pelo menos uma maiúscula e um número no browser -->
                <input type="password" name="password" id="password" placeholder="Password" required 
                       pattern="(?=.*[A-Z])(?=.*\d).{1,}" 
                       title="A password deve conter pelo menos uma letra maiúscula e um número.">
                <div id="passwordFeedback" style="color: #ff4d4d;">⚠️ Password fraca: deve incluir uma letra maiúscula e um número.</div>
            </div>
            <div class="inputGroup">
                <label>CC/NIF</label>
                <input type="text" name="documento" placeholder="CC/NIF" required>
            </div>  

            <button type="submit" class="btn btnPrimary">Criar Conta</button>
        </form>

        <div class="linkFooter">
            Já tens conta? <a href="paginaLogin.php">Login</a>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const feedback = document.getElementById('passwordFeedback');

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            // Verifica se tem pelo menos uma maiúscula e um número
            const hasUpper = /[A-Z]/.test(val);
            const hasNumber = /[0-9]/.test(val);

            if (val.length > 0 && (!hasUpper || !hasNumber)) {
                feedback.style.display = 'block'; // Feedback de password fraca
            } else {
                feedback.style.display = 'none';
            }
        });
    </script>

    <footer class="autenticacaoFooter">
        <div class="footerDivider"></div>
        <div class="footerLinks">
            <a href="#">Condições de Uso</a>
            <a href="#">Aviso de Privacidade</a>
            <a href="#">Ajuda</a>
        </div>
        <div class="footerCopyright">
            © 1996-2026, Biblioteca Digital, Inc. ou suas afiliadas
        </div>
    </footer>
</body>
</html>