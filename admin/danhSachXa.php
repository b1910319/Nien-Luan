<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php 
        include_once ("../class/xa.php");
        $xa = new xa();
    ?>
    <?php 
        include_once ("../class/huyen.php") ;
        $huyen = new huyen();
    ?>
    <?php 
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_xa = $xa->delete_xa($maXoa);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH XÃ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themXa.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemXa.php" method="get">
                        <input name="timkiem-xa" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_xa)){
                    echo $delete_xa;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Xã</th>
                            <th scope="col">Mã Xã</th>
                            <th scope="col">Xã thuộc Huyện</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_xa = $xa->show_xa();
                            if ($tatca_xa){
                                $i=0;
                                while ($result = $tatca_xa->fetch_assoc()){
                                    $i++;
                                    $laytenhuyen = $huyen->layHuyen($result['ma_huyen']);
                                    if ($laytenhuyen){
                                        $resultH = $laytenhuyen->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_xa'] ?></td>
                                            <td><?php echo $result['ma_xa'] ?></td>
                                            <td><?php echo $resultH['ten_huyen'] ?></td>
                                            <td >
                                                <a href="suaXa.php?ma=<?php echo $result['ma_xa'] ?>" ><i class="fas fa-user-edit" ></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_xa'] ?> không?')" href="?maXoa=<?php echo $result['ma_xa'] ?>">
                                                    <i class="fas fa-user-minus"></i>
                                                </a>
                                            </td>
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