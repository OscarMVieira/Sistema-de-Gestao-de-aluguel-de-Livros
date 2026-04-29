<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../templates/header.php'; 
require_once '../basedados/basedados.h';

$sql = "SELECT * FROM users WHERE tipoContaId = 3"; 
$resultado = $conn->query($sql);
?>

<link rel="stylesheet" href="../../public/css/gerirClientes.css">

<div class="clientesPageContainer">
    <h1 class="pageMainTitle">Clientes no Sistema</h1>

    <div class="searchBoxContainer">
        <input type="text" id="inputBuscaCliente" placeholder="Pesquisar por nome ou e-mail..." onkeyup="filtrarClientes()">
        <i class="fa-solid fa-magnifying-glass searchIcon"></i>
    </div>

    <div class="clientesCard">
        <div class="cardHeader">
            <h2>Clientes Registados</h2>
        </div>
        
        <div class="cardBody" id="listaClientes">
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                while($cliente = $resultado->fetch_assoc()) { 
            ?>
                <div class="clienteRow" 
                     data-nome="<?php echo strtolower(htmlspecialchars($cliente['username'])); ?>" 
                     data-email="<?php echo strtolower(htmlspecialchars($cliente['email'])); ?>">
                    
                    <div class="infoCliente">
                        <span class="clienteNome">Nome: <?php echo htmlspecialchars($cliente['username']); ?></span>
                        <small style="display:block; color:#666;"><?php echo htmlspecialchars($cliente['email']); ?></small>
                    </div>
                    
                    <div class="clienteActions">
                        <a href="paginaVerHistorico.php?id=<?php echo $cliente['id']; ?>" class="actionBtn">Ver Histórico</a>
                        <a href="paginaDetalhesCliente.php?id=<?php echo $cliente['id']; ?>" class="actionBtn">Ver Detalhes</a>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo "<p style='text-align:center; padding: 20px;'>Não foram encontrados clientes no sistema.</p>";
            }
            ?>
        </div>
    </div>

    <div class="containerBotao">
        <a href="paginaCatalogo.php" class="btnVoltarLargo">Voltar</a>
    </div>
</div>

<script>
function filtrarClientes() {
    const input = document.getElementById('inputBuscaCliente');
    const filtro = input.value.toLowerCase();
    const rows = document.querySelectorAll('.clienteRow');

    rows.forEach(row => {
        const nome = row.getAttribute('data-nome');
        const email = row.getAttribute('data-email');

        if (nome.includes(filtro) || email.includes(filtro)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>

<?php include '../templates/footer.php'; ?>