<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php 
        include_once ("../class/binhLuan.php") ;
        $binhLuan = new binhLuan();
        include_once("../class/nguoiDung.php");
        $nguoiDung = new nguoiDung();
        include_once("../class/sanPham.php");
        $sanPham = new sanPham();
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div>
            <h1 class="title">NỘI DUNG BÌNH LUẬN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="noiDungBinhLuan.php">Nội dung bình luận</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemBinhLuan.php" method="get">
                        <input name="timkiem-binhluan" class="form-control " type="search" placeholder="Search" aria-label="Search">
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
                            <th scope="col">Nội dung bình luận</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $lay_binhluan = $binhLuan->lay_binhluan();
                            if ($lay_binhluan){
                                $i=0;
                                while ($resultBL = $lay_binhluan->fetch_assoc()){
                                    $i++;
                                    // lấy tên khách hàng
                                    $layten_khach = $nguoiDung->show_thongTin($resultBL['ma_nguoidung']);
                                    if ($layten_khach){
                                        $resultND = $layten_khach->fetch_assoc();
                                    }
                                    // lấy tên sản phẩm
                                    $layten_sanpham = $sanPham->laySanPham($resultBL['ma_sanpham']);
                                    if ($layten_sanpham){
                                        $resultSP = $layten_sanpham->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $resultND['hoten_nguoidung'] ?></td>
                                            <td><?php echo $resultBL['noidung_binhluan'] ?></td>
                                            <td ><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo $resultBL['thoigian_binhluan'] ?></td>
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