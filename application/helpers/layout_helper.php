<?php

    function login_box(){ 
        $CI =& get_instance();
        /* We check whether the user is logged in. */
        
        if($CI->session->userdata('logged_in') != TRUE) {
           return $CI->load->view('login_view',true);
        } else {
            return "Hello ".$CI->session->userdata('username') ."<br />"." You are logged in <br /><a href=\"index.php/users/logout\">Logout</a>"; 
        }
    } 
    
    function panel_title(){
        $CI =& get_instance();
    
        if($CI->session->userdata('logged_in') != TRUE){
            $html = "<ul class=\"login\">
			<li class=\"left\">&nbsp;</li>
			<li>You are not logged in</li>
			<li class=\"sep\">|</li>
			<li id=\"toggle\">
				<a id=\"open\" class=\"open\" href=\"#\">Log In | Register</a>
				<a id=\"close\" style=\"display: none;\" class=\"close\" href=\"#\">Close Panel</a>			
			</li>
			<li class=\"right\">&nbsp;</li>
		</ul>";
        } else {
            $html = "<ul class=\"login\">
			<li class=\"left\">&nbsp;</li>
			<li>Hello ".$CI->session->userdata('username')."</li>
			<li class=\"sep\">|</li>
			<li id=\"toggle\">
                                <a id=\"open\" class=\"open\" href=\"#\">Logout | View Cart</a>
				<a id=\"close\" style=\"display: none;\" class=\"close\" href=\"#\">Close Panel</a></li>
			<li class=\"right\">&nbsp;</li>
		</ul>";
       
        } 
        return $html;
    }
    
    function show_cart(){
        $CI =& get_instance();
        if(!isset($logged_in) || $logged_in != TRUE) {
                        
        } else {
            $CI->load->view('minicart_view');
        }
    }