<?php
include_once("class/nguoiDung.php");
$nguoiDung = new nguoiDung();
include_once("class/tinh.php");
$tinh = new tinh();
include_once("class/huyen.php");
$huyen = new huyen();
include_once("class/xa.php");
$xa = new xa();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/styleDangKy_DangNhap.css">
    <script src="js/jquery-3.6.0.min.js"></script>

    <!-- lấy huyện theo tinh  -->
    <script>
        $(document).ready(function() {
            $('#tinh').change(function() {
                var matinh = $(this).val();
                // alert(matinh);
                $.ajax({
                    url: "danhSachHuyen.php",
                    method: "POST",
                    data: {
                        idtinh: matinh
                    },
                    success: function(data) {
                        $('#huyen').html(data);
                    }
                });
            });
        });
    </script>
    <!--  -->
    <!-- lấy xã theo huyện -->
    <script>
        $(document).ready(function() {
            $('#huyen').change(function() {
                var mahuyen = $(this).val();
                // alert(matinh);
                $.ajax({
                    url: "danhSachXa.php",
                    method: "POST",
                    data: {
                        idhuyen: mahuyen
                    },
                    success: function(data) {
                        $('#xa').html(data);
                    }
                });
            });
        });
    </script>
    <!--  -->
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangky'])) {
    $inset_nguoidung = $nguoiDung->insert_nguoidung($_POST);
}
?>

<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <!--  -->
        <!-- đăng ký  -->
        <br><br><br>
        <div class="container">
            <div class="login-box" style="margin-top: 25%;">
                <h2>ĐĂNG KÝ</h2>
                <form action="" method="POST">
                    <?php
                    if (isset($inset_nguoidung)) {
                        echo $inset_nguoidung;
                    }
                    ?>
                    <div class="user-box">
                        <input type="text" name="hoten" required="">
                        <label>Họ và tên</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="sdt" required="">
                        <label>Số điện thoại</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="mail" required="">
                        <label>Email</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="user" required="">
                        <label>Username</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="pass" required="">
                        <label>Password</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="user-box">
                                <select class="form-select" aria-label="Default select example" name="tinh" id="tinh">
                                    <option selected>Chọn Tỉnh/Thành phố</option>
                                    <?php
                                    $laytinh = $tinh->show_tinh();
                                    if ($laytinh) {
                                        while ($resultT = $laytinh->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $resultT['ma_tinh'] ?>"><?php echo $resultT['ten_tinh'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="user-box">
                                <select class="form-select" aria-label="Default select example" name="huyen" id="huyen">
                                    <option selected>Chọn Quận/Huyện</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="user-box">
                                <select class="form-select" aria-label="Default select example" name="xa" id="xa">
                                    <option selected>Chọn Xã/Phường</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="user-box mt-3">
                        <input type="text" name="diachi" required="" min="20">
                        <label>Địa chỉ</label>
                    </div>
                    <button type="submit" name="dangky">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            ĐĂNG KÝ
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>