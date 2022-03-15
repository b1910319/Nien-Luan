<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br><br>
        <h1 class="text-center" style="font-weight: bold;">LỊCH SỬ ĐƠN HÀNG</h1>
        <div class="row">
            <div class="col">
                <?php
                    if (isset($_GET['maDH'])){
                        $maDH = $_GET['maDH'];
                        $thoigian = $_GET['thoigian'];
                        $donhang_danhan = $donHang->donhang_danhan($maDH, $thoigian);
                    }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-giohang-title">
                            <th scope="col">STT</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Gía</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ma_khachhang = Session::get('login_ma');
                        $laysanpham_tudonhang = $donHang->lay_donhang($ma_khachhang);
                        if ($laysanpham_tudonhang) {
                            $i = 0;
                            $tongTien = 0;
                            while ($resultDH = $laysanpham_tudonhang->fetch_assoc()) {
                                $i++;
                                $laytensanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                                if ($laytensanpham){
                                    $resultSP = $laytensanpham->fetch_assoc();
                                }
                                ?>
                                    <tr class="table-giohang-body">
                                        <th><?php echo $i; ?></th>
                                        <td scope="row"><?php echo $resultDH['ngay_dathang'] ?></td>
                                        <td>
                                            <?php
                                            // lấy hình ảnh
                                            $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultDH['ma_sanpham']);
                                            if ($layHinhAnh) {
                                                while ($resultHA = $layHinhAnh->fetch_assoc()) {
                                            ?>
                                                    <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" class="card-img-top img-fluid" style="width: 150px;!important">
                                            <?php
                                                    break;
                                                }
                                            }
                                            // 
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
                                        <td>
                                            <?php
                                                if ($resultDH['tinhtrang_donhang'] == 0){
                                                    echo '<a href="#" style="color: #eb3007; font-weight: bold;">Đang chờ xử lý</a>';
                                                }
                                                elseif ($resultDH['tinhtrang_donhang'] == 1){
                                                    ?>
                                                        <a href="?maDH=<?php echo $resultDH['ma_donhang'] ?>&thoigian=<?php echo $resultDH['ngay_dathang'] ?>" style="color: #038018;font-weight: bold;">Đã nhận hàng</a>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <a href="chiTietSanPham.php?masp=<?php echo $resultDH['ma_sanpham'] ?>" style="color: #9100c4;font-weight: bold;">Mua lại</a>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>