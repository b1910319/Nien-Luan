<?php
    include_once("../class/xuatXu.php");
?>
<?php    
    $xuatxu = new xuatXu();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL){
        echo "<script> window.location = 'danhSachXuatXu.php' </script>";
    } else{
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_xuatxu = $_POST['xuatxu'];
        $update_xuatxu = $xuatxu->update_xuatxu($ten_xuatxu, $ma);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container sua-danh-muc" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachXuatXu.php" class="col-2" >
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA XUẤT XỨ SẢN PHẨM</h1>
        </div>
        <div class="them-danh-muc-body">
            <?php
                    if (isset($update_xuatxu)){
                        echo $update_xuatxu;
                    }
                ?>
            <?php
                    $layTen = $xuatxu->layXuatXu($ma);
                    if ($layTen){
                        while ($result = $layTen->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Xuất xứ: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required  name="xuatxu"
                                                        value="<?php echo $result['ten_xuatxu'] ?>">
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