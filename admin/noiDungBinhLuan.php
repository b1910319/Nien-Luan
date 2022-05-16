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
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_binhluan = $binhLuan->delete_binhluan_admin($maXoa);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div>
            <h1 class="alert alert-secondary" role="alert" >NỘI DUNG BÌNH LUẬN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col-8"></div>
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
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">User khách hàng</th>
                            <th scope="col" class="tieude-bang">Nội dung bình luận</th>
                            <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                            <th scope="col" class="tieude-bang">Thời gian</th>
                            <th scope="col" class="tieude-bang">Xóa bình luận</th>
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
                                            <td><?php echo $resultND['user_nguoidung'] ?></td>
                                            <td><?php echo $resultBL['noidung_binhluan'] ?></td>
                                            <td ><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo $resultBL['thoigian_binhluan'] ?></td>
                                            <td>
                                                <a onclick="return confirm('Bạn có muốn xóa bình luận này không?')"
                                                        href="?maXoa=<?php echo $resultBL['ma_binhluan']?>">
                                                    <center>
                                                        <button type="button" class="btn xoa">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </center>
                                                </a>
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