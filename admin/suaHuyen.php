<?php
    include_once("../class/tinh.php");
    $tinh = new tinh();
    include_once("../class/huyen.php");
    $huyen = new huyen();
?>
<?php
    if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suahuyen'])){
        $ten_huyen = $_POST['ten_huyen'];
        $ten_tinh = $_POST['ten_tinh'];
        $update_huyen = $huyen->update_huyen($ten_tinh, $ten_huyen, $ma);
    }
?>
<!DOCTYPE html>
<html lang="en">


<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-san-pham" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachHuyen.php" class="col-2 mt-2">
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA THÔNG TIN HUYÊN</h1>
        </div>
        <div class="them-san-pham-body">
            <?php
                $layhuyen = $huyen->layHuyen($ma);
                if ($layhuyen){
                    while ($result = $layhuyen->fetch_assoc()){
                        ?>
                            <form action="" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Huyện: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="ten_huyen"
                                                value="<?php echo $result['ten_huyen'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Huyện thuộc Tỉnh: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="ten_tinh">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $huyenThuocTinh = $tinh->show_tinh();
                                                        if ($huyenThuocTinh){
                                                            while ($resultT = $huyenThuocTinh->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultT['ma_tinh'] == $result['ma_tinh'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultT['ma_tinh']  ?>"><?php echo $resultT['ten_tinh'] ?></option>
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
                                                <button type="submit" class="btn btn-outline-danger font-weight-bold" name="suahuyen">
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