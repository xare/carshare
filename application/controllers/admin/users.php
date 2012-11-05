<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
        {
            parent::__construct();
            $this->load->model('general_model');
            $this->load->model('users_model');
        }
    
    public function index()
	{
	}
        
     public function user_add(){
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['users'] = $this->users_model->get_users();
        $this->load->view('admin/user_add',$data);
    }
    
    public function add_user(){
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','trim|required|xss_clean|callback_email_not_exists');
        $this->form_validation->set_rules('username','Username','trim|required|xss_clean|callback_username_not_exists');
        $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('surname','Surname','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|min_length[6]|xss_clean');
        $this->form_validation->set_rules('password_conf','Password confirmation', 'trim|required|alpha_numeric|min_length[6]|xss_clean|matches[password]');
        
        if($this->form_validation->run() == FALSE){
        } else {
            $userdata['username'] = $this->input->post('username');
            $userdata['firstname'] = $this->input->post('firstname');
            $userdata['surname'] = $this->input->post('surname');
            $userdata['password'] = $this->input->post('password');
            $userdata['email'] = $this->input->post('email');
            $id = $this->users_model->add_user($userdata);
            //$this->picture_upload($id,'users');
        }
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['users'] = $this->users_model->get_users();
        
        $this->load->helper('form');
        $this->load->view('admin/user_add', $data);
    }
    
     function edit_user($id){
        $data['id'] = $id;
        $data['username'] = $this->users_model->get_username($id);
        $data['firstname'] = $this->users_model->get_firstname($id);
        $data['surname'] = $this->users_model->get_surname($id);
        $data['email'] = $this->users_model->get_email($id);
        $this->load->view('admin/edit_user',$data);
    }
     function update_user(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','trim|required|xss_clean');
        $this->form_validation->set_rules('username','Username','trim|required|xss_clean');
        $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('surname','Surname','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|min_length[6]|xss_clean');
        $this->form_validation->set_rules('password_conf','Password confirmation', 'trim|required|alpha_numeric|min_length[6]|xss_clean|matches[password]');
        
        if($this->form_validation->run() == FALSE){
            //$this->load->view('admin/error');
        } else {
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $firstname = $this->input->post('firstname');
            $surname = $this->input->post('surname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->users_model->update_user($username,$firstname,$surname,$email,$password, $id);
         }
         
         // update database table with proper data
         redirect('admin/users/add_user');
    }
    
    public function delete_user($id){
        //1. Delete File from folder
        $username = $this->users_model->get_username($id);
            
        //2. Delete Sample from Samples List
        $this->users_model->delete_user($id);
        
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['users'] = $this->users_model->get_users();
        $this->load->view('admin/user_list', $data);
    }
     /* Call back function for sample validation */
    function email_not_exists($email) {
        $this->form_validation->set_message('email_not_exists', 'That %s already exists. Please choose a different email name and try again');
        /*The model function check_exists_sample will return true or false. Only when it exists our function will return false. and block registration*/
        if($this->users_model->check_exists_email($email)){
            return false;   
        } else { 
            return true;
        }
    }
     function username_not_exists($username) {
        $this->form_validation->set_message('username_not_exists', 'That %s already exists. Please choose a different username name and try again');
        /*The model function check_exists_sample will return true or false. Only when it exists our function will return false. and block registration*/
        if($this->users_model->check_exists_username($username)){
            return false;   
        } else { 
            return true;
        }
    }
}