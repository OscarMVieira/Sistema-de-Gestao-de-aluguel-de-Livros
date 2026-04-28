<?php 
session_start();
require_once '../basedados/basedados.h'; 
include '../templates/headerSemSidebar.php'; 

$hoje = date('Y-m-d');
$dataLimite = date('Y-m-d', strtotime('+30 days'));
$carrinho = $_SESSION['carrinho'] ?? [];

// Lógica para determinar o destino do botão Voltar com base no tipo de conta
$tipo_conta = $_SESSION['tipoContaId'] ?? 3; // Assume cliente por defeito
$url_voltar = ($tipo_conta == 1) ? "../admin/paginaCatalogo.php" : "paginaCatalogo.php";
?>

<link rel="stylesheet" href="../../public/css/paginaCarrinho.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="cart-container">
    <h1 class="mainTitle">Carrinho</h1>

    <?php if (empty($carrinho)): ?>
        <div style="text-align:center; padding: 50px; background: white; border-radius: 8px; border: 1px solid #a5c0d6;">
            <p style="font-size: 1.2rem; color: #666;">O carrinho está vazio no momento.</p>
            <br>
            <a href="<?php echo $url_voltar; ?>" class="btnVoltarLargo" style="text-decoration:none;">
                VOLTAR AO CATÁLOGO
            </a>
        </div>
    <?php else: ?>
        <form action="confirmarRequisicao.php" method="POST" class="gridLayout" id="formRequisicao">
            
            <section class="cartSection">
                <h2>Carrinho de Requisições</h2>
                <?php 
                foreach ($carrinho as $id => $qtd): 
                    $sql = "SELECT * FROM livros WHERE ID_Livro = $id";
                    $res = $conn->query($sql);
                    $livro = $res->fetch_assoc();
                ?>
                    <div class="bookCard">
                        <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa">
                        
                        <div class="bookInfo">
                            <h3><?php echo htmlspecialchars($livro['Titulo_Livro']); ?></h3>
                            <p class="author"><?php echo htmlspecialchars($livro['Autor_Livro']); ?></p>
                            <div class="quantityControl">
                                 <a href="logicaCarrinho.php?id=<?php echo $id; ?>&acao=sub"> - </a>
                                 <span><?php echo $qtd; ?> Unid.</span>
                                 <a href="logicaCarrinho.php?id=<?php echo $id; ?>&acao=add"> + </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>

            <section class="dateSection">
                <h2>Duração da Requisição</h2>
                <div class="calendarCard">
                    <p style="margin-bottom: 15px;">Data de Devolução (Máx 30 dias):</p>
                    <input type="date" name="data_devolucao" 
                           min="<?php echo $hoje; ?>" 
                           max="<?php echo $dataLimite; ?>" 
                           required 
                           style="width:100%; padding:10px; border: 1px solid #a5c0d6; border-radius: 4px; margin-bottom: 20px;">
                    
                    <button type="submit" class="confirmBtn">CONFIRMAR REQUISIÇÃO</button>
                </div>
            </section>
        </form> 

        <div class="containerBotao">
            <a href="<?php echo $url_voltar; ?>" class="btnVoltarLargo">Voltar</a>
        </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('formRequisicao')?.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Confirmar Pedido?',
        text: "Deseja finalizar a requisição dos livros selecionados?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#004080',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, confirmar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'A processar...',
                text: 'Por favor, aguarde um momento.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
            this.submit();
        }
    });
});
</script>

<?php include '../templates/footer.php'; ?>