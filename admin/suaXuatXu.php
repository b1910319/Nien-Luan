<?php
    include_once("../class/xuatXu.php");
?>
<?php    
    $xuatxu = new xuatXu();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL){
        echo "<script> window.location = 'danhSachXuatXu.php' </script>";
    } else{
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_xuatxu = $_POST['xuatxu'];
        $update_xuatxu = $xuatxu->update_xuatxu($ten_xuatxu, $ma);
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
        <div>
            <h1 class="title">SỬA XUẤT XỨ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaXuatXu.php">Sửa xuất xứ</a></li>
            </ol>
        </nav>
        <div class="them-danh-muc-body">
            <?php
                    if (isset($update_xuatxu)){
                        echo $update_xuatxu;
                    }
                ?>
            <?php
                    $layTen = $xuatxu->layXuatXu($ma);
                    if ($layTen){
                        while ($result = $layTen->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Xuất xứ: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required style="width: 50%;" name="xuatxu"
                                                        value="<?php echo $result['ten_xuatxu'] ?>">
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