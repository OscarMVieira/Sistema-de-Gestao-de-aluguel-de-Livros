<?php 
session_start();
require_once '../basedados/basedados.h';

// Verifica se o utilizador está logado
if (!isset($_SESSION['email'])) {
    header("Location: paginaLogin.php");
    exit();
}

$email_sessao = $_SESSION['email']; 
$sql = "SELECT * FROM users WHERE email = '$email_sessao'";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

include '../templates/headerSemSidebar.php'; 

// Lógica dinâmica para o botão Voltar com base no ID
$tipo_conta = $_SESSION['tipoContaId'] ?? 3;
$url_voltar = ($tipo_conta == 1) ? "../admin/paginaCatalogo.php" : "../cliente/paginaCatalogo.php";
?>

<link rel="stylesheet" href="../../public/css/paginaPerfil.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Estilo para o aviso de password, semelhante ao do registo */
    #passwordFeedback {
        font-size: 0.85em;
        margin-top: 5px;
        display: none;
        color: #ff4d4d;
        text-align: left;
    }
</style>

<div class="perfil-container">
    <h1 class="perfil-title">Perfil</h1>

    <form action="processarPerfil.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; width: 100%;">
        <div class="perfil-main-card">
            <div class="perfil-grid">
                
                <div class="photo-section">
                    <h2 class="section-label">Foto de Perfil</h2>
                    <div class="photo-card">
                        <img src="../../public/img/<?php echo $user['foto']; ?>" alt="Perfil">
                        <input type="file" name="nova_foto" id="inputFoto" class="perfil-btn mudar-foto" 
                               style="width: 100%; margin-top:10px;" accept=".jpg,.jpeg,.png">
                    </div>
                    <button type="submit" class="perfil-btn confirmar-btn">Confirmar Alterações</button>
                </div>

                <div class="info-section">
                    <h2 class="section-label">Informação Principal</h2>
                    
                    <div class="field-group">
                        <div class="field-row">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <div class="field-row">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" readonly>
                        </div>
                        <div class="field-row">
                            <label for="nif">Nif:</label>
                            <input type="text" name="documento" id="nif" value="<?php echo htmlspecialchars($user['documento']); ?>" 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
                        
                        <div class="field-row" style="flex-wrap: wrap;">
                            <label for="password">Password:</label>
                            <div style="flex-grow: 1;">
                                <input type="password" name="password" id="password" placeholder="Nova password"
                                       pattern="(?=.*[A-Z])(?=.*\d).{1,}" 
                                       title="A password deve conter pelo menos uma letra maiúscula e um número.">
                                <div id="passwordFeedback">⚠️ Password fraca: deve incluir uma letra maiúscula e um número.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </form>

    <div class="containerBotao">
        <a href="<?php echo $url_voltar; ?>" class="btnVoltarLargo">Voltar</a>
    </div>
</div>

<script>
// 1. Validação de password em tempo real
const passwordInput = document.getElementById('password');
const feedback = document.getElementById('passwordFeedback');

passwordInput.addEventListener('input', function() {
    const val = this.value;
    const hasUpper = /[A-Z]/.test(val);
    const hasNumber = /[0-9]/.test(val);

    if (val.length > 0 && (!hasUpper || !hasNumber)) {
        feedback.style.display = 'block'; 
    } else {
        feedback.style.display = 'none';
    }
});

// 2. Validação de extensão da imagem
document.getElementById('inputFoto').addEventListener('change', function() {
    const ficheiro = this.files[0];
    const extensoesPermitidas = ['jpg', 'jpeg', 'png'];
    
    if (ficheiro) {
        const extensao = ficheiro.name.split('.').pop().toLowerCase();
        if (!extensoesPermitidas.includes(extensao)) {
            Swal.fire({
                icon: 'error',
                title: 'Formato Inválido',
                text: 'Apenas são permitidos formatos .jpg ou .png',
                confirmButtonColor: '#004080'
            });
            this.value = ''; 
        }
    }
});

// 3. Alertas de Sucesso ou Erro
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('sucesso') === '1') {
    Swal.fire({
        icon: 'success',
        title: 'Perfil Atualizado!',
        text: 'As tuas alterações foram guardadas com sucesso.',
        confirmButtonColor: '#004080'
    }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
    });
} else if (urlParams.get('erro') === 'formato_invalido') {
    Swal.fire({
        icon: 'error',
        title: 'Erro no Upload',
        text: 'O ficheiro enviado não tem um formato válido (.jpg ou .png).',
        confirmButtonColor: '#004080'
    });
}
</script>

<?php include '../templates/footer.php'; ?>