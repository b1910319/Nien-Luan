<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/hinhAnhCombo.php") ?>
    <?php include_once("../class/combo.php") ?>
    <?php 
        $hinhAnhCombo = new hinhAnhCombo();
        if (isset($_GET['timkiem_hinhanh_combo']) ){
            $timkiem_hinhanh_combo = $_GET['timkiem_hinhanh_combo'];
            $timkiem_hinhanh_combo_ds = $hinhAnhCombo->timkiem_hinhanh_combo($timkiem_hinhanh_combo);
        }
    ?>
    <div class="container danh-sach-hinh-anh" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_hinhanh_combo ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachHinhAnhCombo.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách hình ảnh combo
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemHinhAnhCombo.php" method="get">
                        <input name="timkiem_hinhanh_combo" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-hinh-anh-body">
            <div class="container table-responsive ">
                <table class="table table-bordered table-hover" style="color: black;">
                    <?php
                        if ($timkiem_hinhanh_combo_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Tên combo</th>
                                        <th scope="col" class="tieude-bang">Hình ảnh</th>
                                        <th scope="col" class="tieude-bang">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Hình ảnh của sản phẩm được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if ($timkiem_hinhanh_combo_ds){
                                $i=0;
                                while ($result = $timkiem_hinhanh_combo_ds->fetch_assoc()){
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
                                                <a href="suaHinhAnhCombo.php?ma=<?php echo $result['ma_hinhanh_combo'] ?>">
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của <?php echo $resultC['ten_combo'] ?> không?')" href="danhSachHinhAnhCombo.php?maXoa=<?php echo $result['ma_hinhanh_combo'] ?>">
                                                    <button type="button" class="btn xoa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
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