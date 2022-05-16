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
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container them-danh-muc" style="margin-top: 100px;">
        <div class="">
            <h1 class="alert alert-secondary" role="alert" >THÊM COMBO</h1>
        </div>
        <div class="">
            <a href="danhSachCombo.php">
                <button type="button" class="btn danhsach" >
                    <i class="fas fa-outdent"></i> 
                    Danh sách combo
                </button>
            </a>
        </div>
        <div class="them-danh-muc-body">
            <form action="themCombo.php" method="POST">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên combo: </th>
                            <td class="was-validated">
                                <input type='text' class='form-control' required  name="ten_combo">
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
                                <select class="custom-select" id="gender2"  name="danhmuc_combo">
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
                                <button name="themCombo" type="submit" class="btn btn-outline-danger font-weight-bold">
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
                                            <!-- trình soạn thảo  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('tomtat_combo');
    </script>
    <!--  -->
</html>