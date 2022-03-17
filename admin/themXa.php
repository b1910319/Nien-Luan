<?php
    include_once("../class/xa.php");
    $xa= new xa();
    include_once("../class/huyen.php");
    $huyen = new huyen();
?>
<?php
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_huyen = $_POST['ten_huyen'];
        $ten_xa = $_POST['ten_xa'];
        $insert_xa = $xa->insert_xa($ten_xa, $ten_huyen);
    }
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-tinh" style="margin-top: 100px;">
        <div>
            <h1 class="alert alert-secondary" role="alert" >THÊM XÃ</h1>
        </div>
        <div class="">
            <a href="danhSachXa.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách xã
                </button>
            </a>
        </div>
        <div class=" them-tinh-body">
            <form action="" method="POST">
                <table class="table">
                    <tbody>
                    <tr>
                            <th scope="row">Xã: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_xa">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Huyện: </th>
                            <td class="was-validated">
                                <select name="ten_huyen"  class="custom-select" id="gender2" >
                                    <?php
                                        $layhuyen = $huyen->show_huyen();
                                        if ($layhuyen){
                                            while ($resultH = $layhuyen->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $resultH['ma_huyen'] ?>"><?php echo $resultH['ten_huyen'] ?></option>
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