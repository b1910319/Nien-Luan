<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/danhMucSanPham.php") ?>
    <?php 
        $danhMucSanPham = new danhMucSanPham();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_danhmuc = $danhMucSanPham->delete_danhmuc($maXoa);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1  class="alert alert-secondary" role="alert" >DANH SÁCH DANH MỤC SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <!-- <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachDanhMuc.php">Danh sách danh mục</a>
                </li> -->
                <div class="col">
                    <a href="themDanhMuc.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
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
                <?php
                    if (isset($delete_danhmuc)){
                        echo $delete_danhmuc;
                    }
                ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Mã danh mục</th>
                            <th scope="col">Danh mục cha</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_danhmuc = $danhMucSanPham->show_danhmuc();
                            if ($tatca_danhmuc){
                                $i=0;
                                while ($result = $tatca_danhmuc->fetch_assoc()){
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
                                                <a
                                                    href="suaDanhMuc.php?ma=<?php echo $result['ma_danhmuc'] ?>&cha=<?php echo $result['danhmuc_cha'] ?>"><i
                                                        class="fas fa-user-edit"></i></a>
                                                ||
                                                <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_danhmuc'] ?> không?')"
                                                    href="?maXoa=<?php echo $result['ma_danhmuc'] ?>">
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