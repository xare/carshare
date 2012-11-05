<?php

if(!defined('BASEPATH')) exit('No direct Script Allowed');
    
    class Users_model extends CI_Model 
    {
        
    function add_user($data)
        {
        $data['password'] = sha1($data['password']);
            $result = 0;
            if(!empty($data))
            {
                $result = $this->db->insert('users',$data);
            }
            return $result;
        }
    function confirm_registration($registration_code)
        {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('activation_code', $registration_code);
        $result = $this->db->get();
        if($result->num_rows == 1){
            $data = array(
               'activated' => 1
            );
            $this->db->where('activation_code',$registration_code);
            $this->db->update('users', $data); 
            return true; 
        } else {
            return false;
        }
        $this->db->get();
        }
    function check_exists_username($username)
    {
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('username', $username);        
        $result = $this->db->get();
        
        if($result->num_rows() > 0)
        {
            //username exists
            return true;
        } else {
            //username does not exist
            return false;
        }
    }
    function check_exists_email($email)
    {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('email', $email);        
        $result = $this->db->get();
        
        if($result->num_rows() > 0)
        {
            //username exists
            return true;
        } else {
            //username does not exist
            return false;
        }
    }    
    function check_login($data){
        $sha1_password=sha1($data['password']);
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('username',$data["username"]);
        $this->db->where('password',$sha1_password);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }
    function get_user_id($data){
        $sha1_password=sha1($data['password']);
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('username',$data["username"]);
        $this->db->where('password',$sha1_password);
        $result = $this->db->get();
        if($result->num_rows() == 1){
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
    function check_invitation($email,$token){
        $this->db->select('*');
        $this->db->from('invitations');
        $this->db->where('email',$email);
        $this->db->where('token',$token);
        $result = $this->db->get();
        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }
}