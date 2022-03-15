<?php
    include_once("../class/hinhAnhCombo.php");
    include_once("../class/combo.php");
?>
<?php
    $hinhAnhCombo = new hinhAnhCombo();
    if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suahinhanh_combo'])){
        $ten_combo = $_POST['ten_combo'];
        $update_hinhanh_combo = $hinhAnhCombo->update_hinhanh_combo( $ten_combo, $_FILES, $ma);
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
        <div >
            <h1 class="title">SỬA HÌNH ẢNH COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaHinhAnhCombo.php">Sửa hình ảnh combo</a></li>
            </ol>
        </nav>
        <div class="sua-hinh-anh-san-pham-body">
            <?php 
                $hinhAnhCombo = new hinhAnhCombo();
                $layhinhanh= $hinhAnhCombo->layHinhAnh_combo($ma);
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
                                                <input type='file' required name="hinhanh_combo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <img src="uploads/<?php echo $result['hinhanh_combo'] ?>" width="100px"></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tên combo: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="ten_combo">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $combo = new combo();
                                                        $layten_combo = $combo->show_combo();
                                                        if ($layten_combo){
                                                            while ($resultC = $layten_combo->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultC['ma_combo'] == $result['ma_combo'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultC['ma_combo'] ?>"><?php echo $resultC['ten_combo'] ?></option>
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
                                                <button type="submit" class="btn btn-outline-danger" name="suahinhanh_combo">Sửa</button>
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