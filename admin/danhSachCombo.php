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
            <h1 class="alert alert-secondary" role="alert"  >DANH SÁCH COMBO</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
            <div class="col">
                    <a href="themCombo.php">
                        <button type="button" class="btn themmoi" >
                            <i class="fas fa-plus-square"></i> 
                            Thêm mới
                        </button>
                    </a>
                </div>
                <div class="col">
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
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Tên combo</th>
                            <th scope="col" class="tieude-bang">Tên danh mục combo</th>
                            <th scope="col" class="tieude-bang">Tóm tắt combo</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
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
                                                <th scope="row" style="width: 5%;"><?php echo $i ?></th>
                                                <td style="width: 20%;"><?php echo $result['ten_combo'] ?></td>
                                                <td style="width: 20%;"><?php echo $resultDMC['ten_danhmuc_combo'] ?></td>
                                                <td style="width: 40%;"><?php echo $result['tomtat_combo'] ?></td>
                                                <td style="width: 15%;">
                                                    <a href="suaCombo.php?ma=<?php echo $result['ma_combo'] ?>">
                                                        <button type="button" class="btn sua">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_combo'] ?> không?')"
                                                        href="?maXoa=<?php echo $result['ma_combo'] ?>">
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