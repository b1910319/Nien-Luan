
<?php
    include_once("../class/thongKe.php");
    $thongKe = new thongKe();
    include_once ("../class/sanPham.php");
    $sanPham = new sanPham();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>
<body>
    <?php include_once("include/header.php") ?>
    <?php include_once ("include/rightBar.php") ?>
    <div class="container thong-ke-theo-ngay" style="margin-top: 100px;">
        <div >
            <h1 class="title" style="font-weight: bold; text-align: center; color: #eb3007;">THỐNG KÊ THEO NĂM</h1>
        </div>
        <nav class="duong-dan" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ </a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="thongKeNam.php">Thống kê theo năm</a></li>
            </ol>
        </nav>
        <div class="  thongke_doanhthu-ngay-body">
            <h3 class="title">Thống kê doanh thu theo năm</h3>
            <div id="myfirstchart" style="height: 250px;"></div>
        </div>
        <div class="  thongke-sanpham-ngay-body">
            <br>
            <h3 class="title">Thống kê sản phẩm bán theo năm</h3>
            <div id="chartSP" style="height: 250px;"></div>
        </div>
    </div>
    <script>
        new Morris.Line({
            element: 'myfirstchart',
            data: [
                <?php
                    $thongke_danhthu_nam = $thongKe->thongke_danhso_nam();
                    if ($thongke_danhthu_nam){
                        // $resultTK = $thongke_danhthu_ngay->fetch_assoc();
                        while ($resultTK = $thongke_danhthu_nam->fetch_assoc()){
                            // echo "<pre>";
                            // print_r($resultTK);
                            // echo "</pre>";
                            $nam = $resultTK['nam_thongke'];
                            $tongtien = $resultTK['tongtien_nam'];
                                echo "{ year: '$nam', value: $tongtien },";
                        }
                    }
                ?>
            ],
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Tổng tiền']
        });
    </script>
    <script>
        new Morris.Bar({
            element: 'chartSP',
            data: [
                <?php
                    $thongke_sanpham_nam = $thongKe->thongke_sanpham_nam();
                    if ($thongke_sanpham_nam){
                        // $resultTK = $thongke_danhthu_ngay->fetch_assoc();
                        while ($resultTK = $thongke_sanpham_nam->fetch_assoc()){
                            // echo "<pre>";
                            // print_r($resultTK);
                            // echo "</pre>";
                            $nam = $resultTK['nam_thongke'];
                            // $tenSP = $resultSP['ten_sanpham'];
                            $tongban = $resultTK['tongban_nam'];
                            echo "{ year: '$nam', value: $tongban },";
                        }
                    }
                ?>
            ],
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Số sản phẩm bán ']
        });
    </script>
</body>
</html>