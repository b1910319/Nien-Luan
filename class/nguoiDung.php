<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class nguoiDung{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_nguoidung($data){
            $hoten_nguoidung = mysqli_real_escape_string($this->database->link, $data['hoten']);
            $sdt_nguoidung = mysqli_real_escape_string($this->database->link, $data['sdt']);
            $email_nguoidung = mysqli_real_escape_string($this->database->link, $data['mail']);
            $user_nguoidung = mysqli_real_escape_string($this->database->link, $data['user']);
            $pass_nguoidung = mysqli_real_escape_string($this->database->link, md5($data['pass']));
            $tinh_nguoidung = mysqli_real_escape_string($this->database->link, $data['tinh']);
            $huyen_nguoidung = mysqli_real_escape_string($this->database->link, $data['huyen']);
            $xa_nguoidung = mysqli_real_escape_string($this->database->link, $data['xa']);
            $diachi_nguoidung = mysqli_real_escape_string($this->database->link, $data['diachi']);
            if(empty($hoten_nguoidung) || empty($sdt_nguoidung) || 
            empty($email_nguoidung)||empty($user_nguoidung) || 
            empty($pass_nguoidung) || empty($tinh_nguoidung) || empty($huyen_nguoidung) 
            || empty($xa_nguoidung) || empty($diachi_nguoidung)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $check_user = "SELECT * FROM `nguoidung` WHERE 	user_nguoidung='$user_nguoidung' LIMIT 1 ";
                $resultcheck = $this->database->select($check_user);
                if ($resultcheck){
                    $alert = '<span style="color: #eb3007;">Username đã tồn tại vui lòng đặt lại</span>';
                    return $alert;
                } else{
                    $query = "INSERT INTO `nguoidung`(`hoten_nguoidung`, `sdt_nguoidung`, 
                    `email_nguoidung`, `user_nguoidung`, `pass_nguoidung`, `tinh_nguoidung`, 
                    `huyen_nguoidung`, `xa_nguoidung`, `diachi_nguoidung`) 
                    VALUES 
                    ('$hoten_nguoidung','$sdt_nguoidung','$email_nguoidung','$user_nguoidung',
                    '$pass_nguoidung','$tinh_nguoidung','$huyen_nguoidung','$xa_nguoidung',
                    '$diachi_nguoidung')";
                    $result = $this->database->insert($query);
                    if($result){
                        $alert = '<span style=" color: white; font-weight: bold;">Tài khoản của quý khách đã đăng ký thành công</span>';
                        return $alert;
                    } else{
                        $alert = '<span style="color: white; font-weight: bold;">Tài khoản của quý khách đăng ký không thành công vui lòng kiểm tra lại thông tin</span>';
                        return $alert;
                    }
                }
            }
        }
        public function login_nguoidung($data){
            $user_nguoidung = mysqli_real_escape_string($this->database->link, $data['user']);
            $pass_nguoidung = mysqli_real_escape_string($this->database->link, md5($data['pass']));
            if($user_nguoidung == ' ' || $pass_nguoidung == ' '){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Username và Password không được trống</span>';
                return $alert;
            } else{
                $check_login = "SELECT * FROM `nguoidung` WHERE  user_nguoidung='$user_nguoidung' AND pass_nguoidung = '$pass_nguoidung' ";
                $resultcheck = $this->database->select($check_login);
                if ($resultcheck!= false){
                    $resultlogin = $resultcheck->fetch_assoc();
                    Session::set('login_nguoidung', true);
                    Session::set('login_ma', $resultlogin['ma_nguoidung']);
                    Session::set('login_ten', $resultlogin['hoten_nguoidung']);
                    Session::set('login_user', $resultlogin['user_nguoidung']);
                    $alert = '<span style="color: #038018;  font-weight: bold;">Đăng nhập thành công</span>';
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007;  font-weight: bold;">Username hoặc Password sai quy khách vui lòng đặt lại</span>';
                    return $alert;
                }
            }
        }
        public function show_thongTin($ma_nguoidung){
            $query = "SELECT * FROM `nguoidung` WHERE ma_nguoidung = '$ma_nguoidung'";
            $result= $this ->database->select($query);
            return $result;
        }
        public function show_khachhang(){
            $query = "SELECT * FROM `nguoidung` ORDER BY ma_nguoidung desc";
            $result= $this ->database->select($query);
            return $result;
        }
        public function update_info_nguoidung($data,$ma_nguoidung){
            $hoten_nguoidung = mysqli_real_escape_string($this->database->link, $data['hoten']);
            $sdt_nguoidung = mysqli_real_escape_string($this->database->link, $data['sdt']);
            $email_nguoidung = mysqli_real_escape_string($this->database->link, $data['mail']);
            $user_nguoidung = mysqli_real_escape_string($this->database->link, $data['user']);
            $diachi_nguoidung = mysqli_real_escape_string($this->database->link, $data['diachi']);
            $ma_nguoidung = mysqli_real_escape_string($this->database->link, $ma_nguoidung);
            if(empty($hoten_nguoidung) || empty($sdt_nguoidung) || 
            empty($email_nguoidung)||empty($user_nguoidung) ||  empty($diachi_nguoidung)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                    $query = "UPDATE `nguoidung` SET `hoten_nguoidung`='$hoten_nguoidung',
                    `sdt_nguoidung`='$sdt_nguoidung',`email_nguoidung`='$email_nguoidung',
                    `user_nguoidung`='$user_nguoidung',`diachi_nguoidung`='$diachi_nguoidung' 
                    WHERE ma_nguoidung = '$ma_nguoidung'";
                    $result = $this->database->insert($query);
                    if($result){
                        $alert = '<span style=" color: #038018; font-weight: bold;">Thông tin của quý khách được sửa thành công</span>';
                        return $alert;
                    } else{
                        $alert = '<span style="color: #eb3007; font-weight: bold;">Thông tin của quý khách sửa không thành công vui lòng kiểm tra lại thông tin</span>';
                        return $alert;
                    }
            }
        }
        public function infoAdmin(){
            $query = "SELECT * FROM `admin` ";
            $result = $this->database->select($query);
            return $result;
        }
        public function timkiem_nguoidung($timkiem_nguoidung){
            $query = "SELECT * FROM  `nguoidung` WHERE hoten_nguoidung LIKE '%".$timkiem_nguoidung."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        public function tong_nguoidung (){
            $query = "SELECT COUNT(ma_nguoidung) as 'tong_nguoidung'  FROM `nguoidung`";
            $result = $this->database->select($query);
            return $result;
        }
    }
?>