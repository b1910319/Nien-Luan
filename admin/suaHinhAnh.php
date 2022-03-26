<?php
    include_once("../class/hinhAnh.php");
    $hinhAnh = new hinhAnh();
    include_once("../class/sanPham.php");
    $sanPham = new sanPham();
?>
<?php
    if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suahinhanh'])){
        $ten_sanpham = $_POST['ten_sanpham'];
        $update_hinhanh = $hinhAnh->update_hinhanh( $ten_sanpham, $_FILES, $ma);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-hinh-anh-san-pham" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachHinhAnh.php" class="col-2 mt-2">
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA HÌNH ẢNH SẢN PHẨM</h1>
        </div>
        <div class="sua-hinh-anh-san-pham-body">
            <?php 
                $hinhAnh = new hinhAnh();
                $layhinhanh= $hinhAnh->layHinhAnh($ma);
                if ($layhinhanh){
                    while($result = $layhinhanh->fetch_assoc()){
                        ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Hình ảnh: </th>
                                            <td>
                                            <td>
                                                <input type='file' required name="hinhanh_sanpham">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <img src="uploads/<?php echo $result['hinhanh'] ?>" width="100px"></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tên sản phẩm: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="ten_sanpham">
                                                    <option selected>Chọn sản phẩm</option>
                                                    <?php
                                                        $sanPham = new sanPham();
                                                        $layten_sanpham = $sanPham->show_sanpham();
                                                        if ($layten_sanpham){
                                                            while ($resultSP = $layten_sanpham->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                        <?php
                                                                            if ($resultSP['ma_sanpham'] == $result['ma_sanpham'] ){ echo 'selected';}
                                                                        ?>
                                                                        value="<?php echo $resultSP['ma_sanpham'] ?>"><?php echo $resultSP['ten_sanpham'] ?>
                                                                    </option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>
                                                <button type="submit" class="btn btn-outline-danger font-weight-bold" name="suahinhanh">
                                                    <i class="fas fa-pen"></i>
                                                    Sửa
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        <?php
                    }
                }
            ?>
        </div>
    </div>

</html>