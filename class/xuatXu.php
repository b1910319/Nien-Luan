<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class xuatXu{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_xuatxu($ten_xuatxu){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $ten_xuatxu = $this->format->validation($ten_xuatxu);
            // kết nối với CSDL 
            $ten_xuatxu = mysqli_real_escape_string($this->database->link, $ten_xuatxu);
            if(empty($ten_xuatxu)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Xuất xứ không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `xuatxu`(`ten_xuatxu`) VALUES ('$ten_xuatxu')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Xuất xứ được thêm thành công</span>';
                    header("Location: themXuatXu.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Xuất xứ thêm không thành công</span>';
                    header("Location: themXuatXu.php");
                    return $alert;
                }
            }
        }
        public function show_xuatxu (){
            $query = "SELECT * FROM `xuatxu` ORDER BY ma_xuatxu desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_xuatxu($ten_xuatxu, $ma){
            $ten_xuatxu = $this->format->validation($ten_xuatxu);
            // kết nối với CSDL 
            $ten_xuatxu = mysqli_real_escape_string($this->database->link, $ten_xuatxu);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($ten_xuatxu)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Xuất xứ không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `xuatxu` SET`ten_xuatxu`='$ten_xuatxu' WHERE ma_xuatxu = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Xuất xứ được sửa thành công</span>';
                    header("Location: danhSachXuatXu.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Xuất xứ sửa không thành công</span>';
                    header("Location: suaXuatXu.php");
                    return $alert;
                }
            }
        }
        public function layXuatXu($ma){
            $query = "SELECT * FROM `xuatxu` WHERE ma_xuatxu = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function delete_xuatxu($maXoa){
            $query = "DELETE FROM `xuatxu` WHERE ma_xuatxu = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Xuất xứ  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Xuất xứ xóa không thành công</span>';
                return $alert;
            }
        }
        public function timkiem_xuatxu($timkiem_xuatxu){
            $query = "SELECT * FROM `xuatxu` WHERE ten_xuatxu LIKE '%".$timkiem_xuatxu."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
    }
?>