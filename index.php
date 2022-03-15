<?php
    include_once("class/danhMucCombo.php");
    $danhMucCombo = new danhMucCombo();
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <!-- top bán chạy  -->
        <div class="sanpham container">
            <?php include("include/slider.php") ?>
            <div class="top-ban-chay ">
                <p class="btn btn-primary "  disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    TOP BÁN CHẠY
                </p>
            </div>
            <div class="row">
                <?php
                    $laySanPham_topBanChay = $sanPham->laySanPham_topBanChay();
                    if ($laySanPham_topBanChay) {
                        while ($resultTBC = $laySanPham_topBanChay->fetch_assoc()) {
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultTBC['ma_bosuutap']);
                            if ($laybosuutap) {
                                $resultBST = $laybosuutap->fetch_assoc();
                            }
                            // 
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultTBC['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                // lấy hình ảnh
                                                $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultTBC['ma_sanpham']);
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
                                                <h5 class="card-title "><?php echo $resultTBC['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap']  ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                    <?php echo number_format($resultTBC['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultTBC['ma_sanpham'] ?>">
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
            <nav aria-label="..." class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                        $laySanPham_topBanChay_phanTrang = $sanPham->laySanPham_topBanChay_phanTrang();
                        $dem_sanpham = mysqli_num_rows($laySanPham_topBanChay_phanTrang);
                        $trang_sanpham = ceil($dem_sanpham/6);
                        for ($i = 1; $i<= $trang_sanpham; $i ++){
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?trangTop=<?php echo $i ?>">
                                        <?php echo $i ?>
                                    </a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
            </nav>
        </div>
        <!--  -->
        <div class="container">
            <div class="top-ban-chay">
                <p class="btn btn-primary" disabled>
                    <span class="" role="status" aria-hidden="true"></span>
                    SẢN PHẨM NỔI BẬT
                </p>
            </div>
            <div class="row">
                <?php
                    $laySanPham_noiBat = $sanPham->laySanPham_noiBat();
                    if ($laySanPham_noiBat) {
                        while ($resultNB = $laySanPham_noiBat->fetch_assoc()) {
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultNB['ma_bosuutap']);
                            if ($laybosuutap) {
                                $resultBST = $laybosuutap->fetch_assoc();
                            }
                            ?>
                            <!-- <div class="carousel-item active"> -->
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultNB['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                // lấy hình ảnh
                                                $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultNB['ma_sanpham']);
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
                                                <h5 class="card-title "><?php echo $resultNB['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap']  ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                    <?php echo number_format($resultNB['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultNB['ma_sanpham'] ?>">
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
                            <!-- </div> -->
                            <?php
                        }
                    }
                ?>
            </div>
            <nav aria-label="..." class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                        $laySanPham_noiBat_phanTrang = $sanPham->laySanPham_noiBat_phanTrang();
                        $dem_sanpham = mysqli_num_rows($laySanPham_noiBat_phanTrang);
                        $trang_sanpham = ceil($dem_sanpham/6);
                        for ($i = 1; $i<= $trang_sanpham; $i ++){
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?trangNoiBat=<?php echo $i ?>">
                                        <?php echo $i ?>
                                    </a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="container">
            <h3 class="text-center">BIẾN NGÔI NHÀ THÀNH TỔ ẤM</h3>
            <div class="row text-center">
                <?php
                    $lay_danhmuc_combo = $danhMucCombo->show_danhmuc_combo();
                    if ($lay_danhmuc_combo){
                        while($resultDMC = $lay_danhmuc_combo->fetch_assoc()){
                            ?>
                                <div class="col">
                                    <a href="combo_danhMuc.php?ma_danhmuc_combo=<?php echo $resultDMC['ma_danhmuc_combo'] ?>">
                                        <img src="admin/uploads/<?php echo $resultDMC['hinhanh_danhmuc_combo'] ?>" alt="" class="img-fluid" style="width: 50%;" >
                                    </a>
                                    <p>
                                        <a href="combo_danhMuc.php?ma_danhmuc_combo=<?php echo $resultDMC['ma_danhmuc_combo'] ?>" 
                                            style="font-weight: bold; padding-top: 10%;">
                                            <?php echo $resultDMC['ten_danhmuc_combo'] ?>
                                        </a>
                                    </p>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>