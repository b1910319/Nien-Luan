<?php
    include_once("../class/thongKe.php");
    $thongKe = new thongKe();
    include_once ("../class/sanPham.php");
    $sanPham = new sanPham();
    include_once ("../class/donHang.php");
    $donHang = new donHang();
    include_once("../class/nguoiDung.php");
    $nguoiDung = new nguoiDung();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container thong-ke-theo-ngay" style="margin-top: 100px;">
        <div >
            <h1 class="title" style="font-weight: bold; text-align: center; color: #eb3007;">THỐNG KÊ SỐ LƯỢNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="thongKeSoLuong.php">Thống kê số lượng</a></li>
            </ol>
        </nav>
        <div>
            <table class="table" style="color: black;">
                <thead>
                    <tr>
                    <th scope="col">Tên</th>
                    <th scope="col">Tổng số</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- tổng số sản phẩm -->
                    <?php
                        $laytong_sanpham = $sanPham->tong_sanpham();
                        if ($laytong_sanpham){
                            $resultSP = $laytong_sanpham->fetch_assoc();
                        }
                        ?>
                            <tr>
                                <td>Tổng số sản phẩm</td>
                                <td><?php echo $resultSP['tong_sanpham']  ?></td>
                            </tr>
                        <?php
                    ?>
                    <!-- tổng đơn hàng -->
                    <?php
                        $laytong_donhang = $donHang->tong_donhang();
                        if ($laytong_donhang){
                            $resultDH = $laytong_donhang->fetch_assoc();
                        }
                        ?>
                            <tr>
                                <td>Tổng số đơn hàng</td>
                                <td><?php echo $resultDH['tong_donhang']  ?></td>
                            </tr>
                        <?php
                    ?>
                    <!-- tổng số khách hàng -->
                    <?php
                        $laytong_khach = $nguoiDung->tong_nguoidung();
                        if ($laytong_khach){
                            $resultND = $laytong_khach->fetch_assoc();
                        }
                        ?>
                            <tr>
                                <td>Tổng số khách hàng</td>
                                <td><?php echo $resultND['tong_nguoidung']  ?></td>
                            </tr>
                        <?php
                    ?>
                </tbody>
            </table>
            <h3 class="text-center">Số sản phẩm của từng danh mục</h3>
            <table class="table" style="color: black;">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tổng số</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- tổng số sản phẩm của từng danh mục -->
                    <?php
                        $laytong_sanpham_danhmuc = $sanPham->tong_sanpham_danhmuc();
                        if ($laytong_sanpham_danhmuc){
                            $i = 0;
                            while ($resultSP = $laytong_sanpham_danhmuc->fetch_assoc()){
                                $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $resultSP['ten_danhmuc'] ?></td>
                                        <td><?php echo $resultSP['tong_sanpham_danhmuc']  ?></td>
                                    </tr>
                                <?php
                            }
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>