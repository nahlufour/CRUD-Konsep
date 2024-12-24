<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "crud_db");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "DELETE FROM pendaftar WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Menampilkan pesan sukses dan kembali ke halaman utama setelah 2 detik
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <title>Data Terhapus</title>
        </head>
        <body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="container text-center">
                <div class="alert alert-success" role="alert">
                    Data berhasil dihapus! Anda akan diarahkan kembali ke halaman utama dalam beberapa detik.
                </div>
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = "index.php";
                }, 2000);
            </script>
        </body>
        </html>
        ';
    } else {
        // Menampilkan pesan error jika gagal menghapus
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <title>Error</title>
        </head>
        <body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="container text-center">
                <div class="alert alert-danger" role="alert">
                    Terjadi kesalahan: ' . $conn->error . '
                </div>
                <a href="index.php" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
            </div>
        </body>
        </html>
        ';
    }

    $conn->close();
}
?>
