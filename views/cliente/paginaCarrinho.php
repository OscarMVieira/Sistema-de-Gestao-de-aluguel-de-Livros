<?php 
session_start();
require_once '../basedados/basedados.h'; //
include '../templates/headerSemSidebar.php'; 

$hoje = date('Y-m-d');
$dataLimite = date('Y-m-d', strtotime('+30 days'));
$carrinho = $_SESSION['carrinho'] ?? [];
?>

<link rel="stylesheet" href="../../public/css/paginaCarrinho.css">

<div class="cart-container">
    <h1 class="mainTitle">Carrinho</h1>

    <form action="confirmarRequisicao.php" method="POST" class="gridLayout">
        
        <section class="cartSection">
            <h2>Carrinho de Requisições</h2>
            <?php 
            if (empty($carrinho)): 
                echo "<p>O seu carrinho está vazio.</p>";
            else:
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
            <?php endforeach; endif; ?>
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
</div>

<?php include '../templates/footer.php'; ?>