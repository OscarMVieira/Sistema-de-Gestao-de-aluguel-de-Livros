<?php 
session_start();
require_once '../basedados/basedados.h'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['id']) ? intval($_POST['id']) : 0);

if ($id <= 0) {
    header("Location: paginaCatalogo.php");
    exit();
}

$mensagemSucesso = false;
$erroValidacao = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_editar'])) {
    $titulo = trim($_POST['titulo']);
    $autor  = trim($_POST['autor']);
    $genero = trim($_POST['genero']);
    $qtd    = intval($_POST['quantidade']);
    
    $disponibilidade = ($qtd > 0) ? 1 : 0;

    if (empty($titulo) || empty($autor) || empty($genero)) {
        $erroValidacao = "Erro: Título, Autor e Género não podem ficar em branco!";
    } else {
        
        if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
            $nomeCapa = time() . "_" . $_FILES['capa']['name'];
            move_uploaded_file($_FILES['capa']['tmp_name'], "../../public/img/" . $nomeCapa);
            
            $stmt_upd = $conn->prepare("UPDATE livros SET Titulo_Livro=?, Autor_Livro=?, Genero=?, Quantidade=?, Disponibilidade=?, Capa=? WHERE ID_Livro=?");
            $stmt_upd->bind_param("sssiisi", $titulo, $autor, $genero, $qtd, $disponibilidade, $nomeCapa, $id);
        } else {
            
            $stmt_upd = $conn->prepare("UPDATE livros SET Titulo_Livro=?, Autor_Livro=?, Genero=?, Quantidade=?, Disponibilidade=? WHERE ID_Livro=?");
            $stmt_upd->bind_param("sssiii", $titulo, $autor, $genero, $qtd, $disponibilidade, $id);
        }

        if ($stmt_upd->execute()) {
            $mensagemSucesso = true;
        }
        $stmt_upd->close();
    }
}

$stmt_busca = $conn->prepare("SELECT * FROM livros WHERE ID_Livro = ?");
$stmt_busca->bind_param("i", $id);
$stmt_busca->execute();
$livro = $stmt_busca->get_result()->fetch_assoc();

if (!$livro) {
    header("Location: paginaCatalogo.php");
    exit();
}

include '../templates/header.php'; 
?>

<link rel="stylesheet" href="../../public/css/detalhesLivro.css">

<div class="centralizador-pagina">
    <h1 class="tituloPagina">Editar Livro</h1>

    <form action="paginaEditarLivro.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="gradeInfo">
            <section class="caixaCard selecaoCapa">
                <h2 class="tituloCard">Editar Capa</h2>
                <div class="bordaImagem">
                    <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa">
                </div>
                <input type="file" name="capa" style="margin-top: 15px;">
            </section>

            <section class="caixaCard detalhesLivro">
                <h2 class="tituloCardSublinhado">Informação Principal</h2>
                
                <div class="linhaForm">
                    <div class="campoIndividual">
                        <label>Título:</label>
                        <input type="text" name="titulo" value="<?php echo htmlspecialchars($livro['Titulo_Livro']); ?>" required>
                    </div>
                    <div class="campoIndividual">
                        <label>Género:</label>
                        <input type="text" name="genero" value="<?php echo htmlspecialchars($livro['Genero']); ?>" required>
                    </div>
                </div>

                <div class="linhaForm">
                    <div class="campoIndividual">
                        <label>Autor:</label>
                        <input type="text" name="autor" value="<?php echo htmlspecialchars($livro['Autor_Livro']); ?>" required>
                    </div>
                    <div class="campoIndividual">
                        <label>ID Interno:</label>
                        <input type="text" value="<?php echo $id; ?>" readonly style="background-color: #eee;">
                    </div>
                </div>

                <div class="containerCampos">
                    <div class="campoIndividual">
                        <label>Data:</label><input type="text" value="--" readonly>
                    </div>
                    <div class="campoIndividual">
                        <label>Preço:</label><input type="text" value="--" readonly>
                    </div>
                    <div class="campoIndividual">
                        <label>Qtd:</label>
                        <input type="number" name="quantidade" value="<?php echo $livro['Quantidade']; ?>" min="0" required>
                    </div>
                </div>
            </section>
        </div>

        <div class="containerAcoesFinal">
            <button type="submit" name="btn_editar" class="btnAzulLargo">
                <i class="fa-solid fa-pen-to-square"></i> Editar Livro
            </button>
            
            <div class="grupoBotoesAcaoDireita">
                <button type="reset" class="btnAzulMedio">Limpar Formulário</button>
                <a href="paginaConsultarLivro.php?id=<?php echo $id; ?>" class="btnAzulMedio">Voltar</a>
            </div>
        </div>
    </form> 
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if ($mensagemSucesso): ?>
    Swal.fire({
        icon: 'success',
        title: 'Atualizado!',
        text: 'O livro foi editado com sucesso.',
        confirmButtonColor: '#004080'
    });
<?php endif; ?>

<?php if ($erroValidacao): ?>
    Swal.fire({
        icon: 'error',
        title: 'Campos Vazios',
        text: '<?php echo $erroValidacao; ?>',
        confirmButtonColor: '#d33'
    });
<?php endif; ?>
</script>

<?php include '../templates/footer.php'; ?>