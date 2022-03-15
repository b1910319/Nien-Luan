<?php
    include_once("../class/xa.php");
    $xa = new xa();
    include_once("../class/huyen.php");
    $huyen = new huyen();
?>
<?php
    if ( isset($_GET['ma']) && $_GET['ma']!= NULL){
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['suaxa'])){
        $ten_huyen = $_POST['ten_huyen'];
        $ten_xa = $_POST['ten_xa'];
        $update_xa = $xa->update_xa($ten_xa, $ten_huyen, $ma);
    }
?>
<!DOCTYPE html>
<html lang="en">


<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container sua-san-pham" style="margin-top: 100px;">
        <div>
            <h1 class="title">SỬA THÔNG TIN XÃ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaXa.php">Sửa thông tin Xã </a></li>
            </ol>
        </nav>
        <div class="them-san-pham-body">
            <?php
                $layxa = $xa->layXa($ma);
                if ($layxa){
                    while ($result = $layxa->fetch_assoc()){
                        ?>
                            <form action="" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Xã: </th>
                                            <td class="was-validated">
                                                <input type='text' class='form-control' required name="ten_xa"
                                                value="<?php echo $result['ten_xa'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Xã thuộc Huyện: </th>
                                            <td>
                                                <select class="custom-select" id="gender2" name="ten_huyen">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                        $xaThuocHuyen = $huyen->show_huyen();
                                                        if ($xaThuocHuyen){
                                                            while ($resultH = $xaThuocHuyen->fetch_assoc()){
                                                                ?>
                                                                    <option 
                                                                    <?php
                                                                        if ($resultH['ma_huyen'] == $result['ma_huyen'] ){ echo 'selected';}
                                                                    ?>
                                                                    value="<?php echo $resultH['ma_huyen']  ?>"><?php echo $resultH['ten_huyen'] ?></option>
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
                                                <button type="submit" class="btn btn-outline-danger" name="suaxa">Sửa</button>
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