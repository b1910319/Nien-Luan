<?php
    include_once("../class/combo.php");
    include_once("../class/danhMucCombo.php");
?>
<?php    
    $combo = new combo();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL){
        echo "<script> window.location = 'danhSachDanhMuc.php' </script>";
    } else{
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sua_combo'])){
        $ten_combo = $_POST['ten_combo'];
        $tomtat_combo =$_POST['tomtat_combo'] ;
        $danhmuc_combo = $_POST['danhmuc_combo'];
        $update_combo = $combo->update_combo($ten_combo, $tomtat_combo, $ma,$danhmuc_combo);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-danh-muc" style="margin-top: 100px;">
        <div >
            <h1 class="title">SỬA COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaCombo.php">Sửa combo</a></li>
            </ol>
        </nav>
        <div class="them-danh-muc-body">
            <?php
                if (isset($update_combo)){
                    echo $update_combo;
                }
            ?>
                <?php
                    $layCombo = $combo->layCombo($ma);
                    if ($layCombo){
                        while ($result = $layCombo->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tên combo: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required style="width: 50%;" name="ten_combo" value="<?php echo $result['ten_combo'] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tóm tắt combo: </th>
                                                <td class="was-validated">
                                                    <textarea name="tomtat_combo" id="" cols="60" rows="10"><?php echo $result['tomtat_combo'] ?></textarea>
                                                </td>
                                            </tr>
                                            <!-- trình soạn thảo  -->
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                            <!-- <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> -->
                                            <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
                                            <script>
                                                CKEDITOR.replace('tomtat_combo');
                                            </script>
                                            <tr>
                                                <th scope="row">Danh mục combo: </th>
                                                <td>
                                                    <select class="custom-select" id="gender2" name="danhmuc_combo">
                                                        <option selected>Choose...</option>
                                                        <?php
                                                            $danhMucCombo = new danhMucCombo();
                                                            $danhsach_danhmuc_combo = $danhMucCombo->show_danhmuc_combo();
                                                            if ($danhsach_danhmuc_combo){
                                                                while ($resultDMC = $danhsach_danhmuc_combo->fetch_assoc()){
                                                                    ?>
                                                                        <option 
                                                                            <?php
                                                                                if ($resultDMC['ma_danhmuc_combo'] == $result['ma_danhmuc_combo'] ){ echo 'selected';}
                                                                            ?>
                                                                        value="<?php echo $resultDMC['ma_danhmuc_combo']  ?>"><?php echo $resultDMC['ten_danhmuc_combo'] ?></option>
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
                                                    <button name="sua_combo" type="submit" class="btn btn-outline-danger">Sửa</button>
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