<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php 
        include_once ("../class/tinh.php");
        $tinh = new tinh();
    ?>
    <?php 
        include_once ("../class/huyen.php") ;
        $huyen = new huyen();
    ?>
    <?php 
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_huyen = $huyen->delete_huyen($maXoa);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div>
            <h1 class="title">DANH SÁCH HUYỆN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachHuyen.php">Danh sách Huyện</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemHuyen.php" method="get">
                        <input name="timkiem-huyen" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_huyen)){
                    echo $delete_huyen;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Huyện</th>
                            <th scope="col">Mã Huyện</th>
                            <th scope="col">Huyện thuộc Tỉnh</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_huyen = $huyen->show_huyen();
                            if ($tatca_huyen){
                                $i=0;
                                while ($result = $tatca_huyen->fetch_assoc()){
                                    $i++;
                                    $laytentinh = $tinh->layTinh($result['ma_tinh']);
                                    if ($laytentinh){
                                        $resultT = $laytentinh->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_huyen'] ?></td>
                                            <td><?php echo $result['ma_huyen'] ?></td>
                                            <td><?php echo $resultT['ten_tinh'] ?></td>
                                            <td >
                                                <a href="suaHuyen.php?ma=<?php echo $result['ma_huyen'] ?>" ><i class="fas fa-user-edit" ></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_huyen'] ?> không?')" href="?maXoa=<?php echo $result['ma_huyen'] ?>">
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