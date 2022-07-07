<?php

$conn = mysqli_connect("localhost","root","","uas");


function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows=[];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data){
    global $conn;

    $wilayah = htmlspecialchars($data["wilayah"]);
    $positif = htmlspecialchars($data["positif"]);
    $dirawat = htmlspecialchars($data["dirawat"]);
    $sembuh = htmlspecialchars($data["sembuh"]);
    $meninggal = htmlspecialchars($data["meninggal"]);
    $operator = htmlspecialchars($data["operator"]);
    $nim = htmlspecialchars($data["nim"]);
    $query = "INSERT INTO pasien
    VALUES
    ('','$wilayah','$positif','$dirawat','$sembuh','$meninggal',
    '$operator','$nim')";
    mysqli_query($conn,$query);


    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM pasien WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;
    $id = $data["id"];
    $wilayah = htmlspecialchars($data["wilayah"]);
    $positif = htmlspecialchars($data["positif"]);
    $dirawat = htmlspecialchars($data["dirawat"]);
    $sembuh = htmlspecialchars($data["sembuh"]);
    $meninggal = htmlspecialchars($data["meninggal"]);
    $operator = htmlspecialchars($data["operator"]);
    $nim = htmlspecialchars($data["nim"]);


    $query = "UPDATE pasien SET 
    wilayah ='$wilayah',
    positif ='$positif',
    dirawat ='$dirawat',
    sembuh ='$sembuh',
    meninggal = '$meninggal',
    operator = '$operator',
    nim = '$nim'
    WHERE id = $id;

    ";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    //cek username sudah ada atau beelum
    $result = mysqli_query($conn,"SELECT username FROM user WHERE 
    username ='$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar!');
                </script>";
                return false;
    }



    //cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert ('Mohon masukan password yang sama');
                </script>";
                return false;
    } 

    //enkripsi password 
    $password = password_hash($password,PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn,"INSERT INTO user VALUES('','$username','$password')");

    return mysqli_affected_rows($conn);

    
}
?>