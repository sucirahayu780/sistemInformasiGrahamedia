<?php
session_start();
if (!isset($_SESSION['data'])) {
  header("Location: login.php");
}

require 'functions.php';

$queryIbu = "SELECT COUNT(*) as total FROM dataIbu";
$resultIbu = mysqli_query($conn, $queryIbu);
$dataIbu = mysqli_fetch_assoc($resultIbu);
$jumlahDataIbu = $dataIbu['total'];

$queryBalita = "SELECT COUNT(*) as total FROM dataBalita";
$resultBalita = mysqli_query($conn, $queryBalita);
$dataBalita = mysqli_fetch_assoc($resultBalita);
$jumlahDataBalita = $dataBalita['total'];

$queryPetugas = "SELECT COUNT(*) as total FROM user";
$resultPetugas = mysqli_query($conn, $queryPetugas);
$dataPetugas = mysqli_fetch_assoc($resultPetugas);
$jumlahDataPetugas = $dataPetugas['total'];

$queryStunting = "SELECT COUNT(*) as total FROM dataPenimbanganBalita WHERE keterangan='Stunting'";
$resultStunting = mysqli_query($conn, $queryStunting);
$dataStunting = mysqli_fetch_assoc($resultStunting);
$jumlahDataStunting = $dataStunting['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Informasi Posyandu</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/style.min.css" />
</head>

<body>
  <!-- ! Body -->
  <div class="page-flex">
    <!-- ! Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-start">

        <div class="sidebar-head">
          <a href="" class="logo-wrapper" title="Home">
            <span class="icon logo" aria-hidden="true"></span>
            <div class="logo-text">
              <span class="logo-title">Posyandu</span>
            </div>
          </a>

          <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle" aria-hidden="true"></span>
          </button>
        </div>

        <div class="sidebar-body">
          <ul class="sidebar-body-menu">

            <li>
              <a class="active" href="index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
            </li>

            <li>
              <a class="show-cat-btn" href="##">
                <span class="icon document" aria-hidden="true"></span>Master Data
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="dataIbu.php">Data Ibu</a>
                </li>
                <li>
                  <a href="dataBalita.php">Data Balita</a>
                </li>
                <li>
                  <a href="dataJenisImunisasi.php">Data Jenis Imunisasi</a>
                </li>
                <?php
                if ($_SESSION['data']['role'] == 1) {
                ?>
                  <li>
                    <a href="dataPetugas.php">Data Petugas</a>
                  </li>
                <?php
                }
                ?>
              </ul>
            </li>

            <li>
              <a class="show-cat-btn" href="##">
                <span class="icon category" aria-hidden="true"></span>Layanan
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="penimbanganBalita.php">Penimbangan Balita</a>
                </li>
                <li>
                  <a href="imunisasi.php">Imunisasi</a>
                </li>
              </ul>
            </li>

            <li>
              <a class="show-cat-btn" href="##">
                <span class="icon paper" aria-hidden="true"></span>Laporan
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="laporanKehadiran.php">Laporan Kehadiran</a>
                </li>
                <li>
                  <a href="laporanBalita.php">Laporan Balita</a>
                </li>
                <li>
                  <a href="laporanStatusGizi.php">Laporan Status Gizi</a>
                </li>
                <li>
                  <a href="laporanImunisasi.php">Laporan Imunisasi</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </aside>

    <div class="main-wrapper">
      <!-- ! Main nav -->
      <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-start">
            <h1>Sistem Informasi Posyandu</h1>
          </div>
          <div class="main-nav-end">
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
              <span class="sr-only">Toggle menu</span>
              <span class="icon menu-toggle--gray" aria-hidden="true"></span>
            </button>

            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>

            <div class="nav-user-wrapper">
              <a class="danger" href="logout.php">
                <i data-feather="log-out" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </nav>

      <!-- ! Main -->
      <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Dashboard</h2>
          <div class="row stat-cards">
            <div class="col-md-6 col-xl-3">
              <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                  <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                  <p class="stat-cards-info__num"><?= $jumlahDataIbu ?></p>
                  <p class="stat-cards-info__title">Total Data Ibu</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3">
              <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                  <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                  <p class="stat-cards-info__num"><?= $jumlahDataBalita ?></p>
                  <p class="stat-cards-info__title">Total Data Balita</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3">
              <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                  <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                  <p class="stat-cards-info__num"><?= $jumlahDataPetugas ?></p>
                  <p class="stat-cards-info__title">Total Data Petugas</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3">
              <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                  <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                  <p class="stat-cards-info__num"><?= $jumlahDataStunting ?></p>
                  <p class="stat-cards-info__title">Total Data Stunting</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </main>

      <!-- ! Footer -->
      <footer class="footer">
        <div class="container footer--flex">
          <div class="footer-start">
            <p>
              2024 © Sistem Informasi Posyandu
            </p>
          </div>
        </div>
    </div>
  </div>
  <!-- Chart library -->
  <script src="plugins/chart.min.js"></script>
  <!-- Icons library -->
  <script src="plugins/feather.min.js"></script>
  <!-- Custom scripts -->
  <script src="js/script.js"></script>
</body>

</html>