<?php 
include '../templates/header.php'; 
require_once '../basedados/basedados.h';

$sql = "SELECT * FROM users WHERE tipoContaId = 3"; 
$resultado = $conn->query($sql);
?>

<link rel="stylesheet" href="../../public/css/gerirClientes.css">

<div class="clientesPageContainer">
    <h1 class="pageMainTitle">Clientes no Sistema</h1>

    <div class="clientesCard">
        <div class="cardHeader">
            <h2>Clientes no Sistema</h2>
        </div>
        
        <div class="cardBody">
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                
                while($cliente = $resultado->fetch_assoc()) { 
            ?>
                <div class="clienteRow">
                    <span class="clienteNome">Nome: <?php echo htmlspecialchars($cliente['username']); ?></span>
                    
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

<?php include '../templates/footer.php'; ?>