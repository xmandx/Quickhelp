<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/adicionar_contato.css') }}">
    <link rel="stylesheet" href="{{ asset('style/sidebar.css') }}">
    <title>Adicionar Contato - Quickhelp</title>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('assets/icon/logo-branca.png') }}" alt="logo Quickhelp">
                </a>
            </div>
            <nav>
                <a href="/usuario">Inicio</a>
                <a href="/informacoes">Informações</a>
                <a href="">Configurações</a>
                <a href="">Ajuda</a>
                <a href="#" id="btnLogout">
                    <button>Sair</button>
                </a>
                <button type="button" id="tema">
                    <img src="{{ asset('assets/icon/sol-branco.png') }}" alt="Tema escuro">
                </button>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="user-info">
                    <input type="text" class="search-box" placeholder="Buscar...">
                    <div class="user-profile">
                        <div class="avatar" id="userInitial"></div>
                        <span id="userName">Carregando...</span>
                        <span>▼</span>
                    </div>
                </div>
            </div>

            <form id="contactForm" style="max-width: 58%">
                <p class="title"><b>Adicionar contato</b></p>
                <div class="input">
                    <input type="text" name="name" id="name" placeholder="Nome" required>
                </div>
                <div class="input">
                    <input type="tel" name="phone" id="phone" placeholder="Telefone" required>
                </div>
                <div class="info">
                    <button type="submit">Enviar</button>
                </div>
                <div id="form-response" style="margin-top: 10px; font-weight: bold;"></div>
            </form>
        </div>
    </div>
    <script src="{{ asset('script/tema.js') }}"></script>
    <script>
        const user = JSON.parse(localStorage.getItem('user'));
        if (!user) {
            window.location.href = '/login';
        } else {
            document.getElementById('userName').innerText = user.name_user;
            document.getElementById('userInitial').innerText = user.name_user.charAt(0).toUpperCase();
        }

        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const responseDiv = document.getElementById('form-response');
            
            const formData = {
                id_user: user.id_user,
                name_contact: document.getElementById('name').value,
                phone_contact: document.getElementById('phone').value
            };

            try {
                const response = await fetch('/api/contacts', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    window.location.href = '/informacoes';
                } else {
                    responseDiv.innerHTML = '<p style="color:var(--main-color);">Erro ao adicionar contato!</p>';
                }
            } catch (error) {
                responseDiv.innerHTML = '<p style="color:var(--main-color);">Erro de conexão.</p>';
            }
        });

        document.getElementById('btnLogout').addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('user');
            window.location.href = '/login';
        });
    </script>
</body>
</html>
