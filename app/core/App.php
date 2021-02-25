<?php
    class App{
        // membuat pengaturan default untuk web pada controler, method dan params
        protected $controller = 'Home';
        protected $method = 'index';
        protected $params = [];
        public function __construct()
        {
            $url = $this->parseURL();
            /* controllers dan
            cek controllers */
            if (file_exists('../app/controllers/'.$url[0].'.php')) {
                $this->controller = $url[0];
                // menghilangkan controller
                unset($url[0]);
            }
            // memanggil controller yang baru 
            require_once '../app/controllers/'.$this->controller.'.php';
            // ekstansiasi untuk pemanggilan method
            $this->controller = new $this->controller;
            /* method dan
            cek method */
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            /* params dan
            cek param */
            if (!empty($url)) {
                $this->params = array_values($url);
            }
            // jalankan controllers dan method serta kirimkan params jika ada
            call_user_func_array([$this->controller,$this->method],$this->params);
        }
        public function parseURL(){
            if (isset($_GET['url'])) {
                // menghilangkan tanda slash
                $url = rtrim($_GET['url'], '/');
                // menghilangkan karakter aneh
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // memparsing url atau memisahkan url berdasarkan tanda slash
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>