<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function page_missing()
	{
		$this->load->view('404_this');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */