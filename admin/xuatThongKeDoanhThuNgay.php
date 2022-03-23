<?php
    include_once("../class/thongKe.php");
    $thongKe = new thongKe();
    require('fpdf184/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(0,10,'Do vi bao cao: .................                                                                                                           Mau so B 02', 0,1);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'BAO CAO THONG KE DOANH THU THEO NGAY', 0,1, 'C', );
    $pdf->SetFont('Arial','I',11);
    $pdf->Cell(0,10,'Ngay ......, Thang ......., Nam ............', 0,1, 'C', );
    $thongke_danhthu_ngay = $thongKe->thongke_danhso_ngay();
    $thongke_sanpham_ngay = $thongKe->thongke_sanpham_ngay();
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(20,10,'STT',1,0, 'C');
    $pdf->Cell(50,10,'Ngay thong ke',1,0, 'C');
    $pdf->Cell(50,10,'So san pham ban',1,0, 'C');
    $pdf->MultiCell(65,10,'Tong tien',1,'C');
    $i = 0;
    if ($thongke_danhthu_ngay){
        while($resultTK = $thongke_danhthu_ngay->fetch_assoc()){
            $i ++;
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(20,10,$i,1,0,'C');
            $pdf->Cell(50,10,$resultTK['ngay_thongke'],1,0,'C');
            $pdf->Cell(50,10,$resultTK['tongban_ngay'],1,0, 'C');
            $pdf->MultiCell(65,10,$resultTK['tongtien_ngay'] ,1,'C');
        }
    }
    $pdf->SetFont('Arial','B',11);
    $pdf->MultiCell(61,10,'',0, 'C');
    $pdf->Cell(61,5,'Nguoi lap',0,0, 'C');
    $pdf->Cell(61,5,'Ke toan truong',0,0, 'C');
    $pdf->MultiCell(61,5,'Giam doc',0, 'C');
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(61,5,'(Ky, ho ten)',0,0, 'C');
    $pdf->Cell(61,5,'(Ky, ho ten)',0,0, 'C');
    $pdf->Cell(61,5,'(Ky, ho ten, dong dau)',0,0, 'C');
    $pdf->Output();
?>