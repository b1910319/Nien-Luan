<?php
include_once("class/gioHang.php");
include_once("class/hinhAnh.php");
$hinhAnh = new hinhAnh();
$gioHang = new gioHang();
?>
<?php
if (isset($_GET['maXoa'])) {
    $maXoa = $_GET['maXoa'];
    $delete_giohang = $gioHang->delete_giohang($maXoa);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $ma_giohang = $_POST['ma_giohang'];
    $soLuong = $_POST['soluong'];
    $update_giohang = $gioHang->update_giohang($soLuong, $ma_giohang);
}
?>
<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Giỏ hàng</title>


<body>
    <div class="container-fluid">
        <?php include("include/header.php") ?>
        <!--  -->
        <br><br><br>
        <!-- giỏ hàng  -->
        <div class="container">
            <div class="duong-dan">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item duongdan-item"><a href="index.php"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active duongdan-item" aria-current="page"><a href="">Giỏ hàng</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row giohang-title">
            <div class="col">
                <a href="index.php">
                    <p class="gio-hang-tieptuc-muasam">
                        <i class="fas fa-chevron-left"></i>
                        Tiếp tục mua hàng
                    </p>
                </a>
            </div>
            <div class="col">
                <h1> <strong>GIỎ HÀNG</strong> </h1>
                <?php
                if (isset($update_giohang)) {
                    echo $update_giohang;
                }
                if (isset($delete_giohang)) {
                    echo $delete_giohang;
                }
                ?>
            </div>
            <?php
            $logincheck = Session::get('login_nguoidung');
            if ($logincheck == false) {
            ?>
                <div class="col">
                </div>
            <?php
            } else {
            ?>
                <div class="col">
                    <a href="">
                        <p class="giohang-thanhtoan">
                            <a href="thanhToan.php">Thanh toán <i class="fas fa-chevron-right"></i></a>
                        </p>
                    </a>
                </div>
            <?php
            }
            ?>
            <!-- <div class="col">
                <a href="">
                    <p class="giohang-thanhtoan">
                        Thanh toán
                        <i class="fas fa-chevron-right"></i>
                    </p>
                </a>
            </div> -->
        </div>
        <div class="giohang-body container">
            <table class="table table-hover">
                <thead>
                    <tr class="table-giohang-title">
                        <th scope="col">STT</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Gía</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ma_khachhang = Session::get('login_ma');
                    $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                    if ($laysanpham_tugiohang) {
                        $i = 0;
                        $tongTien = 0;
                        while ($resultDH = $laysanpham_tugiohang->fetch_assoc()) {
                            $i++;
                            $laytensanpham = $sanPham->laySanPham($resultDH['ma_sanpham']);
                            if ($laytensanpham){
                                $resultSP = $laytensanpham->fetch_assoc();
                            }
                            ?>
                                <tr class="table-giohang-body">
                                    <th scope="row"><?php echo $i ?></th>
                                    <td>
                                        <?php
                                        // lấy hình ảnh
                                        $layHinhAnh = $hinhAnh->layHinhAnh_tuSanPham($resultDH['ma_sanpham']);
                                        if ($layHinhAnh) {
                                            while ($resultHA = $layHinhAnh->fetch_assoc()) {
                                        ?>
                                                <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" class="card-img-top img-fluid" style="width: 150px;!important">
                                        <?php
                                                break;
                                            }
                                        }
                                        // 
                                        ?>
                                    </td>
                                    <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" name="ma_giohang" value="<?php echo $resultDH['ma_giohang'] ?>">
                                                <input type="number" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" min="0" max="10" name="soluong" value="<?php echo $resultDH['soluong_sanpham'] ?>">
                                                <button class="btn btn-success" name="update" type="submit" id="button-addon2">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <?php echo number_format($resultSP['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?>
                                    </td>
                                    <td>
                                        <?php
                                        $thanhTien = $resultDH['soluong_sanpham'] * $resultSP['gia_sanpham'];
                                        $tongTien += $thanhTien;
                                        echo number_format($thanhTien, 0, ',', '.') . ' <sup>đ</sup>';
                                        ?>
                                    </td>
                                    <td><a href="?maXoa=<?php echo $resultDH['ma_giohang'] ?>"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--  -->
        <div class="container">
            <div class="giohang-bottom">
                <?php
                // $sessionid = session_id();
                // $check_giohang = $gioHang->check_giohang($sessionid);
                $ma_khachhang = Session::get('login_ma');
                $session_masp = Session::get('giohang_masanpham');
                $laysanpham_tugiohang = $gioHang->lay_donhang($ma_khachhang);
                if ($ma_khachhang ) {
                    if ($session_masp == NULL && $laysanpham_tugiohang == false){
                        ?>
                            <center><img src="img/gio-hang/gio-hang-trong.png" class="img-fluid" style="width: 30%;"></center>
                        <?php
                    }
                    else{
                        ?>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <p style="font-weight: bold; font-size: 20px;">Nhập mã ưu đãi tại đây</p>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nhập Mã Giảm Gía" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" style="background-color: #eb3007; color: white; font-weight: bold;">ÁP DỤNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="giohang-tamtinh">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Tạm tính </th>
                                                    <td style="text-align: right; font-weight: bold; color: #8f8fa7;">
                                                        <?php
                                                        echo number_format($tongTien, 0, ',', '.') . ' <sup>đ</sup>';
                                                        Session::set('tong', $tongTien);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Giảm giá </th>
                                                    <td style="text-align: right; font-weight: bold; color: #8f8fa7;">0 <sup>đ</sup></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Vận chuyển </th>
                                                    <td style="text-align: right; font-weight: bold; color: #8f8fa7;">MIỄN PHÍ</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: #038018;">TỔNG THANH TOÁN </th>
                                                    <td style="text-align: right; color: #eb3007; font-weight: bold; font-size: 20px;"><?php echo number_format($tongTien, 0, ',', '.') . ' <sup>đ</sup>'; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="chitiet-muangay" style="margin-bottom: 20px;">
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <?php
                                                $logincheck = Session::get('login_nguoidung');
                                                if ($logincheck == false) {
                                                    echo '<a href="dangNhap.php"><button class="btn btn-primary" type="button" style="width: 100%;">ĐĂNG NHẬP </button></a> ';
                                                } else {
                                                    echo '<a href="thanhToan.php"><button class="btn btn-primary" type="button" style="width: 100%;">THANH TOÁN</button></a>';
                                                }
                                                ?>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                
                } else {
                    // echo '<a href="dangNhap.php"><button class="btn btn-primary" type="button" style="width: 50%;">ĐĂNG NHẬP </button></a> ';
                    ?>
                        <div class="row">
                            <div class="col">
                                <h5 class="text-end" style="color: #9daf88;">Qúy khách vui lòng đăng nhập để tiếp tục mua hàng</h5>
                            </div>
                            <div class="col">
                                <a href="dangNhap.php"><button class="btn btn-primary" type="button" style="width: 50%;">ĐĂNG NHẬP </button></a>
                            </div>
                        </div>
                    <?php
                }
                ?>





            </div>
        </div>

        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
        <!--  -->
    </div>
</body>

</html>

