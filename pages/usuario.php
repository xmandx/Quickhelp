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
    <link rel="stylesheet" href="../style/usuario.css">
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
            <article>
                <?php
                include '../config/config.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $insert_sos = "INSERT INTO sos (id_user) VALUES (?)";
                    $stmt = $conn->prepare($insert_sos);
                    $stmt->bind_param("i", $_SESSION['user_id']);
                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Emergência acionada! A ajuda está a caminho.');
                        </script>";
                    } else {
                        echo "<p>Erro ao acionar o SOS: " . $stmt->error . "</p>";
                    }
                }
                ?>
                <form method="post">
                    <button type="submit">clique aqui</button>
                </form>
                <p>Em caso de emergência</p>
            </article>
            <!-- segunda section -->
            <section class="section2">
                <div class="cards">
                    <a href="informacoes.php">
                        <div>
                            <p class="subtitle">Contatos de Emergência</p>
                            <p>Clique aqui para ter acesso aos seus contatos de emergência</p>
                        </div>
                    </a>
                    <div>
                        <p class="subtitle">Central de ajuda</p>
                        <p>Clique aqui para acionar a central de ajuda</p>
                    </div>
                    <div>
                        <p class="subtitle">Informações</p>
                        <p>Clique aqui para ter mais informações que te ajudem</p>
                    </div>
                </div>
            </section>
            <?php
            $select_sos = "SELECT * FROM sos WHERE id_user = ?";
            $stmt = $conn->prepare($select_sos);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<div style='display:flex; gap:10px; flex-direction:column'><p class='subtitle'>Contatos de Emergência Acionados</p><ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>SOS acionado em: " . $row['date_sos'] . "</li>";
                }
                echo "</ul></div>";
            } else {
                echo "<p>Nenhum SOS acionado recentemente.</p>";
            }
            ?>
        </div>
    </div>
    <script src="../script/dashboard.js"></script>
    <script src="../script/tema.js"></script>
</body>

</html>