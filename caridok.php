<?php
session_start();
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--FONT AWESOMW JS-->
    <!-- Font Awesome JS -->
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/x-icon" href="img/icon.png" />
    <title>Selamat Datang!</title>
  </head>
  <body class="overflow-x-hidden">
    <div id="home"></div>
    <!-- Navbar -->
    <nav id="nav1" class="navbar navbar-expand-lg bg-body-tertiary fixed-top pt-3">
      <div class="container-fluid">
        <button style="border-radius: 12px!important;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
          <ul class="navbar-nav text-center d-flex align-items-center">
            <li class="nav-item ">
            <a href="idxUser.php"><img src="gambar/sj.png" style="left: 5;" alt="" srcset=""><a class="navbar-brand" href="#"></a></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark ms-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Konsultasi
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Identifikasi Masalah Anda</a></li>
              </ul>
            </li>
            <li class=" ms-2 nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profil Dokter
              </a>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Cari dokter</a></li>
                <li><a class="dropdown-item" href="#">Rekomendasi dokter</a></li>
                <li><a class="dropdown-item" href="dok.php">Daftar dokter</a></li>
              </ul>
            </li>
            <li class=" ms-2 nav-item">
              <a class="nav-link active text-dark" aria-current="page" href="#">Tentang Kami</a>
            </li>
            <li class=" ms-2 nav-item">
              <button style="border-radius: 12px!important;" class="btn btn-outline-dark ms-5"><a class="nav-link active text-dark" href="admin/logout.php" aria-current="page">Logout</a></button>
            </li>
            <li class=" ms-2 nav-item">
              <button style="border-radius: 12px!important;" class="btn btn-dark bg-dark ms-4"><a class="nav-link active text-light" aria-current="page" href="pesananU.php">Jadwal Saya</a></button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
    <!-- HERO GRID -->
    <section class=" mb-5 mt-5 pt-5" style="background-image: url(gambar/bg.jpg); background-size: cover;">
        <h1 class="mt-5" style="margin-left: 285px;">Meet Our Team</h1>
        <div class="carddd d-flex justify-content-center align-items-center mt-5" >
        <?php
            include 'koneksi.php';
            $spesialis = $_POST['special'];
            $no = 1;
            $data = mysqli_query($connect,"select * from dokter WHERE spesialis = '$spesialis'");
            while($d = mysqli_fetch_array($data)){
            ?>
            <div class="card ms-5 text-dark" style="width: 18rem; border-radius: 40px!important">
                <a href="DetailDok.php?id=<?=$d["id_dokter"] ?>"><img src="gambar/dok1.png" class="card-img-top" alt="..."></a>
                <div class="card-body">
                  <p class="mb-0">Nama : <?= $d["nama"]?></p>
                  <p class="mb-0">Pengalaman : <?= $d["pengalaman"]?> Tahun</p>
                  <p class="mb-0">Spesialis : <?= $d["spesialis"]?></p>
                  <b><p class="mb-0">Harga : <?= $d["harga"]?></p></b>
                </div>
              </div>
            <?php
            }
            ?>
        </div>
    <!-- HERO GRID -->
    <br><br><br>
      <!-- inputGAMBAR -->
      <form  autocomplete="off" class="p-4 card-body mt-5 mx-auto shadow-lg" style="width: 50vw; border-radius: 12px!important; margin-bottom: 140px;">
        <div class="row">
            <div class="col ms-5 col-sm-4 px-2 mb-2 w">
                <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.25rem !important">
                    <span class="h6 small bg-white text-muted px-1">Spesialis</span>
                </label>
                <input autocomplete="false" type="text" class="form-control mt-2 p-3" id="input1">
            </div>
            <div class="col col-sm-4 px-2 mb-2">
                <label for="input2" class="ms-2 position-absolute" style="margin-top: -0.25rem !important">
                    <span class="h6 small bg-white text-muted px-1">Hari</span>
                </label>
                <input autocomplete="false" type="password" class="form-control mt-2 p-3" id="input2">
            </div>
            <div class="col col-sm-1 px-2 mb-2">
              <button style="border-radius: 12px!important;" class="btn btn-dark bg-dark text-light pt-2 pb-2 ps-5 pe-5" style="font-size: 10px;">Cari Jadwal</button>
          </div>
        </div>
      </form>
    </section>
      <!-- input -->
      <!-- Project -->
        <div class="bg-primary w-100 mt-5 pb-5">
          <h1 class="mx-auto text-center pt-5">Apa Yang Kami Tawarkan?</h1>
          <div class="row mt-5 d-flex justify-content-center grid gap-0 col-gap-5">
            <div class="col col-md-3 mt-5 pb-5">
              <h4>Identifikasi masalah anda</h4><br>
              <p style="font-size: 12px;">A pay as-you-go solution for: pallet storage, inventory management, fulfillment(e.g. pick and pack), in/out-bound solutions, and more.</p>
            </div>
            <div class="col col-md-3 mt-5 pb-5">
              <h4>Temukan orang yang tepat</h4><br>
              <p style="font-size: 12px;">Search and compare the best shipping rates among dozens of trusted logistic partners for the last mile delivery and freight.</p>
            </div>
            <div class="col col-md-3 mt-5 pb-5">
            <h4>Reservasi</h4><br>
            <p style="font-size: 12px;">Our packaging solutions are optimized for each individual customer and are selected based on on the customer’s specific needs and requirements.</p>
            </div>
          </div>
          <div class="row d-flex align-items-center justify-content-center pb-5">
            <div class="col col-sm-2 mt-4"><button style="border-radius: 12px!important;" class="btn ps-4 pe-4 pt-3 pb-3 ms-3 border border-dark bg-light text-dark">Buat Akun</button></div>
            <div class="col col-sm-2 mt-4"><button style="border-radius: 12px!important;" class="btn pb-3 pt-3 ps-4 pe-4 border border-light bg-dark text-light">Pesan Sekarang!</button></div>
          </div>
        </div>
      <!-- Project -->
      <!-- Footer -->
      <div class="px-3 pb-5 footer" style="background-color: #182831!important;">
        <div class="container">
          <div class="row ">
            <div class="col-lg-4 col-xs-12 mt-5">
              <img src="gambar/sj.png" class="mb-3" alt="" srcset="" style="filter: invert(100%);">
              <p class="pr-5 text-white-50 mb-1">ShipUp delivers an unparalleled customer service through dedicated customer teams, engaged people working in an agile culture, and a global footprint</p>
            </div>
            <div class="col-lg-2 col-xs-12 mt-5 ms-5 links">
              <h4 class="mt-lg-0 mb-3 mt-sm-3 text-light">Explore</h4>
              <ul class="m-0 p-0" style="list-style: none">
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">About Us</a></li>
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">Our Warehouses</a></li>
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">Blog</a></li>
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">News and Media</a></li>
                <br />
              </ul>
            </div>
            <div class="col-lg-1 col-xs-12 mt-5 ms-5 location">
              <h4 class="mt-lg-0 mb-3 mt-sm-4 text-light">Legal</h4>
              <ul class="m-0 p-0" style="list-style: none">
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">Terms</a></li>
                <li class="mb-1"><a class="text-decoration-none text-light" href="profile.html">Privacy</a></li>
                <br />
              </ul>
            </div>
            <div class="col-lg-3 col-xs-12 mt-5 ms-5 lsocial">
              <h4 class="mt-lg-0 mb-3 mt-sm-4 text-light">Social Media</h4>
              <div class="icon d-inline">
              <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                <!-- Facebook -->
                <a
                   class="btn btn-outline-light rounded-circle m-1"
                   class="text-white"
                   role="button"
                   ><i class="bi bi-facebook"></i
                  ></a>
    
                <!-- Twitter -->
                <a
                   class="btn btn-outline-light rounded-circle m-1"
                   class="text-white"
                   role="button"
                   ><i class="bi bi-twitter"></i
                  ></a>
    
                <!-- Google -->
                <a
                   class="btn btn-outline-light rounded-circle m-1"
                   class="text-white"
                   role="button"
                   ><i class="bi bi-google"></i
                  ></a>
    
                <!-- Instagram -->
                <a
                   class="btn btn-outline-light rounded-circle m-1"
                   class="text-white"
                   role="button"
                   ><i class="bi bi-instagram"></i
                  ></a>
              </div>
            </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col copyright">
              <p class=""><small class="text-white-50">© 2022. All Rights Reserved.</small></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <script src="script.js"></script>
    </div>
  </body>
</html>
