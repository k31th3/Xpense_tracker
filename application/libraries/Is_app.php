<?php  
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Is_app
    {   
        public function ajax_method_required()
        {
            $ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            if (!$ajax) 
            {
                die(FALSE);
            }
        }   

        public function ajax_method_with_session_required()
        {
            $ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            if (!$ajax) 
            {
                $msm["message"] = "xmlhttprequest"; 
                $msm["status"] = false;
            }
            else if (empty($_SESSION['user_id'])) 
            {
                $msm["message"] = "expired_session";
                $msm["status"] = false;
            }
            else
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

        public function required_userdata_active()
        {
            if (
                    $_SESSION['active_status'] != 1 && 
                    $_SESSION['user_id'] == 0
                ) 
            {
                redirect(base_url(''), 'refresh');
            } 

        }
    }


