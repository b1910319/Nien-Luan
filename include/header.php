<?php
    include("lib/session.php");
    Session::init();
?>
<?php
    include_once("lib/database.php");
    include_once("helper/format.php");
    spl_autoload_register(function ($className) {
        include_once "class/" . $className . ".php";
    });
    $xuaXu = new xuatXu();
    $phong = new phong();
    $boSuuTap = new boSuuTap();
    $hinhAnh = new hinhAnh();
    $database = new database();
    $format = new fomat();
    $nguoiDung = new nguoiDung();
    $sanPham = new sanPham();
    $danhMuc = new danhMucSanPham();
    $gioHang = new gioHang();
    $donHang = new donHang();

?>
<?php
    $con = mysqli_connect('localhost', 'root', '', 'nienluan_noithat');
    $res = mysqli_query($con, "SELECT * FROM `danhmuc_sanpham`");
    while ($row = mysqli_fetch_assoc($res)) {
        $arr[$row['ma_danhmuc']]['ten_danhmuc'] = $row['ten_danhmuc'];
        $arr[$row['ma_danhmuc']]['danhmuc_cha'] = $row['danhmuc_cha'];
    }
    $html = '';
    function menu_tree($arr, $parent, $level = 0, $prelevel = -1)
    {
        global $html;
        foreach ($arr as $id => $data) {
            if ($parent == $data['danhmuc_cha']) {
                if ($level > $prelevel) {
                    if ($html == '') {
                        $html .= '<ul>';
                    } else {
                        $html .= '<ul class="sub-menu">';
                    }
                }
                if ($level == $prelevel) {
                    $html .= '</li>';
                }
                $html .= "<li><a href='sanPham_danhMuc.php?maDM=$id'>" . $data['ten_danhmuc'] . '</a>';
                if ($level > $prelevel) {
                    $prelevel = $level;
                }
                $level++;
                menu_tree($arr, $id, $level, $prelevel);
                $level--;
            }
        }
        if ($level == $prelevel) {
            $html .= '</li></ul>';
        }
        return $html;
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/bootstrap-5.1.3-dist//css//bootstrap.min.css">
    <script src="lib/bootstrap-5.1.3-dist//js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- link icon  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--  -->
    <title>BAYA</title>
</head>
<header >
    <div class="header">
        <a href=""><img src="img/header/mienphi-giaohang.gif" class="img-fluid" style="height: 65px;"></a>
    </div>
    <div class="menu1">
        <div class="row ">
            <div class="col-2">
                <a href="index.php"><img src="img/header/logo.png" class="img-fluid" style="width: 50%;"></a>
            </div>
            <?php
                if (isset($_GET['ma_nguoidung'])) {
                    Session::destroy();
                }
            ?>
            <?php
                $logincheck = Session::get('login_nguoidung');
                if ($logincheck == false) {
                    ?>
                        <div class="col">
                            <a href="dangNhap.php"><button type="button" class="btn btn-danger chucnang"><i class="fas fa-user-shield"></i>
                                    &nbsp; Đăng nhập</button></a>
                        </div>
                        <div class="col">
                            <a href="dangKy.php"><button type="button" class="btn btn-danger chucnang"><i class="fas fa-user-edit"></i> &nbsp;
                                    Đăng Ký</button></a>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="col">
                            <a href="?ma_nguoidung=<?php echo Session::get('login_ma') ?>"><button type="button" class="btn btn-danger chucnang"><i class="fas fa-sign-out-alt"></i> &nbsp;
                                    Đăng Xuất</button></a>
                        </div>
                        <div class="col">
                            <a href="thongTinKhachHang.php"><button type="button" class="btn btn-danger chucnang"><i class="fas fa-info"></i> &nbsp;
                                    Thông Tin</button></a>
                        </div>
                        <div class="col">
                            <a href="lichSuDonHang.php"><button type="button" class="btn btn-danger chucnang"><i class="fas fa-history"></i> &nbsp;
                                    Đơn hàng</button></a>
                        </div>
                    <?php
                }
            ?>
            <div class="col">
                <a href="gioHang.php">
                    <button type="button" class="btn btn-danger chucnang position-relative">
                        <i class="fas fa-shopping-cart"></i> &nbsp; Giỏ hàng
                        <span class="position-absolute p-2 top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            <?php
                                $ma_nguoidung = Session::get('login_ma');
                                $lay_giohang = $gioHang->lay_donhang($ma_nguoidung);
                                $tong = 0;
                                if ($lay_giohang){
                                    while($resultGH = $lay_giohang->fetch_assoc()){
                                        $ma_sanpham = $resultGH['ma_sanpham'];
                                        $lay_gia = $sanPham->laySanPham($ma_sanpham);
                                        if ($lay_gia){
                                            $resultSP = $lay_gia->fetch_assoc();
                                            $tong+=$resultGH['soluong_sanpham'] * $resultSP['gia_sanpham'];
                                        }
                                    }
                                }
                                if (isset($ma_nguoidung)){
                                    echo number_format($tong, 0, ',', '.') . ' <sup>đ</sup>';
                                }
                                else{
                                    echo '0 <sup>đ</sup>';
                                }
                            ?>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="menu2 row  ">
        <nav class="nav">
            <div class="menu-icon">
                <i class="fas fa-bars" id="open"></i>
                <i class="fas fa-times  " id="close"></i>
                <script src="js/js.js"></script>
            </div>
            <ul class="nav-list">
                <div class="col">
                    <li>
                        <a href="index.php"> <i class="fas fa-home"></i> Trang chủ</a>
                    </li>
                </div>
                <div class="col-2">
                    <li>
                        <?php
                        echo menu_tree($arr, 0);
                        ?>
                    </li>
                </div>
                <div class="col">
                    <li>
                        <!-- in menu bộ sưu tập ra màn hình -->
                        <?php
                        $conBST = mysqli_connect('localhost', 'root', '', 'nienluan_noithat');
                        $resBST = mysqli_query($conBST, "SELECT * FROM `bosuutap`");
                        while ($row = mysqli_fetch_assoc($resBST)) {
                            $arrBST[$row['ma_bosuutap']]['ten_bosuutap'] = $row['ten_bosuutap'];
                            $arrBST[$row['ma_bosuutap']]['bosuutap_cha'] = $row['bosuutap_cha'];
                        }
                        $html = '';
                        function menu_treeBST($arrBST, $parent, $level = 0, $prelevel = -1)
                        {
                            global $html;
                            foreach ($arrBST as $id => $data) {
                                if ($parent == $data['bosuutap_cha']) {
                                    if ($level > $prelevel) {
                                        if ($html == '') {
                                            $html .= '<ul>';
                                        } else {
                                            $html .= '<ul class="sub-menu">';
                                        }
                                    }
                                    if ($level == $prelevel) {
                                        $html .= '</li>';
                                    }
                                    $html .= "<li><a href='sanPham_boSuuTap.php?maBST=$id'>" . $data['ten_bosuutap'] . '</a>';
                                    if ($level > $prelevel) {
                                        $prelevel = $level;
                                    }
                                    $level++;
                                    menu_treeBST($arrBST, $id, $level, $prelevel);
                                    $level--;
                                }
                            }
                            if ($level == $prelevel) {
                                $html .= '</li></ul>';
                            }
                            return $html;
                        }
                        ?>
                        <?php
                        echo menu_treeBST($arrBST, 0);
                        ?>
                        <!--  -->
                    </li>
                </div>
                <div class="col">
                    <li>
                        <a href=""> Phòng</a>
                        <ul class="sub-menu">
                            <?php
                            $conP = mysqli_connect('localhost', 'root', '', 'nienluan_noithat');
                            $resP = mysqli_query($conP, "SELECT * FROM `phong`");
                            while ($row = mysqli_fetch_assoc($resP)) {
                            ?>
                                <li>
                                    <a href="sanPham_phong.php?maPhong=<?php echo $row['ma_phong'] ?>"> <?php echo $row['ten_phong'] ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </div>
                <div class="col">
                    <li>
                        <a href=""> Combo</a>
                        <ul class="sub-menu">
                            <?php
                            $conCombo = mysqli_connect('localhost', 'root', '', 'nienluan_noithat');
                            $resCombo = mysqli_query($conCombo, "SELECT * FROM `danhmuc_combo`");
                            while ($row = mysqli_fetch_assoc($resCombo)) {
                            ?>
                                <li>
                                    <a href="combo_danhMuc.php?ma_danhmuc_combo=<?php echo $row['ma_danhmuc_combo'] ?>"> <?php echo $row['ten_danhmuc_combo'] ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </div>
                <div class="col">
                    <nav class="navbar navbar-light ">
                        <form class="d-flex" action="timKiem.php" method="get" >
                            <input name="timkiem" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" >
                            <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </nav>
                </div>
            </ul>
        </nav>
    </div>
</header>