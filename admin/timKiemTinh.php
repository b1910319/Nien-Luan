<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/tinh.php") ?>
    <?php 
        $tinh = new tinh();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_tinh = $tinh->delete_tinh($maXoa);
        }
    ?>
    <?php 
        if (isset($_GET['timkiem-tinh']) ){
            $timkiem_tinh = $_GET['timkiem-tinh'];
            $timkiem_tinh_ds = $tinh->timkiem_tinh($timkiem_tinh);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="title">KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_tinh ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="timKiemTinh.php">Tìm Tỉnh/Thành Phố</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemTinh.php" method="get">
                        <input name="timkiem-tinh" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_tinh)){
                    echo $delete_tinh;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <?php
                        if ($timkiem_tinh_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tỉnh</th>
                                        <th scope="col">Mã Tỉnh</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;">Tỉnh được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if ($timkiem_tinh_ds){
                                $i=0;
                                while ($result = $timkiem_tinh_ds->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_tinh'] ?></td>
                                            <td><?php echo $result['ma_tinh'] ?></td>
                                            <td >
                                                <a href="suaTinh.php?ma=<?php echo $result['ma_tinh'] ?>" ><i class="fas fa-user-edit" ></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_tinh'] ?> không?')" href="danhSachTinh.php?maXoa=<?php echo $result['ma_tinh'] ?>">
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