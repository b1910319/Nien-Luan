<!DOCTYPE html>
<html lang="en">
<?php
    include_once("class/sanPham.php");
    include_once("class/danhMucSanPham.php");
    include_once("class/hinhAnh.php");
    include_once("class/boSuuTap.php");
    include_once("class/gioHang.php");
    include_once("class/binhLuan.php");
    include_once("class/nguoiDung.php");
    $nguoiDung = new nguoiDung();
    $binhLuan = new binhLuan();
    $sanPham = new sanPham();
    if(isset($_GET['maBL']) && $_GET['maBL'] !=NULL ){
        $maBL = $_GET['maBL'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suabinhluan'])){
        $noidung_binhluan = $_POST['noidung_binhluan'];
        $update_binhluan = $binhLuan->update_binhluan($noidung_binhluan, $maBL);
    }
?>

<body>
    <div class="container-fluid">
        <!-- header  -->
        <?php include("include/header.php") ?>
        <!--  -->
        <br><br><br>
        <div class="container binhluan ">
            <h3 ><strong>Sửa bình luận</strong></h3>
            <?php
                $ten_khachhang = Session::get('login_ten');
                $ma_khachhang = Session::get('login_ma');
            ?>
            <?php
                $ma_khachhang = Session::get('login_ma');
                if ($ma_khachhang != NULL){
                    $lay_binhluan_maBL = $binhLuan->lay_binhluan_maBL($maBL);
                    if ($lay_binhluan_maBL){
                        $resultBLMa = $lay_binhluan_maBL->fetch_assoc();
                    }
                    $lay_nguoidung = $nguoiDung->show_thongTin($resultBLMa['ma_nguoidung']);
                    if ($lay_nguoidung){
                        $resultND = $lay_nguoidung->fetch_assoc();
                    }
                    ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="exampleFormControlInput1" name="ma_sanpham" value="<?php echo $masp ?>">
                                <input type="hidden" class="form-control" id="exampleFormControlInput1" name="ma_khach" value="<?php echo $ma_khachhang ?>">
                                <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="ten_khach" value="<?php echo $resultND['hoten_nguoidung'] ?>">
                            </div>
                            <div class="mb-3">
                                <textarea name="noidung_binhluan" style="resize: none;" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $resultBLMa['noidung_binhluan'] ?></textarea>
                            </div>
                            <input type="submit" name="suabinhluan" class="btn btn-outline-success " style="font-weight: bold;" value="Sửa bình luận">
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