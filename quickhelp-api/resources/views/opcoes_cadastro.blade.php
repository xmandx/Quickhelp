<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/forms.css') }}">
    <title>Opções de cadastro - Quickhelp</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="/">
                <img src="{{ asset('assets/icon/logo-vermelha.png') }}" alt="logo Quickhelp" style="width: 150px;">
            </a>
        </div>
        <button type="button" id="tema">
            <img src="{{ asset('assets/icon/sol-vermelho.png') }}" alt="Tema escuro">
        </button>
    </header>
    <div class="bg"></div>
    <main>
        <img src="{{ asset('assets/img/img-opcoes.png') }}" alt="Mulher caminhando com sacolas">
        <form>
            <article>
                <p class="title">Um clique para começar</p>
                <p>Selecione uma das opções</p>
            </article>
            <a href="/cadastro">Sou cliente</a>
            <a href="/backoffice_cadastro" id="backoffice"> Sou backoffice</a>
        </form>
    </main>
    <script src="{{ asset('script/tema.js') }}"></script>
</body>
</html>
