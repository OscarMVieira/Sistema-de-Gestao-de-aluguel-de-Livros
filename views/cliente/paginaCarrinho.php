<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo - Carrinho de Compras</title>
    <link rel="stylesheet" href="../../public/css/paginaCarrinho.css">
    <!-- Font Awesome para os icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header / Navbar / Sidebar -->
       <?php include '../templates/header.php'; ?>

        <!-- Main Content -->
        <main class="content">
            <h1 class="mainTitle">Carrinho</h1>

            <div class="gridLayout">
                <!-- Coluna do Carrinho -->
                <section class="cartSection">
                    <h2>Carrinho de Requisições</h2>
                    
                    <!-- Item 1 -->
                    <div class="bookCard">
                        <img src="https://via.placeholder.com/80x120" alt="Capa do Livro">
                        <div class="bookInfo">
                            <h3>O Gato Que Salvava Livros</h3>
                            <p class="author">Sosuke Natsukawa</p>
                            <div class="quantityControl">
                                <span>+ / -</span>
                                <span class="qty-number">(1)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bookCard">
                        <img src="https://via.placeholder.com/80x120" alt="Capa do Livro">
                        <div class="bookInfo">
                            <h3>O Gato Que Salvava Livros</h3>
                            <p class="author">Sosuke Natsukawa</p>
                            <div class="quantityControl">
                                <span>+ / -</span>
                                <span class="qty-number">(1)</span>
                            </div>
                        </div>
                    </div>

                    <p class="limitText">Limite: 2 de 3 Livros</p>
                </section>

                <!-- Coluna do Calendário -->
                <section class="dateSection">
                    <h2>Duração da Requisição</h2>
                    <div class="calendarCard">
                        <div class="calendarHeader">
                            <button>&lt;</button>
                            <span>Junho – 2026</span>
                            <button>&gt;</button>
                        </div>
                        <table class="calendarTable">
                            <thead>
                                <tr>
                                    <th>Do</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>
                                <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>
                                <tr><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td></tr>
                                <tr><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td></tr>
                                <tr><td>29</td><td>30</td><td></td><td></td><td></td><td></td><td></td></tr>
                            </tbody>
                        </table>
                        <button class="confirmBtn">CONFIRMAR REQUISIÇÃO</button>
                    </div>
                </section>
            </div>
            <!-- Footer -->
        <?php include '../templates/footer.php'; ?>