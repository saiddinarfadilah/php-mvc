<?php 
    // kelas diextend dengan file Controller yang ada di folder core
    class About extends Controller {
        public function index($nama="Said", $pekerjaan="Mahasiswa"){
            $data['nama'] = $nama;
            $data['pekerjaan'] = $pekerjaan;
            $this->view('about/index',$data);
        }
        public function page(){
            $this->view('about/page');
        }
    }
?>