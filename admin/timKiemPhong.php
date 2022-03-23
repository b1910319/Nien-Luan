<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/phong.php") ?>
    <?php 
        $phong = new phong();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_phong = $phong->delete_phong($maXoa);
        }
    ?>
    <?php 
        if (isset($_GET['timkiem-phong']) ){
            $timkiem_phong = $_GET['timkiem-phong'];
            $timkiem_phong_ds = $phong->timkiem_phong($timkiem_phong);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_phong ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachPhong.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách phòng
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemPhong.php" method="get">
                        <input name="timkiem-phong" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_phong)){
                    echo $delete_phong;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Phòng</th>
                            <th scope="col" class="tieude-bang">Mã</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($timkiem_phong_ds){
                                $i=0;
                                while ($result = $timkiem_phong_ds->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_phong'] ?></td>
                                            <td><?php echo $result['ma_phong'] ?></td>
                                            <td >
                                                <a href="suaPhong.php?ma=<?php echo $result['ma_phong'] ?>" >
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa  <?php echo $result['ten_phong'] ?> không?')" href="danhSachPhong.php?maXoa=<?php echo $result['ma_phong'] ?>">
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