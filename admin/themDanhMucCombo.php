<?php
    include("../class/danhMucCombo.php");
    $danhMucCombo = new danhMucCombo();
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['them_combo'])){
        $ten_danhmuc_combo = $_POST['ten_danhmuc_combo'];
        $inset_danhmuc_combo = $danhMucCombo->insert_danhmuc_combo($ten_danhmuc_combo, $_FILES);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-danh-muc" style="margin-top: 100px;">
        <div class="">
            <h1 class="title">THÊM DANH MỤC COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themDanhMucCombo.php">Thêm danh mục</a></li>
            </ol>
        </nav>
        <div class="them-danh-muc-body">
            <form action="themDanhMucCombo.php" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên danh mục: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required style="width: 50%;" name="ten_danhmuc_combo">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Hình ảnh: </th>
                            <td>
                                <input type="file" name="hinhanh_danhmuc_combo">
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button name="them_combo" type="submit" class="btn btn-outline-danger">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</html>