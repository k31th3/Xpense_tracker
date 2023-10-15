<?php  
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    define('ENCRYPTION_KEY', '4736d52f85bdb63e46bf7d6d41bbd551af36e1bfb7c68164bf81e2400d299532');
    
    class Is_app
    {   
        public function ajax_method_required()
        {
            $ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            if (!$ajax) 
            {
                redirect(base_url(''), 'refresh');
            }
        }   

        public function user_session_required()
        {
            $msm["status"] = false;
                       
            if (isset($_SESSION['user_id'])) 
            {
                $msm["status"] = true;
            }

            return (object)$msm;
        }

        public function login_ajax_method_required()
        {
            $ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            $msm["status"] = true;
            
            if (!$ajax) 
            {
                $msm["message"] = "xmlhttprequest"; 
                $msm["status"] = false;
            }

            return (object)$msm;
        }

        public function required_user_active()
        {
            if (!isset($_SESSION['user_id'])) 
            {
                redirect(base_url(''), 'refresh');
            } 
        }

        public function load_assets($list)
        {   
            $file = null;
            foreach($list as $row)
            {
                $ext = pathinfo($row, PATHINFO_EXTENSION);
                $url = "assets/{$row}";

                if($ext == 'css')
                {
                    $file .= link_tag($url);
                }
                else
                {
                    $file .= script_tag($url);
                }
            }

            echo $file; 
        }

        public function encrypt($string, $salt = null)
        {
            if($salt === null) { $salt = hash('sha256', uniqid(mt_rand(), true)); }  

            // this is an unique salt per entry and directly stored within a password
            return base64_encode(openssl_encrypt($string, 'AES-256-CBC', ENCRYPTION_KEY, 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT))).':'.$salt;
        }     

        public function decrypt($string)
        {
            if( count(explode(':', $string)) !== 2 ) { return $string; }

            // read salt from entry
            $salt = explode(":",$string)[1]; $string = explode(":",$string)[0]; 
            
            return openssl_decrypt(base64_decode($string), 'AES-256-CBC', ENCRYPTION_KEY, 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT));
        } 
    }


