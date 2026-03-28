<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Criar Novo Livro - EX Exemplo</title>
    <link rel="stylesheet" href="../../public/css/detalhesLivro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="layoutPrincipal">
        <aside class="menuLateral">
            <nav class="caixaMenu">
                <ul>
                    <li class="itemDoMenu"><i class="fas fa-home"></i> Início</li>
                    <li class="itemDoMenu"><i class="far fa-file-alt"></i> Gestão de Pedidos</li>
                    <li class="itemDoMenu"><i class="fas fa-users"></i> Gerir Clientes</li>
                    <li class="itemDoMenu ativo"><i class="far fa-copy"></i> Gestão Catálogo</li>
                </ul>
            </nav>
        </aside>

        <main class="areaConteudo">
            <h1 class="tituloPagina">Criar Novo Livro</h1>

            <div class="gradeInfo">
                <div style="text-align: left;">
                    <section class="caixaCard selecaoCapa">
                        <h2 class="tituloCard">Upload Capa</h2>
                        <div class="bordaImagem">
                            <img src="https://m.media-amazon.com/images/I/71jY8t-W3vL.jpg" alt="Capa">
                        </div>
                        <button class="botaoAzulPequeno">Mudar Capa</button>
                    </section>
                </div>

                <section class="caixaCard detalhesLivro">
                    <h2 class="tituloCardSublinhado">Informação Principal</h2>
                    <div class="linhaForm">
                        <input type="text" placeholder="Nome do Livro">
                        <input type="text" placeholder="Gênero do Livro">
                    </div>
                    <div class="linhaForm">
                        <input type="text" placeholder="Autor do Livro">
                        <input type="text" placeholder="ID do Livro">
                    </div>
                    <div class="containerCampos">
                        <div class="campoIndividual"><label>Data Publicação:</label><input type="text"></div>
                        <div class="campoIndividual"><label>Preço:</label><input type="text"></div>
                        <div class="campoIndividual"><label>Quantidade:</label><input type="text"></div>
                    </div>
                </section>
            </div>

            <div class="containerAcoesFinal">
                <button class="botaoVoltar">Criar Livro</button>
                
                <div class="grupoBotoesBrancos">
                    <button class="botaoBranco">Limpar Formulário</button>
                    <button class="botaoBranco">Cancelar</button>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
<?php include '../templates/footer.php'; ?>