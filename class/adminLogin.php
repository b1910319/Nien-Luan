<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/session.php");
    Session::checkLogin();
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class adminLogin{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        // hàm đăng nhập vào trang admin 
        public function login($userAdmin, $passAdmin){
            // kiểm tra dữ liệu truyền vào có hợp lệ không
            $userAdmin = $this->format->validation($userAdmin);
            $passAdmin = $this->format->validation($passAdmin);
            // kết nối với CSDL 
            $userAdmin = mysqli_real_escape_string($this->database->link, $userAdmin);
            $passAdmin = mysqli_real_escape_string($this->database->link, $passAdmin);
            if(empty($userAdmin) || empty($passAdmin)){
                $alert = 'Username và Password không được trống';
                return $alert;
            } else{
                $query = "SELECT * FROM `admin` WHERE user_admin='$userAdmin' AND pass_admin = '$passAdmin' LIMIT 1";
                $result = $this->database->select($query);
                if($result != false){
                    $value = $result->fetch_assoc();
                    // đăng nhập đúng lưu lại cái session 
                    Session::set('adminLogin', true);
                    Session::set('adminId', $value['ma_admin']);
                    Session::set('adminName', $value['ten_admin']);
                    Session::set('adminUser', $value['user_admin']);
                    header("Location:index.php");
                }
                else{
                    $alert = 'Username hoặc Password sai bạn vui lòng nhập lại';
                    return $alert;
                }
            }
        }
    }
?>