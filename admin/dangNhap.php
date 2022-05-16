<?php
    include_once("../class/adminLogin.php");
?>
<?php
    $adminLogin = new adminLogin ();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $userAdmin = $_POST['userAdmin'];
        $passAdmin = md5($_POST['passAdmin']) ;
        $loginCheck = $adminLogin->login($userAdmin, $passAdmin);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styleDangNhapAdmin.css">
    <title>Đăng nhập Admin</title>
</head>
<body>
    <!-- form đăng nhập của admin  -->
    <div class="container">
        <section id="content">
            <form action="dangNhap.php" method="POST">
                <h1>Đăng nhập</h1>
                <span style="color: #eb3007; font-weight: bold; ">
                    <?php
                        if (isset($loginCheck)){
                            echo $loginCheck;
                        }
                    ?>
                </span>
                <div>
                    <input type="text" placeholder="Username" id="username" name="userAdmin" />
                </div>
                <div>
                    <input type="password" placeholder="Password" id="password" name="passAdmin" />
                </div>
                <div>
                    <input type="submit" value="Đăng nhập" />
                </div>
            </form>
        </section>
    </div>
    <!--  -->
</body>

</html>