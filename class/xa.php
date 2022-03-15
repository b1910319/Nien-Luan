<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class xa{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function show_xa_theoHuyen($maHuyen){
            $query = "SELECT * FROM `xa`  WHERE ma_huyen = '$maHuyen'";
            $result = $this->database->select($query);
            return $result;
        }
        public function insert_xa($ten_xa, $ten_huyen){
            $ten_xa = $this->format->validation($ten_xa);
            $ten_huyen = $this->format->validation($ten_huyen);
            // kết nối với CSDL 
            $ten_huyen = mysqli_real_escape_string($this->database->link, $ten_huyen);
            $ten_xa = mysqli_real_escape_string($this->database->link, $ten_xa);
            if(empty($ten_xa) || empty($ten_huyen)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `xa`( `ten_xa`, `ma_huyen`) VALUES 
                ('$ten_xa','$ten_huyen')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Xã được thêm thành công</span>';
                    header("Location: themXa.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Xã thêm không thành công</span>';
                    header("Location: themXa.php");
                    return $alert;
                }
            }
        }
        public function show_xa(){
            $query = "SELECT * FROM `xa` ORDER BY ma_xa DESC";
            $result = $this->database->select($query);
            return $result;
        }
        public function layXa($ma){
            $query="SELECT * FROM `xa` WHERE ma_xa = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }

        public function update_xa($ten_xa, $ten_huyen, $ma){
            $ten_xa = $this->format->validation($ten_xa);
            $ten_huyen = $this->format->validation($ten_huyen);
            // kết nối với CSDL 
            $ten_xa = mysqli_real_escape_string($this->database->link, $ten_xa);
            $ten_huyen = mysqli_real_escape_string($this->database->link, $ten_huyen);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if (empty($ten_huyen) || empty ($ten_xa)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `xa` SET `ten_xa`='$ten_xa',`ma_huyen`='$ten_huyen' 
                WHERE ma_xa = '$ma'";
                $result = $this ->database->update($query);
                if ($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Xã được sửa thành công</span>';
                    header("Location: danhSachXa.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Xã sửa không thành công</span>';
                    header("Location: suaXa.php");
                    return $alert;
                }
            }
        }
        public function delete_xa($maXoa){
            $query = "DELETE FROM `xa` WHERE ma_xa = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Xã xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Xã xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_xa($timkiem_xa){
            $query = "SELECT * FROM `xa` WHERE ten_xa LIKE '%".$timkiem_xa."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>