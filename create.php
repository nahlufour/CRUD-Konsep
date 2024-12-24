<?php
// Mengecek apakah form telah dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = substr(preg_replace('/[^0-9]/', '', $_POST["phone"]), 0, 13);

    // Membuat koneksi ke database
    $conn = new mysqli("localhost", "root", "", "crud_db");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error); // Mengecek apakah koneksi gagal  
    }

    // Menyusun Query untuk memasukkan data ke tabel users
    $sql = "INSERT INTO pendaftar (name, email, phone) VALUES ('$name', '$email', '$phone')";

    // Mengeksekusi query dan mengecek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        header("location: index.php"); // Redirect ke halaman utama jika berhasil
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup Koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Pengguna</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Tambah Pengguna</h4>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS dan Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
