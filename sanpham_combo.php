
<?php
    include_once("class/combo.php");
    $combo = new combo();
    include_once("class/boSuuTap.php");
    $boSuuTap = new boSuuTap();
    include_once ("class/hinhAnh.php");
    $hinhAnh = new hinhAnh();
    include_once("class/sanPham.php");
    $sanPham = new sanPham();
    include_once("class/hinhAnhCombo.php");
    $hinhAnhCombo = new hinhAnhCombo();
    if ( isset($_GET['ma_combo']) && $_GET['ma_combo']!= NULL){
        $ma_combo = $_GET['ma_combo'];
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
            <div class="row">
                <?php 
                    $laycombo = $combo->layCombo($ma_combo);
                    if ($laycombo){
                        $resultC = $laycombo->fetch_assoc();
                    }
                    ?>
                        <div class="col-4">
                            <h2><?php echo $resultC['ten_combo'] ?></h2>
                            <p><?php echo $resultC['tomtat_combo'] ?></p>
                        </div>
                    <?php
                    $layHinhAnh_combo = $hinhAnhCombo->layHinhAnh($ma_combo);
                    if ($layHinhAnh_combo){
                        while($resultHAC = $layHinhAnh_combo->fetch_assoc()){
                            ?>
                                <div class="col-8">
                                    <img src="admin/uploads/<?php echo $resultHAC['hinhanh_combo'] ?>" alt="" style="width: 100%;">
                                </div>
                            <?php
                            break;
                        }
                    }
                ?>
            </div>
            <br><br>
            <div class="row">
                <?php
                    $layHinhAnh_combo = $hinhAnhCombo->layHinhAnh($ma_combo);
                    if ($layHinhAnh_combo){
                        while($resultHAC = $layHinhAnh_combo->fetch_assoc()){
                            ?>
                                <div class="col">
                                    <img src="admin/uploads/<?php echo $resultHAC['hinhanh_combo'] ?>" alt="" style="width: 100%;">
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <br>
            <h1 class="text-center">SẢN PHẨM TRONG PHÒNG</h1>
            <br>
            <div class="row">
                <?php
                    $laysanpham_combo = $sanPham->laySanPham_combo($ma_combo);
                    if ($laysanpham_combo){
                        while ($resultSP_C = $laysanpham_combo->fetch_assoc()){
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultSP_C['ma_bosuutap']);
                            if ($laybosuutap) {
                                $resultBST = $laybosuutap->fetch_assoc();
                            }
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_C['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                // lấy hình ảnh
                                                $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultSP_C['ma_sanpham']);
                                                if ($layHinhAnh) {
                                                    while ($resultHA = $layHinhAnh->fetch_assoc()) {
                                                        ?>
                                                            <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" class="card-img-top img-fluid" style="width: 280px;!important">
                                                        <?php
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title "><?php echo $resultSP_C['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap']  ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                    <?php echo number_format($resultSP_C['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_C['ma_sanpham'] ?>">
                                                        <button type="submit" class="btn btn-danger muangay">
                                                            <i class="fas fa-info-circle"></i>
                                                            Chi tiết
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
        </div>
        <?php
            include_once("include/footerTop.php");
            include_once("include/footer.php");
        ?>
    </div>
</body>
</html>