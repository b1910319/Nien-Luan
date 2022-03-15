<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class tinh{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_tinh($ten_tinh){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_tinh = $this->format->validation($ten_tinh);
            // kết nối với CSDL 
            $ten_tinh = mysqli_real_escape_string($this->database->link, $ten_tinh);
            if(empty($ten_tinh)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tỉnh/Thành Phố không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `tinh`( `ten_tinh`) VALUES ('$ten_tinh')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Tình/Thành Phố được thêm thành công</span>';
                    header("Location: themTinh.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Tình/Thành Phố thêm không thành công</span>';
                    header("Location: themTinh.php");
                    return $alert;
                }
            }
        }

        public function update_tinh($ten_tinh, $ma){
            $ten_tinh = $this->format->validation($ten_tinh);
            // kết nối với CSDL 
            $ten_tinh = mysqli_real_escape_string($this->database->link, $ten_tinh);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_tinh)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Phòng không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `tinh` SET `ten_tinh`='$ten_tinh' WHERE  ma_tinh = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Tỉnh được sửa thành công</span>';
                    header("Location: danhSachTinh.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Tỉnh sửa không thành công</span>';
                    header("Location: suaTinh.php");
                    return $alert;
                }
            }
        }

        public function show_tinh(){
            $query = "SELECT * FROM `tinh`  ORDER BY ma_tinh desc";
            $result = $this->database->select($query);
            return $result;
        }

        public function layTinh($ma){
            $query = "SELECT * FROM `tinh` WHERE ma_tinh = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }

        public function delete_tinh($maXoa){
            $query = "DELETE FROM `tinh` WHERE ma_tinh = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Tỉnh xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tỉnh xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_tinh($timkiem_tinh){
            $query = "SELECT * FROM `tinh` WHERE ten_tinh LIKE '%".$timkiem_tinh."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>