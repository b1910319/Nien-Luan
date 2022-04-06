<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

</head>

<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br><br>
        <h1 class="text-center" style="font-weight: bold;">THANH TOÁN KHI NHẬN HÀNG </h1>
        <!-- <h4>Qúy khách vui lòng chọn hình thức thanh toán</h4> -->
        <form action="" method="POST">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hoantat'])) {
                $ma_khachhang = Session::get('login_ma');
                $gichu_khachhang = $_POST['ghichu_khachhang'];
                $insert_donhang = $donHang->insert_donhang($ma_khachhang, $gichu_khachhang);
                // header("Location: thongBao.php");
            }
            ?>
            <div class="row">
                <div class="col mt-4">
                    <table class="table table-hover">
                        <?php
                        $ma_khachhang = Session::get('login_ma');
                        $session_masp = Session::get('giohang_masanpham');
                        $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                        if ($ma_khachhang) {
                            if ($session_masp == NULL && $laysanpham_tugiohang == false) {
                                echo '';
                            } else {
                        ?>
                                <thead>
                                    <tr class="table-giohang-title">
                                        <th scope="col">STT</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Gía</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                        <?php
                            }
                        }
                        ?>

                        <tbody>
                            <?php
                            $ma_khachhang = Session::get('login_ma');
                            $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                            if ($laysanpham_tugiohang) {
                                $i = 0;
                                $tongTien = 0;
                                while ($resultDH = $laysanpham_tugiohang->fetch_assoc()) {
                                    $i++;
                                    $laytensanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                                    if ($laytensanpham) {
                                        $resultSP = $laytensanpham->fetch_assoc();
                                    }
                                    ?>
                                        <tr class="table-giohang-body">
                                            <th scope="row"><?php echo $i ?></th>
                                            <td>
                                                <?php
                                                // lấy hình ảnh
                                                $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultDH['ma_sanpham']);
                                                if ($layHinhAnh) {
                                                    while ($resultHA = $layHinhAnh->fetch_assoc()) {
                                                ?>
                                                        <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" class="card-img-top img-fluid" style="width: 150px !important;">
                                                <?php
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td>
                                                <?php echo $resultDH['soluong_sanpham'] ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($resultSP['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?>
                                            </td>
                                            <td>
                                                <?php
                                                $thanhTien = $resultDH['soluong_sanpham'] * $resultSP['gia_sanpham'];
                                                $tongTien += $thanhTien;
                                                echo number_format($thanhTien, 0, ',', '.') . ' <sup>đ</sup>';
                                                ?>
                                            </td>
                                            </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <?php
                                $ma_khachhang = Session::get('login_ma');
                                $session_masp = Session::get('giohang_masanpham');
                                $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                                if ($ma_khachhang) {
                                    if ($session_masp == NULL && $laysanpham_tugiohang == false) {
                                        ?>
                                            <center><img src="img/gio-hang/gio-hang-trong.png" class="img-fluid" style="width: 30%;"></center>
                                            <center><h4 style="font-weight: bold; color: #eb3007;">Đơn hàng của quý khách đặt thành công và đang chờ xử lý</h4></center>
                                        <?php
                                    } 
                                    else {
                                        ?>
                                            <div class="giohang-tamtinh">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Tạm tính </th>
                                                            <td style="text-align: right; font-weight: bold; color: #8f8fa7;">
                                                                <?php
                                                                echo number_format($tongTien, 0, ',', '.') . ' <sup>đ</sup>';
                                                                Session::set('tong', $tongTien);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Giảm giá </th>
                                                            <td style="text-align: right; font-weight: bold; color: #8f8fa7;">0
                                                                <sup>đ</sup>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Vận chuyển </th>
                                                            <td style="text-align: right; font-weight: bold; color: #8f8fa7;">MIỄN PHÍ
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="color: #038018;">TỔNG THANH TOÁN </th>
                                                            <td style="text-align: right; color: #eb3007; font-weight: bold; font-size: 20px;">
                                                                <?php echo number_format($tongTien, 0, ',', '.') . ' <sup>đ</sup>'; ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    $ma_khachhang = Session::get('login_ma');
                    $session_masp = Session::get('giohang_masanpham');
                    $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                    if ($ma_khachhang) {
                        if ($session_masp == NULL && $laysanpham_tugiohang == false) {
                            echo '';
                        } else {
                            ?>
                                <div class="col mt-4">
                                <table class="table">
                                    <?php
                                    $ma_nguoidung = Session::get('login_ma');
                                    $laythongtin_nguoidung = $nguoiDung->show_thongTin($ma_nguoidung);
                                    if ($laythongtin_nguoidung) {
                                        while ($result = $laythongtin_nguoidung->fetch_assoc()) {
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
                                                            <button class="btn btn-primary " style="width: 30%; background-color: #eb3007; border: none; font-weight: bold;">
                                                                <a href="suaThongTinKhachHang.php" style="color: white;">Update</a>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <div class=" mt-4">
                                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                                    <textarea name="ghichu_khachhang" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ghi chú của khách hàng"></textarea>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php
            $ma_khachhang = Session::get('login_ma');
            $session_masp = Session::get('giohang_masanpham');
            $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
            if ($ma_khachhang) {
                if ($session_masp == NULL && $laysanpham_tugiohang == false) {
                    echo '';
                } else {
                    ?>
                        <div class="row ">
                            <div class="col">
                                <input class="hoantat" type="submit" name="hoantat" class="btn btn-primary" value="HOÀN TẤT" type="button" style="width: 50%;">
                            </div>
                        </div>
                    <?php
                }
            }
            ?>
        </form>
        <br><br>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>