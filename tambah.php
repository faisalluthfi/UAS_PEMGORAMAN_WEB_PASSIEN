<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
    
}

require 'functions.php';


if(isset($_POST["submit"])){


    if(tambah($_POST) > 0){
        echo "
        <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
        alert('data gagal ditambahkan');
        </script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS_PemogramanWeb2</title>
    <style type="text/css">
        input[type=submit] {
            padding: 5px 20px;
            background-color: #4169E1;
            color: whitesmoke;
            margin-left: 10px;
            margin-right: 20px;
        }

        input[type="number"] {
            width: 310px
        }

        table {
            background: -webkit-linear-gradient(30deg, #ADD8E6, #D3D3D3);
        }
    </style>
</head>

<body>
    <form method="POST" action="">
        <table align="center" border="3" cellpadding="2" cellspacing="5">
            <tr align="center">
                <td>
                    <h2><b>Silahkan Input Data Covid-19</b></h2>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="500px" border=0 cellpadding="0" cellspacing="10" align="center">
                        <tr>
                            <td>Wilayah</td>
                            <td> : </td>
                            <td>
                                <select name="wilayah" id="wilayah">
                                    <option value=""> ------------------------ Pilih Wilayah -----------------------</option>
                                    <?php
                                    $wilayah = array("DKI Jakarta", "Jawa Barat", "Banten", "Jawa Tengah");

                                    foreach ($wilayah as $val) {
                                    ?>
                                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Positif</td>
                            <td> : </td>
                            <td><input type="number" name="positif"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Dirawat</td>
                            <td> : </td>
                            <td><input type="number" name="dirawat"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Sembuh</td>
                            <td> : </td>
                            <td><input type="number" name="sembuh"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Meninggal</td>
                            <td> : </td>
                            <td><input type="number" name="meninggal"></td>
                        </tr>
                        <tr>
                            <td>Nama Operator</td>
                            <td> : </td>
                            <td><input type="text" name="operator" size="40"></td>
                        </tr>
                        <tr>
                            <td>Nim Mahasiswa</td>
                            <td> : </td>
                            <td><input type="text" name="nim" size="40"></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <input type="submit" name="simpan" value="Simpan">
                            </td>
                        </tr>
                    </table>
                    <a class="adddata"  href="logout.php">logout</a>
                </td>
            </tr>
        </table>
    </form>

    <?php
    date_default_timezone_set('Asia/Jakarta');

    if (isset($_POST['simpan'])) {
        $wilayah = $_POST['wilayah'];
        $positif = (int) $_POST['positif'];
        $dirawat = (int)$_POST['dirawat'];
        $sembuh = (int)$_POST['sembuh'];
        $meninggal = (int)$_POST['meninggal'];
        $operator = $_POST['operator'];
        $nim = $_POST['nim'];
        $waktu = date('d F Y H:i:s');

        $namafile = "data.txt";
        $file = fopen($namafile, "w") or die('File tidak bisa dibuka:  ' . $namafile);

        fprintf($file, "%60s %12s %10s", "", "", "Data Pemantaun Covid19 Wilayah " . $wilayah . "\n");
        fprintf($file, "%60s %20s %10s", "", "", "Per " . $waktu . "\n");
        fprintf($file, "%60s %14s %10s", "", "", $operator . " / " . $nim . "\n\n");
        fprintf($file, "%60s %10s", "", "--------------------------------------------------------------------\n");
        fprintf($file, "%60s |%10s     | %10s     | %10s     | %5s   |", "", "Positif", "Dirawat", "Sembuh", "   Meninggal");
        fprintf($file, "%-61s %10s", "\n", "--------------------------------------------------------------------\n");
        fprintf($file, "%60s |   %-10s  |     %-10s |     %-10s |     %-10s |", "", number_format($positif, 0, ",", "."), number_format($dirawat, 0, ",", "."), number_format($sembuh, 0, ",", "."), number_format($meninggal, 0, ",", "."));
        fprintf($file, "%-61s %10s", "\n", "--------------------------------------------------------------------");

        fclose($file);

        echo "<h1>Hasil Output : <a href=" . $namafile . ">" . $namafile . "</a></h1>";
        echo '<script type="text/javascript">alert("Data berhasil disimpan Ke dalam file ' . $namafile . ' !")</script>';
    }
    ?>
</body>

</html>