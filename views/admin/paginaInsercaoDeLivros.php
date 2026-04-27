<?php include '../templates/header.php'; ?>
<link rel="stylesheet" href="../../public/css/detalhesLivro.css">
<div class="layoutPrincipal">
    <main class="areaConteudo">
        <h1 class="tituloPagina">Criar Novo Livro</h1>

        <form action="../auth/processarInsercao.php" method="POST" enctype="multipart/form-data">
            
            <div class="gradeInfo">
                <div style="text-align: left;">
                    <section class="caixaCard selecaoCapa">
                        <h2 class="tituloCard">Upload Capa</h2>
                        <div class="bordaImagem">
                            <img src="https://via.placeholder.com/180x260" alt="Capa Preview">
                        </div>
                        <input type="file" name="capa" style="margin-top: 10px;" required>
                    </section>
                </div>

                <section class="caixaCard detalhesLivro">
                    <h2 class="tituloCardSublinhado">Informação Principal</h2>
                    <div class="linhaForm">
                        <input type="text" name="titulo" placeholder="Nome do Livro" required>
                        <input type="text" name="genero" placeholder="Gênero do Livro">
                    </div>
                    <div class="linhaForm">
                        <input type="text" name="autor" placeholder="Autor do Livro" required>
                        <input type="text" name="id_manual" placeholder="Código Interno (Opcional)">
                    </div>
                    <div class="containerCampos">
                        <div class="campoIndividual">
                            <label>Quantidade:</label>
                            <input type="number" name="quantidade" value="1" min="1">
                        </div>
                    </div>
                </section>
            </div>
            
            <div class="containerAcoesFinal">
                <button type="submit" class="btnAzulLargo">Criar Livro</button>
                
                <div class="grupoBotoesAcaoDireita">
                    <button type="reset" class="btnAzulMedio">Limpar Formulário</button>
                    <a href="../admin/paginaCatalogo.php" class="btnAzulMedio">Voltar</a>
                </div>
            </div>
        </form> 
    </main>
</div>
<?php include '../templates/footer.php'; ?>