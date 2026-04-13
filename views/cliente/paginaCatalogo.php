<?php 

session_start(); 

include '../templates/headerCliente.php'; 
require_once '../basedados/basedados.h'; 


$sql = "SELECT * FROM livros ORDER BY ID_Livro DESC"; 
$resultado = $conn->query($sql);
?>

<link rel="stylesheet" href="../../public/css/paginaCatalogo.css">

<div class="catalog-container">
    <h1 class="main-title">Catálogo de Livros</h1>

    <div class="catalog-filters">
        <input type="text" placeholder="Filtrar por género ou autor...">
        <select>
            <option value="">Todos os Géneros</option>
            <option value="ficcao">Ficção</option>
            <option value="romance">Romance</option>
            <option value="tecnico">Técnico</option>
        </select>
    </div>

    <div class="book-grid">
        <?php 

        if ($resultado->num_rows > 0) {
            

            while($livro = $resultado->fetch_assoc()) { 
                

                if ($livro['Disponibilidade'] == 1 && $livro['Quantidade'] > 0) {
                    $classeExtra = "";            
                    $textoStatus = "Disponível";
                    $estiloBotao = ""; 
                } else {
                    $classeExtra = "out";         
                    $textoStatus = "Indisponível";

                    $estiloBotao = "pointer-events: none; opacity: 0.5;"; 
                }
        ?>
            <div class="book-item">
                <div class="book-cover">
                    <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa do Livro">
                    <span class="tag <?php echo $classeExtra; ?>">
                        <?php echo $textoStatus; ?>
                    </span>
                </div>

                <div class="book-details">
                    <h3><?php echo htmlspecialchars($livro['Titulo_Livro']); ?></h3>
                    <p class="author"><?php echo htmlspecialchars($livro['Autor_Livro']); ?></p>
                    <p class="genre">Quantidade: <?php echo $livro['Quantidade']; ?></p>
                    
                    <a href="paginaConsultarLivro.php?id=<?php echo $livro['ID_Livro']; ?>" class="btn-detalhes">
                        <i class="fa-solid fa-eye"></i> Ver Detalhes
                    </a>
                    
                    <a href="logicaCarrinho.php?id=<?php echo $livro['ID_Livro']; ?>&acao=add" 
                       class="add-to-cart-btn" 
                       style="text-decoration: none; <?php echo $estiloBotao; ?>">
                        <i class="fa-solid fa-cart-plus"></i> Requisitar
                    </a>
                </div>
            </div>
        <?php 
            } 
            
        } else {
            echo "<p style='text-align:center; width:100%;'>Ainda não existem livros registados no sistema.</p>";
        }
        ?>
    </div>
</div>

<?php 
include '../templates/footer.php'; 
?>