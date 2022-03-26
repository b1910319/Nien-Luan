<?php
    include_once("../class/danhMucSanPham.php");
?>
<?php    
    $danhMucSanPham = new danhMucSanPham();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL || !isset($_GET['cha']) || $_GET['cha'] == NULL){
        echo "<script> window.location = 'danhSachDanhMuc.php' </script>";
    } else{
        $cha = $_GET['cha'];
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $danhmuc_cha =$_POST['danhmuc_cha'] ;
        $update_danhmuc = $danhMucSanPham->update_danhmuc($ten_danhmuc, $danhmuc_cha, $ma);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-danh-muc" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachDanhMuc.php" class="col-2 mt-2">
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA DANH MỤC SẢN PHẨM</h1>
        </div>
        <div class="them-danh-muc-body">
            <?php
                if (isset($update_danhmuc)){
                    echo $update_danhmuc;
                }
            ?>
            <?php
                $layTen = $danhMucSanPham->layDanhMuc($ma);
                if ($layTen){
                    while ($result = $layTen->fetch_assoc()){
                        ?>
                            <form action="" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tên danh mục: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required  name="ten_danhmuc" value="<?php echo $result['ten_danhmuc'] ?>">
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
                                                                    <option
                                                                    <?php
                                                                        if ($result['ma_danhmuc'] == $cha){  echo 'selected';   }
                                                                    ?>
                                                                    value="<?php echo $result['ma_danhmuc'] ?>"><?php echo $result['ten_danhmuc'] ?></option>
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
                                                    <i class="fas fa-pen"></i>
                                                    Sửa
                                                </button>
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
</html>