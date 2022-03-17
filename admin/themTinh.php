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
            <h1 class="alert alert-secondary" role="alert" >THÊM TỈNH/THÀNH PHỐ</h1>
        </div>
        <div class="">
            <a href="danhSachTinh.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách Tỉnh/Thành phố
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
                            <th scope="row">Tỉnh/Thành Phố: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_tinh">
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