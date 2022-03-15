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
            <h1 class="title">DANH SÁCH XÃ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachXa.php">Danh sách Xã</a>
                </li>
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