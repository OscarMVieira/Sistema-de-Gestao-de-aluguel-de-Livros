<?php 
session_start();
require_once '../basedados/basedados.h'; 

// Capturar o ID do utilizador que vem do link da outra pagina
$id_cliente = $_GET['id'] ?? 0;

// Procurar os dados do utilizador na BD
$sql = "SELECT * FROM users WHERE id = $id_cliente";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

include '../templates/headerSemSidebar.php'; 
?>

<link rel="stylesheet" href="../../public/css/paginaDetalhesCliente.css">

<div class="detalhesWrapper">
    <h1 class="detalhesTitle">Detalhes: <?php echo htmlspecialchars($user['username']); ?></h1>

    <div class="detalhesCard">
        <h2 class="cardSubtitle">Informação Principal</h2>
        
        <div class="infoContainer">
            <div class="fieldRow">
                <div class="labelBox">Id do Cliente:</div>
                <input type="text" value="#<?php echo $user['id']; ?>" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">Nome Completo:</div>
                <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">Email:</div>
                <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">NIF:</div>
                <input type="text" value="<?php echo htmlspecialchars($user['documento']); ?>" readonly>
            </div>

            <div class="buttonContainer">
                <a href="gerirClientes.php" class="btnVoltar-link">
                    <button class="btnVoltar">Voltar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>