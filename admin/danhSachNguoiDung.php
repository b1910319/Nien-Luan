<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php
        include_once("../class/nguoiDung.php");
        $nguoiDung = new nguoiDung();
        if (isset($_GET['ma_nguoidung']) && $_GET['ma_nguoidung'] != NULL){
            $ma_nguoidung = $_GET['ma_nguoidung'];
            $delete_nguoidung = $nguoiDung->delete_nguoidung($ma_nguoidung);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >THÔNG TIN KHÁCH HÀNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col-8"></div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemNguoiDung.php" method="get">
                        <input name="timkiem-nguoidung" class="form-control " type="search" placeholder="Search" aria-label="Search">
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
                            <th scope="col" class="tieude-bang">Tên khách hàng</th>
                            <th scope="col" class="tieude-bang">Sđt khách hàng</th>
                            <th scope="col" class="tieude-bang">Email khách hàng</th>
                            <th scope="col" class="tieude-bang">User khách hàng</th>
                            <th scope="col" class="tieude-bang">Địa chỉ khách hàng</th>
                            <th scope="col" class="tieude-bang">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $laykhachhang = $nguoiDung->show_khachhang();
                            if ($laykhachhang){
                                $i = 0;
                                while($resultND = $laykhachhang->fetch_assoc()){
                                    $i ++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $resultND['hoten_nguoidung']  ?> </td>
                                            <td><?php echo $resultND['sdt_nguoidung']  ?></td>
                                            <td><?php echo $resultND['email_nguoidung'] ?></td>
                                            <td><?php echo $resultND['user_nguoidung'] ?></td>
                                            <td><?php echo $resultND['diachi_nguoidung'] ?></td>
                                            <td>
                                                <a href="?ma_nguoidung=<?php echo $resultND['ma_nguoidung'] ?>">
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