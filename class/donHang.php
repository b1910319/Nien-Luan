<?php
use Carbon\Carbon;

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
    include_once("sanPham.php");
    include_once($filepath."/../lib/Carbon-2.57.0/autoload.php");
?>
<?php
    class donHang{
        private $sanPham;
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
            $this->sanPham= new sanPham();
        }
        public function insert_donhang($ma_khachhang,$gichu_khachhang){
            $date_now = Carbon::now('Asia/Ho_Chi_Minh');
            $ngay_thongke = $date_now->toDateString();
            $nam_thongke = $date_now->year;
            $gichu_khachhang = mysqli_real_escape_string($this->database->link, $gichu_khachhang);
            $queryGH = "SELECT * FROM `giohang` WHERE 	ma_khachhang = '$ma_khachhang' ORDER BY ma_giohang desc";
            $lay_donhang = $this ->database->select($queryGH);
            if ($lay_donhang){
                while ($resultDH = $lay_donhang->fetch_assoc()){
                    $ma_sanpham = $resultDH['ma_sanpham'];
                    $laygia_sanpham = $this->sanPham->laySanPham($ma_sanpham);
                    if ($laygia_sanpham){
                        $resultSP = $laygia_sanpham->fetch_assoc();
                    }
                    $soluong_sanpham = $resultDH['soluong_sanpham'];
                    $tongtien = $soluong_sanpham * $resultSP['gia_sanpham'];
                    $ma_giohang = $resultDH['ma_giohang'];
                    $ma_khach = $ma_khachhang;
                    $tongsoluong_sanpham_conlai = $resultSP['tongsoluong_sanpham'] - $soluong_sanpham;
                    $queryDH = "INSERT INTO `donhang`( `ma_sanpham`, `ma_nguoidung`, 
                    `soluong_sanpham`, `ghichu_nguoidung`, `tinhtrang_donhang`,`ngay_dathang`) VALUES 
                    ('$ma_sanpham','$ma_khach','$soluong_sanpham','$gichu_khachhang', '0','$date_now')";
                    $inserDH = $this->database->insert($queryDH);
                    $query_updateSoLuong = "UPDATE `sanpham` SET 
                    `tongsoluong_sanpham`='$tongsoluong_sanpham_conlai' WHERE ma_sanpham = '$ma_sanpham' ";
                    $update_soluong = $this->database->update($query_updateSoLuong);
                    $queryTK = "INSERT INTO `thongke`(`ma_sanpham`, `soluong_ban`, `tongtien`,`ngay_thongke`,`nam_thongke`) 
                    VALUES 
                    ('$ma_sanpham','$soluong_sanpham','$tongtien', '$ngay_thongke','$nam_thongke')";
                    $resultTK = $this->database->insert($queryTK);
                    // Session::set('donhang', true);
                    // Session::set('donhang_magiohang',$ma_giohang);
                    $query_xoaDH = "DELETE FROM `giohang` WHERE ma_giohang = '$ma_giohang' ";
                    $result_xoaDH = $this ->database->delete($query_xoaDH);
                    unset($_SESSION['giohang_masanpham']);
                }
            }
            
        }
        public function lay_donhang($ma_khachhang){
            $queryDH = "SELECT * FROM `donhang` WHERE 	ma_nguoidung = '$ma_khachhang' ORDER BY ma_donhang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        // public function show_donhang(){
        //     $query = "SELECT * FROM `donhang` ORDER BY ma_donhang desc";
        //     $result = $this->database->select($query);
        //     return $result;
        // }
        public function doiTinhTrangDH($maDH, $thoigian){
            $maDH = mysqli_real_escape_string($this->database->link, $maDH);
            $thoigian = mysqli_real_escape_string($this->database->link, $thoigian);
            $query = "UPDATE `donhang` SET `tinhtrang_donhang`='1' WHERE ma_donhang = '$maDH' AND 	ngay_dathang = '$thoigian' AND tinhtrang_donhang = '0'";
            $result = $this->database->update($query);
        }
        public function donhang_danhan($maDHK, $thoigian){
            $maDHK = mysqli_real_escape_string($this->database->link, $maDHK);
            $thoigian = mysqli_real_escape_string($this->database->link, $thoigian);
            $query = "UPDATE `donhang` SET `tinhtrang_donhang`='2' WHERE ma_donhang = '$maDHK' AND 	ngay_dathang = '$thoigian' AND tinhtrang_donhang = '1' ";
            $result = $this->database->update($query);
        }
        public function timkiem_donhang($timkiem_donhang){
            $query = "SELECT * FROM `donhang` join `nguoidung` on donhang.ma_nguoidung = nguoidung.ma_nguoidung 
            WHERE hoten_nguoidung LIKE '%".$timkiem_donhang."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        public function tong_donhang (){
            $query = "SELECT COUNT(ma_donhang) as 'tong_donhang'  FROM `donhang`";
            $result = $this->database->select($query);
            return $result;
        }
        public function dem_donhang_xuly(){
            $query = "SELECT COUNT(ma_donhang) as tong_donhang_xuly FROM `donhang` WHERE tinhtrang_donhang = 0";
            $result = $this->database->select($query);
            return $result;
        }
        public function dem_donhang_vanchuyen(){
            $query = "SELECT COUNT(ma_donhang) as tong_donhang_vanchuyen FROM `donhang` WHERE tinhtrang_donhang = 1";
            $result = $this->database->select($query);
            return $result;
        }
        public function dem_donhang_danhan(){
            $query = "SELECT COUNT(ma_donhang) as tong_donhang_danhan FROM `donhang` WHERE tinhtrang_donhang = 2";
            $result = $this->database->select($query);
            return $result;
        }
        public function huy_donhang($maDHHuy){
            $query = "DELETE FROM `donhang` WHERE ma_donhang = '$maDHHuy'";
            $result = $this->database->delete($query);
            return $result;
        }
        // 
        public function lay_donhang_thoigian($ma_khachhang){
            $queryDH = "SELECT DISTINCT ngay_dathang, tinhtrang_donhang FROM `donhang` WHERE 	ma_nguoidung = '$ma_khachhang' order by ngay_dathang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function dem_donhang_thoigian($ma_khachhang, $ngay_dathang){
            $queryDH = "SELECT ngay_dathang, COUNT(ma_sanpham) as tongsp_ngaydathang FROM `donhang` WHERE 	ma_nguoidung = '$ma_khachhang' AND ngay_dathang = '$ngay_dathang'";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function lay_chitiet_donhang($ma_khachhang, $ngay_dathang){
            $queryDH = "SELECT * FROM `donhang` WHERE 	ma_nguoidung = '$ma_khachhang' AND ngay_dathang = '$ngay_dathang' ORDER BY ma_donhang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function show_donhang_thoigian(){
            $queryDH = "SELECT DISTINCT ngay_dathang, ma_nguoidung, tinhtrang_donhang FROM `donhang` order by ngay_dathang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function show_chitiet_donhang($ma_khachhang, $ngay_dathang){
            $queryDH = "SELECT * FROM `donhang` WHERE 	ma_nguoidung = '$ma_khachhang' AND ngay_dathang = '$ngay_dathang' ORDER BY ma_donhang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        // 
    }
?>