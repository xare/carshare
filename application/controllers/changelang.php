<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 
{  
    function __construct(){
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('users_model');
    }
    function index(){
        /*This would be the users main page but we will not use it for the moment*/
        $this->session->set_userdata($lang);
        redirect('home');
    }
}
