<?php 
	if (!defined('BASEPATH')) exit('Ga boleh ada akses langsung ke script!');
	
	/**
	* 
	*/
	class Buat extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->helper(array('string','url'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		}

		function index()
		{
			# code...
			$this->form_validation->set_rules('url_address',$this->lang->line('create_url_address'),'required|min_length[1]|max_length[1000]|trim');
			if ($this->form_validation->run()==false) {
				# code...
				// nentuin nilai awal untuk view
				$page_data = array(
					'success_fail' => null, 
					'encoded_url' => false 
				);
				$this->load->view('nav/nav_atas');
				$this->load->view('buat/buat',$page_data);
			}
			else
			{
				// mulai bangun data untuk dikirim ke database
				$data = array('url_address' => $this->input->post('url_address') );
				$this->load->model('Model_Url');
				if ($res=$this->Model_Url->simpan_url($data)) {
					# code...
					$page_data['success_fail']='success';
					$page_data['encoded_url']=$res;
				}
				else
				{
					// beberapa error, tetapkan untuk nampilin pesan error
					$page_data['success_fail']='fail';
				}
				
				// bangun link yang akan ditampilkan ke user
				$page_data['encoded_url']=base_url().$res;
				$this->load->view('nav/nav_atas');
				$this->load->view('buat/buat',$page_data);
			}
		}
	}
?>