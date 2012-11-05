<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{  
    function __construct(){
        parent::__construct();
        $CI =& get_instance();
        $CI->load->model('general_model');
        $CI->load->model('users_model');
    }
    function index(){
        /*This would be the users main page but we will not use it for the moment*/
    }
    
    function register(){
        /* http://domain.tld/users/register page */
        /* We load CI's form validation library in order to perform validation checks*/
        $CI->load->library('form_validation');
        
        /* VALIDATION CHECKS */
        $CI->form_validation->set_rules('firstname','Name','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $CI->form_validation->set_rules('surname','Surname','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $CI->form_validation->set_rules('username','Username','trim|required|alpha_numeric|min_lengh[6]|xss_clean|strtolower|callback_username_not_exists');
        $CI->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|strtolower|callback_email_not_exists');
        $CI->form_validation->set_rules('password','Password','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $CI->form_validation->set_rules('password_conf','Password confirmation','trim|required|alpha_numeric|min_lengh[6]|xss_clean|matches[password]');
        
        /*Provide an error view if the validation fails*/
        if($CI->form_validation->run() == FALSE){
            //error validation was not correct
            $CI->load->view('register_view');
        } else {
            //validation was successful process the data.
            $firstname = $CI->input->post('firstname');
            $surname = $CI->input->post('surname');
            $username = $CI->input->post('username');
            $email = $CI->input->post('email');
            $password = $CI->input->post('password');
            // The random string function is private to the Users class and is declared below on this file.
            $activation_code = $CI->_random_string_length(10);
            // We create the data array that will be passed to the add_user function in the model, 
            // this function is in charge of adding the user to the database.
            // The activation code is used as a way to ensure that the user can confirm his registration via email.
            $data = array(
               'firstname' => $firstname,
               'surname' => $surname,
               'username' => $username,
               'email' => $email,
               'password' => $password,
               'activation_code' => $activation_code
            );
            $CI->users_model->add_user($data);
            // once the data has been stored in the data base we load the register view again (??)
            $CI->load->view('register_view');
            
            //email confirmation
            // 1st we load CI's email library that will ease the task
            
            $CI->load->library('email');
            // We store all the parameters for the email
            $CI->email->from('xaresd@gmail.com','xare');
            $CI->email->to($email);
            $CI->email->subject('[carshare] Registration Confirmation');
            $CI->email->message('Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/register_confirm/'. $activation_code, 'Confirmation Code'));
            
            echo 'Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/register_confirm/'. $activation_code, 'Confirmation Code');
            
            // we send the email.
            //$CI->email->send();
            
            //confirmation view
        }
        
            
    }
    function invite(){
        // WE will use an invitation system to increase security for users. Before they register.
        
        $CI->load->library('form_validation');
        // Validate data
        $CI->form_validation->set_rules('firstname','Name','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $CI->form_validation->set_rules('surname','Surname','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $CI->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|strtolower|callback_email_not_exists');
        if($CI->form_validation->run() == FALSE){
            //error validation was not correct
            $CI->load->view('invite_view');
        } else {
            // Take data from form. A token value is added as an encrypted string in order to make this invitation unique and storable for checking.
            $data = array(
                        'name' => $CI->input->post('name'),
                        'surname' => $CI->input->post('surname'),
                        'email' => $CI->input->post('email'),
                        'token' => md5(uniqid() . microtime() . rand())
                    );

            // Store data in Database
            $CI->db->insert('invitations',$data);
            // generate a link
            // 
            // Send email with confirmation data
            $CI->load->library('email');
            $CI->email->from('xaresd@gmail.com','xare');
            $CI->email->to($data['email']);
            $CI->email->subject('[carshare] Invitation ');
            
            //split_email to be passed to the url as the @ symbol is not allowed on urls.
            $split_email=explode("@",$data['email']);

            // In code igniter urls'follow the pattern http://www.domain.tld/controller/function/parameter1/parameter2/parameter3/...
            $CI->email->message('You have been invited by carshare to join our community.' . anchor('http://localhost/carshare/users/confirm_invitation/'.$split_email[0].'/'.$split_email[1].'/'.$data['token'], 'Confirmation Code'));
            
            echo 'Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/confirm_invitation/'.$split_email[0].'/'.$split_email[1].'/'. $data['token'], 'Confirmation Code');
            
            //$CI->email->send();
            // Generate response to the user
        }
        
        
       
    }
    
    function confirm_invitation($split_email1,$split_email2 , $token){
        // http://www.domain.tld/users/confirm_invitation/$split_email1/$split_email2/$token
        // In code igniter urls'follow the pattern http://www.domain.tld/controller/function/parameter1/parameter2/parameter3/...
        // Since the @ symbol is not allowed in urls the email is split in to and then 
        
        //Invitations are confirmed
        $email=$split_email1."@".$split_email2;
   
        // The user has clicked on the link
        // Check the token and the database in the database. Check invitation is a boolean which takes the email and the token
        // and checks in the invitations table of the database, this operation is performed by the check_invitation function.
        $check_invitation = $CI->users_model->check_invitation($email, $token);
        
        // Generate approval message on page and guide to registry
        if($check_invitation == FALSE){
            echo "You have not been invited";
        } else {
            echo "Welcome please <a id=\"register_link\" href=\"users/show_registration\">Register</a>";
        }
        // Send a welcome email.
    }
    function show_registration(){
        //http://www.domain.tld/users/show_registration
        $CI->load->view('register_view');
    }
    function username_not_exists($username)
    {
        $CI->form_validation->set_message('username_not_exists', 'That %s already exists. Please choose a different username and try again.');
        if($CI->users_model->check_exists_username($username))
            return false;
    }  
    
    function email_not_exists($email)
    {
        $CI->form_validation->set_message('email_not_exists', 'That %s already exists. Please choose a different %s and try again.');
        if($CI->users_model->check_exists_email($email))
            return false;
    }  
    
    function _random_string_length($length)
    {
        $len = $length;
        $base = "ABCDEFGHIJKLMNRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
        $max = strlen($base)-1;
        $activatecode='';
        mt_srand((double)microtime()*1000000);
        while (strlen($activatecode) < $len+1)
            $activatecode .= $base{mt_rand(0,$max)};
        
        return $activatecode;
    }
    
    function register_confirm(){
        $registration_code = $CI->uri->segment(3);
        if($registration_code == '')
        {
            echo "Error no registration code in url";
            exit();
        } else {
            $registration_confirmed = $CI->users_model->confirm_registration($registration_code);
            if($registration_confirmed){
                echo "You have succesfully registered";
            } else {
                echo "You have not registered succesfully.";
            }
        }
    }
    
    function reset_password()
    {
        $CI->load->view('reset_password_view');
    }
    
    function reset_password_send(){
        $email = $CI->input->post('email');
        $newpassword = $CI->users_model->update_password($email,$password);
        
        /* Send an email */
        $CI->load->library('email');
            $from = "carshare";
            $from_email = "xaresd@gmail.com";
            $to = $data['email'];
            $subject = "[CarShare] Password Renewal";
            $message ="Please receive your new password ".$newpassword;
        $CI->general_model->send_email($from_email,$from,$to,$subject,$message);
    }
    function login(){
        //http://www.domain.tld/users/login
        $CI->load->library('form_validation');

        $CI->form_validation->set_rules('username','Username','trim|required|alpha_numeric|xss_clean');
        $CI->form_validation->set_rules('password','Password','trim|required|alpha_numeric|xss_clean');
        
        if($CI->form_validation->run() == FALSE){
            echo "Form not validated show form again";
            //Form not validated show form again
            $CI->load->view('login_view');
        } else {
            //Success validation
            //echo "You have succesfully filled your form";
            $username = $CI->input->post('username');
            $password = $CI->input->post('password');
            $data=array(
                'username' => $username,
                'password' => $password
            );
            echo $id_user = $CI->users_model->get_user_id($data);
            
            if($CI->users_model->check_login($data) == FALSE) {
                echo "something wrong";
                //not logged in fail error
                $CI->session->set_flashdata('login_error', TRUE);
                //redirect('users/login');
            } else {
                //succesfully logged in
                $username = $CI->users_model->get_username($id_user);
                $login_data=array('logged_in'=>TRUE, 'id_user'=>$id_user, 'username'=>$username);
                $CI->session->set_userdata($login_data);
                redirect();
            }
        }
    }
    function show_login(){
        $CI->load->view('login_view');
    }
    function logout(){
        $CI->session->sess_destroy();
    }
    
    function profile(){
        // http://domain.tld/users/profile page
        
        $data['logged_in'] = $CI->session->userdata('logged_in');
        $data['user_id'] = $CI->session->userdata('id');
        $data['username'] = $CI->users_model->get_username($data['user_id']);
        $CI->load->view('profile_view',$data);
    }
    
    function picture(){
        $data['id_user'] = $CI->session->userdata('id');
        $data['username'] = $CI->session->userdata('username');
        $data['logged_in'] = $CI->session->userdata('logged_in');
        $CI->load->view('upload_picture_view',$data);
    }
    
    function picture_upload(){
        $data['id_user'] = $CI->session->userdata('id_user');
        $data['username'] = $CI->session->userdata('username');
        $data['logged_in'] = $CI->session->userdata('logged_in');
        $config['upload_path'] = './uploads/';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $data['username'];
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= '100';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
        $CI->load->library('upload', $config);
        if ( ! $CI->upload->do_upload())
	{
		$error = array('error' => $CI->upload->display_errors());
                print_r($error);
		$CI->load->view('profile_view', $error);
	}
	else
	{
            $CI->load->helper('directory');
            
                $data['upload_data'] = $CI->upload->data();
                $config_img['image_library'] = 'gd2';
                $config_img['source_image'] = $data['upload_data']['full_path'];
                $config_img['create_thumb'] = TRUE; 
                $config_img['maintain_ratio'] = TRUE;
                $config_img['width'] = 75;
                $config_img['height'] = 50;
                $CI->load->library('image_lib', $config_img);
                $CI->image_lib->resize();
                $data_picture = array(
                    'picture' => $data['upload_data']['file_name']
                );
                $CI->db->update('users', $data_picture, array('id' => $data['id_user']));
                $CI->load->view('profile_view', $data);
           
        }

       
    }
   
}