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
    <div class="container danh-sach-bo-suu-tap" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH BỘ SƯU TẬP</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themBoSuuTap.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
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
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên bộ sưu tập</th>
                            <th scope="col" class="tieude-bang">Mã bộ sưu tập</th>
                            <th scope="col" class="tieude-bang">Bộ sưu tập cha</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_bosuutap = $boSuuTap->show_bosuutap();
                            if ($tatca_bosuutap){
                                $i=0;
                                while ($result = $tatca_bosuutap->fetch_assoc()){
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
                                                <a href="suaBoSuuTap.php?ma=<?php echo $result['ma_bosuutap'] ?>&cha=<?php echo $result['bosuutap_cha'] ?>">
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>  
                                                <a onclick="return confirm('Bạn có muốn xóa bộ sưu tập <?php echo $result['ten_bosuutap'] ?> không?')" href="?maXoa=<?php echo $result['ma_bosuutap'] ?>">
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