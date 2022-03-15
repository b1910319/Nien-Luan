<?php
    include_once("../class/hinhAnhCombo.php");
    include_once("../class/combo.php");
?>
<?php
    $hinhAnhCombo = new hinhAnhCombo();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['them_hinhanh_combo'])){
        $ten_combo = $_POST['ten_combo'];
        $inset_hinhanh_combo = $hinhAnhCombo->insert_hinhanh_combo($ten_combo, $_FILES);
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
            <h1 class="title">HÌNH ẢNH CỦA COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themHinhAnhCombo.php">Hình ảnh của combo</a></li>
            </ol>
        </nav>
        <div class="hinh-anh-san-pham-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Hình ảnh: </th>
                            <td>
                                <input type='file' required name="hinhanh_combo">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tên combo: </th>
                            <td>
                                <select class="custom-select" id="gender2" name="ten_combo">
                                    <option selected>Choose...</option>
                                    <?php
                                        $combo = new combo();
                                        $layCombo = $combo->show_combo();
                                        if ($layCombo){
                                            while ($result = $layCombo->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $result['ma_combo'] ?>"><?php echo $result['ten_combo'] ?></option>
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
                                <button type="submit" class="btn btn-outline-danger" name="them_hinhanh_combo">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</html>