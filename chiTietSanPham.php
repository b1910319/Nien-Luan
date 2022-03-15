<!DOCTYPE html>
<html lang="en">
<?php
    include_once("class/sanPham.php");
    include_once("class/danhMucSanPham.php");
    include_once("class/hinhAnh.php");
    include_once("class/boSuuTap.php");
    include_once("class/gioHang.php");
    include_once("class/binhLuan.php");
    $binhLuan = new binhLuan();
    $boSuuTap = new boSuuTap();
    $hinhanh = new hinhAnh();
    $sanPham = new sanPham();
    $gioHang = new gioHang();
    if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
        $masp = $_GET['masp'];
        $laysanpham = $sanPham->laySanPham($masp);
    }
    if (isset($_POST['binhluan'])){
        $binhluan_sanpham = $binhLuan->insert_binhluan();
    }
    //xóa bình luận
    if (isset($_GET['maBLXoa']) ){
        $maBLXoa = $_GET['maBLXoa'];
        $delete_binhluan = $binhLuan->delete_binhluan($maBLXoa);
    }
?>

<body>
    <div class="container-fluid">
        <!-- header  -->
        <?php include("include/header.php") ?>
        <!--  -->
        <br><br><br>
        <!-- chi tiết sản phẩm  -->
        <div class="container">
            <div class="duong-dan">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item duongdan-item"><a href="index.php"><i class="fas fa-home"></i></a>
                        </li>
                        <?php
                        if ($laysanpham) {
                            while ($result = $laysanpham->fetch_assoc()) {
                                // lấy tên danh mục của sản phẩm 
                                $danhMucSanPham = new danhMucSanPham();
                                $ten_danhmuc = $danhMucSanPham->layDanhMuc($result['ma_danhmuc']);
                                if ($ten_danhmuc) {
                                    $resultDM = $ten_danhmuc->fetch_assoc();
                                }
                                ?>
                                    <li class="breadcrumb-item active duongdan-item" aria-current="page"><a href=""><?php echo $resultDM['ten_danhmuc'] ?></a></li>
                                    <li class="breadcrumb-item duongdan-item"><a href=""><?php echo $result['ten_sanpham'] ?></li>
                                <?php
                            }
                        }
                        ?>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col chitiet-hinh">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                                $masp = $_GET['masp'];
                                $layhinhanh = $hinhanh->layHinhAnh_tuSanPham($masp);
                            }
                            if ($layhinhanh) {
                                while ($resultHA = $layhinhanh->fetch_assoc()) {
                                    ?>
                                            <div class="carousel-item " data-bs-interval="1500">
                                                <img src="admin/uploads/<?php echo $resultHA['hinhanh']  ?>" style="width: 100%;">
                                            </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="carousel-item  active" data-bs-interval="50">
                                <img src="">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col chitiet-info">
                    <?php
                        if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                            $masp = $_GET['masp'];
                            $laysanpham = $sanPham->laySanPham($masp);
                        }
                        if ($laysanpham) {
                            while ($resultSP = $laysanpham->fetch_assoc()) {
                                ?>
                                        <div class="chitiet-title">
                                        <h1><?php echo $resultSP['ten_sanpham'] ?></h1>
                                        <p class="masp">Mã sản phẩm: <?php echo $resultSP['ma_sanpham'] ?></p>
                                        <p class="tongsoluongsp">Sản phẩm còn lại: <?php echo $resultSP['tongsoluong_sanpham'] ?></p>
                                        <p class="card-price alert alert-danger giasp" role="alert"> <i class="fas fa-tags"></i>
                                            <?php echo number_format($resultSP['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?>
                                        </p>
                                    </div>
                                    <div class="chitiet-body mt-4">
                                        <div class="row chinhsach-muahang">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="img/chitiet-sanpham/baohanh.png" class=" img-fluid" width="100%">
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="chinhsach-title">1 năm bảo hành</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="img/chitiet-sanpham/giaohang.png" class=" img-fluid" width="100%">
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="chinhsach-title">Miễn phí giao hàng</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="img/chitiet-sanpham/tichdiem.png" class=" img-fluid" width="100%">
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="chinhsach-title">Tích điểm My Baya</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="img/chitiet-sanpham/khoanlap.png" class=" img-fluid" width="100%">
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="chinhsach-title">Miễn phí lắp đặt</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="img/chitiet-sanpham/doitra.png" class=" img-fluid" width="100%">
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="chinhsach-title">Đổi trả trong 3 ngày</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tóm tắt sản phẩm  -->
                                        <div class="row mt-4 tomtat-sanpham">
                                            <ul>
                                                <span class="spinner-grow text-danger"></span>
                                                <?php echo $resultSP['tomtat_sanpham'] ?>
                                            </ul>
                                        </div>
                                        <!--  -->
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="mota-sanpham">
                <?php
                $gioHang = new gioHang();
                if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                    $masp = $_GET['masp'];
                    $laysanpham = $sanPham->laySanPham($masp);
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themvaogio'])) {
                    $ma_khachhang = Session::get('login_ma');
                    $sessionid = session_id();
                    $soLuong = $_POST['soluong'];
                    $inset_giohang = $gioHang->insert_giohang($soLuong, $masp, $sessionid, $ma_khachhang);
                }
                ?>
                <form action="" method="POST">
                    <p>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"> <i class="fas fa-bars"></i> Mô
                                tả sản phẩm</a>
                        </div>
                        <div class="col">
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Quy cách</a>
                        </div>
                        <div class="col">
                            <div class="group">
                                <input name="soluong" type="number" required min="1" max="10" value="1">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label style="font-size: 18px; font-weight: bold;">Số lượng</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chitiet-muangay">
                                <?php
                                    $ma_nguoidung = Session::get('login_ma');
                                    if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                                        $masp = $_GET['masp'];
                                        $laysanpham = $sanPham->laySanPham($masp);
                                    }
                                    if ($laysanpham){
                                        $resultSP = $laysanpham->fetch_assoc();
                                    }
                                    if ($ma_nguoidung!= NULL ){
                                        if ($resultSP['tongsoluong_sanpham'] != 0){
                                            ?>
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <a href="gioHang.php" style="background-color: white;">
                                                    <button class="btn btn-primary" type="submit" name="themvaogio"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        else{
                                            ?>
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <a href="gioHang.php" style="background-color: white;">
                                                        <button class="btn btn-primary" > Sản phẩm hết hàng</button>
                                                    </a>
                                                </div>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <a href="dangNhap.php" style="background-color: white;">
                                                    <!-- <button class="btn btn-primary"> Đăng nhập để mua hàng</button> -->
                                                    <input type="text" class="btn btn-primary" value="Đăng nhập để mua hàng">
                                                </a>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    </p>
                </form>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card card-body">
                                <?php
                                if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                                    $masp = $_GET['masp'];
                                    $laysanpham = $sanPham->laySanPham($masp);
                                }
                                if ($laysanpham) {
                                    while ($resultSP = $laysanpham->fetch_assoc()) {
                                ?>
                                        <p>
                                            <i class="fas fa-dot-circle" style="color: #eb3007;"></i>
                                            <?php echo $resultSP['mota_sanpham'] ?>
                                        </p>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card card-body quy-cach">
                                <?php
                                if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                                    $masp = $_GET['masp'];
                                    $laysanpham = $sanPham->laySanPham($masp);
                                }
                                while ($resultSP = $laysanpham->fetch_assoc()) {
                                    // lấy tên danh mục của sản phẩm 
                                    $danhMucSanPham = new danhMucSanPham();
                                    $ten_danhmuc = $danhMucSanPham->layDanhMuc($resultSP['ma_danhmuc']);
                                    if ($ten_danhmuc) {
                                        $resultDM = $ten_danhmuc->fetch_assoc();
                                    }
                                    // 
                                    // lấy tên xuất xứ của sản phẩm
                                    $xuatxu = new xuatXu();
                                    $ten_xuatxu = $xuatxu->layXuatXu($resultSP['ma_xuatxu']);
                                    if ($ten_xuatxu) {
                                        $resultXX = $ten_xuatxu->fetch_assoc();
                                    }
                                    // 
                                ?>
                                    <p><span>Sản phẩm: </span> <?php echo $resultSP['ten_sanpham'] ?></p>
                                    <p><span>Danh mục: </span> <?php echo $resultDM['ten_danhmuc'] ?></p>
                                    <p><span>Kích thước: </span> <?php echo $resultSP['kichthuoc_sanpham'] ?></p>
                                    <p><span>Chất liệu: </span> <?php echo $resultSP['vatlieu_sanpham'] ?></p>
                                    <p><span>Màu sắc: </span> <?php echo $resultSP['mausac_sanpham'] ?></p>
                                    <p><span>Xuất xứ: </span> <?php echo $resultXX['ten_xuatxu'] ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
        <!-- sản phẩm tương tự -->
        <div class="top-ban-chay container">
            <div class="row">
                <div class="col-9">
                    <p class="btn btn-primary"> Sản phẩm tương tự</p>
                </div>
                <div class="col-3">
                    <nav class="navbar navbar-light ">
                        <div class="container-fluid">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sanpham container">
            <div class="row">
                <?php
                if (isset($_GET['masp']) && $_GET['masp'] != NULL) {
                    $masp = $_GET['masp'];
                    $laysanpham = $sanPham->laySanPham($masp);
                }
                if ($laysanpham) {
                    while ($resultSP = $laysanpham->fetch_assoc()) {
                        $laysanpham_theodanhmuc = $sanPham->laySanPham_theoDanhmuc($resultSP['ma_danhmuc']);
                        if ($laysanpham_theodanhmuc) {
                            while ($resultSP_DM = $laysanpham_theodanhmuc->fetch_assoc()) {
                                $laybosuutap = $boSuuTap->layBoSuuTap($resultSP_DM['ma_bosuutap']);
                                if ($laybosuutap) {
                                    $resultBST = $laybosuutap->fetch_assoc();
                                }
                                ?>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 sanpham-chitiet">
                                        <a href="chiTietSanPham.php?masp=<?php echo $resultSP_DM['ma_sanpham'] ?>">
                                            <div class="card">
                                                <div class="cart-heart ">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                                <div class="cart-img">
                                                    <?php
                                                    // lấy hình ảnh
                                                    $layHinhAnh = $hinhanh->layHinhAnh_tuSanPham($resultSP_DM['ma_sanpham']);
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
                                                    <h5 class="card-title "><?php echo $resultSP_DM['ten_sanpham'] ?></h5>
                                                    <h6 class="text-center card-bst"><?php echo $resultBST['ten_bosuutap'] ?></h6>
                                                    <p class="card-price alert alert-danger" role="alert"> <i class="fas fa-tags"></i>
                                                        <?php echo number_format($resultSP_DM['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></p>
                                                    <div class="cart-action">
                                                        <a href="chiTietSanPham.php?masp=<?php echo $resultSP_DM['ma_sanpham'] ?>">
                                                            <button type="submit" class="btn btn-danger muangay">
                                                            <i class="fas fa-info-circle"></i> Chi tiết
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
                    }
                }
                ?>
            </div>
        </div>
        <div class="container binhluan ">
            <?php
                $ten_khachhang = Session::get('login_ten');
                $ma_khachhang = Session::get('login_ma');
            ?>
            <h3 ><strong>Nhận xét về sản phẩm</strong></h3>
            <hr>
            <?php
                $lay_binhluan = $binhLuan->hienthi_binhluan($masp);
                if ($lay_binhluan){
                    while ($resultBL = $lay_binhluan->fetch_assoc()){
                        $lay_tenkhach = $nguoiDung->show_thongTin($resultBL['ma_nguoidung']);
                        if ($lay_tenkhach){
                            $resultTenKhach = $lay_tenkhach->fetch_assoc();
                        }
                        ?>
                            <p style="color: #eb3007; font-weight: bold;"><?php echo $resultTenKhach['hoten_nguoidung'] ?> <i class="fas fa-solid fa-check-double" style="color: #038018;"></i></p>
                            <p><?php echo $resultBL['noidung_binhluan'] ?></p>
                            <p><?php echo $resultBL['thoigian_binhluan'] ?></p>
                            <?php
                                if($ma_khachhang == $resultBL['ma_nguoidung']){
                                    ?>
                                        <a href="suaBinhLuan.php?maBL=<?php echo $resultBL['ma_binhluan'] ?>">
                                            <i class="fas fa-pen"></i> Chỉnh sửa
                                        </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a onclick="return confirm('Bạn có muốn xóa bình luận không?')" href="?maBLXoa=<?php echo $resultBL['ma_binhluan'] ?>">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </a>
                                    <?php
                                } else{
                                    echo '';
                                }
                            ?>
                            
                            <hr>
                        <?php
                    }
                }
            ?>
            <?php
                $ma_khachhang = Session::get('login_ma');
                if ($ma_khachhang != NULL){
                    ?>
                        <h3 ><strong>Viết nhận xét</strong></h3>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="exampleFormControlInput1" name="ma_sanpham" value="<?php echo $masp ?>">
                                <input type="hidden" class="form-control" id="exampleFormControlInput1" name="ma_khach" value="<?php echo $ma_khachhang ?>">
                                <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="ten_khach" value="<?php echo $ten_khachhang ?>">
                            </div>
                            <div class="mb-3">
                                <textarea name="noidung_binhluan" style="resize: none;" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                            <input type="submit" name="binhluan" class="btn btn-outline-success " style="font-weight: bold;" value="Gửi bình luận">
                        </form>
                    <?php
                }
                else{
                    echo " ";
                }
            ?>
        </div>
        <br><br>
        <?php include("include/footerTop.php") ?>
        <?php include("include/footer.php") ?>
    </div>
</body>

</html>