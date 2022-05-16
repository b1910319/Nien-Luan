<?php
    include_once("../class/boSuuTap.php");
?>
<?php    
    $boSuuTap = new boSuuTap();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL || !isset($_GET['cha']) || $_GET['cha'] == NULL){
        echo "<script> window.location = 'danhSachBoSuuTap.php' </script>";
    } else{
        $cha = $_GET['cha'];
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_bosuutap = $_POST['ten_bosuutap'];
        $bosuutap_cha =$_POST['bosuutap_cha'] ;
        $update_bosuutap = $boSuuTap->update_bosuutap($ten_bosuutap, $bosuutap_cha, $ma);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container sua-danh-muc" style="margin-top: 100px;">
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachBoSuuTap.php" class="col-2 mt-2" >
                <button type="button" class="btn btn-outline-success" style="font-weight: bold;">
                    <i class="fas fa-angle-double-left"></i> Trở lại
                </button>
            </a>
            <h1 class="col-10">SỬA BỘ SƯU TẬP</h1>
        </div>
        <div class="them-danh-muc-body">
            <?php
                if (isset($update_danhmuc)){
                    echo $update_danhmuc;
                }
            ?>
            <?php
                $layTen = $boSuuTap->layBoSuuTap($ma);
                if ($layTen){
                    while ($result = $layTen->fetch_assoc()){
                        ?>
                            <form action="" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tên bộ sưu tập: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required  name="ten_bosuutap" value="<?php echo $result['ten_bosuutap'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Danh mục cha: </th>
                                            <td>
                                                <select class="custom-select" id="gender2"  name="bosuutap_cha">
                                                <option selected>Choose...</option>
                                                <?php
                                                        $list_bosuutap = $boSuuTap->show_bosuutap();
                                                        if ($list_bosuutap){
                                                            while($result = $list_bosuutap->fetch_assoc()){
                                                                ?>
                                                            <option
                                                            <?php
                                                                if ($result['ma_bosuutap'] == $cha){  echo 'selected';   }
                                                            ?>
                                                            value="<?php echo $result['ma_bosuutap'] ?>"><?php echo $result['ten_bosuutap'] ?></option>
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
                                                    <i class="fas fa-pen"></i>  
                                                    Sửa
                                                </button>
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