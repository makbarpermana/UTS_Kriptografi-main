<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data</title>
</head>
<body>
    <h1>Pencarian Data</h1>

    <form action="" method="get">
        <label for="id_customer">Cari Data:</label>
        <input type="text" id="id_customer" name="id_customer" required>
        <button type="submit">Cari</button>
    </form>

    <?php
    // Gabungkan dengan file koneksi.php
    include 'koneksi.php';
    require 'playfairchiper.php';
    $key = "key";

    // Proses pencarian ketika formulir dikirim
    if(isset($_GET['id_customer'])) {
        // Ambil data dari formulir pencarian
        $id_customer = $_GET['id_customer'];

        // Gunakan prepared statement untuk menghindari SQL injection
        $query = "SELECT * FROM customer WHERE id_customer LIKE ?";
        $stmt = $kon->prepare($query);
        $stmt->bind_param("s", $id_customer);
        $stmt->execute();
        $result = $stmt->get_result();

        // Tampilkan hasil pencarian
        if ($result->num_rows > 0) {
            echo "<h2>Hasil Pencarian untuk '$id_customer':</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" .$row['id_customer']. "</li>";
                echo "<li>" . playfairDecrypt($row['nama'], $key) . "</li>";
                echo "<li>" . playfairDecrypt($row['email'], $key) . "</li>";
                echo "<li>" .$row['no_hp']. "</li>"; 
                // Tambahkan kolom-kolom lain sesuai kebutuhan
            }
            echo "</ul>";
        } else {
            echo "<p>Tidak ada hasil pencarian untuk '$id_customer'.</p>";
        }

        // Tutup statement
        $stmt->close();
    }

    // Tutup koneksi
    $kon->close();
    ?>

</body>
</html>
