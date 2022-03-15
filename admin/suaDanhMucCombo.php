<?php 
    include_once ("../class/danhMucCombo.php");
    $danhMucCombo = new danhMucCombo();
?>
<?php    
        if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
            $ma = $_GET['ma'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sua_danhmuc_combo'])){
            $ten_danhmuc_combo = $_POST['ten_danhmuc_combo'];
            $update_danhmuc_combo = $danhMucCombo->update_danhmuc_combo( $ten_danhmuc_combo, $_FILES, $ma);
        }
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-danh-muc" style="margin-top: 100px;">
        <div >
            <h1 class="title">SỬA DANH MỤC COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaDanhMucCombo.php">Sửa danh mục</a></li>
            </ol>
        </nav>
        <div class="them-danh-muc-body">
            <?php
                if (isset($update_danhmuc_combo)){
                    echo $update_danhmuc_combo;
                }
            ?>
                <?php
                    $layDanhMucCombo = $danhMucCombo->layDanhMucCombo($ma);
                    if ($layDanhMucCombo){
                        while ($result = $layDanhMucCombo->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tên danh mục: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required style="width: 50%;" name="ten_danhmuc_combo" value="<?php echo $result['ten_danhmuc_combo'] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hình ảnh: </th>
                                                <td>
                                                    <input type='file' required name="hinhanh_danhmuc_combo">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <img src="uploads/<?php echo $result['hinhanh_danhmuc_combo'] ?>" width="100px"></td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <button type="submit" name="sua_danhmuc_combo" class="btn btn-outline-danger">Sửa</button>
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