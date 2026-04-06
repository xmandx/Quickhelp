<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/config.css">
    <link rel="stylesheet" href="../style/forms.css">
    <title>Cadastro de backoffice - Quickhelp</title>
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
        <img src="../assets/img/img-backoffice-cadastro.png" alt="Mulher caminhando com sacolas">
        <form method="post">
            <article>
                <p class="title">Faça parte do time</p>
                <p>Complete seu cadastro para contribuir com nossas operações</p>
            </article>
            <div class="input">
                <input type="text" name="name" id="name" placeholder="Nome">
            </div>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail">
            </div>
            <div class="input">
                <input type="password" name="password" id="password" placeholder="Senha">
                <button type="button" id="btn-pass">
                    <img src="../assets/icon/mostrar.png" alt="Mostrar senha">
                </button>
            </div>
            <div class="input">
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirmar senha">
                <button type="button" id="btn-pass2">
                    <img src="../assets/icon/mostrar.png" alt="Mostrar senha">
                </button>
            </div>
            <div>
                <p>Já possui cadastro?</p>
                <a href="login.php">Faça login</a>
            </div>
            <button type="submit">Registrar</button>
            <?php
                include '../config/config.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $c_password = $_POST['cpassword'];
                    
                    if ($name == "" || $email == "" || $password == "" || $c_password == "") {
                        echo "<p style='color: var(--main-color)'>Preencha todos os campos!</p>";
                    }else{
                        if ($password != $c_password) {
                            echo "<p style='color: var(--main-color)'>As senhas não coincidem!</p>";
                        } else {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO user (name_user, email_user, password_user, rule_user) VALUES ('$name', '$email', '$hashed_password', 'backoffice')";
                            if (mysqli_query($conn, $sql)) {
                                echo '<script>alert("Cadastro realizado com sucesso!"); window.location.href = "login.php";</script>';
                            } else {
                                echo "<p style='color: var(--main-color)'>Erro ao cadastrar usuário: " . mysqli_error($conn) . "</p>";
                            }
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