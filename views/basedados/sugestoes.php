<?php
require_once 'basedados.h'; 

$termo = mysqli_real_escape_string($conn, $_GET['q'] ?? '');
$sugestoes = [];

if (strlen($termo) >= 1) {
    $query = "SELECT ID_Livro, Titulo_Livro FROM livros 
              WHERE Titulo_Livro LIKE '%$termo%' 
              LIMIT 5";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $sugestoes[] = [
            'id' => $row['ID_Livro'],
            'titulo' => $row['Titulo_Livro']
        ];
    }
}

echo json_encode($sugestoes); 
?>