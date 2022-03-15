<?php
    include_once("class/sanPham.php");
    include_once("class/danhMucSanPham.php");
    $danhMuc = new danhMucSanPham();
    include_once("class/boSuuTap.php");
    $boSuuTap = new boSuuTap();
    include_once("class/phong.php");
    $phong = new phong();
?>
<?php
    $sanPham = new sanPham();
    if ( isset($_GET['maPhong']) && $_GET['maPhong']!= NULL){
        $maPhong = $_GET['maPhong'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm theo phòng</title>
</head>
<body>
    <div class="container-fluid">
        <?php
            include_once("include/header.php");
        ?>
        <br><br><br>
        <div class="container">
            <div class="top-ban-chay">
                <div class="row">
                    <div class="col">
                        <?php
                            $layten_phong = $phong->layPhong($maPhong);
                            if ($layten_phong){
                                $resultP = $layten_phong->fetch_assoc();
                            }
                        ?>
                        <p class="btn btn-primary"> Sản phẩm của phòng " <?php echo $resultP['ten_phong'] ?> "</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $laysanpham_phong = $sanPham->laySanPham_theoPhong_all($maPhong);
                    if ($laysanpham_phong){
                        while ($resultSP_P = $laysanpham_phong->fetch_assoc()){
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultSP_P['ma_bosuutap']);
                            if ($laybosuutap) {
                                $result_TenBST = $laybosuutap->fetch_assoc();
                            }
                            //
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6  sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_P['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                    // lấy hình ảnh
                                                    $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultSP_P['ma_sanpham']);
                                                    if ($layHinhAnh) {
                                                        while ($resultHA = $layHinhAnh->fetch_assoc()) {
                                                    ?>
                                                            <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" class="card-img-top img-fluid" style="width: 280px;!important">
                                                    <?php
                                                            break;
                                                        }
                                                    }
                                                    // 
                                                ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title "><?php echo $resultSP_P['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $result_TenBST['ten_bosuutap'] ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                <?php echo number_format($resultSP_P['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_P['ma_sanpham'] ?>">
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
                    } else{
                        echo '<h4 class="text-center" style="font-weight: bold; color: #038018;">Danh mục hiện chưa có sản phẩm</h4>';
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