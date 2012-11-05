<?php

class Auth extends DataMapper {
    var $table = 'auth';
    var $has_one = array('user');
    var $validation = array(
            'password' => array(
                'label' => 'Password',
                'rules' => array('required', 'min_length' => 4, 'encrypt')
            ),
            'password_conf' => array(
                'label' => 'Confirm Password',
                'rules' => array('required', 'encrypt', 'matches' => 'password')
            )
     );
    
    /*Function to check the registration code exists in the database*/
    function confirm_registration($registration_code) {
        /* Check the users table for the activation code */
        $a = new Auth();
        $a->where('activation_code',$registration_code)->get();
        $a->activated = 1;
        $success = $a->save();
        if($success){
            return $a->user_id;
        } else {
            return false;
        }
    }
    
    function random_string_length($length){
        $len = $length;
        $base = "ABCDEFGHIJKLMNRSTUVWXYabcdefghijklmnopqrstuvwxyz123456789";
        $max = strlen($base) - 1;
        $activatecode = '';
        mt_srand((double)microtime()*1000000);
        while(strlen($activatecode) < $len + 1)
            $activatecode .= $base{mt_rand(0,$max)};
        return $activatecode;
    }
    
    function update_password($email){
        $newpassword = $this->random_string_length(8);
        $password = $this->_encrypt($newpassword);
        
        $u = new User();
        $u->where('email', $email)->get();
        
        $a = new Auth();
        $a->where('password',$password)->get();
        $a->save($u);
        
        $array = array(
            'email' => $u->email,
            'password' => $newpassword
        );
        print_r($array);
        return $array;
    }
    
    function _encrypt($field){
        // Don't encrypt an empty string
        if (!empty($this->{$field}))
        {
            // Generate a random salt if empty
            if (empty($this->salt))
            {
                $this->salt = md5(uniqid(rand(), true));
            }

            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }
    
    
    
}