<?php include '../templates/header.php'; ?>

<link rel="stylesheet" href="../../public/css/paginaPerfil.css">

<div class="perfil-container">
    <h1 class="perfil-title">Perfil</h1>

    <div class="perfil-main-card">
        <div class="perfil-grid">
            
            <div class="photo-section">
                <h2 class="section-label">Foto de Perfil</h2>
                <div class="photo-card">
                    <img src="https://via.placeholder.com/150" alt="">
                    <button class="perfil-btn mudar-foto">Mudar foto</button>
                </div>
            </div>

            <div class="info-section">
                <h2 class="section-label">Informação Principal</h2>
                
                <div class="field-group">
                    <div class="field-row">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" value="João">
                        <button class="edit-btn">Edit</button>
                    </div>

                    <div class="field-row">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="Exemplo@gmail.com">
                        <button class="edit-btn">Edit</button>
                    </div>

                    <div class="field-row">
                        <label for="nif">Nif:</label>
                        <input type="text" id="nif" value="3217404">
                        <button class="edit-btn">Edit</button>
                    </div>

                    <div class="field-row">
                        <label for="password">Password:</label>
                        <input type="password" id="password" value="************">
                        <button class="edit-btn">Edit</button>
                    </div>
                </div>
            </div>

        </div> </div> <button class="perfil-btn confirmar-btn">Confirmar</button>
</div>

<?php include '../templates/footer.php'; ?>