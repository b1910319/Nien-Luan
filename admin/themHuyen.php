<?php
    include_once("../class/tinh.php");
    include_once("../class/huyen.php");
    $huyen = new huyen();
?>
<?php
    $tinh = new tinh();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_huyen = $_POST['ten_huyen'];
        $ten_tinh = $_POST['ten_tinh'];
        $insert_huyen = $huyen->insert_huyen($ten_huyen, $ten_tinh);
    }
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-tinh" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >THÊM HUYỆN</h1>
        </div>
        <div class="">
            <a href="danhSachHuyen.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách Huyện
                </button>
            </a>
        </div>
        <div class=" them-tinh-body">
            <form action="" method="POST">
                <?php
                    if (isset($insert_tinh)){
                        echo $insert_tinh;
                    }
                ?>
                <table class="table">
                    <tbody>
                    <tr>
                            <th scope="row">Huyện: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_huyen">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tỉnh/Thành Phố: </th>
                            <td class="was-validated">
                                <select name="ten_tinh"  class="custom-select" id="gender2" >
                                    <?php
                                        $laytinh = $tinh->show_tinh();
                                        if ($laytinh){
                                            while ($resultT = $laytinh->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultT['ma_tinh'] ?>"><?php echo $resultT['ten_tinh'] ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
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