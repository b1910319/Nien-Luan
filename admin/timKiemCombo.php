<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php include_once ("../class/combo.php") ?>
    <?php 
        $combo = new combo();
        if (isset($_GET['timkiem-combo']) ){
            $timkiem_combo = $_GET['timkiem-combo'];
            $timkiem_combo_ds = $combo->timkiem_combo($timkiem_combo);
        }
    ?>
    <div class="container danh-sach-danh-muc" style="margin-top: 100px;">
        <div>
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_combo ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachCombo.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách combo
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
                <table class="table table-bordered table-hover">
                    <?php
                        if ($timkiem_combo_ds){
                            ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="tieude-bang">STT</th>
                                        <th scope="col" class="tieude-bang">Tên combo</th>
                                        <!-- <th scope="col">Mã combo</th> -->
                                        <th scope="col" class="tieude-bang">Tên danh mục combo</th>
                                        <th scope="col" class="tieude-bang">Tóm tắt combo</th>
                                        <th scope="col" class="tieude-bang">Quản lý</th>
                                    </tr>
                                </thead>
                            <?php
                        }
                        else{
                            ?>
                                <h5 style="color: #eb3007; font-weight: bold;"> Combo được tìm hiện không tồn tại</h5>
                            <?php
                        }
                    ?>
                    <tbody>
                        <?php
                            if (isset($_GET['maXoa']) ){
                                $maXoa = $_GET['maXoa'];
                                $timkiem_delete_combo = $combo->delete_combo($maXoa);
                            }
                            if (isset($timkiem_delete_combo)){
                                echo $timkiem_delete_combo;
                            }
                            if ($timkiem_combo_ds != NULL){
                                $i = 0;
                                while ($result = $timkiem_combo_ds->fetch_assoc()){
                                    $ten_danhmuc_combo = $combo->layDanhMucCombo($result['ma_danhmuc_combo']);
                                    if($ten_danhmuc_combo){
                                        $resultDMC = $ten_danhmuc_combo->fetch_assoc();
                                    }
                                    $i++;
                                    ?>
                                        <tr>
                                            <th scope="row" style="width: 5%;"><?php echo $i ?></th>
                                            <td style="width: 20%;"><?php echo $result['ten_combo'] ?></td>
                                            <!-- <td style="width: 20%;"><?php echo $result['ma_combo'] ?></td> -->
                                            <td style="width: 20%;"><?php echo $resultDMC['ten_danhmuc_combo'] ?></td>
                                            <td style="width: 40%;"><?php echo $result['tomtat_combo'] ?></td>
                                            <td style="width: 15%;">
                                                <a href="suaCombo.php?ma=<?php echo $result['ma_combo'] ?>">
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['ten_combo'] ?> không?')"
                                                    href="danhSachCombo.php?maXoa=<?php echo $result['ma_combo'] ?>">
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