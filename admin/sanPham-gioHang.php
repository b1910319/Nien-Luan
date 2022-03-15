<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php
        include_once("../class/gioHang.php");
        $gioHang = new gioHang();
        include_once("../class/nguoiDung.php");
        $nguoiDung = new nguoiDung();
        include_once("../class/sanPham.php");
        $sanPham = new sanPham();
        include_once("../class/hinhAnh.php");
        $hinhAnh = new hinhAnh();
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="title">SẢN PHẨM - GIỎ HÀNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="sanPham-gioHang.php">Giỏ hàng</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemGioHang.php" method="get">
                        <input name="timkiem-giohang" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Sđt khách hàng</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $laygiohang = $gioHang->show_giohang();
                            $i = 0;
                            if ($laygiohang){
                                while($resultGH = $laygiohang->fetch_assoc()){
                                    $i++;
                                    $laynguoidung = $nguoiDung->show_thongTin($resultGH['ma_khachhang']);
                                    if ($laynguoidung){
                                        $resultND = $laynguoidung->fetch_assoc();
                                    }
                                    $laysanpham = $sanPham->laySanPham($resultGH['ma_sanpham']);
                                    if ($laysanpham){
                                        $resultSP = $laysanpham->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $resultND['hoten_nguoidung'] ?></td>
                                            <td><?php echo $resultND['sdt_nguoidung'] ?> </td>
                                            <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo $resultGH['soluong_sanpham'] ?></td>
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