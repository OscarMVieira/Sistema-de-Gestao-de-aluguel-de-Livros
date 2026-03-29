<?php 
$activePage = 'catalogo'; 
include '../templates/header.php'; 
?>

<link rel="stylesheet" href="../../public/css/detalhesLivro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="centralizador-pagina">
    <h1 class="tituloPagina">Editar Livro</h1>

    <div class="gradeInfo">
        <section class="caixaCard selecaoCapa">
            <h2 class="tituloCard">Editar Capa</h2>
            <p class="textoUpload">Upload Capa</p>
            <div class="bordaImagem">
                <img src="https://m.media-amazon.com/images/I/71jY8t-W3vL.jpg" alt="Capa">
            </div>
            <button class="botaoAzulPequeno">Mudar Capa</button>
        </section>

        <section class="caixaCard detalhesLivro">
            <h2 class="tituloCardSublinhado">Informação Principal</h2>
            <div class="linhaForm">
                <input type="text" value="Nome do Livro">
                <input type="text" value="Gênero do Livro">
            </div>
            <div class="linhaForm">
                <input type="text" value="Autor do Livro">
                <input type="text" value="ID do Livro">
            </div>
            <div class="containerCampos">
                <div class="campoIndividual"><label>Data:</label><input type="text"></div>
                <div class="campoIndividual"><label>Preço:</label><input type="text"></div>
                <div class="campoIndividual"><label>Qtd:</label><input type="text"></div>
            </div>
        </section>
    </div>

    <div class="containerAcoesFinal">
        <button class="botaoVoltar">Editar Livro</button>
        
        <div class="grupoBotoesBrancos">
            <button class="botaoBranco">Limpar Formulário</button>
            <a href="../cliente/paginaCatalogo.php" class="botaoBranco">Voltar</a>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>