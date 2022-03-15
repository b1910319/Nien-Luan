<?php
    include("../class/combo.php");
    include_once("../class/danhMucCombo.php");
?>
<?php
    $combo = new combo();
    $danhMucCombo = new danhMucCombo();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['themCombo'])){
        $ten_combo = $_POST['ten_combo'];
        $tomtat_combo = $_POST['tomtat_combo'];
        $danhmuc_combo = $_POST['danhmuc_combo'];
        $inset_combo = $combo->insert_combo($ten_combo, $tomtat_combo, $danhmuc_combo);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-danh-muc" style="margin-top: 100px;">
        <div class="">
            <h1 class="title">THÊM COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="themCombo.php">Thêm combo</a></li>
            </ol>
        </nav>
        <div class="them-danh-muc-body">
            <form action="themCombo.php" method="POST">
                <?php
                    // if (isset($inset_danhmuc)){
                    //     echo $inset_danhmuc;
                    // }
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên combo: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required style="width: 50%;" name="ten_combo">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tóm tắt: </th>
                            <td class="was-validated">
                                <textarea name="tomtat_combo" id="" cols="60" rows="10" placeholder="Tóm tắt combo"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Danh mục combo: </th>
                            <td>
                                <select class="custom-select" id="gender2" style="width: 50%;" name="danhmuc_combo">
                                <option selected>Choose...</option>
                                <?php
                                        $list_danhmuc_combo = $danhMucCombo->show_danhmuc_combo();
                                        if ($list_danhmuc_combo){
                                            while($result = $list_danhmuc_combo->fetch_assoc()){
                                                ?>
                                            <option value="<?php echo $result['ma_danhmuc_combo'] ?>"><?php echo $result['ten_danhmuc_combo'] ?></option>
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
                                <button name="themCombo" type="submit" class="btn btn-outline-danger">Thêm</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </form>
        </div>
    </div>
                                            <!-- trình soạn thảo  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> -->
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('tomtat_combo');
    </script>
    <!--  -->
</html>