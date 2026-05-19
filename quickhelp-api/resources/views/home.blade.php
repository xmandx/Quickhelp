<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/header.css') }}">
    <link rel="stylesheet" href="{{ asset('style/home.css') }}">
    <link rel="stylesheet" href="{{ asset('style/footer.css') }}">
    <title>Home - Quickhelp</title>
</head>

<body>
    <!-- header -->
    <header>
        <a href="/" class="logo">
            <img src="{{ asset('assets/icon/logo-vermelha.png') }}" alt="logo Quickhelp">
        </a>
        <button type="button" id="menu">
            <img src="{{ asset('assets/icon/menu-vermelho.png') }}" alt="Barra de navegação">
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
                    <a href="/cadastro">Criar conta</a>
                </li>
                <li>
                    <a href="/login">
                        <button>Entrar</button>
                    </a>
                </li>
                <button type="button" id="tema">
                    <img src="{{ asset('assets/icon/sol-vermelho.png') }}" alt="Tema escuro">
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
                <img src="{{ asset('assets/icon/icon-localizacao.png') }}" alt="Pin de mapa">
                <input type="text" name="endereco" id="endereco" placeholder="Informe o endereço de entrega">
            </div>
            <button type="button">Buscar</button>
        </div>
    </article>
    <!-- primeira section -->
    <section class="section1">
        <article>
            <img src="{{ asset('assets/img/boia.png') }}" alt="Boia">
            <div>
                <p class="title">O que você <b>precisa</b>, chega até você!</p>
                <p>Seja uma refeição quentinha ou aquele apoio imediato, estamos sempre prontos para entregar o que faz diferença na sua vida.</p>
                <a href="">
                    <button>Saiba mais</button>
                </a>
            </div>
        </article>
        <article>
            <img src="{{ asset('assets/img/sino.png') }}" alt="Campainha">
            <div>
                <p class="title">Aqui você <b>encontra</b> o que procura</p>
                <p>Variedade, rapidez e confiança em cada entrega. Porque toda escolha merece chegar até você de forma segura.</p>
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
                    <img src="{{ asset('assets/icon/email.png') }}" alt="E-Mail Quickhelp">
                    <p>suporte@quickhelp.com</p>
                </div>
                <div>
                    <img src="{{ asset('assets/icon/telefone.png') }}" alt="Telefone Quickhelp">
                    <p>+55 (11) 99999-9999</p>
                </div>
                <div>
                    <img src="{{ asset('assets/icon/pin.png') }}" alt="Endereço Quickhelp">
                    <p>Av. das Acácias, 742 - 12º andar - Bairro Aurora - São Paulo, SP</p>
                </div>
            </div>
        </article>
        <form id="contactForm" style="max-width: 58%">
            <p class="title"><b>Diga algo</b></p>
            <div class="input">
                <input type="text" name="name" id="name" placeholder="Nome" required>
            </div>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail" required>
            </div>
            <div class="textarea">
                <textarea name="message" id="message" placeholder="Mensagem" maxlength="500" required></textarea>
                <p>Restam <span id="caracteres">500</span> caracteres</p>
            </div>
            <div class="info">
                <button type="submit">Enviar</button>
                <div id="form-response" style="margin-top: 10px;"></div>
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
            <a href="/" class="logo">
                <img src="{{ asset('assets/icon/logo-branca.png') }}" alt="logo Quickhelp">
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
                        <a href="#contact">Fale conosco</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <u>Social</u>
                    </li>
                    <div>
                        <li>
                            <a href=""><img src="{{ asset('assets/icon/facebook.png') }}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{ asset('assets/icon/twitter.png') }}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{ asset('assets/icon/youtube.png') }}" alt=""></a>
                        </li>
                        <li>
                            <a href=""><img src="{{ asset('assets/icon/instagram.png') }}" alt=""></a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
        <p>© Copyright 2025 - Quickhelp - Todos os direitos reservados</p>
    </footer>
    <script src="{{ asset('script/header.js') }}"></script>
    <script src="{{ asset('script/home.js') }}"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const responseDiv = document.getElementById('form-response');
            responseDiv.innerHTML = '<p style="color: #666;">Enviando...</p>';

            const formData = {
                name_message: document.getElementById('name').value,
                email_message: document.getElementById('email').value,
                message_message: document.getElementById('message').value
            };

            try {
                const response = await fetch('/api/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    responseDiv.innerHTML = '<p style="color: #16a34a">Mensagem enviada com sucesso!</p>';
                    document.getElementById('contactForm').reset();
                    document.getElementById('caracteres').innerText = '500';
                } else {
                    responseDiv.innerHTML = '<p style="color: #f53003">Erro ao enviar. Verifique os dados.</p>';
                }
            } catch (error) {
                responseDiv.innerHTML = '<p style="color: #f53003">Erro de conexão.</p>';
            }
        });
    </script>
</body>
</html>
