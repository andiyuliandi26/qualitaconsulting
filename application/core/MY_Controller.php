<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->helper('jwt');
        $this->load->library(array('ion_auth', 'form_validation'));
        //$this->load->library('pdfgenerator');
 
		$this->load->helper(array('url', 'language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
    }

    public function current_user(){
        return $this->ion_auth->user()->row();
    }

    protected function load_view($path, $data = NULL){
        $this->load->view("layouts/header");
        $this->load->view("layouts/nav_global");        
        $this->load->view($path, $data);        
        $this->load->view("layouts/footer");
    }

    protected function load_administrator_view($path, $data = NULL){
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}else{

            $this->load->view("layouts/header");
            $this->load->view("layouts/nav");        
            $this->load->view($path, $data);        
            //$view;
            $this->load->view("layouts/footer");
        }
    }
}


?>