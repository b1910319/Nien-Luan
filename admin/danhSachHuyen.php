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
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH HUYỆN</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themHuyen.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
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
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Huyện</th>
                            <th scope="col" class="tieude-bang">Mã Huyện</th>
                            <th scope="col" class="tieude-bang">Huyện thuộc Tỉnh</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
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
                                                <a href="suaHuyen.php?ma=<?php echo $result['ma_huyen'] ?>" >
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_huyen'] ?> không?')" href="?maXoa=<?php echo $result['ma_huyen'] ?>">
                                                    <button type="button" class="btn xoa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
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