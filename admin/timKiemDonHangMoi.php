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
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_donhang ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="donHangMoi.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách đơn hàng mới
                        </button>
                    </a>
                </div>
                <div class="col">
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
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Ngày đặt</th>
                                        <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                                        <th scope="col" class="tieude-bang">Gía</th>
                                        <th scope="col" class="tieude-bang">Ghi chú</th>
                                        <th scope="col" class="tieude-bang">Số lượng</th>
                                        <th scope="col" class="tieude-bang">Thành tiền</th>
                                        <th scope="col" class="tieude-bang">Tên khách hàng</th>
                                        <th scope="col" class="tieude-bang">Số điện thoại</th>
                                        <th scope="col" class="tieude-bang">Địa chỉ</th>
                                        <th scope="col" class="tieude-bang">Quản lý</th>
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</html>