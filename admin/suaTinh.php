<?php
    include_once("../class/tinh.php");
?>
<?php    
    $tinh = new tinh();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL){
        echo "<script> window.location = 'danhSachTinh.php' </script>";
    } else{
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_tinh = $_POST['ten_tinh'];
        $update_tinh = $tinh->update_tinh($ten_tinh, $ma);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container sua-phong" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachTinh.php" class="col-2 mt-2" >
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA THÔNG TIN TỈNH/THÀNH PHỐ</h1>
        </div>
        <div class="sua-phong-body">
            <?php
                    if (isset($update_tinh)){
                        echo $update_tinh;
                    }
                ?>
            <?php
                    $layTen = $tinh->layTinh($ma);
                    if ($layTen){
                        while ($result = $layTen->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tỉnh/Thành Phố: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required  name="ten_tinh"
                                                        value="<?php echo $result['ten_tinh'] ?>">
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