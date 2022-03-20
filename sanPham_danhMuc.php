<?php
    include_once("class/sanPham.php");
    include_once("class/danhMucSanPham.php");
    $danhMuc = new danhMucSanPham();
    include_once("class/boSuuTap.php");
    $boSuuTap = new boSuuTap();
?>
<?php
    $sanPham = new sanPham();
    if ( isset($_GET['maDM']) && $_GET['maDM']!= NULL){
        $maDM = $_GET['maDM'];
        $dem_sanpham_danhmuc = $sanPham->dem_sanpham_danhmuc($maDM);
    }
    // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suasanpham'])){
    //     $update_sanpham = $sanPham->update_sanpham($_POST, $ma);
    // }
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
            <div class="top-ban-chay">
                <div class="row">
                    <div class="col">
                        <?php
                            $layten_danhmuc = $danhMuc->layDanhMuc($maDM);
                            if ($layten_danhmuc){
                                $resultTDM = $layten_danhmuc->fetch_assoc();
                            }
                            if($dem_sanpham_danhmuc){
                                $resultDemSP = $dem_sanpham_danhmuc->fetch_assoc();
                            }
                        ?>
                        <p class="btn btn-primary"> Có "<?php echo $resultDemSP['tong_sanpham_danhmuc'] ?>" sản phẩm của danh mục " <?php echo $resultTDM['ten_danhmuc'] ?> "</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $laysanpham_danhmuc = $sanPham->laySanPham_theoDanhMuc_all($maDM);
                    if ($laysanpham_danhmuc){
                        while ($resultDM = $laysanpham_danhmuc->fetch_assoc()){
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultDM['ma_bosuutap']);
                            if ($laybosuutap) {
                                $resultBST = $laybosuutap->fetch_assoc();
                            }
                            //
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6  sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultDM['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                    // lấy hình ảnh
                                                    $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultDM['ma_sanpham']);
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
                                                <h5 class="card-title "><?php echo $resultDM['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap'] ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                <?php echo number_format($resultDM['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultDM['ma_sanpham'] ?>">
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