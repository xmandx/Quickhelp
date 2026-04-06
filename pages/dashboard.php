<?php
session_start();

if (!isset($_SESSION)) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/icon/favicon.png" type="image/x-icon">
  <title>Dashboard Backoffice - Quickhelp</title>

  <!-- CSS externo -->
  <link rel="stylesheet" href="../style/config.css">
  <link rel="stylesheet" href="../style/sidebar.css">
  <link rel="stylesheet" href="../style/dashboard.css">

  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <a href="../index.php">
          <img src="../assets/icon/logo-branca.png" alt="logo Quickhelp">
        </a>
      </div>
      <nav>
        <a href="">Inicio</a>
        <a href="">Informações</a>
        <a href="">Configurações</a>
        <a href="">Ajuda</a>
        <a href="../index.php">
          <button>Sair</button>
        </a>
        <button type="button" id="tema">
          <img src="../assets/icon/sol-branco.png" alt="Tema escuro">
        </button>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <div class="user-info">
          <input type="text" class="search-box" placeholder="Buscar...">
          <div class="user-profile">
            <div class="avatar"><?php echo substr($_SESSION['user_name'], 0, 1); ?></div>
            <span><?php echo $_SESSION['user_name']; ?></span>
            <span>▼</span>
          </div>
        </div>
      </div>

      <div class="mensagens">
        <div class="card-title">Mensagens</div>
        <?php
        include '../config/config.php';
        $sql = "SELECT * FROM message ORDER BY id_message DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="mensagem-item">';
            echo '<style>';
            echo '.mensagem-user { font-weight: bold; }';
            echo '.mensagem-text { color: #666; }';
            echo '.mensagem-date { font-size: 12px; color: #999; }';
            echo '</style>';
            echo '<div class="mensagem-user">' . $row["name_message"] . '</div>';
            echo '<div class="mensagem-text">' . $row["message_message"] . '</div>';
            echo '<div class="mensagem-date">' . date("d/m/Y H:i", strtotime($row["date_message"])) . '</div>';
            echo '<form method="POST">';
            echo '<input type="hidden" name="delete_message" value="' . $row["id_message"] . '">';
            echo '<button type="submit" class="delete-btn">Excluir</button>';
            echo '</form>';

            if (isset($_POST['delete_message'])) {
              $id = $_POST['delete_message'];

              $delete_sql = "DELETE FROM message WHERE id_message = $id";
              if (mysqli_query($conn, $delete_sql)) {
                echo '<script>alert("Mensagem excluída com sucesso!"); window.location.href = "dashboard.php";</script>';
              } else {
                echo '<script>alert("Erro ao excluir mensagem: ' . mysqli_error($conn) . '");</script>';
              }
            }
            echo '</div>';
          }
        } else {
          echo 'Nenhuma mensagem recente.';
        }
        ?>
      </div>

      <div class="dashboard-grid">
        <!-- Ocorrências -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Ocorrências</div>
            <a href="#" class="view-link">Visualizar</a>
          </div>
          <div class="metric-label">Ocorrências do DD/MM, AAAA</div>
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
        <!-- Localização -->
<div class="card">
  <div class="card-header">
    <div class="card-title">Localização & Distribuição</div>
    <a href="#" class="view-link">Visualizar</a>
  </div>

  <?php
    include '../config/config.php';

    $sql = "SELECT city_address, COUNT(*) as total 
            FROM adress 
            GROUP BY city_address";

    $result = mysqli_query($conn, $sql);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
  ?>

  <div class="chart-container">
    <canvas id="locationChart"></canvas>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const dados = <?php echo json_encode($data); ?>;

  console.log(dados); // debug (pode remover depois)

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

  const ctx = document.getElementById('locationChart').getContext('2d');

  new Chart(ctx, {
    type: 'bubble',
    data: {
      datasets: datasets
    },
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
</script>

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
          <div class="table-container">
            <?php
            $select = "SELECT name_user, total_sos FROM reincidencia LIMIT 5";
            $result = mysqli_query($conn, $select);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['total_sos'] > 0) {
                  echo '<div class="user-item">';
                  echo '<div class="user-avatar">' . substr($row['name_user'], 0, 1) . '</div>';
                  echo '<div class="user-name">' . $row['name_user'] . '</div>';
                  echo '<div class="user-count">' . $row['total_sos'] . '</div>';
                  echo '</div>';
                }
              }
            }
            ?>
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
  <script src="../script/dashboard.js"></script>
  <script src="../script/tema.js"></script>
</body>

</html>