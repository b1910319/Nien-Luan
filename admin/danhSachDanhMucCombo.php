<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/danhMucCombo.php") ?>
    <?php 
        $danhMucCombo = new danhMucCombo();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_danhmuc_combo = $danhMucCombo->delete_danhmuc_combo($maXoa);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1 class="alert alert-secondary" role="alert"  >DANH SÁCH DANH MỤC COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themDanhMucCombo.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemDanhMucCombo.php" method="get">
                        <input name="timkiem-danhmuc-combo" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
                <?php
                    if (isset($delete_danhmuc)){
                        echo $delete_danhmuc;
                    }
                ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên danh mục</th>
                            <th scope="col" class="tieude-bang">Mã danh mục</th>
                            <th scope="col" class="tieude-bang">Hình ảnh</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $tatca_danhmuc_combo = $danhMucCombo->show_danhmuc_combo();
                                if ($tatca_danhmuc_combo){
                                    $i=0;
                                    while ($result = $tatca_danhmuc_combo->fetch_assoc()){
                                        $i++;
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $i ?></th>
                                                <td><?php echo $result['ten_danhmuc_combo'] ?></td>
                                                <td><?php echo $result['ma_danhmuc_combo'] ?></td>
                                                <td><img src="uploads/<?php echo $result['hinhanh_danhmuc_combo'] ?>" width="100px"></td>
                                                <td>
                                                    <a href="suaDanhMucCombo.php?ma=<?php echo $result['ma_danhmuc_combo'] ?>">
                                                        <button type="button" class="btn sua">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_danhmuc_combo'] ?> không?')"
                                                        href="?maXoa=<?php echo $result['ma_danhmuc_combo'] ?>">
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