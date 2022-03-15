<?php
    include_once("../class/tinh.php");
    include_once("../class/huyen.php");
    $huyen = new huyen();
?>
<?php
    $tinh = new tinh();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
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
            <h1 class="title">THÊM HUYỆN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themHuyen.php">Thêm Huyện</a></li>
            </ol>
        </nav>
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
                                <input type='text' class='form-control' required style="width: 50%;" name="ten_huyen">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tỉnh/Thành Phố: </th>
                            <td class="was-validated">
                                <select name="ten_tinh"  class="custom-select" id="gender2" style="width: 50%;">
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
                                <button type="submit" class="btn btn-outline-danger">Thêm</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </form>
        </div>
    </div>

</html>