
<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
    
}

require_once 'functions.php';

global $conn;

$pasien  = query("SELECT * FROM pasien");

$query = mysqli_query($conn,"SELECT wilayah,operator,nim FROM pasien");
$data = mysqli_fetch_assoc($query);
$hariIni = new DateTime();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK PRINT DATA DARI DATABASE DENGAN PHP - WWW.MALASNGODING.COM</title>
</head>
<body>
 
	<center>
 
		<h2>Data Pemantauan Covid 19 Wilayah <?=$data["wilayah"];?> </h2>
		<h4> per <?=strftime('%A %d %B %Y, %H:%M', $hariIni->getTimestamp()) ;?></h4>
        <h4><?=$data["operator"];?>/<?=$data["nim"];?></h4>
 
	</center>
 
	
 
	<table border="1" style="width: 100%">
		<tr>
			<th width="1%">No</th>
			<th>wilayah</th>
			<th>positif</th>
			<th>dirawat</th>
            <th>sembuh</th>
            <th>meninggal</th>
            <th>operator</th>
            <th>nim</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($conn,"SELECT * FROM pasien");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
        <td><?= $data["wilayah"];?></td>
            <td><?= $data["positif"];?></td>
            <td><?= $data["dirawat"];?></td>
            <td><?= $data["sembuh"];?></td>
            <td><?= $data["meninggal"];?></td>
            <td><?= $data["operator"];?></td>
            <td><?= $data["nim"];?></td>
		</tr>
		<?php 
		}
		?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>