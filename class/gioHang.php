<?php
    include_once("sanPham.php");
?>
<?php
    class gioHang{
        private $database ;
        private $format;
        private $sanPham;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
            $this->sanPham = new sanPham();
        }
        public function insert_giohang($soLuong,$masp,$sessionid,$ma_khachhang){
            $soLuong = $this->format->validation($soLuong);
            $soLuong = mysqli_real_escape_string($this->database->link, $soLuong);
            $sessionid = mysqli_real_escape_string($this->database->link, $sessionid);
            $ma_khachhang = mysqli_real_escape_string($this->database->link, $ma_khachhang);
            $masp = mysqli_real_escape_string($this->database->link, $masp);
            $queryInsert = "INSERT INTO `giohang`( `ma_sanpham`, `ma_session`, `soluong_sanpham`, 
                `tinhtrang_giohang`,`ma_khachhang`) VALUES ('$masp','$sessionid', '$soLuong','0','$ma_khachhang')";
                $insert_giohang = $this->database->insert($queryInsert);
                Session::set('giohang', true);
                Session::set('giohang_masanpham', $masp );
        }
        public function lay_donhang($ma_khachhang){
            $queryDH = "SELECT * FROM `giohang` WHERE 	ma_khachhang = '$ma_khachhang' ORDER BY ma_giohang desc";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function update_giohang($soLuong,$ma_giohang){
            $soLuong = mysqli_real_escape_string($this->database->link, $soLuong);
            $ma_giohang = mysqli_real_escape_string($this->database->link, $ma_giohang);
            $query = "UPDATE `giohang` SET `soluong_sanpham`='$soLuong' WHERE ma_giohang = '$ma_giohang'";
            $result = $this ->database ->update($query);
            if ($result){
                $arler = '<span style=" color: #038018;">Số lượng của sản phẩm được update thành công</span><br>';
                header("Location: gioHang.php");
                return $arler;
            } else {
                $arler = '<span style=" color: #eb3007;">Số lượng của sản phẩm update không thành công</span>';
                header("Location: gioHang.php");
                return $arler;
            }
        }
        public function delete_giohang($maXoa){
            $query = "DELETE FROM `giohang` WHERE ma_giohang = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Sản phẩm xóa thành công khỏi giỏ hàng</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Sản phẩm trong giỏ hàng xóa không thành công</span>';
                return $alert;
            }
        }
        public function check_giohang($sessionid){
            $queryDH = "SELECT * FROM `giohang` WHERE 	ma_session = '$sessionid'";
            $resultDH = $this ->database->select($queryDH);
            return $resultDH;
        }
        public function show_giohang(){
            $query = "SELECT * FROM `giohang` ORDER BY ma_giohang desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_giohang($timkiem_giohang){
            $query = "SELECT * FROM `giohang` join `nguoidung` on giohang.ma_khachhang = nguoidung.ma_nguoidung WHERE user_nguoidung LIKE '%".$timkiem_giohang."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>