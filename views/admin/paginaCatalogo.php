<?php include '../templates/headerCatalogoAdmin.php'; ?>

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
        <div class="book-item">
            <div class="book-cover">
                <img src="https://via.placeholder.com/150x220" alt="Capa do Livro">
                <span class="tag">Disponível</span>
            </div>
            <div class="book-details">
                <h3>O Gato Que Salvava Livros</h3>
                <p class="author">Sosuke Natsukawa</p>
                <p class="genre">Ficção Japonesa</p>
                <button class="add-to-cart-btn">
                    <i class="fa-solid fa-cart-plus"></i> Adicionar
                </button>
            </div>
        </div>
        </div>
</div>

<?php include '../templates/footer.php'; ?>