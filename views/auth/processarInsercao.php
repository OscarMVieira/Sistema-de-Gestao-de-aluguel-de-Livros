<?php
session_start();

require_once '../basedados/basedados.h'; //Liga à BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $genero = $_POST['genero'];
    $qtd    = $_POST['quantidade'];
    $disponibilidade = 1; // 1 Já que um livro novo adicionado ao sistema estará disponivel

    
    $nome_foto = "default.png"; // Imagem default caso não for enviado nada
    
    //Verifica se foi feito um upload de uma capa 
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
    
    $nome_foto = $_FILES['capa']['name']; 
    $destino = "../../public/img/" . $nome_foto;

    // Move o ficheiro para a pasta final
    move_uploaded_file($_FILES['capa']['tmp_name'], $destino);
}

    //Inserir os dados na BD
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