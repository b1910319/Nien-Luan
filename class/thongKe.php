<?php

use Carbon\Carbon;

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
    include_once($filepath."/../lib/Carbon-2.57.0/autoload.php");
?>
<?php
    class thongKe{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function thongke_danhso_ngay (){
            $query = "SELECT ngay_thongke , SUM(tongtien) AS tongtien_ngay FROM thongke GROUP BY ngay_thongke";
            $result = $this->database->select($query);
            return $result;
        }
        public function thongke_sanpham_ngay (){
            $query = "SELECT ngay_thongke , SUM(soluong_ban) AS tongban_ngay FROM thongke GROUP BY ngay_thongke";
            $result = $this->database->select($query);
            return $result;
        }
        public function thongke_danhso_nam (){
            $query = "SELECT nam_thongke , SUM(tongtien) AS tongtien_nam FROM thongke GROUP BY nam_thongke";
            $result = $this->database->select($query);
            return $result;
        }
        public function thongke_sanpham_nam (){
            $query = "SELECT nam_thongke , SUM(soluong_ban) AS tongban_nam FROM thongke GROUP BY nam_thongke";
            $result = $this->database->select($query);
            return $result;
        }
    }
?>