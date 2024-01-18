<?php
 // Make sure to include your database connection file



include('koneksi.php');
//inisialisasi session
session_start();

//mengecek username pada session
if($_SESSION['role'] != 'admin' ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}





$no = 1;
$ambildata = mysqli_query($con, "SELECT * FROM mdt_buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark text-light'>
        <div class="container">
            <a href="index.php" class="navbar-brand">Selamat datang di Perpustakaan ABC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto pt-2 pb-2">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-light"></a>
                    </li>
                    <li class="nav-item ml-4">
                        <a href="logout.php" class="nav-link text-light"> LOGOUT </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron jumbotron-fluid bg-light" style="height:90vh">
        <div class="container">
            <h1 class="display-4 text-center mt-4"></h1>
            <p class="lead text-center">DAFTAR BUKU</p>
            <div>
                <a href="form_upload_buku_admin.php"><button type="button" class="btn btn-success">Upload Buku</button></a>
            </div>

            <table class='table table-bordered'>
                <thead class='table-secondary'>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Pengarang</th>
                        <th>Jenis Buku</th>
                        <th>Nama File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "
            <tr>
                <td>$no</td>
                <td>{$tampil['judul_buku']}</td>
                <td>{$tampil['deskripsi']}</td>
                <td>{$tampil['pengarang']}</td>
                <td>{$tampil['jenis_buku']}</td>
                <td>{$tampil['file']}</td>
                <td><a href='BUKU/{$tampil['file']}' target='_blank' class='btn btn-primary'>Baca<i class='bx bx-book-reader'></i></a> <a href='delete_buku.php?id_buku={$tampil['id_buku']}&judul_buku={$tampil['judul_buku']}' class='btn btn-danger'>Hapus</a></td>
            </tr>";
            $no++;
        }
    ?>








                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap requirements: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
