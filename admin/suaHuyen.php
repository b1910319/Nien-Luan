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
        <div >
            <h1>SỬA HUYỆN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaHuyen.php">Sửa thông tin Huyện</a></li>
            </ol>
        </nav>
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
                                                <button type="submit" class="btn btn-outline-danger" name="suahuyen">Sửa</button>
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