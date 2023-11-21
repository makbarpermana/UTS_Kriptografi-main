<?php
// Include file koneksi ke database
include "koneksi.php";
require "playfairchiper.php";
$key = "key";

// Menerima nilai dari kiriman form pendaftaran
$id_customer    = random_int(1000,10000);
$nama = playfairEncrypt($_POST["nama"],$key);
$email = playfairEncrypt($_POST["email"],$key);
$no_hp = $_POST["no_hp"];

// Query input menginput data ke dalam tabel customer
	$sql = "insert into customer (id_customer,nama,email,no_hp) VALUES
        ('$id_customer','$nama','$email','$no_hp')";

// Mengeksekusi/menjalankan query di atas
	$hasil=mysqli_query($kon,$sql);
// Kondisi apakah berhasil atau tidak
if ($hasil) {
    // Jika berhasil, ambil ID terakhir yang dimasukkan
    $id_customer = mysqli_insert_id($kon);

    // Tampilkan hasil ID
    echo "Berhasil simpan data anggota. ID terakhir: $id_customer"; 

    // Tambahkan tombol Kembali
    echo "<br><br><a href='form-pendaftaran.php'>Kembali</a>";
    exit;
} else {
    echo "Gagal simpan data customer";

    // Tambahkan tombol Kembali
    echo "<br><br><a href='form-pendaftaran.php'>Kembali</a>";
    exit;
}
?>
