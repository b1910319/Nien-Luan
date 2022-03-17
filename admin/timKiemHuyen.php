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
    <?php 
        if (isset($_GET['timkiem-huyen']) ){
            $timkiem_huyen = $_GET['timkiem-huyen'];
            $timkiem_huyen_ds = $huyen->timkiem_huyen($timkiem_huyen);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_huyen ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="">
                    <a href="danhSachHuyen.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách Huyện
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
                    <?php
                        if ($timkiem_huyen_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Huyện</th>
                                        <th scope="col">Mã Huyện</th>
                                        <th scope="col">Huyện thuộc Tỉnh</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Huyện được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if ($timkiem_huyen_ds){
                                $i=0;
                                while ($result = $timkiem_huyen_ds->fetch_assoc()){
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
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_huyen'] ?> không?')" href="danhSachHuyen.php?maXoa=<?php echo $result['ma_huyen'] ?>">
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