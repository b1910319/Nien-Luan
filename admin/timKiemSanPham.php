<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
</head>
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once("../class/danhMucSanPham.php") ?>
    <?php include_once("../class/xuatXu.php") ?>
    <?php include_once("../class/phong.php") ?>
    <?php include_once("../class/boSuuTap.php") ?>
    <?php 
        include_once("../class/combo.php");
    ?>
    <?php
        include_once("../class/sanPham.php");
        $sanPham = new sanPham();
    ?>
        <?php 
        if (isset($_GET['timkiem-sanpham']) ){
            $timkiem_sanpham = $_GET['timkiem-sanpham'];
            $timkiem_sanpham_ds = $sanPham->timkiem($timkiem_sanpham);
        }
    ?>
    <div class="container danh-sach-san-pham" style="margin-top: 100px;  ">
        <div>
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_sanpham ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachSanPham.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách sản phẩm
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemSanPham.php" method="get">
                        <input name="timkiem-sanpham" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

            </ol>
        </nav>
        <div class="danh-sach-san-pham-body">
            <div class=" table-responsive ">
            <?php
                if (isset($delete_sanpham)){
                    echo $delete_sanpham;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <?php
                            if ($timkiem_sanpham_ds){
                                ?>
                                    <tr>
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                                        <th scope="col" class="tieude-bang">Gía</th>
                                        <th scope="col" class="tieude-bang">Tổng số lượng</th>
                                        <th scope="col" class="tieude-bang">Combo</th>
                                        <th scope="col" class="tieude-bang">Danh mục</th>
                                        <th scope="col" class="tieude-bang">Xuất xứ</th>
                                        <th scope="col" class="tieude-bang">Phòng</th>
                                        <th scope="col" class="tieude-bang">Bộ sưu tập</th>
                                        <th scope="col" class="tieude-bang">Loại sản phẩm</th>
                                        <th scope="col" class="tieude-bang">Quản lý</th>
                                    </tr>
                                <?php
                            }
                            else{
                                ?>
                                    <h5 style="color: #eb3007; font-weight: bold;">Sản phẩm được tìm hiện không tồn tại</h5>
                                <?php
                            }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            if ($timkiem_sanpham_ds){
                                $i=0;
                                while ($result = $timkiem_sanpham_ds->fetch_assoc()){
                                    $i++;
                                    // lấy tên danh mục của sản phẩm 
                                    $danhMucSanPham = new danhMucSanPham();
                                    $ten_danhmuc = $danhMucSanPham->layDanhMuc($result['ma_danhmuc']);
                                    if($ten_danhmuc){
                                        $resultDM=$ten_danhmuc->fetch_assoc();
                                    }
                                    // 
                                    // lấy tên xuất xứ của sản phẩm
                                    $xuatxu = new xuatXu();
                                    $ten_xuatxu = $xuatxu->layXuatXu($result['ma_xuatxu']);
                                    if($ten_xuatxu){
                                        $resultXX=$ten_xuatxu->fetch_assoc();
                                    }
                                    // 
                                    // lấy tên phòng của sản phẩm
                                    $phong = new phong();
                                    $ten_phong = $phong->layPhong($result['ma_phong']);
                                    if($ten_phong){
                                        $resultP=$ten_phong->fetch_assoc();
                                    }
                                    // 
                                     // lấy tên bộ sưu tập của sản phẩm
                                    $boSuuTap = new boSuuTap();
                                    $ten_bosuutap = $boSuuTap->layBoSuuTap($result['ma_bosuutap']);
                                    if($ten_bosuutap){
                                        $resultBST=$ten_bosuutap->fetch_assoc();
                                    }
                                     // 
                                     // lấy tên combo của sản phẩm
                                    $combo = new combo();
                                    
                                     // 
                                    ?>
                                        <tr>
                                            <th scope="row" style="width: 5%;"><?php echo $i ?></th>
                                            <td style="width: 10%;"><?php echo $result['ten_sanpham'] ?></td>
                                            <td style="width: 10%;"><?php echo number_format($result['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                            <td style="width: 5%;"><?php echo $result['tongsoluong_sanpham'] ?></td>
                                            <td style="width: 10%;">
                                                <?php 
                                                    $ten_combo = $combo->layCombo($result['ma_combo']);
                                                    if($ten_combo){
                                                        $resultC=$ten_combo->fetch_assoc();
                                                        echo $resultC['ten_combo'];
                                                    }
                                                ?>
                                            </td>
                                            <td style="width: 10%;"><?php echo $resultDM['ten_danhmuc'] ?></td>
                                            <td style="width: 10%;"><?php echo $resultXX['ten_xuatxu'] ?></td>
                                            <td style="width: 10%;"><?php echo $resultP['ten_phong'] ?></td>
                                            <td style="width: 5%;"><?php echo $resultBST['ten_bosuutap'] ?></td>
                                            <td style="width: 10%;">
                                                <?php
                                                    if($result['loai_sanpham'] == 1){
                                                        echo 'Sản phẩm nổi bật';
                                                    } else {
                                                        echo 'Top bán chạy';
                                                    }
                                                ?>
                                            </td>
                                            <td style="width: 15%;" >
                                                <a href="suaSanPham.php?ma=<?php echo $result['ma_sanpham'] ?>" >
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của  <?php echo $result['ten_sanpham'] ?> không?')" href="danhSachSanPham.php?maXoa=<?php echo $result['ma_sanpham'] ?>">
                                                    <button type="button" class="btn xoa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>