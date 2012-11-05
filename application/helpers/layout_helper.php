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
                    
