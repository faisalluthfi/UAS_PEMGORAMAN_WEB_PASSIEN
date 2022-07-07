<?php
require 'functions.php';
global $conn;
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
    
}


$pasien  = query("SELECT * FROM pasien");

$query = mysqli_query($conn,"SELECT wilayah FROM pasien");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class="judul">
    <h1>Daftar Pasien Covid <?=$data['wilayah'];?></h1>
    <br>
    <a class="adddata" href="index.php" style="margin-left:10px ;">Tambah data pasien</a>
    <a class="adddata"  href="logout.php">logout</a>
    
    </div>
    
    <form action="" method="post">
    <input type="text" name="keyword" class="form-control" id="nama"  style="width: 300px; margin:20px 20px 10px 10px;" autofocus
    placeholder="Masukan Keyword Pencarian" autocomplete="off">
    <button type="submit" name="cari" class="btn btn-primary" style="margin:5px 5px 10px 10px">Cari Data</button>
    <br>
    
    
    
    <div class="container">
    <hr>
    <table class="table table-striped">
        <tr>
            <td>No.</td>
            <td>Aksi.</td>
            <td>Wilayah</td>
            <td>positif</td>
            <td>dirawat</td>
            <td>sembuh</td>
            <td>meninggal</td>
            <td>operator</td>
            <td>nim</td>
        </tr>
        <?php $i = 1 ;?>
        <?php foreach ($pasien as $row) :?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                
                <a href="ubah.php?id=<?=$row["id"];?>">rubah</a>
                <a href="hapus.php?id=<?=$row["id"];?>" onclick="return confirm('yakin?');">hapus</a>
                <a href="laporan-pdf.php">export to pdf</a>
                
                </div>
            </td>
            
            <td><?= $row["wilayah"];?></td>
            <td><?= $row["positif"];?></td>
            <td><?= $row["dirawat"];?></td>
            <td><?= $row["sembuh"];?></td>
            <td><?= $row["meninggal"];?></td>
            <td><?= $row["operator"];?></td>
            <td><?= $row["nim"];?></td>

        </tr>
        <?php $i++;?>
        <?php endforeach;?>
    </table>
    <form action="" method="POST">
    <button type="submit" name="cetak" class="btn btn-primary" style="margin:5px 5px 10px 10px">Cetak Data</button>
    </form>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    
    // if (isset($_POST['cetak'])) {
    //         $wilayah = $row['wilayah'];
    //         $positif = $row['positif'];
    //         $dirawat = $row['dirawat'];
    //         $sembuh = $row['sembuh'];
    //         $meninggal = $row['meninggal'];
    //         $operator =$row['operator'];
    //         $nim = $row['nim'];
    //         $waktu = date('d F Y H:i:s');
    
    //         $namafile = "data.pdf";
    //         $file = fopen($namafile, "w") or die('File tidak bisa dibuka:  ' . $namafile);
    
    //         fprintf($file, "%60s %12s %10s", "", "", "Data Pemantaun Covid19 Wilayah " . $wilayah . "\n");
    //         fprintf($file, "%60s %20s %10s", "", "", "Per " . $waktu . "\n");
    //         fprintf($file, "%60s %14s %10s", "", "", $operator . " / " . $nim . "\n\n");
    //         fprintf($file, "%60s %10s", "", "--------------------------------------------------------------------\n");
    //         fprintf($file, "%60s |%10s     | %10s     | %10s     | %5s   |", "", "Positif", "Dirawat", "Sembuh", "   Meninggal");
    //         fprintf($file, "%-61s %10s", "\n", "--------------------------------------------------------------------\n");
    //         fprintf($file, "%60s |   %-10s  |     %-10s |     %-10s |     %-10s |", "", number_format($positif, 0, ",", "."), number_format($dirawat, 0, ",", "."), number_format($sembuh, 0, ",", "."), number_format($meninggal, 0, ",", "."));
    //         fprintf($file, "%-61s %10s", "\n", "--------------------------------------------------------------------");
    
    //         fclose($file);
    
    //         echo "<h1>Hasil Output : <a href=" . $namafile . ">" . $namafile . "</a></h1>";
    //         echo '<script type="text/javascript">alert("Data berhasil disimpan Ke dalam file ' . $namafile . ' !")</script>';
    //     }
    //     ?>
    
    </div>
    
</body>
</html>






