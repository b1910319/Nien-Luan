<?php
    class session{
        // taọ session ban đầu 
        public static function init(){
            if(version_compare(phpversion(), '5.4.0', '<')){
                if(session_id() == ' '){
                    session_start();
                }
            }else{
                if (session_status() == PHP_SESSION_NONE){
                    session_start();
                }
            }
        }
        public static function set ($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            } else{
                return false;
            }
        }
        // kiểm tra session có tồn tại hay không
        public static function checkSession(){
            self::init();
            if (self::get("adminLogin") == false) {
                self::destroy();
                header("Location:dangNhap.php");
            }
        }
        public static function checkLogin (){
            self::init();
            if (self::get("adminLogin") == true){
                header("Location:index.php");
            }
        }
        // hủy session 
        public static function destroy(){
            session_destroy();
            header("Location:dangNhap.php");
        }
    }
?>