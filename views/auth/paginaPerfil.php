<?php 
session_start();

require_once '../basedados/basedados.h';// Liga à BD

$email_sessao = $_SESSION['email']; 
$sql = "SELECT * FROM users WHERE email = '$email_sessao'";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

include '../templates/headerSemSidebar.php'; 
?>

<link rel="stylesheet" href="../../public/css/paginaPerfil.css">

<div class="perfil-container">
    <h1 class="perfil-title">Perfil</h1>

    <form action="processarPerfil.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; width: 100%;">
        <div class="perfil-main-card">
            <div class="perfil-grid">
                
                <div class="photo-section">
                    <h2 class="section-label">Foto de Perfil</h2>
                    <div class="photo-card">
                        <img src="../../public/img/<?php echo $user['foto']; ?>" alt="Perfil">
                        <input type="file" name="nova_foto" class="perfil-btn mudar-foto" style="width: 100%; margin-top:10px;">
                    </div>
                    <button type="submit" class="perfil-btn confirmar-btn">Confirmar Alterações</button>
                </div>

                <div class="info-section">
                    <h2 class="section-label">Informação Principal</h2>
                    
                    <div class="field-group">
                        <div class="field-row">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo $user['username']; ?>">
                        </div>

                        <div class="field-row">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" readonly>
                        </div>

                        <div class="field-row">
                            <label for="nif">Nif:</label>
                            <input type="text" name="documento" id="nif" value="<?php echo $user['documento']; ?>">
                        </div>

                        <div class="field-row">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Nova password">
                        </div>
                    </div>
                </div>

            </div> 
        </div> 
    </form>

    <div class="containerBotao">
        <a href="../admin/paginaCatalogo.php" class="btnVoltarLargo">Voltar</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>