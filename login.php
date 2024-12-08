<?php  
    session_start();
    require 'functions/functions.php';

    if($_COOKIE['id'] && $_COOKIE['key']){
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];
        $user = select("SELECT * FROM user WHERE id = $id")[0];
        
        if($user){
            // cek apakah username yang dihash di database sama dengan key di cookie;
            if(hash('sha256',$user['username']) == $key){
                $_SESSION['username'] = $user['username'];
                $_SESSION['login'] = true;
                $_SESSION['role'] = $user['role'];
            }
        }
    }

    if($_SESSION['login']){
        header('location:index.php');
        exit;
    }
    

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $checkUser = select("SELECT * FROM user WHERE username = '$username'")[0];

        $error = [];

        // check apakah username sudah ada didatabase atau tidak
        if($checkUser){
            // check apakah password sama dengan yg di db
            if(password_verify($password, $checkUser['password'])){
                // set cookie jika remember me dicentang
                if($_POST['remember']){
                    setcookie('id',$checkUser['id'],time() + (60 * 60 * 24) * 30);
                    setcookie('key',hash('sha256',$checkUser['username']),time() + (60 * 60 * 24) * 30);
                }
                $_SESSION['username'] = $checkUser['username'];
                $_SESSION['login'] = true;
                $_SESSION['role'] = $checkUser['role'];
                header('location:index.php');
                exit;
            }            
        }
        $error = ["error" => "all","message" => "username / password yang anda masukkan salah!"];
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

    <title>Inventaris - Login</title>

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
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-5">Login</h1>
                                    </div>
                                    <form action="" method="post" class="user">
                                        <?php if(isset($error['error'])){ ?>
                                            <p class="text-danger" style="font-size: 14px; margin: 0 0 5px 10px"><?= $error['message'] ?></p>
                                        <?php } ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="registrasi.php">Belum memiliki akun? daftar</a>
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