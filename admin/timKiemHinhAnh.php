<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/hinhAnh.php") ?>
    <?php include_once("../class/sanPham.php") ?>
    <?php 
        $hinhanh = new hinhAnh();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_hinhanh = $hinhanh->delete_hinhanh($maXoa);
        }
        if (isset($_GET['timkiem-hinhanh']) ){
            $timkiem_hinhanh = $_GET['timkiem-hinhanh'];
            $timkiem_hinhanh_ds = $hinhanh->timkiem_hinhanh($timkiem_hinhanh);
        }
    ?>
    <div class="container danh-sach-hinh-anh" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_hinhanh ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="">
                    <a href="danhSachHinhAnh.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách hình ảnh sản phẩm
                        </button>
                    </a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemHinhAnh.php" method="get">
                        <input name="timkiem-hinhanh" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-hinh-anh-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_hinhanh)){
                    echo $delete_hinhanh;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <?php
                        if ($timkiem_hinhanh_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Mã hình ảnh</th>
                                        <th scope="col">Quản lý</th>
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
                            if ($timkiem_hinhanh_ds){
                                $i=0;
                                while ($result = $timkiem_hinhanh_ds->fetch_assoc()){
                                    $sanPham = new sanPham();
                                    $ten_sanpham = $sanPham->laySanPham($result['ma_sanpham']);
                                    if($ten_sanpham){
                                        $resultSP=$ten_sanpham->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo $result['ma_sanpham'] ?></td>
                                            <td><img src="uploads/<?php echo $result['hinhanh'] ?>" width="100px"></td>
                                            <td><?php echo $result['ma_hinhanh'] ?></td>
                                            <td>
                                                <a href="suaHinhAnh.php?ma=<?php echo $result['ma_hinhanh'] ?>"><i class="fas fa-user-edit"></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của <?php echo $resultSP['ten_sanpham'] ?> không?')" href="danhSachHinhAnh.php?maXoa=<?php echo $result['ma_hinhanh'] ?>">
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