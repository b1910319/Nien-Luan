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
        <div >
            <h1 class="title">SỬA DANH MỤC SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaDanhMuc.php">Sửa danh mục</a></li>
            </ol>
        </nav>
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
                                                    <input type='text' class='form-control' required style="width: 50%;" name="ten_bosuutap" value="<?php echo $result['ten_bosuutap'] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Danh mục cha: </th>
                                                <td>
                                                    <select class="custom-select" id="gender2" style="width: 50%;" name="bosuutap_cha">
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
                                                    <button type="submit" class="btn btn-outline-danger">Sửa</button>
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