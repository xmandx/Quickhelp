<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/forms.css') }}">
    <title>Login - Quickhelp</title>
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
        <img src="{{ asset('assets/img/img-login.png') }}" alt="Mulher caminhando com sacolas">
        <form id="loginForm">
            <article>
                <p class="title">Bem vindo de volta!</p>
                <p>O que você precisa já está aqui</p>
            </article>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail" required>
            </div>
            <div class="input">
                <input type="password" name="password" id="password" placeholder="Senha" required>
                <button type="button" id="btn-pass">
                    <img src="{{ asset('assets/icon/mostrar.png') }}" alt="Mostrar senha">
                </button>
            </div>
            <div>
                <p>Ainda não possui conta?</p>
                <a href="/opcoes_cadastro">Cadastre-se</a>
            </div>
            <button type="submit">Acessar</button>
            <div id="form-response" style="margin-top: 10px; font-weight: bold;"></div>
        </form>
    </main>
    <script src="{{ asset('script/tema.js') }}"></script>
    <script src="{{ asset('script/pass.js') }}"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const responseDiv = document.getElementById('form-response');
            responseDiv.innerHTML = '<p style="color: #666;">Acessando...</p>';

            const formData = {
                email_user: document.getElementById('email').value,
                password_user: document.getElementById('password').value
            };

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    const data = await response.json();
                    localStorage.setItem('user', JSON.stringify(data.user));
                    
                    if (data.user.rule_user === 'backoffice') {
                        window.location.href = '/dashboard';
                    } else {
                        window.location.href = '/usuario';
                    }
                } else {
                    const data = await response.json();
                    responseDiv.innerHTML = `<p style="color: var(--main-color)">${data.message || 'Email ou senha incorretos!'}</p>`;
                }
            } catch (error) {
                responseDiv.innerHTML = '<p style="color: var(--main-color)">Erro de conexão.</p>';
            }
        });
    </script>
</body>
</html>
