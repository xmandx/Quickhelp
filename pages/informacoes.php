<?php
session_start();

if (!isset($_SESSION)) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/config.css">
    <link rel="stylesheet" href="../style/informacoes.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <title>Início - Quickhelp</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/icon/logo-branca.png" alt="logo Quickhelp">
                </a>
            </div>
            <nav>
                <a href="usuario.php">Inicio</a>
                <a href="informacoes.php">Informações</a>
                <a href="">Configurações</a>
                <a href="">Ajuda</a>
                <a href="../index.php">
                    <button>Sair</button>
                </a>
                <button type="button" id="tema">
                    <img src="../assets/icon/sol-branco.png" alt="Tema escuro">
                </button>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="user-info">
                    <input type="text" class="search-box" placeholder="Buscar...">
                    <div class="user-profile">
                        <div class="avatar"><?php echo substr($_SESSION['user_name'], 0, 1); ?></div>
                        <span><?php echo $_SESSION['user_name']; ?></span>
                        <span>▼</span>
                    </div>
                </div>
            </div>

            <div class="contatos">
                <div class="card-title">Contatos de Emergência</div>
                <?php
                include "../config/config.php";

                $id_user = $_SESSION['user_id'];
                $select = "SELECT name_contact, phone_contact FROM contact WHERE id_user = ?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("i", $id_user);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='contact-item'>";
                        echo "<p><b>Nome:</b> " . $row['name_contact'] . "</p>";
                        echo "<p><b>Telefone:</b> " . $row['phone_contact'] . "</p>";
                        echo "</div>";
                    }
                }
                ?>
                <a href="adicionar_contato.php" style="color: var(--main-purple);">+ Adicione um contato</a>
            </div>

            <div class="enderecos">
                <div class="card-title">Endereços</div>
                <?php
                include "../config/config.php";

                $id_user = $_SESSION['user_id'];
                $select = "SELECT * FROM adress WHERE id_user = ?";
                $stmt = $conn->prepare($select);
                $stmt->bind_param("i", $id_user);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='contact-item'>";
                        echo "<p><b>Estado:</b> " . $row['state_address'] . "</p>";
                        echo "<p><b>Cidade:</b> " . $row['city_address'] . "</p>";
                        echo "<p><b>Bairro:</b> " . $row['neighborhood_address'] . "</p>";
                        echo "<p><b>Rua:</b> " . $row['street_address'] . "</p>";
                        echo "<p><b>Número:</b> " . $row['number_address'] . "</p>";
                        echo "<p><b>Complemento:</b> " . $row['complement_address'] . "</p>";
                        echo "</div>";
                    }
                }
                ?>
                <a href="adicionar_endereco.php" style="color: var(--main-purple);">+ Adicione um endereço</a>
            </div>
        </div>
    </div>
    <script src="../script/dashboard.js"></script>
    <script src="../script/tema.js"></script>
</body>

</html>