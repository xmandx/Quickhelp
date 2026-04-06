<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/config.css">
    <link rel="stylesheet" href="../style/forms.css">
    <title>Login - Quickhelp</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php">
            </a>
        </div>
        <button type="button" id="tema">
            <img src="../assets/icon/sol-vermelho.png" alt="Tema escuro">
        </button>
    </header>
    <div class="bg"></div>
    <main>
        <img src="../assets/img/img-login.png" alt="Mulher caminhando com sacolas">
        <form method="post">
            <article>
                <p class="title">Bem vindo de volta!</p>
                <p>O que você precisa já está aqui</p>
            </article>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail">
            </div>
            <div class="input">
                <input type="password" name="password" id="password" placeholder="Senha">
                <button type="button" id="btn-pass">
                    <img src="../assets/icon/mostrar.png" alt="Mostrar senha">
                </button>
            </div>
            <div>
                <p>Ainda não possui conta?</p>
                <a href="opcoes_cadastro.php">Cadastre-se</a>
            </div>
            <button type="submit">Acessar</button>
            <?php
                include '../config/config.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    if ($email == "" || $password == "") {
                        echo "<p style='color: var(--main-color)'>Preencha todos os campos!</p>";
                    } else {
                        $sql = "SELECT * FROM user WHERE email_user = '$email'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row['password_user'])) {
                                session_start();
                                $_SESSION['user_id'] = $row['id_user'];
                                $_SESSION['user_name'] = $row['name_user'];
                                $_SESSION['user_email'] = $row['email_user'];
                                $_SESSION['user_rule'] = $row['rule_user'];
                                
                                if ($row['rule_user'] == 'backoffice') {
                                    header("Location: dashboard.php");
                                } else {
                                    header("Location: usuario.php");
                                }
                                exit();
                            } else {
                                echo "<p style='color: var(--main-color)'>Senha incorreta!</p>";
                            }
                        } else {
                            echo "<p style='color: var(--main-color)'>Usuário não encontrado!</p>";
                        }
                    }
                }
            ?>
        </form>
    </main>
    <script src="../script/tema.js"></script>
    <script src="../script/pass.js"></script>
</body>
</html>