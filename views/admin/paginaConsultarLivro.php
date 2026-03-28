<?php 
$activePage = 'catalogo'; 
include '../templates/header.php'; 
?>

<div class="centralizador-conteudo" style="width: 100%; max-width: 1000px;">
    <h1 class="tituloPagina">Informações Livro</h1>

    <div class="gradeInfo">
        <section class="caixaCard selecaoCapa">
            <h2 class="tituloCard">Capa</h2>
            <div class="bordaImagem">
                <img src="https://m.media-amazon.com/images/I/71jY8t-W3vL.jpg" alt="Capa">
            </div>
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

    <div class="botaoAcoes">
        <button class="botaoVoltar">Voltar</button>
    </div>
</div>

<?php include '../templates/footer.php'; ?>