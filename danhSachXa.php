<?php
    $idhuyen= $_POST['idhuyen'];
    include_once("class/xa.php");
    $xa = new xa();
    $layxa = $xa->show_xa_theoHuyen($idhuyen);
    if ($layxa){
        while ($resultX = $layxa->fetch_assoc()){
            ?>
                echo "<option value="<?php echo $resultX['ma_xa'] ?>"><?php echo $resultX['ten_xa'] ?></option>";
            <?php
        }
    }
?>