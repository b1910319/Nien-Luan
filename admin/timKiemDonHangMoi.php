<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/sanPham.php") ?>
    <?php 
        include_once("../class/donHang.php");
        $donHang = new donHang();
    ?>
    <?php
        include_once("../class/sanPham.php");
        $sanPham = new sanPham();
    ?>
    <?php
        include_once("../class/nguoiDung.php");
        $nguoiDung = new nguoiDung();
    ?>
    <?php 
        if (isset($_GET['timkiem-donhang']) ){
            $timkiem_donhang = $_GET['timkiem-donhang'];
            $timkiem_donhang_ds = $donHang->timkiem_donhang($timkiem_donhang);
        }
    ?>
    <div class="container danh-sach-san-pham" style="margin-top: 100px; ">
        <div >
            <h1 class="title">KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_donhang ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="timKiemDonHangMoi.php">Tìm hàng mới</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemDonHangMoi.php" method="get">
                        <input name="timkiem-donhang" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-san-pham-body">
            <div class=" table-responsive ">
                <?php
                    if (isset($_GET['maDH'])){
                        $maDH = $_GET['maDH'];
                        $thoigian = $_GET['thoigian'];
                        $doiTinhTrangDH = $donHang->doiTinhTrangDH($maDH, $thoigian);
                    }
                ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <?php
                        if ($timkiem_donhang_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Gía</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Đơn hàng được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            $i=0;
                            if ($timkiem_donhang_ds){
                                while($resultDH = $timkiem_donhang_ds->fetch_assoc()){
                                    $laysanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                                    if ($laysanpham){
                                        $resultSP = $laysanpham->fetch_assoc();
                                    }
                                    $laynguoidung = $nguoiDung->show_thongTin($resultDH['ma_nguoidung']);
                                    if ($laynguoidung){
                                        $resultND = $laynguoidung->fetch_assoc();
                                    }
                                    $i ++ ;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $resultDH['ngay_dathang'] ?></td>
                                            <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo number_format($resultSP['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                            <td><?php echo $resultDH['ghichu_nguoidung'] ?></td>
                                            <td><?php echo $resultDH['soluong_sanpham'] ?></td>
                                            <?php $thanhtien = $resultDH['soluong_sanpham']*$resultSP['gia_sanpham'] ?>
                                            <td><?php echo number_format($thanhtien, 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                            <td><?php echo $resultND['hoten_nguoidung'] ?></td>
                                            <td><?php echo $resultND['sdt_nguoidung'] ?></td>
                                            <td><?php echo $resultND['diachi_nguoidung'] ?></td>
                                            <td class="don-hang-moi">
                                                <?php
                                                    if ($resultDH['tinhtrang_donhang'] == 0 ){
                                                        ?>
                                                            <a href="?maDH=<?php echo $resultDH['ma_donhang'] ?>&thoigian=<?php echo $resultDH['ngay_dathang'] ?>" style="color: #eb3007; font-weight: bold;">Đang chờ xử lý</a>
                                                        <?php
                                                    }
                                                    elseif ($resultDH['tinhtrang_donhang'] == 1 ){
                                                        ?>
                                                            <span style="color: #038018; font-weight: bold;">Đang vận chuyển</span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <span style="color: #9100c4; font-weight: bold;">Đã nhận hàng</span>
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
    </div>
</html>