<?php
    include_once("../class/hinhAnh.php");
    include_once("../class/sanPham.php");
?>
<?php
    $hinhAnh = new hinhAnh();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themhinhanh'])){
        $inset_hinhanh = $hinhAnh->insert_hinhanh($_POST, $_FILES);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container hinh-anh-san-pham" style="margin-top: 100px;">
        <div >
            <h1 class="title">HÌNH ẢNH SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="hinhAnhSanPham.php">Hình ảnh sản phẩm</a></li>
            </ol>
        </nav>
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
                                    <option selected>Choose...</option>
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
                                <button type="submit" class="btn btn-outline-danger" name="themhinhanh">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</html>