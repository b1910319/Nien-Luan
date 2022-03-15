<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class phong{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_phong($ten_phong){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_phong = $this->format->validation($ten_phong);
            // kết nối với CSDL 
            $ten_phong = mysqli_real_escape_string($this->database->link, $ten_phong);
            if(empty($ten_phong)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên phòng không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `phong`(`ten_phong`) VALUES ('$ten_phong')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Phòng được thêm thành công</span>';
                    header("Location: themPhong.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Phòng thêm không thành công</span>';
                    header("Location: themPhong.php");
                    return $alert;
                }
            }
        }
        public function show_phong (){
            $query = "SELECT * FROM `phong` ORDER BY ma_phong desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_phong($ten_phong, $ma){
            $ten_phong = $this->format->validation($ten_phong);
            // kết nối với CSDL 
            $ten_phong = mysqli_real_escape_string($this->database->link, $ten_phong);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_phong)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Phòng không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `phong` SET `ten_phong`='$ten_phong' WHERE  ma_phong = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Phòng được sửa thành công</span>';
                    header("Location: danhSachPhong.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Phòng sửa không thành công</span>';
                    header("Location: suaPhong.php.php");
                    return $alert;
                }
            }
        }
        public function layPhong($ma){
            $query = "SELECT * FROM `phong` WHERE ma_phong = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function delete_phong($maXoa){
            $query = "DELETE FROM `phong` WHERE ma_phong = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Phòng  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Phòng xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_phong($timkiem_phong){
            $query = "SELECT * FROM `phong` WHERE ten_phong LIKE '%".$timkiem_phong."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>