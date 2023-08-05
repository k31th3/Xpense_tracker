<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Setting extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->is_app->required_user_active();
		}

		public function index()
		{
			$data['page'] = 'Audit trail';

			$this->load->view('layout/header', $data);
			$this->load->view('audit trail/index')
					   ->view('layout/footer');
		}

		public function logo()
		{
			$row = $this->setting->get_logo_data();

			$details = (object)json_decode(preg_replace('/[\r\n]/',' ', $row->setting_details), true);
 			
			echo img([
				'src' => "https://drive.google.com/uc?export=view&id=1rauOr02DACvcbNVO2_64nSVeuxtwUDPH",
				'width' => '100%',
				'height' => '100%'
			]);

			
		}
	}
