
<?php
session_start();
if($_SESSION['status']!="login"){
  header("location:../login.php?pesan=belumlogin");
}


$id_dokter = $_GET['id'];
include 'koneksi.php';
$data = mysqli_query($connect,"select * from dokter where id_dokter='$id_dokter'");
$d = mysqli_fetch_array($data);



if(isset($_POST['submit'])){
    $tanggal = $_POST['tanggal'];
    $norek = $_SESSION['norek'];
    $jam = $_POST['jam'];
    $id_dokter = $_GET['id'];

    $query1 = mysqli_query($connect, "INSERT INTO jadwal_dokter VALUES ('','$tanggal','$jam','$id_dokter')");

    include 'koneksi.php';
    $data1 = mysqli_query($connect,"select * from jadwal_dokter where id_dokter='$id_dokter'");
    $d1 = mysqli_fetch_array($data1);
    $id_jadwal = $d1['id_jadwal'];

    $query2 = mysqli_query($connect, "INSERT INTO pesanan VALUES ('','$norek','$id_jadwal')");
    if($query1 && $query2){
        header("location:idxUser.php");
    }else{
        header("location:DetailDok.php?pesan=gagal");
    }
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
    <link rel="stylesheet" href="../style.css" />
    <link rel="icon" type="image/x-icon" href="img/icon.png" />
    <style>
        .cek {
            visibility: hidden;
        }
        .klikk {
            text-align:center; 
            border-radius: 10px; 
            background-color: #919191;
            color : white;
        }
        .klikk.aktif{
            background-color: #182831;
            color: white;
        }
    </style>
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
    <br><br><br>
    <section style="background-image: url(gambar/bg3.jpg); background-size: cover;">
    <div class="container mt-5">
        <div class="row mt-5 ms-5 d-flex justify-content-center align-items-center">
            <div class="col mt-5 ms-5">
                <img class="w-50" src="gambar/dok1.png" alt="">
            </div>
            <div class="col mt-5">
                <h1><?= $d["nama"] ?></h1>
                <h6>Spesialis : <?= $d["spesialis"] ?> </h6>
                <h6>Pengalaman : <?= $d["pengalaman"] ?> </h6>
                <h6>Ruangan : <?= $d["ruangan"] ?> </h6>
                <h6>Harga : <?= $d["harga"] ?> </h6>
            </div>
        </div>
        <div class="ms-5" style="margin-top :160px; ">
            <div class="ms-5">
                <h1 class="mb-2 mt-5">Deskripsi</h1>
                <p style="text-align:justify;" class="mt-3"><?= $d["deskripsi"] ?></p>
            </div>
        </div>
        <div class="ms-5 mt-5">
            <div class="ms-5">
                <h1 class="mb-2 mt-5">Reservasi</h1>
                <p>Pilih tanggal untuk Konsultasi</p>
                <form action="" method="post">
                <div class="tanggal mx-auto d-flex justify-content-center">

                <?php
                $q1 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-01'");
                $cek1 = mysqli_num_rows($q1);
                $q2 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-02'");
                $cek2 = mysqli_num_rows($q2);
                $q3 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-03'");
                $cek3 = mysqli_num_rows($q3);
                $q4 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-04'");
                $cek4 = mysqli_num_rows($q4);
                $q5 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-05'");
                $cek5 = mysqli_num_rows($q5);
                $q6 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-06'");
                $cek6 = mysqli_num_rows($q6);
                $q7 = mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND jadwal = '2023-11-07'");
                $cek7 = mysqli_num_rows($q7);
                ?>

                <label for="tanggal1" class="<?=($cek1 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek1 < 3) ? "cursor:pointer;;" : "filter:opacity(0.4);" ;?> > Rab, 1 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal1" value="2023-11-1">
                <label for="tanggal2" class="<?=($cek2 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style= <?=($cek2 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Kam, 2 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal2" value="2023-11-2">
                <label for="tanggal3" class="<?=($cek3 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek3 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Jum, 3 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal3" value="2023-11-3">
                <label for="tanggal4" class="<?=($cek4 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek4 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Sen, 6 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal4" value="2023-11-6">
                <label for="tanggal5" class="<?=($cek5 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek5 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Sel, 7 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal5" value="2023-11-7">
                <label for="tanggal6" class="<?=($cek6 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek6 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Rab, 8 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal6" value="2023-11-8">
                <label for="tanggal7" class="<?=($cek7 >= 3) ? "penuh" : ""?> p-2 klikk mt-5" style=<?=($cek7 < 3) ? "cursor:pointer;;": "filter:opacity(0.4);" ;?> > Kam, 9 <br> Nov</label>
                <input type="checkbox" name="tanggal" class="cek m-2" id="tanggal7" value="2023-11-9">
                </div>
                <button type="button" class="btn btn-dark mt-3 mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Pesan</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="jam" id="jam1" value="09.00">
                        <label class="form-check-label" for="jam1">
                            Pukul 09.00
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="jam" id="jam2" value="12.00">
                        <label class="form-check-label" for="jam2">
                            Pukul 12.00
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="jam" id="jam3" value="15.00">
                        <label class="form-check-label" for="jam3">
                            Pukul 15.00
                        </label>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                    </div>
                </div>
                </div>
                </form>
            </div>
    </div>
    </section>
    <!-- HERO GRID -->
    <br><br><br>

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
      <script src="detail.js"></script>
    </div>
  </body>
</html>