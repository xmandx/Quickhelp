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
    <link rel="stylesheet" href="../style/adicionar_contato.css">
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

            <form method="post" style="max-width: 58%">
                <p class="title"><b>Adicionar endereço</b></p>
                <div class="input">
                    <input type="text" name="state" id="state" placeholder="Estado">
                </div>
                <div class="input">
                    <input type="text" name="city" id="city" placeholder="Cidade">
                </div>
                <div class="input">
                    <input type="text" name="neighborhood" id="neighborhood" placeholder="Bairro">
                </div>
                <div class="input">
                    <input type="text" name="street" id="street" placeholder="Rua">
                </div>
                <div class="input">
                    <input type="text" name="number" id="number" placeholder="Número">
                </div>
                <div class="input">
                    <input type="text" name="complement" id="complement" placeholder="Complemento">
                </div>
                <div class="info">
                    <button type="submit">Enviar</button>
                    <!--envio do endereço para o banco-->
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include "../config/config.php";

                    $state = $_POST["state"];
                    $city = $_POST["city"];
                    $neighborhood = $_POST["neighborhood"];
                    $street = $_POST["street"];
                    $number = $_POST["number"];
                    $complement = $_POST["complement"];

                    var_dump($_POST);

                    if ($city == "" || $state == "" || $number == "" || $street == "" || $neighborhood == "") {
                        echo "<p style='color: var(--main-color)'>Preencha todos os campos!</p>";
                    } else {
                        $insert = "INSERT INTO adress (state_address, city_address, neighborhood_address, street_address, number_address, complement_address, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insert);
                        $stmt->bind_param("ssssssi", $state, $city, $neighborhood, $street, $number, $complement, $_SESSION['user_id']);
                        if ($stmt->execute()) {
                            header("Location: informacoes.php");
                            exit();
                        } else {
                            echo "<p style='color: var(--main-color)'>Erro ao adicionar endereço!</p>";
                        }
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <script src="../script/dashboard.js"></script>
    <script src="../script/tema.js"></script>
</body>

</html>