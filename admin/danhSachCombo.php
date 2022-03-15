<!DOCTYPE html>
<html lang="en">

<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/combo.php") ?>
    <?php 
        $combo = new combo();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_combo = $combo->delete_combo($maXoa);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1 class="title" >DANH SÁCH COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <li class="breadcrumb-item col-2"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item col-6 " aria-current="page">
                    <a href="danhSachCombo.php">Danh sách combo</a>
                </li>
                <div class="col-4">
                    <form class="d-flex" action="timKiemCombo.php" method="get">
                        <input name="timkiem-combo" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
                <?php
                    if (isset($delete_combo)){
                        echo $delete_combo;
                    }
                ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên combo</th>
                            <th scope="col">Mã combo</th>
                            <th scope="col">Tên danh mục combo</th>
                            <th scope="col">Tóm tắt combo</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $tatca_combo = $combo->show_combo();
                                if ($tatca_combo){
                                    $i=0;
                                    while ($result = $tatca_combo->fetch_assoc()){
                                        $ten_danhmuc_combo = $combo->layDanhMucCombo($result['ma_danhmuc_combo']);
                                        if($ten_danhmuc_combo){
                                            $resultDMC = $ten_danhmuc_combo->fetch_assoc();
                                        }
                                        $i++;
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $i ?></th>
                                                <td><?php echo $result['ten_combo'] ?></td>
                                                <td><?php echo $result['ma_combo'] ?></td>
                                                <td><?php echo $resultDMC['ten_danhmuc_combo'] ?></td>
                                                <td><?php echo $result['tomtat_combo'] ?></td>
                                                <td>
                                                    <a
                                                        href="suaCombo.php?ma=<?php echo $result['ma_combo'] ?>"><i
                                                            class="fas fa-user-edit"></i></a>
                                                    ||
                                                    <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_combo'] ?> không?')"
                                                        href="?maXoa=<?php echo $result['ma_combo'] ?>">
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