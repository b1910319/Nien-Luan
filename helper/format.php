<?php
    class fomat{
        // định dạng ngày
        public function formatDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }
        // kiểm tra kí tự có hợp lệ không
        public function validation ($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        public function title (){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            if ($title == 'index'){
                $title = 'home';
            } elseif ($title == 'contact'){
                $title = 'contact';
            }
            return $title = ucfirst($title);
        }
    }
?>