<!DOCTYPE html>
<html lang="en">
<?php include_once("include/header.php") ?>
<?php include_once ("include/rightBar.php") ?>
<body>
    <?php
        include_once("../class/luotXem.php");
        $luotXem = new luotXem();
        include_once("../class/sanPham.php");
        $sanPham = new sanPham();
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >LƯỢT XEM CỦA CÁC SẢN PHẨM</h1>
        </div>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên sản phẩm</th>
                            <th scope="col" class="tieude-bang">Số lượt xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $show_luotxem_full = $luotXem->show_luotxem_full();
                            if ($show_luotxem_full){
                                $i=0;
                                while ($resultLX = $show_luotxem_full->fetch_assoc()){
                                    $laySanPham = $sanPham->laySanPham($resultLX['ma_sanpham']);
                                    if($laySanPham){
                                        $resultSP = $laySanPham->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $resultSP['ten_sanpham'] ?></td>
                                            <td><?php echo $resultLX['so_luotxem'] ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</html>