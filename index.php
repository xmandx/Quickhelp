<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/icon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style/config.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Home - Quickhelp</title>
</head>

<body>
    <!-- header -->
    <header>
        <a href="index.php" class="logo">
            <img src="assets/icon/logo-vermelha.png" alt="logo Quickhelp">
        </a>
        <button type="button" id="menu">
            <img src="assets/icon/menu-vermelho.png" alt="Barra de navegação">
        </button>
        <nav>
            <ul>
                <li>
                    <a href="">Backoffice</a>
                </li>
                <li>
                    <a href="">Empresas</a>
                </li>
                <li>
                    <a href="">Quem somos</a>
                </li>
                <li>
                    <a href="#contact">Fale conosco</a>
                </li>
            </ul>
            <ul class="acesso">
                <li>
                    <a href="pages/opcoes_cadastro.html">Criar conta</a>
                </li>
                <li>
                    <a href="pages/login.html">
                        <button>Entrar</button>
                    </a>
                </li>
                <button type="button" id="tema">
                    <img src="assets/icon/sol-vermelho.png" alt="Tema escuro">
                </button>
            </ul>
        </nav>
    </header>
    <!-- article -->
    <article>
        <p class="title">Veja o que tem perto de você</p>
        <p>Não importa a hora e o lugar!</p>
        <div class="search">
            <div class="input">
                <img src="assets/icon/icon-localizacao.png" alt="Pin de mapa">
                <input type="text" name="endereco" id="endereco" placeholder="Informe o endereço de entrega">
            </div>
            <button type="button">Buscar</button>
        </div>
    </article>
    <!-- primeira section -->
    <section class="section1">
        <article>
            <img src="assets/img/boia.png" alt="Boia">
            <div>
                <p class="title">O que você <b>precisa</b>, chega até você!</p>
                <p>Seja uma refeição quentinha ou aquele apoio imediato, estamos sempre prontos para entregar o que faz
                    diferença na sua vida.</p>
                <a href="">
                    <button>Saiba mais</button>
                </a>
            </div>
        </article>
        <article>
            <img src="assets/img/sino.png" alt="Campainha">
            <div>
                <p class="title">Aqui você <b>encontra</b> o que procura</p>
                <p>Variedade, rapidez e confiança em cada entrega. Porque toda escolha merece chegar até você de forma
                    segura.</p>
                <a href="">
                    <button>Saiba mais</button>
                </a>
            </div>
        </article>
    </section>
    <!-- contact us -->
    <section class="contact" id="contact">
        <article>
            <p class="title">Entre em <b>contato</b></p>
            <p>Estamos prontos para atender você. No <b>Quickhelp</b>, estamos sempre prontos para ouvir você! Seja uma dúvida, uma sugestão ou um pedido, nossa equipe está aqui para responder o mais rápido possível.</p>
            <div>
                <div>
                    <img src="assets/icon/email.png" alt="E-Mail Quickhelp">
                    <p>suporte@quickhelp.com</p>
                </div>
                <div>
                    <img src="assets/icon/telefone.png" alt="Telefone Quickhelp">
                    <p>+55 (11) 99999-9999</p>
                </div>
                <div>
                    <img src="assets/icon/pin.png" alt="Endereço Quickhelp">
                    <p>Av. das Acácias, 742 - 12º andar - Bairro Aurora - São Paulo, SP</p>
                </div>
            </div>
        </article>
        <form method="post">
            <p class="title"><b>Diga algo</b></p>
            <div class="input">
                <input type="text" name="name" id="name" placeholder="Nome">
            </div>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail">
            </div>
            <div class="textarea">
                <textarea name="message" id="message" placeholder="Mensagem" maxlength="500"></textarea>
                <p>Restam <span id="caracteres">500</span> caracteres</p>
            </div>
            <div class="info">
                <button type="submit">Enviar</button>
                <!--envio das mensagens para o banco-->
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include "config/config.php";

                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $message = $_POST["message"];

                    if ($name == "" || $email == "" || $message == "") {
                        echo "<p style='color: var(--main-color)'>Preencha todos os campos!</p>";
                    }else{
                        $insert = "INSERT INTO message (name_message, email_message, message_message) VALUES ('$name', '$email', '$message')";
                        $stmt = $conn->prepare($insert);
                        if ($stmt->execute()) {
                            echo "<p style='color: #16a34a'>Mensagem enviada com sucesso!</p>";
                        }
                    }
                }
                ?>
            </div>
        </form>

    </section>
    <!-- segunda section -->
    <section class="section2">
        <p class="title">Aproveite todas as <b>vantagens</b> de <b>estar com o Quickhelp</b></p>
        <div class="cards">
            <div>
                <p class="subtitle">Confiável e discreto</p>
                <p>Sua entrega é feita com cuidado e sigilo, garantindo que tudo chegue até você da forma mais segura.</p>
            </div>
            <div>
                <p class="subtitle">Está aí em instantes</p>
                <p>Com apenas um toque, sua escolha chega rápido — seja comida ou a ajuda que faz diferença.</p>
            </div>
            <div>
                <p class="subtitle">Tudo em um só lugar</p>
                <p>Do sabor que você procura ao apoio que precisa, sempre disponível para você.</p>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer>
        <div class="info">
            <a href="index.php" class="logo">
                <img src="assets/icon/logo-branca.png" alt="logo Quickhelp">
            </a>
            <div>
                <ul>
                    <li>
                        <u>Quickhelp</u>
                    </li>
                    <li>
                        <a href="">Backoffice</a>
                    </li>
                    <li>
                        <a href="">Empresas</a>
                    </li>
                    <li>
                        <a href="">Quem somos</a>
                    </li>
                    <li>
                        <a href="">Fale conosco</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <u>Social</u>
                    </li>
                    <div>
                        <li>
                            <a href="">
                                <img src="assets/icon/facebook.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/icon/twitter.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/icon/youtube.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/icon/instagram.png" alt="">
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
        <p>© Copyright 2025 - Quickhelp - Todos os direitos reservados</p>
    </footer>
    <script src="script/header.js"></script>
    <script src="script/tema.js"></script>
    <script src="script/home.js"></script>
</body>

</html>