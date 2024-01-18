<?php
function hapusBuku($id_buku, $judul_buku)
{
    // Koneksi ke database
    $con = new mysqli("localhost", "root", "", "perpustakaan_abcd");

    // Periksa koneksi
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }

    // Escape string untuk mencegah SQL injection
    $id_buku = $con->real_escape_string($id_buku);

    // Query SQL untuk menghapus data dari tabel buku
    $query = "DELETE FROM mdt_buku WHERE id_buku = $id_buku";

    if ($con->query($query) === TRUE) {
        echo "Data buku berhasil dihapus";

        unlink("BUKU/".$judul_buku);
            echo "File berhasil dihapus";
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }

    // Tutup koneksi
    $con->close();
}
print_r($_GET);
$hapus = $_GET['id_buku'];
$judul_buku = $_GET['judul_buku'];
hapusBuku($hapus, $judul_buku);

header('location:buku_admin.php');
?>
