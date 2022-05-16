<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/sanPham.php") ?>
    <?php include_once("../class/danhMucSanPham.php") ?>
    <?php include_once ("../class/xuatXu.php") ?>
    <?php include_once("../class/phong.php") ?>
    <?php include_once("../class/boSuuTap.php") ?>
    <?php include_once("../class/hinhAnh.php") ?>
    <?php include_once("../class/combo.php") ?>
    <?php 
        $sanPham = new sanPham();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_sanpham = $sanPham->delete_sanpham($maXoa);
        }
    ?>
    <div class="container danh-sach-san-pham" style="margin-top: 100px;  ">
        <div >
            <h1  class="alert alert-secondary" role="alert">DANH SÁCH SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themSanPham.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
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
                    </thead>
                    <tbody>
                        <?php
                            $tatca_sanpham = $sanPham->show_sanpham();
                            if ($tatca_sanpham){
                                $i=0;
                                while ($result = $tatca_sanpham->fetch_assoc()){
                                    $i++;
                                    // lấy tên danh mục của sản phẩm 
                                    $danhMucSanPham = new danhMucSanPham();
                                    $ten_danhmuc = $danhMucSanPham->layDanhMuc($result['ma_danhmuc']);
                                    if($ten_danhmuc){
                                        $resultDM=$ten_danhmuc->fetch_assoc();
                                    }
                                    // lấy tên xuất xứ của sản phẩm
                                    $xuatxu = new xuatXu();
                                    $ten_xuatxu = $xuatxu->layXuatXu($result['ma_xuatxu']);
                                    if($ten_xuatxu){
                                        $resultXX=$ten_xuatxu->fetch_assoc();
                                    }
                                    // lấy tên phòng của sản phẩm
                                    $phong = new phong();
                                    $ten_phong = $phong->layPhong($result['ma_phong']);
                                    if($ten_phong){
                                        $resultP=$ten_phong->fetch_assoc();
                                    }
                                     // lấy tên bộ sưu tập của sản phẩm
                                    $boSuuTap = new boSuuTap();
                                    $ten_bosuutap = $boSuuTap->layBoSuuTap($result['ma_bosuutap']);
                                    if($ten_bosuutap){
                                        $resultBST=$ten_bosuutap->fetch_assoc();
                                    }
                                     // lấy tên combo của sản phẩm
                                    $combo = new combo();
                                    $ten_combo = $combo->layCombo($result['ma_combo']);
                                    if($ten_combo){
                                        $resultC=$ten_combo->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row" style="width: 5%;"><?php echo $i ?></th>
                                            <td style="width: 10%;"><?php echo $result['ten_sanpham'] ?></td>
                                            <td style="width: 10%;"><?php echo number_format($result['gia_sanpham'], 0, ',', '.') . ' <sup>đ</sup>' ?></td>
                                            <td style="width: 5%;"><?php echo $result['tongsoluong_sanpham'] ?></td>
                                            <td style="width: 10%;">
                                                <?php 
                                                if($result['ma_combo'] == 0){
                                                    echo "";
                                                } else{
                                                    echo $resultC['ten_combo'] ;
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
                                                <a onclick="return confirm('Bạn có muốn xóa hình ảnh của  <?php echo $result['ten_sanpham'] ?> không?')" href="?maXoa=<?php echo $result['ma_sanpham'] ?>">
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

</html>