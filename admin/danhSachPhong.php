<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/phong.php") ?>
    <?php 
        $phong = new phong();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_phong = $phong->delete_phong($maXoa);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH PHÒNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themPhong.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemPhong.php" method="get">
                        <input name="timkiem-phong" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_phong)){
                    echo $delete_phong;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Phòng</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_phong = $phong->show_phong();
                            if ($tatca_phong){
                                $i=0;
                                while ($result = $tatca_phong->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_phong'] ?></td>
                                            <td><?php echo $result['ma_phong'] ?></td>
                                            <td >
                                                <a href="suaPhong.php?ma=<?php echo $result['ma_phong'] ?>" ><i class="fas fa-user-edit" ></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa  <?php echo $result['ten_phong'] ?> không?')" href="?maXoa=<?php echo $result['ma_phong'] ?>">
                                                    <i class="fas fa-user-minus"></i>
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