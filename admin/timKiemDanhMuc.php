<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/danhMucSanPham.php") ?>
    <?php 
        $danhMucSanPham = new danhMucSanPham();
        if (isset($_GET['timkiem-danhmuc']) ){
            $timkiem_danhmuc = $_GET['timkiem-danhmuc'];
            $timkiem_danhmuc_ds = $danhMucSanPham->timkiem_danhmuc($timkiem_danhmuc);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_danhmuc ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachDanhMuc.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách danh mục sản phẩm
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemDanhMuc.php" method="get">
                        <input name="timkiem-danhmuc" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
                <table class="table table-bordered table-hover">
                    <?php
                        if ($timkiem_danhmuc_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Tên danh mục</th>
                                        <th scope="col" class="tieude-bang">Mã danh mục</th>
                                        <th scope="col" class="tieude-bang">Danh mục cha</th>
                                        <th scope="col" class="tieude-bang">Quản lý</th>
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
                                $timkiem_delete_danhmuc = $danhMucSanPham->delete_danhmuc($maXoa);
                            }
                            if (isset($timkiem_delete_danhmuc)){
                                echo $timkiem_delete_danhmuc;
                            }
                            if ($timkiem_danhmuc_ds != NULL){
                                $i = 0;
                                while ($result = $timkiem_danhmuc_ds->fetch_assoc()){
                                    $ten_danhmuc_cha = $danhMucSanPham->layDanhMuc($result['danhmuc_cha']);
                                    if($ten_danhmuc_cha){
                                        $result1 = $ten_danhmuc_cha->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_danhmuc'] ?></td>
                                            <td><?php echo $result['ma_danhmuc'] ?></td>
                                            <td><?php echo $result1['ten_danhmuc'] ?></td>
                                            <td>
                                                <a href="suaDanhMuc.php?ma=<?php echo $result['ma_danhmuc'] ?>&cha=<?php echo $result['danhmuc_cha'] ?>">
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_danhmuc'] ?> không?')" href="danhSachDanhMuc.php?maXoa=<?php echo $result['ma_danhmuc'] ?>">
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