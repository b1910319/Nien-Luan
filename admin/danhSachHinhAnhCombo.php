<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/hinhAnhCombo.php") ?>
    <?php include_once("../class/combo.php") ?>
    <?php 
        $hinhAnhCombo = new hinhAnhCombo();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_hinhanh_combo = $hinhAnhCombo->delete_hinhanh_combo($maXoa);
        }
    ?>
    <div class="container danh-sach-hinh-anh" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH HÌNH ẢNH COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themHinhAnhCombo.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemHinhAnhCombo.php" method="get">
                        <input name="timkiem_hinhanh_combo" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-hinh-anh-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_hinhanh_combo)){
                    echo $delete_hinhanh_combo;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên combo</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_hinhanh_combo = $hinhAnhCombo->show_hinhanh_combo();
                            if ($tatca_hinhanh_combo){
                                $i=0;
                                while ($result = $tatca_hinhanh_combo->fetch_assoc()){
                                    $combo = new combo();
                                    $ten_combo = $combo->layCombo($result['ma_combo']);
                                    if($ten_combo){
                                        $resultC=$ten_combo->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $resultC['ten_combo'] ?></td>
                                            <td><img src="uploads/<?php echo $result['hinhanh_combo'] ?>" width="100px"></td>
                                            <td>
                                                <a href="suaHinhAnhCombo.php?ma=<?php echo $result['ma_hinhanh_combo'] ?>"><i class="fas fa-user-edit"></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của <?php echo $resultC['ten_combo'] ?> không?')" href="?maXoa=<?php echo $result['ma_hinhanh_combo'] ?>">
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