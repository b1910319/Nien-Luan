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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themsanpham'])){
        $inset_sanpham = $sanPham->insert_sanpham($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container them-san-pham" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" style=" font-weight: bold; text-align: center; color: #038018;">THÊM SẢN PHẨM</h1>
        </div>
        <div class="">
            <a href="danhSachSanPham.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách sản phẩm
                </button>
            </a>
        </div>
        <div class="them-san-pham-body">
            <form action="" method="POST">
                <table class="table" style="color: black;">
                    <tbody>
                        <tr>
                            <th scope="row">Tên sản phẩm: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required name="ten_sanpham" placeholder="Tên sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Gía sản phẩm: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required name="gia_sanpham" placeholder="Gía sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tổng số lượng sản phẩm: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required name="tongsoluong_sanpham" placeholder="Tổng số lượng sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Vật liệu: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required name="vatlieu_sanpham" placeholder="Vật liệu của sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kích thước: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required name="kichthuoc_sanpham" placeholder="Kích thước của sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Màu sắc: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control'  name="mau_sanpham" placeholder="Màu sắc của sản phẩm">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tóm tắt sản phẩm: </th>
                            <td class="was-validated">
                                <textarea name="tomtat_sanpham" id="" cols="60" rows="10" placeholder="Tóm tắt sản phẩm"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Mô tả sản phẩm: </th>
                            <td class="was-validated">
                                <textarea name="mota_sanpham" id="" cols="60" rows="10" placeholder="Mô tả sản phẩm"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Danh mục sản phẩm: </th>
                            <td>
                                <select class="custom-select" id="gender2" name="danhmuc_sanpham">
                                    <option selected>Choose danh mục sản phẩm</option>
                                    <?php
                                        $danhMucSanPham= new danhMucSanPham();
                                        $danhsach_danhmuc = $danhMucSanPham->show_danhmuc();
                                        if ($danhsach_danhmuc){
                                            while ($resultDM = $danhsach_danhmuc->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultDM['ma_danhmuc']  ?>"><?php echo $resultDM['ten_danhmuc'] ?></option>
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
                                    <option selected>Choose xuất xứ sản phẩm</option>
                                    <?php
                                        $xuatXu= new xuatXu();
                                        $danhsach_xuatxu = $xuatXu->show_xuatxu();
                                        if ($danhsach_xuatxu){
                                            while ($resultXX = $danhsach_xuatxu->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultXX['ma_xuatxu']  ?>"><?php echo $resultXX['ten_xuatxu'] ?></option>
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
                                    <option selected>Choose loại phòng của sản phẩm</option>
                                    <?php
                                        $phong= new phong();
                                        $danhsach_phong = $phong->show_phong();
                                        if ($danhsach_phong){
                                            while ($resultP = $danhsach_phong->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultP['ma_phong']  ?>"><?php echo $resultP['ten_phong'] ?></option>
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
                                    <option selected>Choose bộ sưu tập</option>
                                    <?php
                                        $boSuuTap= new boSuuTap();
                                        $danhsach_bosuutap = $boSuuTap->show_bosuutap();
                                        if ($danhsach_bosuutap){
                                            while ($resultBST = $danhsach_bosuutap->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultBST['ma_bosuutap']  ?>"><?php echo $resultBST['ten_bosuutap'] ?></option>
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
                                    <option selected value="0">Chọn combo</option>
                                    <?php
                                        $combo= new combo();
                                        $danhsach_combo = $combo->show_combo();
                                        if ($danhsach_combo){
                                            while ($resultC = $danhsach_combo->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultC['ma_combo']  ?>"><?php echo $resultC['ten_combo'] ?></option>
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
                                    <option selected>Choose loại sản phẩm</option>
                                    <option value="1">Sản phẩm nổi bật</option>
                                    <option value="2">Top bán chạy</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" class="btn btn-outline-danger font-weight-bold" name="themsanpham">
                                    <i class="fas fa-plus-square"></i>
                                    Thêm
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <!-- trình soạn thảo  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mota_sanpham');
        CKEDITOR.replace('tomtat_sanpham');
    </script>
    <!--  -->

</html>