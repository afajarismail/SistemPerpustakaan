<?php
session_start();
if(!isset($_SESSION['role'])) header('location:index.php');
if($_SESSION['role'] == 'mhs') header('location:page_mhs.php');
if($_SESSION['role'] ==  'mhs-ta') header('location:page_mhs_ta.php');



include('koneksi.php'); 
$isAdmin = true; // Assume the user is an admin for simplicity.

if (!$isAdmin) {
    header("Location: login.php"); // Redirect non-admin users to the login page.
    exit();
}

// Example function to insert book data into the database.
function insertBook($judul_buku, $deskripsi, $pengarang, $jenis_buku, $id_admin, $file) {
    global $con;

    // Replace this with your actual query to insert book data into the database.
    $query = "INSERT INTO mdt_buku VALUES
            (NULL,'$judul_buku', '$deskripsi', '$pengarang', '$jenis_buku', '$id_admin', '$file', current_timestamp() )";
    $result = mysqli_query($con, $query);

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the book upload form submission
    print_r($_POST);
    echo "<br/><br/>";
    print_r($_FILES);

  
    $judul_buku = $_POST['judul_buku'];
    $deskripsi = $_POST['deskripsi'];
    $pengarang = $_POST['pengarang'];
    $jenis_buku= $_POST['jenis_buku'];
    $id_admin = $_POST['id_admin'];
    
    // Lokasi Penempatan file
    $dirUpload = "BUKU/"; // Adjust the destination folder path as needed
    $namaFile = $_FILES['file']['name'];
    $linkBerkas = $dirUpload . $namaFile;
    $file_tmp = $_FILES['file']['tmp_name'];
  
    // Move the uploaded file to the destination folder
    $terupload = move_uploaded_file($file_tmp, $linkBerkas);

    if ($terupload && insertBook($judul_buku, $deskripsi, $pengarang, $jenis_buku, $id_admin, $namaFile)) {
        echo "Upload berhasil!";
        header('location:buku_admin.php');
    } else {
        echo "Upload Gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Admin Page - Upload Book</title>
    <link rel="stylesheet" href="desainnya.css">
</head>
<body>
    <h1></h1>

    <h2></h2>
    <form action="form_upload_buku_admin.php" method="post" enctype="multipart/form-data">
        <label for="title">Judul:</label>
        <input type="text" name="judul_buku" required><br>

        <label for="author">Deskripsi:</label>
        <input type="text" name="deskripsi" required><br>

        <label for="author">Pengarang:</label>
        <input type="text" name="pengarang" required><br>
        
        <label for="author">Jenis Buku:</label>
        <select name="jenis buku" id="" >
            <option value="" selected>Pilih Jenis Buku</option>
            <option value="Buku Bacaan">Buku Bacaan</option>
            <option value="Buku Ajar(Diktat)">Buku Ajar(Diktat)</option>
        </select>
        
        <input type="hidden"  name="id_admin" value="<?=  $_SESSION['id'] ?>" >
        <br>
        <label for="file">Upload File:</label>
        <input type="file" name="file" accept="application/pdf" required><br>
        </br>
        <button type="submit">Upload Buku</button>
    </form>

    <!-- Add other admin features as needed -->
</body>
</html>
