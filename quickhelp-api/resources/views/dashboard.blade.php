<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}" type="image/x-icon">
  <title>Dashboard Backoffice - Quickhelp</title>

  <!-- CSS externo -->
  <link rel="stylesheet" href="{{ asset('style/config.css') }}">
  <link rel="stylesheet" href="{{ asset('style/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('style/dashboard.css') }}">

  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
        <a href="/dashboard">Inicio</a>
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

      <div class="mensagens">
        <div class="card-title">Mensagens</div>
        <div id="messagesList">Carregando...</div>
      </div>

      <div class="dashboard-grid">
        <!-- Ocorrências -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Ocorrências</div>
            <a href="#" class="view-link">Visualizar</a>
          </div>
          <div class="metric-label" id="sosCount">Carregando...</div>
          <div class="chart-container"><canvas id="occurrencesChart"></canvas></div>
        </div>

        <!-- Atendimentos -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Atendimentos</div>
            <a href="#" class="view-link">Visualizar</a>
          </div>
          <div class="metric-label">De X-Y MM, AAAA</div>
          <div class="chart-container"><canvas id="attendanceChart"></canvas></div>
        </div>
      </div>

      <div class="bottom-grid">
        <!-- Localização -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Localização & Distribuição</div>
            <a href="#" class="view-link">Visualizar</a>
          </div>
          <div class="chart-container">
            <canvas id="locationChart"></canvas>
          </div>
        </div>

        <style>
          .chart-container {
            height: 300px;
          }
        </style>

        <!-- Reincidência -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Reincidência</div>
          </div>
          <div class="table-container" id="reincidenciaList">
            Carregando...
          </div>
        </div>

        <!-- Desempenho -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Desempenho Operacional</div>
            <a href="#" class="view-link">Visualizar</a>
          </div>
          <div class="metric-value">2,568</div>
          <div class="metric-label">De X-Y MM, AAAA</div>
          <div class="chart-container"><canvas id="performanceChart"></canvas></div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('script/dashboard.js') }}"></script>
  <script src="{{ asset('script/tema.js') }}"></script>

  <script>
    const user = JSON.parse(localStorage.getItem('user'));
    if (!user || user.rule_user !== 'backoffice') {
        window.location.href = '/login';
    } else {
        document.getElementById('userName').innerText = user.name_user;
        document.getElementById('userInitial').innerText = user.name_user.charAt(0).toUpperCase();
        loadDashboardData();
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

    async function loadDashboardData() {
        // Load Messages
        const msgRes = await fetch('/api/messages', { cache: 'no-store' });
        const messages = await msgRes.json();
        const ml = document.getElementById('messagesList');
        ml.innerHTML = '';
        if(messages.length === 0) {
            ml.innerHTML = '<p>Nenhuma mensagem recente.</p>';
        } else {
            messages.slice(0, 5).forEach(m => {
                ml.innerHTML += `
                    <div class="mensagem-item">
                        <style>
                        .mensagem-user { font-weight: bold; }
                        .mensagem-text { color: #666; }
                        .mensagem-date { font-size: 12px; color: #999; }
                        </style>
                        <div class="mensagem-user">${escapeHTML(m.name_message)}</div>
                        <div class="mensagem-text">${escapeHTML(m.message_message)}</div>
                        <div class="mensagem-date">${new Date(m.date_message).toLocaleString('pt-BR')}</div>
                        <button onclick="deleteMessage(${m.id_message})" style="margin-top:5px; background:red; color:white; border:none; padding:5px; border-radius:3px; cursor:pointer;">Excluir</button>
                    </div>
                `;
            });
        }

        // Load SOS Count
        const sosRes = await fetch('/api/sos', { cache: 'no-store' });
        const sosData = await sosRes.json();
        document.getElementById('sosCount').innerText = 'Ocorrências Totais: ' + sosData.length;

        // Load Reincidencia
        const usersRes = await fetch('/api/users', { cache: 'no-store' });
        const users = await usersRes.json();
        const rl = document.getElementById('reincidenciaList');
        rl.innerHTML = '';
        
        let usersWithSos = users.map(u => ({
            name: u.name_user,
            total: u.soses ? u.soses.length : 0
        })).filter(u => u.total > 0).sort((a,b) => b.total - a.total).slice(0,5);

        if(usersWithSos.length === 0) {
            rl.innerHTML = '<p>Nenhuma reincidência.</p>';
        } else {
            usersWithSos.forEach(u => {
                rl.innerHTML += `
                    <div class="user-item">
                        <div class="user-avatar">${escapeHTML(u.name.charAt(0).toUpperCase())}</div>
                        <div class="user-name">${escapeHTML(u.name)}</div>
                        <div class="user-count">${u.total}</div>
                    </div>
                `;
            });
        }

        // Load Addresses for Bubble Chart
        const addRes = await fetch('/api/addresses');
        const addresses = await addRes.json();
        
        const cityCounts = {};
        addresses.forEach(a => {
            cityCounts[a.city_address] = (cityCounts[a.city_address] || 0) + 1;
        });

        const locationData = Object.keys(cityCounts).map(city => ({
            city_address: city,
            total: cityCounts[city]
        }));

        renderLocationChart(locationData);
    }

    async function deleteMessage(id) {
        if(confirm("Tem certeza que deseja excluir?")) {
            await fetch('/api/messages/' + id, { 
                method: 'POST',
                headers: {
                    'X-HTTP-Method-Override': 'DELETE'
                }
            });
            window.location.reload();
        }
    }

    function renderLocationChart(dados) {
        const cores = [
            'rgba(124,58,237,0.8)',
            'rgba(168,85,247,0.8)',
            'rgba(196,181,253,0.8)',
            'rgba(59,130,246,0.8)'
        ];

        const datasets = dados.map((item, index) => ({
            label: item.city_address,
            data: [{
                x: Math.random() * 100,
                y: Math.random() * 100,
                r: Math.max(1, parseInt(item.total) * 20)
            }],
            backgroundColor: cores[index % cores.length]
        }));

        const canvas = document.getElementById('locationChart');
        // Destroy existing chart if any
        if(window.locChart) window.locChart.destroy();
        
        const ctx = canvas.getContext('2d');
        window.locChart = new Chart(ctx, {
            type: 'bubble',
            data: { datasets: datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            color: '#64748b'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.raw.r/20 + ' registros';
                            }
                        }
                    }
                }
            }
        });
    }

    document.getElementById('btnLogout').addEventListener('click', function(e) {
        e.preventDefault();
        localStorage.removeItem('user');
        window.location.href = '/login';
    });
  </script>
</body>
</html>
