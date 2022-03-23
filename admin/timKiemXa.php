<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <?php 
        include_once ("../class/xa.php");
        $xa = new xa();
    ?>
    <?php 
        include_once ("../class/huyen.php") ;
        $huyen = new huyen();
    ?>
    <?php 
        if (isset($_GET['maXoa']) ){
            $maXoa = $_GET['maXoa'];
            $delete_xa = $xa->delete_xa($maXoa);
        }
    ?>
    <?php 
        if (isset($_GET['timkiem-xa']) ){
            $timkiem_xa = $_GET['timkiem-xa'];
            $timkiem_xa_ds = $xa->timkiem_xa($timkiem_xa);
        }
    ?>
    <div class="container danh-sach-phong" style="margin-top: 100px;">
        <div >
            <h1 class="alert alert-secondary" role="alert" >KẾT QUẢ TÌM KIẾM THEO "<?php echo $timkiem_xa ?>"</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb row">
                <div class="col">
                    <a href="danhSachXa.php">
                        <button type="button" class="btn danhsach" >
                            <i class="fas fa-outdent"></i> 
                            Danh sách Xã
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex" action="timKiemXa.php" method="get">
                        <input name="timkiem-xa" class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </ol>
        </nav>
        <div class="danh-sach-phong-body">
            <div class="container table-responsive ">
            <?php
                if (isset($delete_xa)){
                    echo $delete_xa;
                }
            ?>
                <table class="table table-bordered table-hover" style="color: black;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="tieude-bang">STT</th>
                            <th scope="col" class="tieude-bang">Xã</th>
                            <th scope="col" class="tieude-bang">Mã Xã</th>
                            <th scope="col" class="tieude-bang">Xã thuộc Huyện</th>
                            <th scope="col" class="tieude-bang">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($timkiem_xa_ds){
                                $i=0;
                                while ($result = $timkiem_xa_ds->fetch_assoc()){
                                    $i++;
                                    $laytenhuyen = $huyen->layHuyen($result['ma_huyen']);
                                    if ($laytenhuyen){
                                        $resultH = $laytenhuyen->fetch_assoc();
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $result['ten_xa'] ?></td>
                                            <td><?php echo $result['ma_xa'] ?></td>
                                            <td><?php echo $resultH['ten_huyen'] ?></td>
                                            <td >
                                                <a href="suaXa.php?ma=<?php echo $result['ma_xa'] ?>" >
                                                    <button type="button" class="btn sua">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a> 
                                                <a onclick="return confirm('Bạn có muốn xóa <?php echo $result['ten_xa'] ?> không?')" href="danhSachXa.php?maXoa=<?php echo $result['ma_xa'] ?>">
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