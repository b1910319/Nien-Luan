<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php
        include_once("../class/nguoiDung.php");
        $nguoiDung = new nguoiDung();
    ?>
    <?php 
        if (isset($_GET['timkiem-nguoidung']) ){
            $timkiem_nguoidung = $_GET['timkiem-nguoidung'];
            $timkiem_nguoidung_ds = $nguoiDung->timkiem_nguoidung($timkiem_nguoidung);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="title">KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_nguoidung ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachNguoiDung.php">Danh sách người dùng</a>
                </li>
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
                    <?php
                        if ($timkiem_nguoidung_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã khách hàng</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Sđt khách hàng</th>
                                        <th scope="col">Email khách hàng</th>
                                        <th scope="col">User khách hàng</th>
                                        <th scope="col">Địa chỉ khách hàng</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Khách hàng được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if ($timkiem_nguoidung_ds){
                                $i = 0;
                                while($resultND = $timkiem_nguoidung_ds->fetch_assoc()){
                                    $i ++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $resultND['ma_nguoidung'] ?></td>
                                            <td><?php echo $resultND['hoten_nguoidung']  ?> </td>
                                            <td><?php echo $resultND['sdt_nguoidung']  ?></td>
                                            <td><?php echo $resultND['email_nguoidung'] ?></td>
                                            <td><?php echo $resultND['user_nguoidung'] ?></td>
                                            <td><?php echo $resultND['diachi_nguoidung'] ?></td>
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