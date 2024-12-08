<?php
    session_start();
    if($_SESSION['login']){
        header('location:index.php');
        exit;
    }

    require 'functions/functions.php';

    $error = [];
    if(isset($_POST['submit'])){
        // mengambil data yang di inputkan user dan meng-escape html elementnya
        $username = htmlspecialchars(strtolower(stripslashes($_POST['username'])));
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $pass_conf = mysqli_real_escape_string($db,$_POST['password_confirm']);
        
        $checkUser = select("SELECT * FROM user WHERE username = '$username'");
        if($pass_conf != $password){
            // check apakah password sama dengan ulangi password
            $error = ["error" => "pass", "messages" => "password tidak sama!"];
        }else if($checkUser){
            // check apakah sudah ada user dengan username yang di inputkan user
            $error = ["error" => "user", "messages" => "username telah digunakan!"];
        }else if(!$checkUser){
            // jika username belum digunakan enkripsi password dan insert ke table user
            $pass_encrypt = password_hash($password,PASSWORD_DEFAULT);
            basic_operation("INSERT INTO user(username,password) VALUES ('$username','$pass_encrypt')");
            $_SESSION['message'] = "akun berhasil dibuat";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventaris - Registrasi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center pt-5">
            <div class="col-lg-5 col-md-9 pt-4">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <?php if($_SESSION['message']){ ?>
                                <div class="col-12">
                                    <div class="card border-left-success shadow mx-5 mt-5">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase">
                                                        <?= $_SESSION['message'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } $_SESSION['message'] = false; ?>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-5">Buat Akun</h1>
                                    </div>
                                    <form action="" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" placeholder="Masukkan Username" required>
                                            <?php if($error['error'] == 'user'){ ?>
                                                <p class="text-danger mx-3"><?= $error['messages'] ?></p>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" required>
                                            <?php if($error['error'] == 'pass'){ ?>
                                                <p class="text-danger mx-3"><?= $error['messages'] ?></p>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirm" class="form-control form-control-user"
                                                id="password" placeholder="Ulangi Password" required>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Sudah memiliki akun? login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>