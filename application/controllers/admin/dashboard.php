<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
            parent::__construct();
            $this->load->model('general_model');
            $this->load->model('users_model');
    }
    
    public function index() {
            $data['logged_in'] = $this->session->userdata('logged_in');
            $data['username'] = $this->session->userdata('username');
            if($data['logged_in'] == TRUE)
                $this->load->view('admin/dashboard',$data);
            else
                redirect("home");
	}
    }

?>