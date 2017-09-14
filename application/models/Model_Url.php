<?php
	if (!defined('BASEPATH')) exit('Ga boleh ada akses langsung ke script!');

	/**
	* 
	*/
	class Model_Url extends CI_Model
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->database();
		}

		function simpan_url($data)
		{
			# code...
			// Periksa kode unik udah ada di database apa belum. Kalo udah ada
			// bikin baru dan periksa lagi udah ada apa belum. Terus-menerus
			// bikin baru sampe ketemu unik. Kalo udah unik, itu lah urlnya.
			do {
				# code...
				$url_code=random_string('alnum',8);

				$this->db->where('url_code=',$url_code);
				$this->db->from('url');
				$num=$this->db->count_all_results();
			} while ( $num >= 1);

			$query="INSERT INTO url (url_code,url_address) VALUES (?,?)";
			$result=$this->db->query($query,array($url_code,$data['url_address']));

			if ($result) {
				# code...
				return $url_code;
			}
			else
			{
				return false;
			}
		}

		function ambil_url($url_code)
		{
			# code...
			$query="SELECT * FROM url WHERE url_code=?";
			$result=$this->db->query($query,array($url_code));

			if ($result) {
				# code...
				return $result;
			}
			else
			{
				return false;
			}
		}

	}
?>