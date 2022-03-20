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
        <div class="alert alert-secondary row" role="alert">
            <a href="danhSachPhong.php" class="col-2" style="font-size: 20px; color: #121e96; font-weight: bold;">
                <i class="fas fa-angle-double-left  mt-4" style="font-size: 25px; color: #121e96; font-weight: bold" ></i> Trở lại
            </a>
            <h1 class="col-10">SỬA THÔNG TIN PHÒNG</h1>
        </div>
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
                                                <th scope="row">Phòng: </th>
                                                <td class="was-validated">
                                                    <input type='text' class='form-control' required  name="ten_phong"
                                                        value="<?php echo $result['ten_phong'] ?>">
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