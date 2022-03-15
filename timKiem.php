<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>
</head>
<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br> <br>
        <?php
            if (isset($_GET['timkiem'])){
                $timkiem = $_GET['timkiem'];
            }
        ?>
        <?php
            include_once("class/sanPham.php");
            $sanPham = new sanPham();
            include_once("class/boSuuTap.php");
            $boSuuTap = new boSuuTap();
        ?>
        <div class="container">
            <div class="top-ban-chay">
                <p class="btn btn-primary" disabled>
                    <span class="" role="status" aria-hidden="true"></span>
                    KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem ?>"
                </p>
            </div>
            <div class="row">
                <?php
                    $timkiem_sanpham = $sanPham->timKiem($timkiem);
                    if ($timkiem_sanpham) {
                        while ($resultTK = $timkiem_sanpham->fetch_assoc()) {
                            // lấy tên bộ sưu tập 
                            $laybosuutap = $boSuuTap->layBoSuuTap($resultTK['ma_bosuutap']);
                            if ($laybosuutap) {
                                $resultBST = $laybosuutap->fetch_assoc();
                            }
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 sanpham-chitiet">
                                    <a href="chiTietSanPham.php?masp=<?php echo $resultTK['ma_sanpham'] ?>">
                                        <div class="card">
                                            <div class="cart-heart ">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div class="cart-img">
                                                <?php
                                                // lấy hình ảnh
                                                $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultTK['ma_sanpham']);
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
                                                <h5 class="card-title "><?php echo $resultTK['ten_sanpham'] ?></h5>
                                                <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap']  ?></h6>
                                                <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                    <?php echo number_format($resultTK['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                <div class="cart-action">
                                                    <a href="chiTietSanPham.php?masp=<?php echo $resultTK['ma_sanpham'] ?>">
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
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>
</html>