<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class binhLuan{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_binhluan (){
            $masp = $_POST['ma_sanpham'];
            $ma_khachhang = $_POST['ma_khach'];
            $noidung_binhluan = $_POST['noidung_binhluan'];
            $query = "INSERT INTO `binhluan`( `ma_nguoidung`, `noidung_binhluan`, `ma_sanpham`) 
            VALUES 
            ('$ma_khachhang','$noidung_binhluan','$masp')";
            $result = $this->database->insert($query);
            return $result;
        }
        public function hienthi_binhluan ($masp){
            $query = "SELECT * FROM `binhluan` WHERE ma_sanpham = '$masp'";
            $result = $this->database->select($query);
            return $result;
        }
        public function lay_binhluan (){
            $query = "SELECT * FROM `binhluan` ORDER BY ma_binhluan desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_donhang($timkiem_binhluan){
            $query = "SELECT * FROM `binhluan` join `sanpham` on  binhluan.ma_sanpham = sanpham.ma_sanpham
            WHERE ten_sanpham LIKE '%".$timkiem_binhluan."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        public function lay_binhluan_maBL ($maBL){
            $query = "SELECT * FROM `binhluan` WHERE ma_binhluan = '$maBL'";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_binhluan($noidung_binhluan, $maBL){
            $noidung_binhluan = $this->format->validation($noidung_binhluan);
            // kết nối với CSDL 
            $noidung_binhluan = mysqli_real_escape_string($this->database->link, $noidung_binhluan);
            $maBL = mysqli_real_escape_string($this->database->link, $maBL);
            if(empty($noidung_binhluan) || empty($maBL)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Nội dung bình luận không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `binhluan` SET `noidung_binhluan`='$noidung_binhluan' WHERE ma_binhluan = '$maBL'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Bình luận được sửa thành công</span>';
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Bình luận sửa không thành công</span>';
                    return $alert;
                }
            }
        }
        public function delete_binhluan($maBLXoa){
            $query = "DELETE FROM `binhluan` WHERE ma_binhluan = $maBLXoa";
            $result = $this->database->delete($query);
            header("Location: index.php");
        }
    }
?>