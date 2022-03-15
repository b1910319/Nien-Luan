<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class hinhAnhCombo{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_hinhanh_combo($ten_combo, $files){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_combo = mysqli_real_escape_string($this->database->link, $ten_combo);
            // kiểm tra hình ảnh và lấy hình ảnh cho vào thư mục uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_combo']['name'];
            $file_size = $_FILES['hinhanh_combo']['size'];
            $file_temp = $_FILES['hinhanh_combo']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            if(empty($file_name) && empty($ten_combo)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên sản phẩm không được trống</span>';
                return $alert;
            } else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO `hinhanh_combo`(`ma_combo`, `hinhanh_combo`) 
                VALUES ('$ten_combo','$unique_image')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được thêm thành công</span>';
                    header("Location: themHinhAnhCombo.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh thêm không thành công</span>';
                    header("Location: themHinhAnhCombo.php");
                    return $alert;
                }
            }
        }
        public function show_hinhanh_combo (){
            $query = "SELECT * FROM `hinhanh_combo` ORDER BY ma_hinhanh_combo desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_hinhanh_combo( $ten_combo, $file, $ma){
            $ten_combo = $this->format->validation($ten_combo);
            $ten_combo = mysqli_real_escape_string($this->database->link, $ten_combo);
            // kiểm tra hình ảnh và lấy hình ảnh cho vào thư mục uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_combo']['name'];
            $file_size = $_FILES['hinhanh_combo']['size'];
            $file_temp = $_FILES['hinhanh_combo']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if( empty($ten_combo)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên combo không được trống</span>';
                return $alert;
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE `hinhanh_combo` SET `ma_combo`='$ten_combo',
                `hinhanh_combo`='$unique_image' WHERE ma_hinhanh_combo = '$ma'";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được sửa thành công</span>';
                    header("Location: danhSachHinhAnhCombo.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh sửa không thành công</span>';
                    header("Location: suaHinhAnhCombo.php");
                    return $alert;
                }
            }
        }
        public function layHinhAnh_combo($ma){
            $query = "SELECT * FROM `hinhanh_combo` WHERE ma_hinhanh_combo = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function layHinhAnh($ma){
            $query = "SELECT * FROM `hinhanh_combo` WHERE ma_combo = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function delete_hinhanh_combo($maXoa){
            $query = "DELETE FROM `hinhanh_combo` WHERE ma_hinhanh_combo = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_hinhanh_combo($timkiem_hinhanh_combo){
            $query = "SELECT * FROM `hinhanh_combo` join `combo` on hinhanh_combo.ma_combo = combo.ma_combo   WHERE ten_combo LIKE '%".$timkiem_hinhanh_combo."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>