<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/xuatXu.php") ?>
    <?php 
        $xuatxu = new xuatXu();
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_xuatxu = $xuatxu->delete_xuatxu($maXoa);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >DANH SÁCH XUẤT XỨ SẢN PHẨM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="themXuatXu.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="timKiemXuatXu.php" method="get">
                        <input name="timkiem-xuatxu" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-sanh-muc-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_xuatxu)){
                    echo $delete_xuatxu;
                }
            ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Xuất xứ</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tatca_xuatxu = $xuatxu->show_xuatxu();
                            if ($tatca_xuatxu){
                                $i=0;
                                while ($result = $tatca_xuatxu->fetch_assoc()){
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_xuatxu'] ?></td>
                                            <td><?php echo $result['ma_xuatxu'] ?></td>
                                            <td>
                                                <a href="suaXuatXu.php?ma=<?php echo $result['ma_xuatxu'] ?>"><i class="fas fa-user-edit"></i></a> 
                                                || 
                                                <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_xuatxu'] ?> không?')" href="?maXoa=<?php echo $result['ma_xuatxu'] ?>">
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