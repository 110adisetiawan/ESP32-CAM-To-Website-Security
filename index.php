<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    @import url(http://fonts.googleapis.com/css?family=Open+Sans);
    /* apply a natural box layout model to all elements, but allowing components to change */

    .activity-feed {
      padding: 15px;
    }

    .activity-feed .feed-item {
      position: relative;
      padding-bottom: 20px;
      padding-left: 30px;
      border-left: 2px solid #e4e8eb;
    }

    .activity-feed .feed-item:last-child {
      border-color: transparent;
    }

    .activity-feed .feed-item:after {
      content: "";
      display: block;
      position: absolute;
      top: 0;
      left: -6px;
      width: 10px;
      height: 10px;
      border-radius: 6px;
      background: #fff;
      border: 1px solid #f37167;
    }

    .activity-feed .feed-item .date {
      position: relative;
      top: -5px;
      color: #8c96a3;
      text-transform: uppercase;
      font-size: 13px;
    }

    .activity-feed .feed-item .text {
      position: relative;
      top: -3px;
    }
  </style>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- API call -->
  <?php

  function http_request($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

  $data = http_request("https://project.prediksibbm.com/api/sensorView.php");
  $data = json_decode($data, TRUE);
  $dataGallery = http_request("https://project.prediksibbm.com/api/galleryTotal.php");
  $dataGallery = json_decode($dataGallery, TRUE);
  $viewGallery = http_request("https://project.prediksibbm.com/api/galleryView.php");
  $viewGallery = json_decode($viewGallery, TRUE);
  $malingTotal = http_request("https://project.prediksibbm.com/api/malingTotal.php");
  $malingTotal = json_decode($malingTotal, TRUE);
  $activity = http_request("https://project.prediksibbm.com/api/activity.php");
  $activity = json_decode($activity, TRUE);
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">EPS32-CAM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Data</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="gallery.php">
          <i class="bi bi-person"></i>
          <span>Gallery</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="container">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-12">
            <div class="row">

              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6 ">
                <div class="card info-card sales-card">


                  <div class="card-body">
                    <?php foreach ($data as $data) { ?>
                      <h5 class="card-title">SENSOR <span>| updated at : <?= $data["last_update"] ?></span></h5>
                      <h6 class="text-<?= ($data['sensor_setting'] == 0) ? 'danger' : 'success' ?>"><?= ($data["sensor_setting"] == 0) ? 'OFF' : 'ON' ?></h6>
                      <span class="text-<?= ($data['sensor_setting'] == 0) ? 'danger' : 'success' ?> small pt-1 fw-bold"><?= ($data["sensor_setting"] == 0) ? 'Mati' : 'Menyala' ?></span>
                      <form action="project.prediksibbm.com/api/sensorUpdate.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $data["id"]; ?>">
                        <input type="hidden" name="sensor_setting" id="sensor_setting" value="<?= ($data['sensor_setting'] == 0) ? '1' : '0' ?>">
                        <button type="submit" class="btn btn-<?= ($data['sensor_setting'] == 0) ? 'success' : 'danger' ?> mt-3"><i class="bi bi-power me-2"></i> <?= ($data['sensor_setting'] == 0) ? 'Power ON' : 'Power OFF' ?></button>
                      </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- End Sales Card -->



              <!-- Customers Card -->
              <div class="col-xxl-4 col-md-6">

                <div class="card info-card customers-card">


                  <div class="card-body">
                    <h5 class="card-title">Total Deteksi <span>| Bulan Ini</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-camera-fill"></i>
                      </div>
                      <?php foreach ($dataGallery as $dataGallery) { ?>
                        <div class="ps-3">
                          <h6 class=""><?= $dataGallery["Total"] ?></h6>
                          <a href="gallery.php" class="text-warning small pt-1 fw-bold">Klik disini!</a><span class="text-muted small pt-2 ps-1">Untuk melihat Data Keamanan</span>
                        <?php } ?>
                        <br><br>
                        </div>
                    </div>

                  </div>
                </div>

              </div><!-- End Customers Card -->

              <!-- Customers Card -->
              <div class="col-xxl-4 col-md-12 col-sm-12 col-xs-12">

                <div class="card info-card customers-card">


                  <div class="card-body">
                    <h5 class="card-title">Total Maling</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bell-fill"></i>
                      </div>
                      <?php foreach ($malingTotal as $malingTotal) { ?>
                        <div class="ps-3">
                          <h6 class="text-danger"><?= $malingTotal["Total"] ?></h6>
                          <a href="gallery.php" class="text-warning small pt-1 fw-bold">Klik disini!</a><span class="text-muted small pt-2 ps-1">Untuk melihat Data Keamanan</span>
                        <?php } ?>
                        <br><br>
                        </div>
                    </div>

                  </div>
                </div>

              </div><!-- End Customers Card -->

              <!-- Reports -->
              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">


                  <div class="card-body">
                    <h5 class="card-title">Deteksi Terbaru <span>/ recent</span></h5>
                    <!-- Line Chart -->
                    <div class="row justify-content-md-center">
                      <?php foreach ($viewGallery as $viewGallery) { ?>

                        <div>
                          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="https://project.prediksibbm.com/uploads/<?= $viewGallery['image'] ?>" class="w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block bg-dark opacity-50">
                                  <h5 class="text-white"><?= $viewGallery["name_sensor"] ?></h5>
                                  <p><?= $viewGallery["time"] ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Aktifitas <span>/ activity</span></h5>
                    <!-- Line Chart -->
                    <div class="activity-feed">
                      <?php $i = 0;
                      foreach ($activity as $activity) { ?>
                        <div class="feed-item">
                          <div class="date"><?= $activity['time']; ?></div>
                          <div class="text">!Terdeteksi pergerakan oleh <b><?= $activity['name_sensor']; ?></b> <?= ($i < 1) ? '- <a href="gallery.php"> cek aktivitas' : '' ?></a></div>
                        </div>
                      <?php $i++;
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>



            </div><!-- End Reports -->


          </div>
        </div><!-- End Left side columns -->



      </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Anybody Can Use This Website.
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>