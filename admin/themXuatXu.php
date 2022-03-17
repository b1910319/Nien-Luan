<?php
    include_once("../class/xuatXu.php");
?>
<?php
    $xuatxu = new xuatXu();
//kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_xuatxu = $_POST['xuatxu'];
        $insert_xuatxu = $xuatxu->insert_xuatxu($ten_xuatxu);
    }
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container them-xuat-xu" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >THÊM XUẤT XỨ SẢN PHẨM</h1>
        </div>
        <div class="">
            <a href="danhSachXuatXu.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách xuất xứ
                </button>
            </a>
        </div>
        <div class=" them-xuat-xu-body">
            <form action="themXuatXu.php" method="POST">
                <?php
                    if (isset($insert_xuatxu)){
                        echo $insert_xuatxu;
                    }
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Xuất xứ: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="xuatxu">
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