<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <br><br><br>
        <h1 class="text-center" style="font-weight: bold;">LỊCH SỬ ĐƠN HÀNG</h1>
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-giohang-title">
                                <th scope="col">STT</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Số sản phẩm đặt</th>
                                <th scope="col">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $ma_khachhang = Session::get('login_ma');
                                $laysanpham_tudonhang = $donHang->lay_donhang_thoigian($ma_khachhang);
                                if ($laysanpham_tudonhang) {
                                    $i = 0;
                                    $tongTien = 0;
                                    while ($resultDH = $laysanpham_tudonhang->fetch_assoc()) {
                                        $i++;
                                        $dem_donhang_thoigian = $donHang->dem_donhang_thoigian($ma_khachhang, $resultDH['ngay_dathang']);
                                        if($dem_donhang_thoigian){
                                            $resultDemDH = $dem_donhang_thoigian->fetch_assoc();
                                            ?>
                                                <tr class="table-giohang-body">
                                                    <th><?php echo $i; ?></th>
                                                    <td scope="row"><?php echo $resultDH['ngay_dathang'] ?></td>
                                                    <td scope="row"><?php echo $resultDemDH['tongsp_ngaydathang'] ?></td>
                                                    <td scope="row">
                                                        <a href="chiTietLichSuDonHang.php?ma_khachhang=<?php echo $ma_khachhang ?>&&ngay_dathang=<?php echo $resultDH['ngay_dathang'] ?>">
                                                            <button type="button" class="btn chitiet_donhang" >
                                                                <i class="fas fa-info-circle"></i> 
                                                                Chi tiết đơn hàng
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                        
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>