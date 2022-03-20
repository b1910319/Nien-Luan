<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once($filepath."/../helper/format.php");
?>
<?php
    class luotXem{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        public function insert_luotxem($maSP){
            $query = "SELECT * FROM `luotxem` WHERE ma_sanpham = '$maSP'";
            $result = $this->database->select($query);
            if($result){
                $ketqua = $result->fetch_assoc();
                $luotxem = $ketqua['so_luotxem'];
                $luotxemUpdate = $luotxem +1;
                $queryUpdate = "UPDATE `luotxem` SET `so_luotxem`='$luotxemUpdate' WHERE ma_sanpham = '$maSP'";
                $resultUpdate = $this->database->update($queryUpdate);
            }else{
                $queryInsert = "INSERT INTO `luotxem`(`ma_sanpham`, `so_luotxem`) VALUES ('$maSP','1')";
                $resultInsert = $this->database->insert($queryInsert);
            }
        }
        public function show_luotxem ($maSP){
            $query = "SELECT * FROM `luotxem` WHERE ma_sanpham = '$maSP'";
            $result = $this->database->select($query);
            return $result;
        }
    }
?>