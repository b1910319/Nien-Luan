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
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH TỈNH/THÀNH PHỐ</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themTinh.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
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
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tỉnh</th>
                            <th scope="col" class="tieude-bang">Mã Tỉnh</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_tinh = $tinh->show_tinh();
                            if ($tatca_tinh){
                                $i=0;
                                while ($result = $tatca_tinh->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_tinh'] ?></td>
                                            <td><?php echo $result['ma_tinh'] ?></td>
                                            <td >
                                                <a href="suaTinh.php?ma=<?php echo $result['ma_tinh'] ?>" >
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_tinh'] ?> không?')" href="?maXoa=<?php echo $result['ma_tinh'] ?>">
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