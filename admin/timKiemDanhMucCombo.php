<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/danhMucCombo.php") ?>
    <?php 
        $danhMucCombo = new danhMucCombo();
        if (isset($_GET['timkiem-danhmuc-combo']) ){
            $timkiem_danhmuc_combo = $_GET['timkiem-danhmuc-combo'];
            $timkiem_danhmuc_combo_ds = $danhMucCombo->timkiem_danhmuc_combo($timkiem_danhmuc_combo);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1 class="title">KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_danhmuc_combo ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="timKiemDanhMucCombo.php">Tìm kiếm danh mục</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemDanhMucCombo.php" method="get">
                        <input name="timkiem-danhmuc-combo" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
                <table class="table table-bordered table-hover">
                    <?php
                        if ($timkiem_danhmuc_combo_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Mã danh mục</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Danh mục được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if (isset($_GET['maXoa']) ){
                                $maXoa = $_GET['maXoa'];
                                $delete_danhmuc_combo = $danhMucCombo->delete_danhmuc_combo($maXoa);
                            }
                            if ($timkiem_danhmuc_combo_ds != NULL){
                                $i = 0;
                                while ($result = $timkiem_danhmuc_combo_ds->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <th scope="row"><?php echo $i ?></th>
                                        <td><?php echo $result['ten_danhmuc_combo'] ?></td>
                                        <td><?php echo $result['ma_danhmuc_combo'] ?></td>
                                        <td><img src="uploads/<?php echo $result['hinhanh_danhmuc_combo'] ?>" width="100px"></td>
                                        <td>
                                            <a
                                                href="suaDanhMucCombo.php?ma=<?php echo $result['ma_danhmuc_combo'] ?>"><i
                                                    class="fas fa-user-edit"></i></a>
                                            ||
                                            <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_danhmuc_combo'] ?> không?')"
                                                href="danhSachDanhMucCombo.php?maXoa=<?php echo $result['ma_danhmuc_combo'] ?>">
                                                <i class="fas fa-user-minus"></i>
                                            </a>
                                        </td>
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