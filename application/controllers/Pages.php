<?php
	class Pages extends CI_Controller   // PHP DOES'NT HAVE PUBLIC BEFORE CLASS
	{
		public function __construct()
		{
			parent:: __construct();
			$this-> load ->helper('url_helper');
			$this-> load->helper('date');
			$this->load->library('encrypt');
		}
		public function view($page = 'home')
		{
			if(! file_exists(APPPATH.'views/pages/'.$page.'.php'))
			{
				show_404();
					
			}
			
			$data['title'] = ucfirst($page);


			$datestring = '%d/%m/%Y %h:%i %a';
			$time = now();

			$data['date'] = mdate($datestring, $time);
			$this -> load -> view('templates/header',$data);
			$this -> load -> view('pages/'.$page);
			$this -> load -> view('templates/footer',$data);
		}
	}
?>