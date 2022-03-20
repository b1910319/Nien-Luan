<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once ($filepath."/../helper/format.php");
?>
<?php
    class sanPham{
        private $database ;
        private $format;
        public function __construct()
        {
            $this ->database = new database();
            $this ->format = new fomat();
        }
        // hàm thêm danh mục sản phẩm
        public function insert_sanpham($data){
            // kết nối với CSDL 
            $ten_sanpham = mysqli_real_escape_string($this->database->link, $data['ten_sanpham']);
            $gia_sanpham = mysqli_real_escape_string($this->database->link, $data['gia_sanpham']);
            $tongsoluong_sanpham = mysqli_real_escape_string($this->database->link, $data['tongsoluong_sanpham']);
            $vatlieu_sanpham = mysqli_real_escape_string($this->database->link, $data['vatlieu_sanpham']);
            $kichthuoc_sanpham = mysqli_real_escape_string($this->database->link, $data['kichthuoc_sanpham']);
            $mau_sanpham = mysqli_real_escape_string($this->database->link, $data['mau_sanpham']);
            $tomtat_sanpham = mysqli_real_escape_string($this->database->link, $data['tomtat_sanpham']);
            $mota_sanpham = mysqli_real_escape_string($this->database->link, $data['mota_sanpham']);
            $danhmuc_sanpham = mysqli_real_escape_string($this->database->link, $data['danhmuc_sanpham']);
            $xuatxu_sanpham = mysqli_real_escape_string($this->database->link, $data['xuatxu_sanpham']);
            $phong = mysqli_real_escape_string($this->database->link, $data['phong']);
            $bosuutap = mysqli_real_escape_string($this->database->link, $data['bosuutap']);
            $combo = mysqli_real_escape_string($this->database->link, $data['combo']);
            $loai_sanpham = mysqli_real_escape_string($this->database->link, $data['loai_sanpham']);
            if(empty($tomtat_sanpham) || empty($mota_sanpham) || 
                empty($danhmuc_sanpham)||empty($xuatxu_sanpham) || 
                empty($phong) || empty($bosuutap) || empty($loai_sanpham)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "INSERT INTO `sanpham`
                ( `ten_sanpham`,`gia_sanpham`,`tongsoluong_sanpham`, `vatlieu_sanpham`, `kichthuoc_sanpham`, `mausac_sanpham`, `tomtat_sanpham`, 
                `mota_sanpham`, `ma_danhmuc`, `ma_xuatxu`, `ma_phong`, `ma_bosuutap`, `ma_combo`, `loai_sanpham`) 
                VALUES 
                ('$ten_sanpham','$gia_sanpham','$tongsoluong_sanpham','$vatlieu_sanpham','$kichthuoc_sanpham','$mau_sanpham',
                '$tomtat_sanpham','$mota_sanpham','$danhmuc_sanpham','$xuatxu_sanpham',
                '$phong','$bosuutap','$combo','$loai_sanpham')";
                $result = $this->database->insert($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Danh mục được thêm thành công</span>';
                    header("Location: themSanPham.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Danh mục thêm không thành công</span>';
                    header("Location: themSanPham.php");
                    return $alert;
                }
            }
        }
        public function show_sanpham (){
            $query = "SELECT * FROM `sanpham`  ORDER BY ma_sanpham desc";
            $result = $this->database->select($query);
            return $result;
        }
        public function update_sanpham($data, $ma){
            $ten_sanpham = mysqli_real_escape_string($this->database->link, $data['ten_sanpham']);
            $gia_sanpham = mysqli_real_escape_string($this->database->link, $data['gia_sanpham']);
            $tongsoluong_sanpham = mysqli_real_escape_string($this->database->link, $data['tongsoluong_sanpham']);
            $vatlieu_sanpham = mysqli_real_escape_string($this->database->link, $data['vatlieu_sanpham']);
            $kichthuoc_sanpham = mysqli_real_escape_string($this->database->link, $data['kichthuoc_sanpham']);
            $mau_sanpham = mysqli_real_escape_string($this->database->link, $data['mau_sanpham']);
            $tomtat_sanpham = mysqli_real_escape_string($this->database->link, $data['tomtat_sanpham']);
            $mota_sanpham = mysqli_real_escape_string($this->database->link, $data['mota_sanpham']);
            $danhmuc_sanpham = mysqli_real_escape_string($this->database->link, $data['danhmuc_sanpham']);
            $xuatxu_sanpham = mysqli_real_escape_string($this->database->link, $data['xuatxu_sanpham']);
            $phong = mysqli_real_escape_string($this->database->link, $data['phong']);
            $bosuutap = mysqli_real_escape_string($this->database->link, $data['bosuutap']);
            $combo = mysqli_real_escape_string($this->database->link, $data['combo']);
            $loai_sanpham = mysqli_real_escape_string($this->database->link, $data['loai_sanpham']);
            $ma = mysqli_real_escape_string($this->database->link, $ma);
            if(empty($tomtat_sanpham) || empty($mota_sanpham) || 
                empty($danhmuc_sanpham)||empty($xuatxu_sanpham) || 
                empty($phong) || empty($bosuutap) ||empty($combo) || empty($loai_sanpham)){
                $alert = '<span style="color: #eb3007; font-weight: bold;">Các trường không được trống</span>';
                return $alert;
            } else{
                $query = "UPDATE `sanpham` SET `ten_sanpham`='$ten_sanpham',
                `gia_sanpham`='$gia_sanpham',`tongsoluong_sanpham`='$tongsoluong_sanpham',`vatlieu_sanpham`='$vatlieu_sanpham',`kichthuoc_sanpham`='$kichthuoc_sanpham',
                `mausac_sanpham`='$mau_sanpham',`tomtat_sanpham`='$tomtat_sanpham',`mota_sanpham`='$mota_sanpham',
                `ma_danhmuc`='$danhmuc_sanpham',`ma_xuatxu`='$xuatxu_sanpham',`ma_phong`='$phong',
                `ma_bosuutap`='$bosuutap',`ma_combo`='$combo',`loai_sanpham`='$loai_sanpham' WHERE ma_sanpham = '$ma'";
                $result = $this->database->update($query);
                if($result){
                    $alert = '<span style="color: #038018; font-weight: bold;">Sản phẩm được sửa thành công</span>';
                    header("Location: danhSachSanPham.php");
                    return $alert;
                } else{
                    $alert = '<span style="color: #eb3007; font-weight: bold;">Sản phẩm sửa không thành công</span>';
                    header("Location: suaSanPham.php");
                    return $alert;
                }
            }
        }
        public function delete_sanpham($maXoa){
            $query = "DELETE FROM `sanpham` WHERE ma_sanpham = '$maXoa'";
            $result = $this->database->delete($query);
            if($result){
                $alert = '<span style="color: #038018; font-weight: bold;">Sản phẩm  xóa thành công</span>';
                return $alert;
            } else{
                $alert = '<span style="color: #eb3007; font-weight: bold;">Sản phẩm xóa không thành công</span>';
                return $alert;
            }
        }
        public function laySanPham($ma){
            $query = "SELECT * FROM `sanpham` WHERE ma_sanpham = '$ma'";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_combo($ma_combo){
            $query = "SELECT * FROM `sanpham` WHERE ma_combo = '$ma_combo'";
            $result = $this->database->select($query);
            return $result;
        }

        public function laySanPham_topBanChay(){
            $sanpham_tungtrang = 6;
            if (!isset($_GET['trangTop'])){
                $trang = 1;
            }
            else{
                $trang = $_GET['trangTop'];
            }
            $tung_trang = ($trang-1)*$sanpham_tungtrang;
            $query = "SELECT * FROM `sanpham` WHERE loai_sanpham = '2' LIMIT $tung_trang, $sanpham_tungtrang";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_topBanChay_phanTrang(){
            $query = "SELECT * FROM `sanpham` WHERE loai_sanpham = '2' ";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_noiBat(){
            $sanpham_tungtrang = 6;
            if (!isset($_GET['trangNoiBat'])){
                $trang = 1;
            }
            else{
                $trang = $_GET['trangNoiBat'];
            }
            $tung_trang = ($trang-1)*$sanpham_tungtrang;
            $query = "SELECT * FROM `sanpham` WHERE loai_sanpham = '1' LIMIT $tung_trang, $sanpham_tungtrang  ";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_noiBat_phanTrang(){
            $query = "SELECT * FROM `sanpham` WHERE loai_sanpham = '1' ";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_theoDanhmuc($ma_danhmuc){
            $query = "SELECT * FROM `sanpham` WHERE ma_danhmuc = $ma_danhmuc LIMIT 6 ";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_theoDanhMuc_all($ma_danhmuc){
            $query = "SELECT * FROM `sanpham` WHERE ma_danhmuc = $ma_danhmuc ";
            $result = $this->database->select($query);
            return $result;
        }
        public function timKiem($timkiem){
            $query = "SELECT * FROM `sanpham` WHERE ten_sanpham LIKE '%".$timkiem."%' ";
            $result = $this ->database->select($query);
            return $result;
        }
        public function laySanPham_theoBoSuuTap_all($maBST){
            $query = "SELECT * FROM `sanpham` WHERE ma_bosuutap = $maBST ";
            $result = $this->database->select($query);
            return $result;
        }
        public function laySanPham_theoPhong_all($maPhong){
            $query = "SELECT * FROM `sanpham` WHERE ma_phong = $maPhong ";
            $result = $this->database->select($query);
            return $result;
        }
        public function tong_sanpham (){
            $query = "SELECT COUNT(ten_sanpham) as 'tong_sanpham'  FROM `sanpham`";
            $result = $this->database->select($query);
            return $result;
        }
        public function tong_sanpham_danhmuc(){
            $query = "SELECT COUNT(sanpham.ma_sanpham) as 'tong_sanpham_danhmuc', ten_danhmuc  
            FROM `sanpham`, `danhmuc_sanpham`
            WHERE sanpham.ma_danhmuc = danhmuc_sanpham.ma_danhmuc  GROUP BY  danhmuc_sanpham.ma_danhmuc, danhmuc_sanpham.ten_danhmuc";
            $result = $this->database->select($query);
            return $result;
        }
        public function dem_sanpham_danhmuc($maDM){
            $query= "SELECT COUNT(ma_sanpham) as  'tong_sanpham_danhmuc' FROM `sanpham` WHERE ma_danhmuc = '$maDM'";
            $result = $this->database->select($query);
            return $result;
        }
    }
?>