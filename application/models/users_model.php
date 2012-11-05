<?php

if(!defined('BASEPATH')) exit('No direct Script Allowed');

class Users_model extends CI_Model
{
    function __construct(){
        $this->load->model('general_model');
    }
    function add_user($data)
    {
        /*Codify the password*/
        $data['password']=sha1($data['password']);
        $result = 0;
        /* Insert user in the database */
        if(!empty($data))
        {
            $result = $this->db->insert('users', $data);
        }
        return $result;
    }
    
    /*Function called from the private _username_not_exists that will return false to the callback function on username validation*/
    function check_exists_username($username){
        /* Select 'users' table on database */
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('username', $username);
        $result = $this->db->get();
        
        if($result->num_rows() >0){
            /*Username Exists*/
            return TRUE;
        } else {
            /*Username does not exist*/
            return FALSE;
        }
    }
    
    /*Function called from the private _email_not_exists that will return false to the callback function on email validation*/
    function check_exists_email($email){
        /* Select 'users' table on database */
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $result = $this->db->get();
        
        if($result->num_rows() >0){
            /*Username Exists*/
            return TRUE;
        } else {
            /*Username does not exist*/
            return FALSE;
        }
    }
    
    /*Function to check the registration code exists in the database*/
    function confirm_registration($registration_code)
    {
        /* Check the users table for the activation code */
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('activation_code',$registration_code);
        $result = $this->db->get();
        if($result->num_rows == 1){
            /* Activate account */
            $data = array(
                'activated' => 1
            );
            $this->db->where('activation_code',$registration_code);
            $this->db->update('users',$data);
            $user = $result->row_array();
            $email = $this->get_email($user['id']);
            return $email;
            } else {
            return false;
        }
    }
    /* Function to check for login */
    function check_login($data){
       /* Codify the password */
        $sha1_password = sha1($data['password']);
        /* Check the login data at the DB table users */
        $this->db->from('users');
        $this->db->where('username', $data['username']);
        $this->db->where('password',$sha1_password);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            /* If it works return the user's id */
            return true;
        } else {
            return false;
        } 
    }
    
    function get_users(){
        $result = $this->db->get('users');
        $data = $result->result_array();
        return $data;
    }
    
    /* Function to get the user id as he logs in */
    function get_user_id($data){
        /* Codify the password */
        $sha1_password = sha1($data['password']);
        /* Check the login data at the DB table users */
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('username', $data['username']);
        $this->db->where('password',$sha1_password);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            /* If it works return the user's id */
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
    
    function get_username($id){
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->username;
        } else {
            return false;
        }
    }
    
    function get_surname($id){
        $this->db->select('surname');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->surname;
        } else {
            return false;
        }
    }
    
    function get_firstname($id){
        $this->db->select('firstname');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->firstname;
        } else {
            return false;
        }
    }
    
    function get_email($id){
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->email;
        } else {
            return false;
        }
    }
    
    function get_status($id){
        $this->db->select('status');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->status;
        } else {
            return false;
        }
    }
    
    function get_user_picture($id){
        $this->db->select('picture');
        $this->db->from('users');
        $this->db->where('id',$id);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return $result->row(0)->picture;
        } else {
            return false;
        }
    }

    
    function update_password($email,$password){
        $password = sha1($password);
        $this->db->where('email', $email);
        $data = array(
            'password' => $password
        );
        $this->db->update('users',$data);
    }
    
    function update_user($username,$firstname,$surname,$email,$password, $id){
        $data = array(
            'username'=>$username,
            'firstname'=>$firstname,
            'surname'=>$surname,
            'email'=>$email,
            'password'=>$password,
        );
        print_r($data);
        $this->db->where('id',$id);
        $this->db->update('users',$data);
        $this->db->last_query();
    }
    
    /* This function creates a random string to be sent to registered users for confirmation */
    function random_string_length($length)
    {
        $len = $length;
        $base = "ABCDEFGHIJKLMNRSTUVWXYabcdefghijklmnopqrstuvwxyz123456789";
        $max = strlen($base) - 1;
        $activatecode = '';
        mt_srand((double)microtime()*1000000);
        while(strlen($activatecode) < $len + 1)
            $activatecode .= $base{mt_rand(0,$max)};
        return $activatecode;
    }
    
     function delete_user($id){
        $this->db->delete('users', array('id' => $id));
       
    }
    
    function check_logged_in(){
        if($this->session->userdata('logged_in')){
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
}