<?php
    include_once("../class/phong.php");
?>
<?php
    $phong = new phong();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_phong = $_POST['ten_phong'];
        $insert_phong = $phong->insert_phong($ten_phong);
    }
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-xuat-xu" style="margin-top: 100px;">
        <div >
            <h1 class="title">THÊM PHÒNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themPhong.php">Thêm phòng</a></li>
            </ol>
        </nav>
        <div class=" them-xuat-xu-body">
            <form action="" method="POST">
                <?php
                    if (isset($insert_phong)){
                        echo $insert_phong;
                    }
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên phòng: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required style="width: 50%;" name="ten_phong">
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