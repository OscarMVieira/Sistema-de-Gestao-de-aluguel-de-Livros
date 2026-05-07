<?php
session_start();
require_once '../basedados/basedados.h'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $genero = $_POST['genero'];
    $qtd    = $_POST['quantidade'];
    $disponibilidade = 1; 

    $nome_foto = "default.png"; 
    
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
        // Validação de extensão no servidor
        $extensao = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));
        $extensoes_permitidas = ['jpg', 'jpeg', 'png'];

        if (in_array($extensao, $extensoes_permitidas)) {
            $nome_foto = time() . "_" . $_FILES['capa']['name']; // Nome mais seguro para evitar duplicados
            $destino = "../../public/img/" . $nome_foto;

            if (!move_uploaded_file($_FILES['capa']['tmp_name'], $destino)) {
                $nome_foto = "default.png"; // Fallback em caso de erro no move
            }
        } else {
            // Se o formato for inválido, volta com erro
            header("Location: ../admin/paginaInsercaoDeLivros.php?erro=formato_invalido");
            exit();
        }
    }

    $sql = "INSERT INTO livros (Titulo_Livro, Autor_Livro, Genero, Capa, Quantidade, Disponibilidade) 
            VALUES ('$titulo', '$autor', '$genero', '$nome_foto', '$qtd', '$disponibilidade')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/paginaCatalogo.php?sucesso=1");
    } else {
        echo "Erro ao inserir livro: " . $conn->error;
    }
}

$conn->close();
?>