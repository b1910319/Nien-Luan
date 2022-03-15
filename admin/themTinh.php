<?php
    include_once("../class/tinh.php");
?>
<?php
    $tinh = new tinh();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_tinh = $_POST['ten_tinh'];
        $insert_tinh = $tinh->insert_tinh($ten_tinh);
    }
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-tinh" style="margin-top: 100px;">
        <div >
            <h1 class="title">THÊM TỈNH/THÀNH PHỐ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themTinh.php">Thêm Tỉnh Thành Phố</a></li>
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
                            <th scope="row">Tỉnh/Thành Phố: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required style="width: 50%;" name="ten_tinh">
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