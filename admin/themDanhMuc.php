<?php
    include("../class/danhMucSanPham.php");
?>
<?php
    $danhMucSanPham = new danhMucSanPham();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $danhmuc_cha =$_POST['danhmuc_cha'] ;
        $inset_danhmuc = $danhMucSanPham->insert_danhmuc($ten_danhmuc, $danhmuc_cha);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-danh-muc" style="margin-top: 100px;">
        <div class="">
            <h1 class="alert alert-secondary" role="alert">THÊM DANH MỤC SẢN PHẨM</h1>
        </div>
        <!-- <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themDanhMuc.php">Thêm danh mục</a></li>
            </ol>
        </nav> -->
        <div class="">
            <a href="danhSachDanhMuc.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách danh mục sản phẩm
                </button>
            </a>
        </div>
        <div class="them-danh-muc-body">
            <form action="themDanhMuc.php" method="POST">
                <?php
                    if (isset($inset_danhmuc)){
                        echo $inset_danhmuc;
                    }
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên danh mục: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_danhmuc">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Danh mục cha: </th>
                            <td>
                                <select class="custom-select" id="gender2"  name="danhmuc_cha">
                                <option selected>Choose...</option>
                                <?php
                                        $list_danhmuc = $danhMucSanPham->show_danhmuc();
                                        if ($list_danhmuc){
                                            while($result = $list_danhmuc->fetch_assoc()){
                                                ?>
                                            <option value="<?php echo $result['ma_danhmuc'] ?>"><?php echo $result['ten_danhmuc'] ?></option>
                                            <?php
                                            }
                                        }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" class="btn btn-outline-danger font-weight-bold">
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

</html>