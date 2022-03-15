<?php
    include_once("../class/sanPham.php");
    include_once("../class/danhMucSanPham.php");
    include_once("../class/boSuuTap.php");
    include_once("../class/phong.php");
    include_once("../class/xuatXu.php");
    include_once("../class/combo.php");
?>
<?php
    $sanPham = new sanPham();
    if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suasanpham'])){
        $update_sanpham = $sanPham->update_sanpham($_POST, $ma);
    }
?>
<!DOCTYPE html>
<html lang="en">


<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-san-pham" style="margin-top: 100px;">
        <div >
            <h1 class="title">SỬA SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaSanPham.php">Sửa sản phẩm</a></li>
            </ol>
        </nav>
        <div class="them-san-pham-body">
            <?php
                $sanPham = new sanPham();
                $laysanpham = $sanPham->laySanPham($ma);
                if ($laysanpham){
                    while ($result = $laysanpham->fetch_assoc()){
                        ?>
                            <form action="" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tên sản phẩm: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="ten_sanpham"
                                                value="<?php echo $result['ten_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gía sản phẩm: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="gia_sanpham"
                                                value="<?php echo $result['gia_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng số lượng sản phẩm: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="tongsoluong_sanpham"
                                                value="<?php echo $result['tongsoluong_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Vật liệu: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="vatlieu_sanpham"
                                                value="<?php echo $result['vatlieu_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kích thước: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="kichthuoc_sanpham"
                                                value="<?php echo $result['kichthuoc_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Màu sắc: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control'  name="mau_sanpham"
                                                value="<?php echo $result['mausac_sanpham'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tóm tắt sản phẩm: </th>
                                            <td class="was-validated">
                                                <textarea name="tomtat_sanpham" id="" cols="60" rows="10"><?php echo $result['tomtat_sanpham'] ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mô tả sản phẩm: </th>
                                            <td class="was-validated">
                                            <textarea name="mota_sanpham" id="" cols="60" rows="10"><?php echo $result['mota_sanpham'] ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Danh mục sản phẩm: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="danhmuc_sanpham">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $danhMucSanPham= new danhMucSanPham();
                                                        $danhsach_danhmuc = $danhMucSanPham->show_danhmuc();
                                                        if ($danhsach_danhmuc){
                                                            while ($resultDM = $danhsach_danhmuc->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultDM['ma_danhmuc'] == $result['ma_danhmuc'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultDM['ma_danhmuc']  ?>"><?php echo $resultDM['ten_danhmuc'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Xuất sứ sản phẩm: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="xuatxu_sanpham">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $xuatXu= new xuatXu();
                                                        $danhsach_xuatxu = $xuatXu->show_xuatxu();
                                                        if ($danhsach_xuatxu){
                                                            while ($resultXX = $danhsach_xuatxu->fetch_assoc()){
                                                                ?>
                                                                    <option
                                                                    <?php
                                                                        if ($resultXX['ma_xuatxu'] == $result['ma_xuatxu'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultXX['ma_xuatxu']  ?>"><?php echo $resultXX['ten_xuatxu'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sản phẩm thuộc phòng: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="phong">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $phong= new phong();
                                                        $danhsach_phong = $phong->show_phong();
                                                        if ($danhsach_phong){
                                                            while ($resultP = $danhsach_phong->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultP['ma_phong'] == $result['ma_phong'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultP['ma_phong']  ?>"><?php echo $resultP['ten_phong'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sản phẩm thuộc bộ sưu tập: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="bosuutap">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $boSuuTap= new boSuuTap();
                                                        $danhsach_bosuutap = $boSuuTap->show_bosuutap();
                                                        if ($danhsach_bosuutap){
                                                            while ($resultBST = $danhsach_bosuutap->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultBST['ma_bosuutap'] == $result['ma_bosuutap'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultBST['ma_bosuutap']  ?>"><?php echo $resultBST['ten_bosuutap'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sản phẩm thuộc combo: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="combo">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $combo= new combo();
                                                        $danhsach_combo = $combo->show_combo();
                                                        if ($danhsach_combo){
                                                            while ($resultC = $danhsach_combo->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultC['ma_combo'] == $result['ma_combo'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultC['ma_combo']  ?>"><?php echo $resultC['ten_combo'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sản phẩm thuộc loại: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="loai_sanpham">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        if ($result['loai_sanpham'] == 1 ){
                                                            ?>
                                                                <option selected value="1">Sản phẩm nổi bật</option>
                                                                <option value="2">Top bán chạy</option>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <option value="1">Sản phẩm nổi bật</option>
                                                                <option selected value="2">Top bán chạy</option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>
                                                <button type="submit" class="btn btn-outline-danger" name="suasanpham">Sửa</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    <!-- trình soạn thảo  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> -->
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mota_sanpham');
        CKEDITOR.replace('tomtat_sanpham');
    </script>
    <!--  -->

</html>