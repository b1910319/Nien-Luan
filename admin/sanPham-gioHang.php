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
            <h1 class="alert alert-secondary" role="alert" >SẢN PHẨM - GIỎ HÀNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col-8"></div>
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
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">User khách hàng</th>
                            <th scope="col" class="tieude-bang">Sđt khách hàng</th>
                            <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                            <th scope="col" class="tieude-bang">Số lượng</th>
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
                                            <td><?php echo $resultND['user_nguoidung'] ?></td>
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