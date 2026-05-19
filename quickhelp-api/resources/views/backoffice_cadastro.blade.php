<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/forms.css') }}">
    <title>Cadastro de backoffice - Quickhelp</title>
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
        <img src="{{ asset('assets/img/img-backoffice-cadastro.png') }}" alt="Mulher caminhando com sacolas">
        <form id="registerForm">
            <article>
                <p class="title">Faça parte do time</p>
                <p>Complete seu cadastro para contribuir com nossas operações</p>
            </article>
            <div class="input">
                <input type="text" name="name" id="name" placeholder="Nome" required>
            </div>
            <div class="input">
                <input type="email" name="email" id="email" placeholder="E-Mail" required>
            </div>
            <div class="input">
                <input type="password" name="password" id="password" placeholder="Senha" required>
                <button type="button" id="btn-pass">
                    <img src="{{ asset('assets/icon/mostrar.png') }}" alt="Mostrar senha">
                </button>
            </div>
            <div class="input">
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirmar senha" required>
                <button type="button" id="btn-pass2">
                    <img src="{{ asset('assets/icon/mostrar.png') }}" alt="Mostrar senha">
                </button>
            </div>
            <div>
                <p>Já possui cadastro?</p>
                <a href="/login">Faça login</a>
            </div>
            <button type="submit">Registrar</button>
            <div id="form-response" style="margin-top: 10px; font-weight: bold;"></div>
        </form>
    </main>
    <script src="{{ asset('script/tema.js') }}"></script>
    <script src="{{ asset('script/pass.js') }}"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const responseDiv = document.getElementById('form-response');
            responseDiv.innerHTML = '<p style="color: #666;">Registrando...</p>';

            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;

            if (password !== cpassword) {
                responseDiv.innerHTML = '<p style="color: var(--main-color)">As senhas não coincidem!</p>';
                return;
            }

            const formData = {
                name_user: document.getElementById('name').value,
                email_user: document.getElementById('email').value,
                password_user: password,
                rule_user: 'backoffice'
            };

            try {
                const response = await fetch('/api/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    responseDiv.innerHTML = '<p style="color: #16a34a">Cadastro realizado com sucesso!</p>';
                    document.getElementById('registerForm').reset();
                } else {
                    const data = await response.json();
                    responseDiv.innerHTML = `<p style="color: var(--main-color)">Erro ao cadastrar. ${data.message || 'Verifique os dados.'}</p>`;
                }
            } catch (error) {
                responseDiv.innerHTML = '<p style="color: var(--main-color)">Erro de conexão.</p>';
            }
        });
    </script>
</body>
</html>
