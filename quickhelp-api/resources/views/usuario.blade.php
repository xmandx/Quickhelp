<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('style/sidebar.css') }}">
    <title>Início - Quickhelp</title>
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
                <a href="#">Configurações</a>
                <a href="#">Ajuda</a>
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
            <article>
                <form id="sosForm">
                    <button type="submit">clique aqui</button>
                    <div id="sosResponse" style="margin-top: 10px;"></div>
                </form>
                <p>Em caso de emergência</p>
            </article>
            <!-- segunda section -->
            <section class="section2">
                <div class="cards">
                    <a href="/informacoes">
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
            <div id="sosHistoryContainer" style="display:none; gap:10px; flex-direction:column">
                <p class='subtitle'>Contatos de Emergência Acionados</p>
                <ul id="sosList"></ul>
            </div>
            <p id="noSosMsg">Nenhum SOS acionado recentemente.</p>
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
            
            // Load SOS history
            fetch('/api/sos')
                .then(r => r.json())
                .then(data => {
                    const mySos = data.filter(s => s.id_user === user.id_user);
                    if (mySos.length > 0) {
                        document.getElementById('sosHistoryContainer').style.display = 'flex';
                        document.getElementById('noSosMsg').style.display = 'none';
                        const ul = document.getElementById('sosList');
                        mySos.forEach(s => {
                            const li = document.createElement('li');
                            li.innerText = 'SOS acionado em: ' + new Date(s.date_sos).toLocaleString('pt-BR');
                            ul.appendChild(li);
                        });
                    }
                });
        }

        document.getElementById('sosForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const responseDiv = document.getElementById('sosResponse');
            
            try {
                const response = await fetch('/api/sos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ id_user: user.id_user })
                });

                if (response.ok) {
                    alert('Emergência acionada! A ajuda está a caminho.');
                    window.location.reload();
                } else {
                    responseDiv.innerHTML = '<p style="color:red;">Erro ao acionar o SOS.</p>';
                }
            } catch (error) {
                responseDiv.innerHTML = '<p style="color:red;">Erro de conexão.</p>';
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
