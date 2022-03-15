
<?php
    include_once("class/danhMucCombo.php");
    $danhMucCombo = new danhMucCombo();
    include_once("class/combo.php");
    $combo = new combo();
    include_once("class/hinhAnhCombo.php");
    $hinhAnhCombo = new hinhAnhCombo();
    if ( isset($_GET['ma_danhmuc_combo']) && $_GET['ma_danhmuc_combo']!= NULL){
        $ma_danhmuc_combo = $_GET['ma_danhmuc_combo'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAYA</title>
</head>
<body>
    <div class="container-fluid">
        <?php
            include_once("include/header.php");
        ?>
        <br><br><br>
        <div class="container">
            <div>
                <?php
                    $layten_danhmuc_combo = $danhMucCombo->layDanhMucCombo($ma_danhmuc_combo);
                    if ($layten_danhmuc_combo){
                        $resultDMC = $layten_danhmuc_combo->fetch_assoc();
                    }
                ?>
                <h1 class="text-center font-weight-bold text-uppercase"><?php echo $resultDMC['ten_danhmuc_combo'] ?></h1>
            </div>
            <div class="combo_danhmuc row">
                <?php
                    $layCombo = $combo->layCombo_danhMuc($ma_danhmuc_combo);
                    if ($layCombo){
                        while($resultC = $layCombo->fetch_assoc()){
                            ?>
                                <div class="combo_danhmuc_item col-4 text-center ">
                                    <?php
                                    $layHinhAnhCombo = $hinhAnhCombo->layHinhAnh($resultC['ma_combo']);
                                        if($layHinhAnhCombo){
                                            while($resultHAC = $layHinhAnhCombo->fetch_assoc()){
                                                ?>
                                                    <a href="sanpham_combo.php?ma_combo=<?php echo $resultC['ma_combo'] ?>">
                                                        <img src="admin/uploads/<?php echo $resultHAC['hinhanh_combo'] ?>" alt="" class="img-fluid" >
                                                        <p style="font-weight: bold; font-size: 18px;"><?php echo $resultC['ten_combo'] ?></p>
                                                    </a>
                                                    <p><?php echo substr($resultC['tomtat_combo'],3,150)." "."[...]" ?></p>
                                                <?php
                                                break;
                                            }
                                        }
                                    ?>
                                </div>
                            <?php
                        }
                    }
                ?>
                <!-- <div class="combo_danhmuc_item col-4 text-center ">
                    <a href="">
                        <img src="img/1.jpg" alt="" class="img-fluid" >
                        <p>rrrrrrrrr</p>
                    </a>
                </div>
                <div class="combo_danhmuc_item col-4 text-center ">
                    <a href="">
                        <img src="img/1.jpg" alt="" class="img-fluid" >
                        <p>rrrrrrrrr</p>
                    </a>
                </div>
                <div class="combo_danhmuc_item col-4 text-center ">
                    <a href="">
                        <img src="img/1.jpg" alt="" class="img-fluid" >
                        <p>rrrrrrrrr</p>
                    </a>
                </div> -->
            </div>
        </div>
        <?php
            include_once("include/footerTop.php");
            include_once("include/footer.php");
        ?>
    </div>
</body>
</html>