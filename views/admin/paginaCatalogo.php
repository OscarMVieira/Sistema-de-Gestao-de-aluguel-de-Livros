<?php 

include '../templates/headerCatalogoAdmin.php'; 
require_once '../basedados/basedados.h'; 

//Buscar os livros da BD
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
        //Verificar se temos livros para apresentar
        if ($resultado->num_rows > 0) {
            
            //Percorrer todos os livros
            while($livro = $resultado->fetch_assoc()) { 
                
                //Disponibilidade
                if ($livro['Disponibilidade'] == 1) {
                    $classeExtra = "";            //Verde se disponivel
                    $textoStatus = "Disponível";
                } else {
                    $classeExtra = "out";         //Vermelho se indisponivel
                    $textoStatus = "Indisponível";
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
                    
                    <button class="add-to-cart-btn">
                        <i class="fa-solid fa-cart-plus"></i> Adicionar
                    </button>
                </div>
            </div>
        <?php 
            } 
            
        } else {
            //Caso não existam livros
            echo "<p style='text-align:center; width:100%;'>Ainda não existem livros registados no sistema.</p>";
        }
        ?>
    </div>
</div>

<?php 
include '../templates/footer.php'; 
?>