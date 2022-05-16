<?php
    include_once("../class/hinhAnh.php");
    include_once("../class/sanPham.php");
?>
<?php
    $hinhAnh = new hinhAnh();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themhinhanh'])){
        $inset_hinhanh = $hinhAnh->insert_hinhanh($_POST, $_FILES);
    }
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container hinh-anh-san-pham" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert">HÌNH ẢNH SẢN PHẨM</h1>
        </div>
        <div class="">
            <a href="danhSachHinhAnh.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách hình ảnh
                </button>
            </a>
        </div>
        <div class="hinh-anh-san-pham-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Hình ảnh: </th>
                            <td>
                                <input type='file' required name="hinhanh_sanpham">
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
                                            while ($result = $layten_sanpham->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $result['ma_sanpham'] ?>"><?php echo $result['ten_sanpham'] ?></option>
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
                                <button type="submit" class="btn btn-outline-danger font-weight-bold " name="themhinhanh">
                                    <i class="fas fa-plus-square"></i>
                                    Thêm
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</html>