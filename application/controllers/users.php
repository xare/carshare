<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 
{  
    var $data = array();
    function __construct(){
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('users_model');
        $this->data['logged_in'] = $this->session->userdata('logged_in');
        $this->data['username'] = $this->session->userdata('username');
    }
    function index(){
        /*This would be the users main page but we will not use it for the moment*/
    }
    
    function register(){
        
         //Create new User Object and a new Auth Object
        $u = new User();
        $a = new Auth();
        
        //Put user supplied data into the variables (no need to validate)
        $u->username = $this->input->post('username');
        $u->firstname = $this->input->post('firstname');
        $u->lastname = $this->input->post('lastname');
        $u->email = $this->input->post('email');
        $success = $u->save();
        
        $a->password = $this->input->post('password');
        $a->password_conf = $this->input->post('password_conf');
        $a->activation_code = $a->random_string_length(10);
        $success2 = $a->save($u);
        
        if (! $success){
             $this->load->view('includes/register_view');
        } else {
            
            //Save related information on Auth info.
            if(! $success2){
                echo $a->error->string;
            } else {
        
                /*SEND CONFIRMATION MAIL*/
                /*An email is sent to the user with the link and the activation link*/
                $this->load->library('email');
        
                $from = "xare";
                $from_email = "xaresd@gmail.com";
                $to = $u->email;
                $subject = '[car share] Registration confirmation';
                $message = 'Please, click on this link to confirm your registration. ' . $this->config->item('base_url') . 'users/register_confirm/'. $a->activation_code;
            
                $this->general_model->send_email($from_email,$from, $to, $subject, $message);
        
                $this->load->view('register_request_view');
            }
        }
   }
        
        /* http://domain.tld/users/register page */
        /* We load CI's form validation library in order to perform validation checks*/
        //$this->load->library('form_validation');
        
        /* VALIDATION CHECKS */
        //$this->form_validation->set_rules('firstname','Name','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        //$this->form_validation->set_rules('surname','Surname','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        //$this->form_validation->set_rules('username','Username','trim|required|alpha_numeric|min_lengh[6]|xss_clean|strtolower|callback_username_not_exists');
        //$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|strtolower|callback_email_not_exists');
        //$this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        //$this->form_validation->set_rules('password_conf','Password confirmation','trim|required|alpha_numeric|min_lengh[6]|xss_clean|matches[password]');
        
        /*Provide an error view if the validation fails*/
        //if($this->form_validation->run() == FALSE){
            //error validation was not correct
            //$this->load->view('register_view');
        //} else {
            //validation was successful process the data.
            //$firstname = $this->input->post('firstname');
            //$surname = $this->input->post('surname');
            //$username = $this->input->post('username');
            //$email = $this->input->post('email');
            //$password = $this->input->post('password');
            // The random string function is private to the Users class and is declared below on this file.
            //$activation_code = $this->_random_string_length(10);
            // We create the data array that will be passed to the add_user function in the model, 
            // this function is in charge of adding the user to the database.
            // The activation code is used as a way to ensure that the user can confirm his registration via email.
            /*$data = array(
               'firstname' => $firstname,
               'surname' => $surname,
               'username' => $username,
               'email' => $email,
               'password' => $password,
               'activation_code' => $activation_code
            );*/
            //$this->users_model->add_user($data);
            // once the data has been stored in the data base we load the register view again (??)
            //$this->load->view('register_view');
            
            //email confirmation
            // 1st we load CI's email library that will ease the task
            
            //$this->load->library('email');
            // We store all the parameters for the email
            //$this->email->from('xaresd@gmail.com','xare');
            //$this->email->to($email);
            //$this->email->subject('[carshare] Registration Confirmation');
            //$this->email->message('Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/register_confirm/'. $activation_code, 'Confirmation Code'));
            
            //echo 'Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/register_confirm/'. $activation_code, 'Confirmation Code');
            
            // we send the email.
            //$this->email->send();
            
            //confirmation view
        //}
   

    
    function register_confirm($registration_code){
        $u = new User();
        $a = new Auth();
        /*Obtain registration code from link sent to user. We will use the url segments*/
        //$registration_code = $this->uri->segment(3);
        if($registration_code == ''){
            echo "Error no registration code in url";
            exit();
        } else {
           $registration_confirmed = $a->confirm_registration($registration_code);
           
           if($registration_confirmed != False){
               /*Successfull registration*/
               /*Send an Email*/
               $u->where('id',$registration_confirmed)->get();
               $this->load->library('email');
               
                    $from = "xare";
                    $from_email = "xaresd@gmail.com";
                    $to = $u->email;
                    $subject = '[Car Share] Succesfull Registration';
                    $message = 'You have successfully registered in our shop.';
            
                $this->general_model->send_email($from_email,$from, $to, $subject, $message);
                $sessiondata = array(
                    'logged_in' => TRUE,
                    'id_user' => $registration_confirmed,
                    'username' => $u->username
                );
                $this->session->set_userdata($sessiondata);
                $this->load->view('register_successful',$this->data);
           } else {
               echo "Failed registration";
           }
        }
        /*Check it against the database*/
        /*Return values*/
    }
    
    function invite(){
        // WE will use an invitation system to increase security for users. Before they register.
        
        $this->load->library('form_validation');
        // Validate data
        $this->form_validation->set_rules('firstname','Name','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $this->form_validation->set_rules('surname','Surname','trim|required|alpha_numeric|min_lengh[6]|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|strtolower|callback_email_not_exists');
        if($this->form_validation->run() == FALSE){
            //error validation was not correct
            $this->load->view('invite_view');
        } else {
            // Take data from form. A token value is added as an encrypted string in order to make this invitation unique and storable for checking.
            $data = array(
                        'name' => $this->input->post('name'),
                        'surname' => $this->input->post('surname'),
                        'email' => $this->input->post('email'),
                        'token' => md5(uniqid() . microtime() . rand())
                    );

            // Store data in Database
            $this->db->insert('invitations',$data);
            // generate a link
            // 
            // Send email with confirmation data
            $this->load->library('email');
            $this->email->from('xaresd@gmail.com','xare');
            $this->email->to($data['email']);
            $this->email->subject('[carshare] Invitation ');
            
            //split_email to be passed to the url as the @ symbol is not allowed on urls.
            $split_email=explode("@",$data['email']);

            // In code igniter urls'follow the pattern http://www.domain.tld/controller/function/parameter1/parameter2/parameter3/...
            $this->email->message('You have been invited by carshare to join our community.' . anchor('http://localhost/carshare/users/confirm_invitation/'.$split_email[0].'/'.$split_email[1].'/'.$data['token'], 'Confirmation Code'));
            
            echo 'Please, click on this link to confirm your registration.' . anchor('http://localhost/carshare/users/confirm_invitation/'.$split_email[0].'/'.$split_email[1].'/'. $data['token'], 'Confirmation Code');
            
            //$this->email->send();
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
        $check_invitation = $this->users_model->check_invitation($email, $token);
        
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
        $this->load->view('register_view');
    }
    function username_not_exists($username)
    {
        $this->form_validation->set_message('username_not_exists', 'That %s already exists. Please choose a different username and try again.');
        if($this->users_model->check_exists_username($username))
            return false;
    }  
    
    function email_not_exists($email)
    {
        $this->form_validation->set_message('email_not_exists', 'That %s already exists. Please choose a different %s and try again.');
        if($this->users_model->check_exists_email($email))
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
    
/*    function register_confirm(){
        $registration_code = $this->uri->segment(3);
        if($registration_code == '')
        {
            echo "Error no registration code in url";
            exit();
        } else {
            $registration_confirmed = $this->users_model->confirm_registration($registration_code);
            if($registration_confirmed){
                echo "You have succesfully registered";
            } else {
                echo "You have not registered succesfully.";
            }
        }
    }
 * 
 */
    
    function reset_password()
    {
        $this->load->view('reset_password_view');
    }
    
    function reset_password_send(){
        /*Collect email address to send new password to*/
        
        $u = new User();
        $a = new Auth();
        
        $array = $a->update_password($this->input->post('email'));
        
        /*Send an Email*/
        $this->load->library('email');       
            $from = "xare";
            $from_email = "xaresd@gmail.com";
            $to = $array['email'];
            $subject = '[car share] Succesfull Resetting your Password';
            $message = 'Please receive your new password. '.$array['password'];
            
        $this->general_model->send_email($from_email,$from, $to, $subject, $message);
        
        $this->load->view('reset_password_view');
    }
    
    /*function reset_password_send(){
        $email = $this->input->post('email');
        $newpassword = $this->users_model->update_password($email,$password);
        
        /* Send an email */
        /*$this->load->library('email');
            $from = "carshare";
            $from_email = "xaresd@gmail.com";
            $to = $data['email'];
            $subject = "[CarShare] Password Renewal";
            $message ="Please receive your new password ".$newpassword;
        $this->general_model->send_email($from_email,$from,$to,$subject,$message);
    }*/
    
    
    function login(){
        //http://www.domain.tld/users/login
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','Username','trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|xss_clean');
        
        if($this->form_validation->run() == FALSE){
            echo "Form not validated show form again";
            //Form not validated show form again
            $this->load->view('login_view');
        } else {
            //Success validation
            //echo "You have succesfully filled your form";
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data=array(
                'username' => $username,
                'password' => $password
            );
            echo $id_user = $this->users_model->get_user_id($data);
            
            if($this->users_model->check_login($data) == FALSE) {
                echo "something wrong";
                //not logged in fail error
                $this->session->set_flashdata('login_error', TRUE);
                //redirect('users/login');
            } else {
                //succesfully logged in
                $user = $this->general_model->get_row($id_user,'users');
                //$username = $this->users_model->get_username($id_user);
                $status = $this->users_model->get_status($id_user);
                $login_data=array(
                    'logged_in'=>TRUE, 
                    'id_user'=>$id_user, 
                    'username'=>$user['username'],
                    'firstname'=>$user['firstname'],
                    'surname'=>$user['surname'],
                    'email' => $user['email'],
                    'picture' => $user['picture'],
                    'status'=>$user['status'],
                    'language'=>$user['language']
                    );
                $this->session->set_userdata($login_data);
                if($status == "admin"){
                    redirect("admin/dashboard");
                } else {
                redirect();
                }
            }
        }
    }
    function show_login(){
        $this->load->view('login_view');
    }
    function logout(){
        $this->session->sess_destroy();
    }
    
    function profile(){
        // http://domain.tld/users/profile page
        
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['user_id'] = $this->session->userdata('id');
        $data['username'] = $this->users_model->get_username($data['user_id']);
        $this->load->view('profile_view',$data);
        //$this->user->profile();
    }
    
    function picture(){
        $data['id_user'] = $this->session->userdata('id');
        $data['username'] = $this->session->userdata('username');
        $data['logged_in'] = $this->session->userdata('logged_in');
        $this->load->view('upload_picture_view',$data);
    }
    
    function picture_upload(){
        $data['id_user'] = $this->session->userdata('id_user');
        $data['username'] = $this->session->userdata('username');
        $data['logged_in'] = $this->session->userdata('logged_in');
        $config['upload_path'] = './uploads/';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $data['username'];
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= '100';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload())
	{
		$error = array('error' => $this->upload->display_errors());
                print_r($error);
		$this->load->view('profile_view', $error);
	}
	else
	{
            $this->load->helper('directory');
            
                $data['upload_data'] = $this->upload->data();
                $config_img['image_library'] = 'gd2';
                $config_img['source_image'] = $data['upload_data']['full_path'];
                $config_img['create_thumb'] = TRUE; 
                $config_img['maintain_ratio'] = TRUE;
                $config_img['width'] = 75;
                $config_img['height'] = 50;
                $this->load->library('image_lib', $config_img);
                $this->image_lib->resize();
                $data_picture = array(
                    'picture' => $data['upload_data']['file_name']
                );
                $this->db->update('users', $data_picture, array('id' => $data['id_user']));
                      $this->load->view('profile_view', $data);
           
        }

       
    }
   
}