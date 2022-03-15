<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br><br>
        <div class="container">
            <div class="row">
            <div class="col-4">
                    <a href="gioHang.php">
                        <p class="gio-hang-tieptuc-muasam " style="font-weight: bold;">
                            <i class="fas fa-chevron-left"></i>
                            Quay về
                        </p>
                    </a>
                </div>
                <div class="col-8">
                    <h1 style="font-weight: bold;">THANH TOÁN</h1>
                </div>
            </div>
            <!-- <h4>Qúy khách vui lòng chọn hình thức thanh toán</h4> -->
            <div class="row">
                <div class="col mt-3">
                    <a href="thanhToanOff.php">
                        <button class="btn btn-outline-success " style="font-weight: bold;">
                            <img src="img/hinhthuc-thanhtoan/thanh-toan-khi-nhan-hang.svg" alt="">
                            Thanh toán khi nhận được hàng
                        </button>
                    </a>
                </div>
                <div class="col mt-3">
                    <a href="donHangThanhToanOnl.php">
                        <button class="btn btn-outline-success" style="font-weight: bold;">
                            <img src="img/hinhthuc-thanhtoan/thanh-toan-onl.svg" >
                            Thanh toán Online
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <br><br>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>