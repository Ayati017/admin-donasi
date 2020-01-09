<?php 
class c_login extends ci_controller{

	public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');    
        $this->load->library('session');           
    }


	public function index(){
		
		$this->form_validation->set_rules('nama', 'nama', 'trim|required|alpha');
		
        $this->form_validation->set_rules('password', 'password', 'trim|required|integer');

         if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('v_login');
                }
                else
                {
                    $this->session->set_flashdata('succses','Data Yang anda masukan berhasil.');
          			redirect('c_login');
                }

	}

}