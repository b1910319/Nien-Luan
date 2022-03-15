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
            <h1 class="text-center" style="font-weight: bold;">THÔNG TIN KHÁCH HÀNG</h1>
            <table class="table">
                <?php
                    $ma_nguoidung = Session::get('login_ma');
                    $laythongtin_nguoidung = $nguoiDung->show_thongTin($ma_nguoidung);
                    if ($laythongtin_nguoidung){
                        while ($result = $laythongtin_nguoidung->fetch_assoc()){
                            ?>
                                <tbody>
                                    <tr>
                                        <th scope="row">Họ tên: </th>
                                        <td><?php echo $result['hoten_nguoidung'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Số điện thoại: </th>
                                        <td><?php echo $result['sdt_nguoidung'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email: </th>
                                        <td><?php echo $result['email_nguoidung'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tên đăng nhập: </th>
                                        <td><?php echo $result['user_nguoidung'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Địa chỉ</th>
                                        <td><?php echo $result['diachi_nguoidung'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center " colspan="2">
                                            <a href="suaThongTinKhachHang.php">
                                                <button class="btn btn-primary " style="width: 30%; background-color: #eb3007; border: none; font-weight: bold;">Update</button>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>