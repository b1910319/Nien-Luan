<?php
    $idtinh= $_POST['idtinh'];
    include_once("class/huyen.php");
    $huyen = new huyen();
    $layhuyen = $huyen->show_huyen_theoTinh($idtinh);
    if ($layhuyen){
        while ($resultH = $layhuyen->fetch_assoc()){
            ?>
                echo "<option value="<?php echo $resultH['ma_huyen'] ?>"><?php echo $resultH['ten_huyen'] ?></option>";
            <?php
        }
    }
?>