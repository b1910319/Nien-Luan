<?php
    include_once("../class/boSuuTap.php");
?>
<?php
    $boSuuTap = new boSuuTap();
// kiểm tra xem form gửi có phải bằng phương pháp POST không nếu phải thì lấy dữ liệu ra
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_bosuutap = $_POST['ten_bosuutap'];
        $bosuutap_cha =$_POST['bosuutap_cha'] ;
        $inset_bosuutap = $boSuuTap->insert_bosuutap($ten_bosuutap, $bosuutap_cha);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-bo-suu-tap" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >THÊM BỘ SƯU TẬP SẢN PHẨM</h1>
        </div>
        <div class="">
            <a href="danhSachBoSuuTap.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách bộ sưu tập
                </button>
            </a>
        </div>
        <div class="them-bo-suu-tap-body">
            <form action="themBoSuuTap.php" method="POST">
                <?php
                    if (isset($inset_bosuutap)){
                        echo $inset_bosuutap;
                    }
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên bộ sưu tập: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_bosuutap">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Bộ sưu tập cha: </th>
                            <td>
                                <select class="custom-select" id="gender2"  name="bosuutap_cha">
                                <option selected>Choose...</option>
                                <?php
                                        $list_bosuutap = $boSuuTap->show_bosuutap();
                                        if ($list_bosuutap){
                                            while($result = $list_bosuutap->fetch_assoc()){
                                                ?>
                                            <option value="<?php echo $result['ma_bosuutap'] ?>"><?php echo $result['ten_bosuutap'] ?></option>
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