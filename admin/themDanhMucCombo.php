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
            <h1 class="alert alert-secondary" role="alert" >THÊM DANH MỤC COMBO</h1>
        </div>
        <div class="">
            <a href="danhSachDanhMucCombo.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách danh mục combo
                </button>
            </a>
        </div>
        <div class="them-danh-muc-body">
            <form action="themDanhMucCombo.php" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên danh mục: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_danhmuc_combo">
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
                                <button name="them_combo" type="submit" class="btn btn-outline-danger font-weight-bold">
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