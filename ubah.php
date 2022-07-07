<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
    
}
require 'functions.php';

//ambiil data di url
$id = $_GET["id"];



$ngubah = query("SELECT * FROM pasien WHERE id = $id")[0];


//cek apakah tombol submit telah ditekan atau belom

//cek apakah ngubah berhasil diubaha tau belom
if(isset($_POST["submit"])){
    if(ubah($_POST) > 0){
        echo "
        <script>
        alert('ngubah berhasil diubah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
        alert('ngubah gagal diubah');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>ubah data passien</title>
</head>
<body>
    <div class="judul">
    <h1>ubah data passien</h1>
    </div>
    <br>
    <form action="" method="POST" style="margin-left: 50px;">
    <input type="hidden" name="id" value="<?= $ngubah["id"];?>">
            <div class="mb-3">
                <label for="wilayah" class="form-label">wilayah</label>
                <input type="text" name="wilayah" class="form-control" id="wilayah"  style="width: 500px;" required
                value="<?=$ngubah["wilayah"]?>">
            </div>
            <div class="mb-3">
                <label for="positif" class="form-label">Positif</label>
                <input type="text"  name="positif" class="form-control" id="positif"  style="width: 500px;"required
                value="<?=$ngubah["positif"]?>" >
            </div>
            <div class="mb-3">
                <label for="dirawat" class="form-label">Dirawat</label>
                <input type="text" name="dirawat" class="form-control" id="dirawat"  style="width: 500px;" required
                value="<?=$ngubah["dirawat"]?>">
            </div>
            <div class="mb-3">
                <label for="sembuh" class="form-label">Sembuh</label>
                <input type="text" name="sembuh" class="form-control" id="sembuh"  style="width: 500px;" required
                value="<?=$ngubah["sembuh"]?>">
            </div>
            <div class="mb-3">
                <label for="meninggal" class="form-label">Meninggal</label>
                <input type="text" name="meninggal" class="form-control" id="meninggal"  style="width: 500px;" required
                value="<?=$ngubah["meninggal"]?>">
            </div>
            <div class="mb-3">
                <label for="operator" class="form-label">Operator</label>
                <input type="text" name="operator"  class="form-control" id="operator" style="width: 500px;" required
                value="<?=$ngubah["operator"]?>">
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="text" name="nim" class="form-control" id="nim"  style="width: 500px;" required
                value="<?=$ngubah["nim"]?>">
            </div>
        <button type="submit" name="submit" class="btn btn-primary">ubah data</button>
    </form>
</body>
</html>