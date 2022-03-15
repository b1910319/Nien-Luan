<?php
    include_once("../class/phong.php");
?>
<?php    
    $phong = new phong();
    if (!isset($_GET['ma']) || $_GET['ma'] == NULL){
        echo "<script> window.location = 'danhSachphong.php' </script>";
    } else{
        $ma = $_GET['ma'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ten_phong = $_POST['ten_phong'];
        $update_phong = $phong->update_phong($ten_phong, $ma);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container sua-phong" style="margin-top: 100px;">
        <div>
            <h1 class="title">SỬA THÔNG TIN PHÒNG</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="suaXuatXu.php">Sửa xuất xứ</a></li>
            </ol>
        </nav>
        <div class="sua-phong-body">
            <?php
                    if (isset($update_phong)){
                        echo $update_phong;
                    }
                ?>
            <?php
                    $layTen = $phong->layPhong($ma);
                    if ($layTen){
                        while ($result = $layTen->fetch_assoc()){
                            ?>
                                <form action="" method="POST">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Xuất xứ: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required style="width: 50%;" name="ten_phong"
                                                        value="<?php echo $result['ten_phong'] ?>">
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