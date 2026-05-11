<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital - Registo</title>
    <link rel="stylesheet" href="../../public/css/autenticacao.css">
    <link rel="stylesheet" href="../../public/css/footerAutenticacao.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <div class="logo">BIBLIOTECA DIGITAL</div>
    </header>

    <div class="formContainer">
        <h2>Criar Conta</h2>
        
        <form action="processarRegisto.php" method="POST">
            <div class="inputGroup">
                <label>Nome Completo</label>
                <input type="text" name="nome" placeholder="Seu nome" required>
            </div>
            <div class="inputGroup">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="inputGroup">
                <label>CC / NIF</label>
                <input type="text" name="documento" placeholder="Seu documento" required>
            </div>
            <div class="inputGroup">
                <label>Password</label>
                <input type="password" name="password" placeholder="Sua password" required>
            </div>

            <button type="submit" name="btn_registar" class="btn btnPrimary">Registar</button>
        </form>

        <div class="linkFooter">
            Já tens conta? <a href="paginaLogin.php">Fazer Login</a>
        </div>
    </div>

    <script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucesso') {
        Swal.fire({ icon: 'success', title: 'Sucesso!', text: 'Registo concluído!', confirmButtonColor: '#1a73e8' })
            .then(() => { window.location.href = 'paginaLogin.php'; });
    } else if (status === 'erro_pass') {
        Swal.fire({ icon: 'error', title: 'Password Fraca', text: 'Usa uma letra maiúscula e um número.', confirmButtonColor: '#d33' });
    } else if (status === 'email_duplicado') {
       
        Swal.fire({ 
            icon: 'warning', 
            title: 'E-mail em uso', 
            text: 'Este endereço de e-mail já está registado. Tenta fazer login ou usa outro e-mail.', 
            confirmButtonColor: '#f39c12' 
        });
    } else if (status === 'erro_db') {
        Swal.fire({ icon: 'error', title: 'Erro', text: 'Ocorreu um erro no servidor.', confirmButtonColor: '#d33' });
    }
    </script>
</body>
</html>