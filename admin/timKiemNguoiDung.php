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
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_nguoidung ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col-8">
                    <a href="danhSachNguoiDung.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách người dùng
                        </button>
                    </a>
                </div>
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
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Mã khách hàng</th>
                                        <th scope="col" class="tieude-bang">Tên khách hàng</th>
                                        <th scope="col" class="tieude-bang">Sđt khách hàng</th>
                                        <th scope="col" class="tieude-bang">Email khách hàng</th>
                                        <th scope="col" class="tieude-bang">User khách hàng</th>
                                        <th scope="col" class="tieude-bang">Địa chỉ khách hàng</th>
                                        <th scope="col" class="tieude-bang">Xóa</th>
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
                                            <td>
                                                <a href="danhSachNguoiDung.php?ma_nguoidung=<?php echo $resultND['ma_nguoidung'] ?>">
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