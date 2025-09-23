// dashboard.js — versão robusta
console.log('dashboard.js carregado');

document.addEventListener('DOMContentLoaded', () => {
  // Verifica se Chart.js está disponível
  if (typeof Chart === 'undefined') {
    console.error('Chart.js não foi carregado. Verifique o <script> CDN em dashboard.html');
    return;
  }

  // helper para criar chart com segurança
  function safeCreateChart(canvasId, createFn) {
    const el = document.getElementById(canvasId);
    if (!el) {
      console.warn(`Canvas com id "${canvasId}" não encontrado.`);
      return null;
    }
    const ctx = el.getContext('2d');
    try {
      return createFn(ctx);
    } catch (err) {
      console.error(`Erro ao criar gráfico "${canvasId}":`, err);
      return null;
    }
  }

  // ajustes globais
  Chart.defaults.font.family = 'Segoe UI';
  Chart.defaults.plugins.legend.display = false;

  // Ocorrências (Bar)
  safeCreateChart('occurrencesChart', (ctx) => new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['01','02','03','04','05','06','07','08','09','10','11','12'],
      datasets: [{ data: [45,30,25,20,40,45,35,22,38,28,42,35], backgroundColor: '#7c3aed', borderRadius: 4, barThickness: 15 }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      scales: {
        y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { color: '#64748b' } },
        x: { grid: { display: false }, ticks: { color: '#64748b' } }
      }
    }
  }));

  // Atendimentos (Doughnut)
  safeCreateChart('attendanceChart', (ctx) => new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Canceladas','Pendentes','Concluídas'],
      datasets: [{ data: [40,32,28], backgroundColor: ['#a855f7','#7c3aed','#e2e8f0'], borderWidth: 0, cutout: '70%' }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: {
        legend: { display: true, position: 'bottom', labels: { usePointStyle: true, padding: 20, color: '#64748b' } }
      }
    }
  }));

  // Localização (Bubble)
  safeCreateChart('locationChart', (ctx) => new Chart(ctx, {
    type: 'bubble',
    data: {
      datasets: [
        { label: 'São Paulo', data: [{x:50,y:50,r:50}], backgroundColor: 'rgba(124,58,237,0.8)' },
        { label: 'Santo André', data: [{x:25,y:75,r:35}], backgroundColor: 'rgba(168,85,247,0.8)' },
        { label: 'Mauá', data: [{x:75,y:25,r:30}], backgroundColor: 'rgba(196,181,253,0.8)' }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      scales: { x: { display: false }, y: { display: false } },
      plugins: {
        legend: { display: true, position: 'bottom', labels: { usePointStyle: true, padding: 15, color: '#64748b' } },
        tooltip: {
          callbacks: { label: function(context) { return context.dataset.label + ': ' + Math.round(context.parsed.r) + '%'; } }
        }
      }
    }
  }));

  // Desempenho (Line)
  safeCreateChart('performanceChart', (ctx) => new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['01','02','03','04','05','06'],
      datasets: [{
        data: [2100,1900,2200,2400,2000,2568],
        borderColor: '#7c3aed',
        backgroundColor: 'rgba(124,58,237,0.1)',
        fill: true, tension: 0.4,
        pointBackgroundColor: '#7c3aed', pointBorderColor: '#ffffff', pointBorderWidth: 2, pointRadius: 4
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      scales: {
        y: { beginAtZero: false, grid: { color: '#f1f5f9' }, ticks: { color: '#64748b' } },
        x: { grid: { display: false }, ticks: { color: '#64748b' } }
      }
    }
  }));

  // Interatividade de menu
  document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
      document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Animação de entrada dos cards (se existirem)
  const cards = document.querySelectorAll('.card');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    setTimeout(() => {
      card.style.transition = 'all 0.5s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, index * 100);
  });

  // Atualização simulada do valor de desempenho
  setInterval(() => {
    const performanceValue = document.querySelector('.metric-value');
    if (!performanceValue) return;
    // remove tudo que não seja número
    const numeric = parseInt(performanceValue.textContent.replace(/\D/g, '') || '0', 10);
    const newValue = numeric + Math.floor(Math.random() * 10) - 5;
    performanceValue.textContent = newValue.toLocaleString('pt-BR');
  }, 5000);
});