<?php
	if (!defined('BASEPATH')) exit('Ga boleh ada akses langsung ke script!');
	
	/**
	* 
	*/
	class TujuKe extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->helper(array('string','url'));
		}

		function index(){
			if (!$this->uri->segment(1)) {
				# code...
				redirect(base_url());
			}
			else
			{
				$url_code=$this->uri->segment(1);
				$this->load->model('Model_Url');
				$query=$this->Model_Url->ambil_url($url_code);

				if ($query->num_rows()==1) {
					# code...
					foreach ($query->result() as $row) {
						# code...
						$url_address=$row->url_address;
					}
					redirect(prep_url($url_address));
				}
				else
				{
					$page_data = array(
						'success_fail' => null, 
						'encoded_url' => false 
					);
					$this->load->view('nav/nav_atas');
					$this->load->view('buat/buat',$page_data);
				}
			}
		}
	}
?>