<?php
    include_once("class/sanPham.php");
    include_once("class/danhMucSanPham.php");
    $danhMuc = new danhMucSanPham();
    include_once("class/boSuuTap.php");
    $boSuuTap = new boSuuTap();
?>
<?php
    $sanPham = new sanPham();
    if ( isset($_GET['maBST']) && $_GET['maBST']!= NULL){
        $maBST = $_GET['maBST'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm theo bộ sưu tập</title>
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
                            $layten_bosuutap = $boSuuTap->layBoSuuTap($maBST);
                            if ($layten_bosuutap){
                                $resultBST = $layten_bosuutap->fetch_assoc();
                            }
                        ?>
                        <p class="btn btn-primary"> Sản phẩm của bộ sưu tập " <?php echo $resultBST['ten_bosuutap'] ?> "</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $laysanpham_bosuutap = $sanPham->laySanPham_theoBoSuuTap_all($maBST);
                    if ($laysanpham_bosuutap){
                        while ($resultSP_BST = $laysanpham_bosuutap->fetch_assoc()){
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultSP_BST['ma_bosuutap']);
                            if ($laybosuutap) {
                                $result_TenBST = $laybosuutap->fetch_assoc();
                            }
                            //
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6  sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_BST['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                    // lấy hình ảnh
                                                    $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultSP_BST['ma_sanpham']);
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
                                                <h5 class="card-title "><?php echo $resultSP_BST['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $result_TenBST['ten_bosuutap'] ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                <?php echo number_format($resultSP_BST['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultSP_BST['ma_sanpham'] ?>">
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