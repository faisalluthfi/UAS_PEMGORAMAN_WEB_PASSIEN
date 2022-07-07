<?php 

session_start();
require 'functions.php';


//cek cookie

if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
    $id=$_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username

    if($key === hash('sha256',$row['username'])){
        $_SESSION['login'] = true;
    }

}

//cek session
if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1 ){
        //cek password

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password,$row["password"])){
            //set session
            $_SESSION["login"] = true;

            //cek rememberme

            if(isset($_POST["remember"])){
                //buat cookie

                setcookie('id',$row['id'],time()+60);
                setcookie('key',hash('sha256',$row['username']),time()+60);
            }
            
            header("Location: index.php");

            exit;
        }
    }

    $error = true;
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
    <title>Halaman Login</title>
    <style>
        body{
        background-image: url(img/sel.jpg);
        }
    </style>

</head>
<body >
    <div class="hal-login">
    <h1 style="color:white ;">Login</h1>

    <?php if(isset($error)) :?>
        <?= "<script>
            alert('Password/Username salah');            
            </script>";?>
     <?php endif; ?>

    <form action="" method="post" >
        
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" style="margin-left: 100px; color:white;">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" style="width: 200px; margin: auto ;">
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="margin-left: 100px; color:white;">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" style="width: 200px; margin:auto;">
  </div>
  <div class="mb-3 form-check" style="margin-left: 100px ; color: white; margin-top: -10px;">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
    <label class="form-check-label" for="exampleCheck1" >Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary" name="login" style="margin-left: 100px; background-color: white; color: black; border: 1px solid white;">Login</button>
  <button type="submit" class="btn btn-primary" name="login" style="margin-left: 200px; background-color: white; color: black; border: 1px solid white; margin-top: -65px;"><a href="registrasi.php" style="text-decoration: none;">Sign Up</a></button>
    </form>
    </div>
</body>
</html>