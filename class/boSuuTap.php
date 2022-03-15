<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class boSuuTap{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        // hàm thêm danh mục sản phẩm
        public function insert_bosuutap($ten_bosuutap, $bosuutap_cha){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_bosuutap = $this->format->validation($ten_bosuutap);
            $bosuutap_cha = $this->format->validation($bosuutap_cha);
            // kết nối với CSDL 
            $ten_bosuutap = mysqli_real_escape_string($this->database->link, $ten_bosuutap);
            $bosuutap_cha = mysqli_real_escape_string($this->database->link, $bosuutap_cha);
            if(empty($ten_bosuutap) || empty($bosuutap_cha)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên bộ sưu tập và danh mục không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `bosuutap`(`ten_bosuutap`, `bosuutap_cha`) VALUES ('$ten_bosuutap','$bosuutap_cha')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Danh mục được thêm thành công</span>';
                    header("Location: themBoSuuTap.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục thêm không thành công</span>';
                    header("Location: themBoSuuTap.php");
                    return $alert;
                }
            }
        }
        // public function show_danhmuc (){
        //     $query = "SELECT * FROM `danhmuc_sanpham`  ORDER BY ma_danhmuc desc";
        //     $result = $this->database->select($query);
        //     return $result;
        // }
        public function update_bosuutap($ten_bosuutap, $bosuutap_cha, $ma){
            $ten_bosuutap = $this->format->validation($ten_bosuutap);
            $bosuutap_cha = $this->format->validation($bosuutap_cha);
            // kết nối với CSDL 
            $ten_bosuutap = mysqli_real_escape_string($this->database->link, $ten_bosuutap);
            $bosuutap_cha = mysqli_real_escape_string($this->database->link, $bosuutap_cha);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_bosuutap) || empty($bosuutap_cha)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên bộ sưu tập không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `bosuutap` SET `ten_bosuutap`='$ten_bosuutap',`bosuutap_cha`='$bosuutap_cha' WHERE ma_bosuutap = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Bộ sưu tập được sửa thành công</span>';
                    header("Location: danhSachBoSuuTap.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Bộ sưu tập sửa không thành công</span>';
                    header("Location: danhSachBoSuuTap.php");
                    return $alert;
                }
            }
        }
        public function delete_bosuutap($maXoa){
            $query = "DELETE FROM `bosuutap` WHERE ma_bosuutap = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Bộ sưu tập xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Bộ sưu tập xóa không thành công</span>';
                return $alert;
            }
        }
        public function layBoSuuTap($ma){
            $query = "SELECT * FROM `bosuutap` WHERE ma_bosuutap = '$ma' ";
            $result = $this->database->select($query);
            return $result;
        }
        public function show_bosuutap (){
            $query = "SELECT * FROM `bosuutap`  ORDER BY ma_bosuutap desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_bosuutap($timkiem_bosuutap){
            $query = "SELECT * FROM `bosuutap` WHERE ten_bosuutap LIKE '%".$timkiem_bosuutap."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        // 
    }
?>