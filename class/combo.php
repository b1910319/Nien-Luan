<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class combo{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_combo ($ten_combo, $tomtat_combo, $danhmuc_combo){
            $ten_combo = mysqli_real_escape_string($this->database->link, $ten_combo);
            $tomtat_combo = mysqli_real_escape_string($this->database->link, $tomtat_combo);
            $danhmuc_combo = mysqli_real_escape_string($this->database->link, $danhmuc_combo);
            if(empty($ten_combo) || empty($danhmuc_combo)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `combo`
                (`ma_danhmuc_combo`, `ten_combo`, `tomtat_combo`) 
                VALUES 
                ('$danhmuc_combo','$ten_combo','$tomtat_combo')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Combo được thêm thành công</span>';
                    header("Location: themCombo.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Combo thêm không thành công</span>';
                    header("Location: themCombo.php");
                    return $alert;
                }
            }
        }
        public function show_combo (){
            $query = "SELECT * FROM `combo`  ORDER BY ma_combo desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function layDanhMucCombo($ma){
            $query = "SELECT * FROM `danhmuc_combo` WHERE ma_danhmuc_combo = '$ma'  LIMIT 1";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_combo($ten_combo, $tomtat_combo, $ma,$danhmuc_combo){
            $ten_combo = $this->format->validation($ten_combo);
            $tomtat_combo = $this->format->validation($tomtat_combo);
            $danhmuc_combo = $this->format->validation($danhmuc_combo);
            // // kết nối với CSDL 
            $ten_combo = mysqli_real_escape_string($this->database->link, $ten_combo);
            $tomtat_combo = mysqli_real_escape_string($this->database->link, $tomtat_combo);
            $danhmuc_combo = mysqli_real_escape_string($this->database->link, $danhmuc_combo);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_combo) || empty($tomtat_combo) || empty($danhmuc_combo)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `combo` SET `ma_danhmuc_combo`='$danhmuc_combo',
                `ten_combo`='$ten_combo',`tomtat_combo`='$tomtat_combo' 
                WHERE ma_combo = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Thông tin combo được sửa thành công</span>';
                    header("Location: danhSachCombo.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Thông tin combo sửa không thành công</span>';
                    header("Location: danhSachCombo.php");
                    return $alert;
                }
            }
        }
        public function delete_combo($maXoa){
            $query = "DELETE FROM `combo` WHERE  ma_combo = '$maXoa'";
            $result = $this->database->delete($query);
            if($result  != NULL){
                $alert = '<span style="color: #038018; font-weight: bold;">Combo được xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Combo xóa không thành công</span>';
                return $alert;
            }
        }
        public function layCombo($ma){
            $query = "SELECT * FROM `combo` WHERE ma_combo = '$ma'  LIMIT 1";
            $result = $this->database->select($query);
            return $result;
        }
        public function layCombo_danhMuc($ma_danhmuc_combo){
            $query = "SELECT * FROM `combo` WHERE ma_danhmuc_combo = '$ma_danhmuc_combo' ";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_combo($timkiem_combo){
            $query = "SELECT * FROM `combo` WHERE  ten_combo LIKE '%".$timkiem_combo."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>