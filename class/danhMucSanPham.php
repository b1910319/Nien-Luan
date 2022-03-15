<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class danhMucSanPham{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        // hàm thêm danh mục sản phẩm
        public function insert_danhmuc($ten_danhmuc, $danhmuc_cha){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_danhmuc = $this->format->validation($ten_danhmuc);
            $danhmuc_cha = $this->format->validation($danhmuc_cha);
            // kết nối với CSDL 
            $ten_danhmuc = mysqli_real_escape_string($this->database->link, $ten_danhmuc);
            $danhmuc_cha = mysqli_real_escape_string($this->database->link, $danhmuc_cha);
            if(empty($ten_danhmuc) || empty($danhmuc_cha)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên danh mục và Danh mục cha không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `danhmuc_sanpham`(`ten_danhmuc`, `danhmuc_cha`) VALUES ('$ten_danhmuc','$danhmuc_cha')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Danh mục được thêm thành công</span>';
                    header("Location: themDanhMuc.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục thêm không thành công</span>';
                    header("Location: themDanhMuc.php");
                    return $alert;
                }
            }
        }
        public function show_danhmuc (){
            $query = "SELECT * FROM `danhmuc_sanpham`  ORDER BY ma_danhmuc desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_danhmuc($ten_danhmuc, $danhmuc_cha, $ma){
            $ten_danhmuc = $this->format->validation($ten_danhmuc);
            $danhmuc_cha = $this->format->validation($danhmuc_cha);
            // kết nối với CSDL 
            $ten_danhmuc = mysqli_real_escape_string($this->database->link, $ten_danhmuc);
            $danhmuc_cha = mysqli_real_escape_string($this->database->link, $danhmuc_cha);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_danhmuc) || empty($danhmuc_cha)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Tên danh mục và Danh mục cha không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `danhmuc_sanpham` SET `ten_danhmuc`='$ten_danhmuc',`danhmuc_cha`='$danhmuc_cha' WHERE ma_danhmuc = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Danh mục được sửa thành công</span>';
                    header("Location: danhSachDanhMuc.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục sửa không thành công</span>';
                    header("Location: suaDanhMuc.php");
                    return $alert;
                }
            }
        }
        //tìm rồi xóa bị lỗi
        public function delete_danhmuc($maXoa){
            $query = "DELETE FROM `danhmuc_sanpham` WHERE ma_danhmuc = '$maXoa'";
            $result = $this->database->delete($query);
            if($result  != NULL){
                $alert = '<span style="color: #038018; font-weight: bold;">Danh mục  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục xóa không thành công</span>';
                return $alert;
            }
        }
        public function layDanhMuc($ma){
            $query = "SELECT * FROM `danhmuc_sanpham` WHERE ma_danhmuc = '$ma'  LIMIT 1";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_danhmuc($timkiem_danhmuc){
            $query = "SELECT * FROM `danhmuc_sanpham` WHERE ten_danhmuc LIKE '%".$timkiem_danhmuc."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        // 
    }
?>