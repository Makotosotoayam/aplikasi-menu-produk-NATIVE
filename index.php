<?php
    include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Ala Oshi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="kategori.php">Kategori</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </div>

    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .sidebar {
        position: fixed;
        top: 0; left: 0;
        width: 220px;
        height: 100vh;
        background-color: #f8f9fa;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #007bff;
    }
    .sidebar ul {
        list-style-type: none;
        padding-left: 0;
    }
    .sidebar ul li {
        margin-bottom: 15px;
    }
    .sidebar ul li a {
        text-decoration: none;
        color: #333;
        font-weight: 600;
    }
    .sidebar ul li a:hover {
        color: #007bff;
    }
    </style>

    <center><h1>Data Menu Produk</h1></center>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a></center>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Deskripsi</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT * FROM produk ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            if(!$result){
                die ("Query Error: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
            }

            $no = 1;
            while($row = mysqli_fetch_assoc($result))
            {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
                    <td>Rp <?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
                    <td>Rp <?php echo $row['harga_jual']; ?></td>
                    <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>          
                    <td>
                        <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                    </td>
                </tr>

            <?php
                $no++; //untuk nomor urut terus bertambah 1
            }
            ?>
        </tbody>
    </table>
</body>
</html>