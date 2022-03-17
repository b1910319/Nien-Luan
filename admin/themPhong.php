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
            <h1 class="alert alert-secondary" role="alert" >THÊM PHÒNG</h1>
        </div>
        <div class="">
            <a href="danhSachPhong.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách phòng
                </button>
            </a>
        </div>
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
                                <input type='text' class='form-control' required  name="ten_phong">
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