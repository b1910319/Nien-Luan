<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/styleDangKy_DangNhap.css">
    </head>
<body>
    <div class="container-fluid">
        <?php include ("include/header.php") ?>
        <?php
            include_once("class/nguoiDung.php");
            $nguoiDung = new nguoiDung();
        ?>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangnhap'])) {
                $login_nguoidung = $nguoiDung->login_nguoidung($_POST);
            }
        ?>
        <!--  -->
        <!-- đăng nhập  -->
        <br><br><br>
        <div class="container">
            <div class="login-box" style="margin-top: 15%;">
                <h2>ĐĂNG NHẬP</h2>
                <?php
                    if (isset($login_nguoidung)){
                        echo $login_nguoidung;
                    }
                ?>
                <form action="" method="POST">
                    <div class="user-box">
                        <input type="text" name="user" required="">
                        <label>Username</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="pass" required="">
                        <label>Password</label>
                    </div>
                    <button type="submit" name="dangnhap">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            ĐĂNG NHẬP
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>