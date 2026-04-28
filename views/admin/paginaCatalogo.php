<?php 
session_start(); 
include '../templates/headerCatalogoAdmin.php'; 
require_once '../basedados/basedados.h'; 

// Lógica de pesquisa e filtros
$pesquisa = isset($_GET['pesquisa']) ? $conn->real_escape_string($_GET['pesquisa']) : '';
$genero_filtro = isset($_GET['genero']) ? $conn->real_escape_string($_GET['genero']) : '';

$sql = "SELECT * FROM livros WHERE 1=1";
if ($pesquisa != '') { $sql .= " AND (Titulo_Livro LIKE '%$pesquisa%' OR Autor_Livro LIKE '%$pesquisa%')"; }
if ($genero_filtro != '') { $sql .= " AND Genero = '$genero_filtro'"; }
$sql .= " ORDER BY ID_Livro DESC"; 
$resultado = $conn->query($sql);

$sql_generos = "SELECT DISTINCT Genero FROM livros WHERE Genero IS NOT NULL AND Genero != ''";
$res_generos = $conn->query($sql_generos);
?>

<link rel="stylesheet" href="../../public/css/paginaCatalogo.css">

<div class="catalog-container">
    <h1 class="main-title">Catálogo de Livros</h1>

    <form method="GET" action="paginaCatalogo.php" class="catalog-filters">
        <input type="text" name="pesquisa" placeholder="Filtrar por título ou autor..." value="<?php echo htmlspecialchars($pesquisa); ?>">
        <select name="genero" onchange="this.form.submit()">
            <option value="">Todos os Géneros</option>
            <?php 
            if ($res_generos->num_rows > 0) {
                while($gen = $res_generos->fetch_assoc()) {
                    $selected = ($genero_filtro == $gen['Genero']) ? 'selected' : '';
                    echo "<option value='".htmlspecialchars($gen['Genero'])."' $selected>".htmlspecialchars($gen['Genero'])."</option>";
                }
            }
            ?>
        </select>
        <button type="submit" class="btn-filtro"><i class="fa-solid fa-filter"></i> Filtrar</button>
        <?php if ($pesquisa != '' || $genero_filtro != ''): ?>
            <a href="paginaCatalogo.php" class="btn-limpar">Limpar Filtros</a>
        <?php endif; ?>
    </form>

    <div class="book-grid">
        <?php 
        if ($resultado->num_rows > 0) {
            while($livro = $resultado->fetch_assoc()) { 
                if ($livro['Disponibilidade'] == 1 && $livro['Quantidade'] > 0) {
                    $classeExtra = ""; $textoStatus = "Disponível"; $estiloBotao = ""; 
                } else {
                    $classeExtra = "out"; $textoStatus = "Indisponível"; $estiloBotao = "pointer-events: none; opacity: 0.5;"; 
                }
        ?>
            <div class="book-item">
                <div class="book-cover">
                    <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa">
                    <span class="tag <?php echo $classeExtra; ?>"><?php echo $textoStatus; ?></span>
                </div>
                <div class="book-details">
                    <h3><?php echo htmlspecialchars($livro['Titulo_Livro']); ?></h3>
                    <p class="author"><?php echo htmlspecialchars($livro['Autor_Livro']); ?></p>
                    <p>Quantidade: <?php echo $livro['Quantidade']; ?></p>
                    
                    <a href="paginaConsultarLivro.php?id=<?php echo $livro['ID_Livro']; ?>" class="btn-detalhes">
                        <i class="fa-solid fa-eye"></i> Ver Detalhes
                    </a>
                    
                    <a href="../cliente/logicaCarrinho.php?id=<?php echo $livro['ID_Livro']; ?>&acao=add" 
                       class="add-to-cart-btn" 
                       style="text-decoration: none; <?php echo $estiloBotao; ?>">
                        <i class="fa-solid fa-cart-plus"></i> Requisitar
                    </a>
                </div>
            </div>
        <?php } } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const urlParams = new URLSearchParams(window.location.search);

// Feedback para quando um livro é criado com sucesso
if (urlParams.get('sucesso') === '1') {
    Swal.fire({
        icon: 'success',
        title: 'Livro Criado!',
        text: 'O novo livro foi adicionado ao catálogo com sucesso.',
        confirmButtonColor: '#004080',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Limpa a URL para o alerta não repetir se o admin fizer refresh
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
}
</script>

<?php include '../templates/footer.php'; ?>