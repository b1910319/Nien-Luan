<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class danhMucCombo{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_danhmuc_combo($ten_danhmuc_combo, $file){
            $ten_danhmuc_combo = $this->format->validation($ten_danhmuc_combo);
            $ten_danhmuc_combo = mysqli_real_escape_string($this->database->link, $ten_danhmuc_combo);
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_danhmuc_combo']['name'];
            $file_size = $_FILES['hinhanh_danhmuc_combo']['size'];
            $file_temp = $_FILES['hinhanh_danhmuc_combo']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            if(empty($ten_danhmuc_combo) || empty($file_name)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên danh mục combo và hình ảnh không được trống</span>';
                return $alert;
            } else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO `danhmuc_combo`
                ( `ten_danhmuc_combo`, `hinhanh_danhmuc_combo`) 
                VALUES 
                ('$ten_danhmuc_combo','$unique_image')";
                $result = $this->database->insert($query);
                if($result){
                    header("Location: themDanhMucCombo.php");
                } else{
                    header("Location: themDanhMucCombo.php");
                }
            }
        }
        public function show_danhmuc_combo (){
            $query = "SELECT * FROM `danhmuc_combo`  ORDER BY ma_danhmuc_combo desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_danhmuc_combo($ten_danhmuc_combo, $file, $ma){
            $ten_danhmuc_combo = $this->format->validation($ten_danhmuc_combo);
            $ten_danhmuc_combo = mysqli_real_escape_string($this->database->link, $ten_danhmuc_combo);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_danhmuc_combo']['name'];
            $file_size = $_FILES['hinhanh_danhmuc_combo']['size'];
            $file_temp = $_FILES['hinhanh_danhmuc_combo']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            if( empty($ten_danhmuc_combo)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên danh mục không được trống</span>';
                return $alert;
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE `danhmuc_combo` 
                SET `ten_danhmuc_combo`='$ten_danhmuc_combo',
                `hinhanh_danhmuc_combo`='$unique_image' 
                WHERE ma_danhmuc_combo = '$ma'";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Thông tin được sửa thành công</span>';
                    header("Location: danhSachDanhMucCombo.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Thông tin được sửa không thành công</span>';
                    header("Location: danhSachDanhMucCombo.php");
                    return $alert;
                }
            }
        }
        public function delete_danhmuc_combo($maXoa){
            $query = "DELETE FROM `danhmuc_combo` WHERE  ma_danhmuc_combo = '$maXoa'";
            $result = $this->database->delete($query);
            if($result  != NULL){
                $alert = '<span style="color: #038018; font-weight: bold;">Danh mục được xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục xóa không thành công</span>';
                return $alert;
            }
        }
        public function layDanhMucCombo($ma){
            $query = "SELECT * FROM `danhmuc_combo` WHERE ma_danhmuc_combo = '$ma'  LIMIT 1";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_danhmuc_combo($timkiem_danhmuc_combo){
            $query = "SELECT * FROM `danhmuc_combo` WHERE  ten_danhmuc_combo LIKE '%".$timkiem_danhmuc_combo."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        // 
    }
?>