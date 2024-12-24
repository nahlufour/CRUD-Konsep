<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD System</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Pengguna</h2>
        
        <!-- Form Pencarian -->
        <form method="GET" action="" class="form-inline justify-content-center mb-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama pengguna" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="create.php" class="btn btn-success ml-2">Tambah Pengguna Baru</a>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mengambil parameter pencarian dari form
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Query SQL dengan pencarian
                    $sql = "SELECT * FROM pendaftar WHERE name LIKE '%$search%'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td>
                                    <a href='update.php?id=". $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?id=". $row["id"] . "' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Tidak Ada Data</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
