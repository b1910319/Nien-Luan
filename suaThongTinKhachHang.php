<?php
    include_once("class/nguoiDung.php");
    $nguoiDung = new nguoiDung();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br><br>
        <div class="container">
            <h3 class="text-center" style="font-weight: bold;">SỬA THÔNG TIN KHÁCH HÀNG</h3>
            <form action="" method="POST">
                <table class="table">
                    <?php
                        $ma_nguoidung = Session::get('login_ma');
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-info'])){
                            $update_info_nguoidung = $nguoiDung->update_info_nguoidung($_POST,$ma_nguoidung);
                        }
                    ?>
                    <?php
                        if (isset($update_info_nguoidung)){
                            echo $update_info_nguoidung;
                        }
                    ?>
                    <?php
                        $ma_nguoidung = Session::get('login_ma');
                        $laythongtin_nguoidung = $nguoiDung->show_thongTin($ma_nguoidung);
                        if ($laythongtin_nguoidung){
                            while ($result = $laythongtin_nguoidung->fetch_assoc()){
                                ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Họ tên: </th>
                                            <td><input class="boder-none" type="text" name="hoten" value="<?php echo $result['hoten_nguoidung'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Số điện thoại: </th>
                                            <td><input class="boder-none" type="text" name="sdt" value="<?php echo $result['sdt_nguoidung'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email: </th>
                                            <td><input class="boder-none" type="text" name="mail" value="<?php echo $result['email_nguoidung'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tên đăng nhập: </th>
                                            <td><input class="boder-none" type="text" name="user" value="<?php echo $result['user_nguoidung'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Địa chỉ</th>
                                            <td><input class="boder-none" type="text" name="diachi" value="<?php echo $result['diachi_nguoidung'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td >
                                                <a href="thongTinKhachHang.php">
                                                    <i class="fas fa-caret-left next-info"></i>
                                                </a>
                                            </td>
                                            <td >
                                                <input name="save-info" type="submit" class="btn btn-primary " value="Save" 
                                                style="width: 30%; background-color: #eb3007; border: none; font-weight: bold;">
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php
                            }
                        }
                    ?>
                </table>
            </form>
        </div>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>