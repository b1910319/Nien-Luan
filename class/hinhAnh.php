<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class hinhAnh{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_hinhanh($data, $files){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_sanpham = mysqli_real_escape_string($this->database->link, $data['ten_sanpham']);
            // kiểm tra hình ảnh và lấy hình ảnh cho vào thư mục uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_sanpham']['name'];
            $file_size = $_FILES['hinhanh_sanpham']['size'];
            $file_temp = $_FILES['hinhanh_sanpham']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            if(empty($file_name) && empty($ten_sanpham)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên sản phẩm không được trống</span>';
                return $alert;
            } else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO `hinhanh_sanpham`( `hinhanh`, `ma_sanpham`) 
                VALUES ('$unique_image','$ten_sanpham')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được thêm thành công</span>';
                    header("Location: themHinhAnhSanPham.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh thêm không thành công</span>';
                    header("Location: themHinhAnhSanPham.php");
                    return $alert;
                }
            }
        }
        public function show_hinhanh (){
            $query = "SELECT * FROM `hinhanh_sanpham` ORDER BY ma_hinhanh desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_hinhanh($ten_sanpham, $files, $ma){
            $ten_sanpham = $this->format->validation($ten_sanpham);
            $ten_sanpham = mysqli_real_escape_string($this->database->link, $ten_sanpham);
            // kiểm tra hình ảnh và lấy hình ảnh cho vào thư mục uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh_sanpham']['name'];
            $file_size = $_FILES['hinhanh_sanpham']['size'];
            $file_temp = $_FILES['hinhanh_sanpham']['tmp_name'];
            $div = explode(' . ', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0 ,10). ' . ' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if( empty($ten_sanpham)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên sản phẩm không được trống</span>';
                return $alert;
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE `hinhanh_sanpham` SET`hinhanh`='$unique_image',`ma_sanpham`='$ten_sanpham' WHERE ma_hinhanh='$ma'";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được thêm thành công</span>';
                    header("Location: danhSachHinhAnh.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh thêm không thành công</span>';
                    header("Location: suaHinhAnh.php");
                    return $alert;
                }
            }
        }
        public function layHinhAnh($ma){
            $query = "SELECT * FROM `hinhanh_sanpham` WHERE ma_hinhanh = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function delete_hinhanh($maXoa){
            $query = "DELETE FROM `hinhanh_sanpham` WHERE ma_hinhanh = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Hình ảnh được  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Hình ảnh xóa không thành công</span>';
                return $alert;
            }
        }
        public function layHinhAnh_tuSanPham($ma){
            $query = "SELECT * FROM `hinhanh_sanpham` WHERE ma_sanpham = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_hinhanh($timkiem_hinhanh){
            $query = "SELECT * FROM `hinhanh_sanpham` join `sanpham` on hinhanh_sanpham.ma_sanpham = sanpham.ma_sanpham   WHERE ten_sanpham LIKE '%".$timkiem_hinhanh."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>