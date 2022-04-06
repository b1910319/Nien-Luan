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
            <?php
                if (isset($_GET['timkiem-donhang']) ){
                    $timkiem_donhang = $_GET['timkiem-donhang'];
                    ?>
                        <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_donhang ?>"</h1>
                    <?php
                }
            ?>
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
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr >
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Ngày đặt</th>
                            <th scope="col" class="tieude-bang">Tên khách hàng</th>
                            <th scope="col" class="tieude-bang">Số điện thoại</th>
                            <th scope="col" class="tieude-bang">Địa chỉ</th>
                            <th scope="col" class="tieude-bang">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_GET['timkiem-donhang']) ){
                                $timkiem_donhang = $_GET['timkiem-donhang'];
                                $timkiem_donhang_ds = $donHang->timkiem_donhang($timkiem_donhang);
                                $i=0;
                                if ($timkiem_donhang_ds){
                                    while($resultDH = $timkiem_donhang_ds->fetch_assoc()){
                                        $laynguoidung = $nguoiDung->show_thongTin($resultDH['ma_nguoidung']);
                                        if ($laynguoidung){
                                            $resultND = $laynguoidung->fetch_assoc();
                                        }
                                        $i ++ ;
                                        if($resultDH['tinhtrang_donhang'] == '0'){
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td style="color: #ee3500; font-weight: bold; font-size: 18px;"><?php echo $resultDH['ngay_dathang'] ?></td>
                                                    <td><?php echo $resultND['hoten_nguoidung'] ?></td>
                                                    <td><?php echo $resultND['sdt_nguoidung'] ?></td>
                                                    <td><?php echo $resultND['diachi_nguoidung'] ?></td>
                                                    <td>
                                                        <a href="chiTietDonHangMoi.php?ma_nguoidung=<?php echo $resultDH['ma_nguoidung'] ?>&&ngay_dathang=<?php echo $resultDH['ngay_dathang'] ?>">
                                                            <button type="button" class="btn chitiet_donhang" >
                                                                <i class="fas fa-info-circle"></i> 
                                                                Chi tiết đơn hàng
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                        } else{
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $resultDH['ngay_dathang'] ?></td>
                                                    <td><?php echo $resultND['hoten_nguoidung'] ?></td>
                                                    <td><?php echo $resultND['sdt_nguoidung'] ?></td>
                                                    <td><?php echo $resultND['diachi_nguoidung'] ?></td>
                                                    <td>
                                                        <a href="chiTietDonHangMoi.php?ma_nguoidung=<?php echo $resultDH['ma_nguoidung'] ?>&&ngay_dathang=<?php echo $resultDH['ngay_dathang'] ?>">
                                                            <button type="button" class="btn chitiet_donhang" >
                                                                <i class="fas fa-info-circle"></i> 
                                                                Chi tiết đơn hàng
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</html>