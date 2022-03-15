<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class huyen{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function show_huyen_theoTinh($maTinh){
            $query = "SELECT * FROM `huyen` WHERE ma_tinh = '$maTinh'";
            $result = $this->database->select($query);
            return $result;
        }
        public function insert_huyen($ten_huyen, $ten_tinh){
            $ten_huyen = $this->format->validation($ten_huyen);
            $ten_tinh = $this->format->validation($ten_tinh);
            // kết nối với CSDL 
            $ten_tinh = mysqli_real_escape_string($this->database->link, $ten_tinh);
            $ten_huyen = mysqli_real_escape_string($this->database->link, $ten_huyen);
            if(empty($ten_tinh) || empty($ten_huyen)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `huyen`( `ten_huyen`, `ma_tinh`) 
                VALUES ('$ten_huyen','$ten_tinh')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Huyện được thêm thành công</span>';
                    header("Location: themHuyen.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Huyện thêm không thành công</span>';
                    header("Location: themHuyen.php");
                    return $alert;
                }
            }
        }
        public function show_huyen(){
            $query = "SELECT * FROM `huyen` ORDER BY ma_huyen desc";
            $result = $this->database->select($query);
            return $result;
        }

        public function layHuyen($ma){
            $query = "SELECT * FROM `huyen` WHERE ma_huyen = '$ma' LIMIT 1";
            $result = $this ->database ->select($query);
            return $result;
        }
        public function update_huyen($ten_tinh, $ten_huyen, $ma){
            $ten_tinh = $this->format->validation($ten_tinh);
            $ten_huyen = $this->format->validation($ten_huyen);
            // kết nối với CSDL 
            $ten_tinh = mysqli_real_escape_string($this->database->link, $ten_tinh);
            $ten_huyen = mysqli_real_escape_string($this->database->link, $ten_huyen);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if (empty($ten_huyen) || empty ($ten_tinh)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `huyen` SET `ten_huyen`='$ten_huyen',`ma_tinh`='$ten_tinh' 
                WHERE ma_huyen = '$ma'";
                $result = $this ->database->update($query);
                if ($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Huyện được sửa thành công</span>';
                    header("Location: danhSachHuyen.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Huyện sửa không thành công</span>';
                    header("Location: suaHuyen.php");
                    return $alert;
                }
            }
        }
        public function delete_huyen($maXoa){
            $query = "DELETE FROM `huyen` WHERE ma_huyen = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Huyện xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Huyện xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_huyen($timkiem_huyen){
            $query = "SELECT * FROM `huyen` WHERE ten_huyen LIKE '%".$timkiem_huyen."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>