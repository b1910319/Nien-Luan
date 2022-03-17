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
    <div class="container danh-sach-san-pham" style="margin-top: 100px; ">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH ĐƠN HÀNG MỚI</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col-8"></div>
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
                    <tbody>
                        <?php
                            $laydonhang = $donHang->show_donhang();
                            $i=0;
                            if ($laydonhang){
                                while($resultDH = $laydonhang->fetch_assoc()){
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