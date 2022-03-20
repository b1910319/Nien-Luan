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
    ?>
    <div class="container danh-sach-hinh-anh" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH HÌNH ẢNH</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <!-- <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachHinhAnh.php">Danh sách hình ảnh</a>
                </li> -->
                <div class="col">
                    <a href="themHinhAnhSanPham.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col">
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
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                            <th scope="col" class="tieude-bang">Mã sản phẩm</th>
                            <th scope="col" class="tieude-bang">Hình ảnh</th>
                            <th scope="col" class="tieude-bang">Mã hình ảnh</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_hinhanh = $hinhanh->show_hinhanh();
                            if ($tatca_hinhanh){
                                $i=0;
                                while ($result = $tatca_hinhanh->fetch_assoc()){
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
                                                <a href="suaHinhAnh.php?ma=<?php echo $result['ma_hinhanh'] ?>">
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>  
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của <?php echo $resultSP['ten_sanpham'] ?> không?')" href="?maXoa=<?php echo $result['ma_hinhanh'] ?>">
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