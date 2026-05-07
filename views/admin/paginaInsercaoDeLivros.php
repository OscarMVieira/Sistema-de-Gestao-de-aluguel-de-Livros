<?php include '../templates/header.php'; ?>
<link rel="stylesheet" href="../../public/css/detalhesLivro.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="layoutPrincipal">
    <main class="areaConteudo">
        <h1 class="tituloPagina">Criar Novo Livro</h1>

        <form action="../auth/processarInsercao.php" method="POST" enctype="multipart/form-data" id="formInsercao">
            
            <div class="gradeInfo">
                <div style="text-align: left;">
                    <section class="caixaCard selecaoCapa">
                        <h2 class="tituloCard">Upload Capa</h2>
                        <div class="bordaImagem">
                            <img src="https://via.placeholder.com/180x260" alt="Capa Preview" id="previewCapa">
                        </div>
                        <input type="file" name="capa" id="inputCapa" style="margin-top: 10px;" required accept=".jpg,.jpeg,.png">
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
                    <button type="reset" class="btnAzulMedio" onclick="resetPreview()">Limpar Formulário</button>
                    <a href="../admin/paginaCatalogo.php" class="btnAzulMedio">Voltar</a>
                </div>
            </div>
        </form> 
    </main>
</div>

<script>
// Lógica para Validação e PREVIEW da Imagem
document.getElementById('inputCapa').addEventListener('change', function() {
    const ficheiro = this.files[0];
    const extensoesPermitidas = ['jpg', 'jpeg', 'png'];
    const preview = document.getElementById('previewCapa');
    
    if (ficheiro) {
        const extensao = ficheiro.name.split('.').pop().toLowerCase();

        if (extensoesPermitidas.includes(extensao)) {
            // Se o formato for válido, gera a preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(ficheiro);
        } else {
            // Se for inválido, bloqueia e limpa
            Swal.fire({
                icon: 'error',
                title: 'Formato Inválido',
                text: 'Apenas são permitidos formatos .jpg ou .png para capas.',
                confirmButtonColor: '#004080'
            });
            this.value = ''; 
            preview.src = 'https://via.placeholder.com/180x260';
        }
    }
});

// Função para limpar a preview quando clicas em "Limpar Formulário"
function resetPreview() {
    document.getElementById('previewCapa').src = 'https://via.placeholder.com/180x260';
}

// Feedback visual ao submeter
document.getElementById('formInsercao').addEventListener('submit', function() {
    Swal.fire({
        title: 'A criar livro...',
        text: 'Por favor, aguarde enquanto gravamos os dados.',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
});
</script>

<?php include '../templates/footer.php'; ?>