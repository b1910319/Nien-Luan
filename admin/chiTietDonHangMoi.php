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
        <div class="row">
            <a href="donHangMoi.php" class="col-2" style="font-size: 20px; color: #121e96; font-weight: bold;">
                <i class="fas fa-angle-double-left  mt-4" style="font-size: 25px; color: #121e96; font-weight: bold" ></i> Trở lại
            </a>
            <h1 class="col-10 text-center">CHI TIẾT ĐƠN HÀNG MỚI</h1>
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
                        <tr >
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                            <th scope="col" class="tieude-bang">Gía</th>
                            <th scope="col" class="tieude-bang">Ghi chú</th>
                            <th scope="col" class="tieude-bang">Số lượng</th>
                            <th scope="col" class="tieude-bang">Thành tiền</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['ma_nguoidung']) && $_GET['ma_nguoidung'] != NULL && isset($_GET['ngay_dathang']) && $_GET['ngay_dathang']){
                                $ma_nguoidung = $_GET['ma_nguoidung'];
                                $ngay_dathang = $_GET['ngay_dathang'];
                                $show_chitiet_donhang = $donHang ->show_chitiet_donhang($ma_nguoidung, $ngay_dathang);
                                $i=0;
                                if ($show_chitiet_donhang){
                                    while($resultDH = $show_chitiet_donhang->fetch_assoc()){
                                        $laysanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                                        if ($laysanpham){
                                            $resultSP = $laysanpham->fetch_assoc();
                                        }
                                        $i ++ ;
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                                <td><?php echo number_format($resultSP['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                                <td><?php echo $resultDH['ghichu_nguoidung'] ?></td>
                                                <td><?php echo $resultDH['soluong_sanpham'] ?></td>
                                                <?php $thanhtien = $resultDH['soluong_sanpham']*$resultSP['gia_sanpham'] ?>
                                                <td><?php echo number_format($thanhtien, 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                                <td class="don-hang-moi">
                                                    <?php
                                                        if ($resultDH['tinhtrang_donhang'] == 0 ){
                                                            ?>
                                                                <a href="?maDH=<?php echo $resultDH['ma_donhang'] ?>&thoigian=<?php echo $resultDH['ngay_dathang'] ?>">
                                                                    <button type="button" class="btn dang-xu-ly">
                                                                        Đang chờ xử lý
                                                                    </button>
                                                                </a>
                                                            <?php
                                                        }
                                                        elseif ($resultDH['tinhtrang_donhang'] == 1 ){
                                                            ?>
                                                                <span>
                                                                    <button type="button" class="btn dang-van-chuyen">
                                                                        Đang vận chuyển
                                                                    </button>
                                                                </span>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <span >
                                                                    <button type="button" class="btn da-nhan-hang">
                                                                        Đã nhận hàng
                                                                    </button>
                                                                </span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        <tr>
                            <?php
                                if(isset($_GET['ma_nguoidung']) && $_GET['ma_nguoidung'] != NULL && isset($_GET['ngay_dathang']) && $_GET['ngay_dathang']){
                                    $ma_nguoidung = $_GET['ma_nguoidung'];
                                    $ngay_dathang = $_GET['ngay_dathang'];
                                    $show_chitiet_donhang = $donHang ->show_chitiet_donhang($ma_nguoidung, $ngay_dathang);
                                    $i=0;
                                    if ($show_chitiet_donhang){
                                        $soluong = 0;
                                        $tongtien = 0;
                                        while($resultDH = $show_chitiet_donhang->fetch_assoc()){
                                            $laysanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                                            if ($laysanpham){
                                                $resultSP = $laysanpham->fetch_assoc();
                                            }
                                            $tongtien= $tongtien + $resultDH['soluong_sanpham'] * $resultSP['gia_sanpham'] ;
                                            $soluong = $soluong + $resultDH['soluong_sanpham'] ;
                                        }
                                        ?>
                                            <td style=" font-weight: bold; font-size: 20px;">Tổng:</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style=" font-weight: bold; font-size: 20px;"><?php echo $soluong ?></td>
                                            <td style=" font-weight: bold; font-size: 20px;"><?php echo number_format($tongtien, 0, ',', '.') . ' <sup>đ</sup>'  ?></td>
                                        <?php
                                    }
                                }
                            ?>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</html>