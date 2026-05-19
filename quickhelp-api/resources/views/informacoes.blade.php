<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/config.css') }}">
    <link rel="stylesheet" href="{{ asset('style/informacoes.css') }}">
    <link rel="stylesheet" href="{{ asset('style/sidebar.css') }}">
    <title>Informações - Quickhelp</title>
    <style>
        .btn-action { margin-top: 5px; padding: 5px 10px; cursor: pointer; border: none; border-radius: 5px; color: white; }
        .btn-edit { background-color: #3b82f6; }
        .btn-delete { background-color: #ef4444; }
        .btn-save { background-color: #10b981; }
        .edit-input { padding: 5px; margin: 2px 0; width: 100%; box-sizing: border-box; }
    </style>
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

            <div class="contatos">
                <div class="card-title">Contatos de Emergência</div>
                <div id="contactsList">Carregando...</div>
                <a href="/adicionar_contato" style="color: var(--main-purple); display: block; margin-top: 15px;">+ Adicione um contato</a>
            </div>

            <div class="enderecos">
                <div class="card-title">Endereços</div>
                <div id="addressList">Carregando...</div>
                <a href="/adicionar_endereco" style="color: var(--main-purple); display: block; margin-top: 15px;">+ Adicione um endereço</a>
            </div>
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

            loadData();
        }

        function escapeHTML(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function loadData() {
            // Load Contacts
            fetch('/api/contacts?id_user=' + user.id_user, { cache: 'no-store' })
                .then(r => r.json())
                .then(data => {
                    const list = document.getElementById('contactsList');
                    list.innerHTML = '';
                    if (data.length === 0) list.innerHTML = '<p>Nenhum contato cadastrado.</p>';
                    data.forEach(c => {
                        const div = document.createElement('div');
                        div.className = 'contact-item';
                        div.innerHTML = `
                            <div id="view-contact-${c.id_contact}">
                                <p><b>Nome:</b> ${escapeHTML(c.name_contact)}</p>
                                <p><b>Telefone:</b> ${escapeHTML(c.phone_contact)}</p>
                                <button class="btn-action btn-edit" onclick="editContact(${c.id_contact})">Editar</button>
                                <button class="btn-action btn-delete" onclick="deleteContact(${c.id_contact})">Deletar</button>
                            </div>
                            <div id="edit-contact-${c.id_contact}" style="display:none;">
                                <input type="text" id="c-name-${c.id_contact}" class="edit-input" value="${escapeHTML(c.name_contact)}" placeholder="Nome">
                                <input type="text" id="c-phone-${c.id_contact}" class="edit-input" value="${escapeHTML(c.phone_contact)}" placeholder="Telefone">
                                <button class="btn-action btn-save" onclick="saveContact(${c.id_contact})">Salvar</button>
                                <button class="btn-action btn-delete" onclick="cancelEditContact(${c.id_contact})">Cancelar</button>
                            </div>
                        `;
                        list.appendChild(div);
                    });
                });

            // Load Addresses
            fetch('/api/addresses?id_user=' + user.id_user, { cache: 'no-store' })
                .then(r => r.json())
                .then(data => {
                    const list = document.getElementById('addressList');
                    list.innerHTML = '';
                    if (data.length === 0) list.innerHTML = '<p>Nenhum endereço cadastrado.</p>';
                    data.forEach(a => {
                        const div = document.createElement('div');
                        div.className = 'contact-item';
                        div.innerHTML = `
                            <div id="view-address-${a.id_address}">
                                <p><b>Estado:</b> ${escapeHTML(a.state_address)}</p>
                                <p><b>Cidade:</b> ${escapeHTML(a.city_address)}</p>
                                <p><b>Bairro:</b> ${escapeHTML(a.neighborhood_address)}</p>
                                <p><b>Rua:</b> ${escapeHTML(a.street_address)}</p>
                                <p><b>Número:</b> ${escapeHTML(a.number_address)}</p>
                                <p><b>Complemento:</b> ${escapeHTML(a.complement_address || '')}</p>
                                <button class="btn-action btn-edit" onclick="editAddress(${a.id_address})">Editar</button>
                                <button class="btn-action btn-delete" onclick="deleteAddress(${a.id_address})">Deletar</button>
                            </div>
                            <div id="edit-address-${a.id_address}" style="display:none;">
                                <input type="text" id="a-state-${a.id_address}" class="edit-input" value="${escapeHTML(a.state_address)}" placeholder="Estado">
                                <input type="text" id="a-city-${a.id_address}" class="edit-input" value="${escapeHTML(a.city_address)}" placeholder="Cidade">
                                <input type="text" id="a-neigh-${a.id_address}" class="edit-input" value="${escapeHTML(a.neighborhood_address)}" placeholder="Bairro">
                                <input type="text" id="a-street-${a.id_address}" class="edit-input" value="${escapeHTML(a.street_address)}" placeholder="Rua">
                                <input type="text" id="a-num-${a.id_address}" class="edit-input" value="${escapeHTML(a.number_address)}" placeholder="Número">
                                <input type="text" id="a-comp-${a.id_address}" class="edit-input" value="${escapeHTML(a.complement_address || '')}" placeholder="Complemento">
                                <button class="btn-action btn-save" onclick="saveAddress(${a.id_address})">Salvar</button>
                                <button class="btn-action btn-delete" onclick="cancelEditAddress(${a.id_address})">Cancelar</button>
                            </div>
                        `;
                        list.appendChild(div);
                    });
                });
        }

        // Contact Actions
        function editContact(id) {
            document.getElementById('view-contact-'+id).style.display = 'none';
            document.getElementById('edit-contact-'+id).style.display = 'block';
        }
        function cancelEditContact(id) {
            document.getElementById('edit-contact-'+id).style.display = 'none';
            document.getElementById('view-contact-'+id).style.display = 'block';
        }
        async function saveContact(id) {
            const data = {
                name_contact: document.getElementById('c-name-'+id).value,
                phone_contact: document.getElementById('c-phone-'+id).value
            };
            await fetch('/api/contacts/'+id, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: JSON.stringify(data)
            });
            window.location.reload();
        }
        async function deleteContact(id) {
            if(confirm('Tem certeza?')) {
                await fetch('/api/contacts/'+id, { 
                    method: 'POST',
                    headers: {
                        'X-HTTP-Method-Override': 'DELETE'
                    }
                });
                window.location.reload();
            }
        }

        // Address Actions
        function editAddress(id) {
            document.getElementById('view-address-'+id).style.display = 'none';
            document.getElementById('edit-address-'+id).style.display = 'block';
        }
        function cancelEditAddress(id) {
            document.getElementById('edit-address-'+id).style.display = 'none';
            document.getElementById('view-address-'+id).style.display = 'block';
        }
        async function saveAddress(id) {
            const data = {
                state_address: document.getElementById('a-state-'+id).value,
                city_address: document.getElementById('a-city-'+id).value,
                neighborhood_address: document.getElementById('a-neigh-'+id).value,
                street_address: document.getElementById('a-street-'+id).value,
                number_address: document.getElementById('a-num-'+id).value,
                complement_address: document.getElementById('a-comp-'+id).value
            };
            await fetch('/api/addresses/'+id, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: JSON.stringify(data)
            });
            window.location.reload();
        }
        async function deleteAddress(id) {
            if(confirm('Tem certeza?')) {
                await fetch('/api/addresses/'+id, { 
                    method: 'POST',
                    headers: {
                        'X-HTTP-Method-Override': 'DELETE'
                    }
                });
                window.location.reload();
            }
        }

        document.getElementById('btnLogout').addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('user');
            window.location.href = '/login';
        });
    </script>
</body>
</html>
