<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/boSuuTap.php") ?>
    <?php 
        $boSuuTap = new boSuuTap();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_bosuutap = $boSuuTap->delete_bosuutap($maXoa);
        }
    ?>
    <?php 
        if (isset($_GET['timkiem-bosuutap']) ){
            $timkiem_bosuutap = $_GET['timkiem-bosuutap'];
            $timkiem_bosuutap_ds = $boSuuTap->timkiem_bosuutap($timkiem_bosuutap);
        }
    ?>
    <div class="container danh-sach-bo-suu-tap" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_bosuutap ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachBoSuuTap.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách bộ sưu tập
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemBoSuuTap.php" method="get">
                        <input name="timkiem-bosuutap" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_bosuutap)){
                    echo $delete_bosuutap;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <?php
                        if ($timkiem_bosuutap_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên bộ sưu tập</th>
                                        <th scope="col">Mã bộ sưu tập</th>
                                        <th scope="col">Bộ sưu tập cha</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                            <h5 style="color: #eb3007; font-weight: bold;"> Bộ sưu tập hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if ($timkiem_bosuutap_ds){
                                $i=0;
                                while ($result = $timkiem_bosuutap_ds->fetch_assoc()){
                                    $ten_bst_cha = $boSuuTap->layBoSuuTap($result['bosuutap_cha']);
                                    if($ten_bst_cha){
                                        $result1 = $ten_bst_cha->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_bosuutap'] ?></td>
                                            <td><?php echo $result['ma_bosuutap'] ?></td>
                                            <td><?php echo $result1['ten_bosuutap'] ?></td>
                                            <td>
                                                <a href="suaBoSuuTap.php?ma=<?php echo $result['ma_bosuutap'] ?>&cha=<?php echo $result['bosuutap_cha'] ?>"><i class="fas fa-user-edit"></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa bộ sưu tập <?php echo $result['ten_bosuutap'] ?> không?')" href="danhSachBoSuuTap.php?maXoa=<?php echo $result['ma_bosuutap'] ?>">
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