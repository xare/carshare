<?php
    $this->load->view('head');
    $this->load->view('header');
    $this->load->view('admin/menu');
?>
<div id="admin_content">
    <h2>User ADD</h2>
    <div class="add_box">
<?php 
    $username = array(
        'name' => 'username',
        'id' => 'username'
    );
    $firstname = array(
        'name' => 'firstname',
        'id' => 'firstname'
    );
    $surname = array(
        'name' => 'surname',
        'id' => 'surname'
    );
    $email = array(
        'name' => 'email',
        'id' => 'email'
    );
    $password = array(
        'id' => 'password',
        'name' => 'password',
        'value' => 'Password'
    );
    $password_conf = array(
        'id' => 'password_conf',
        'name' => 'password_conf',
        'value' => 'Password'
    );
    $upload_data = array(
        'name'=> 'usersfile'
    );
    $submit = array(
        'name' => 'submit',
        'value' => 'Add User'
    );
    echo form_open_multipart('admin/users/add_user');
    echo validation_errors();
    echo form_label('Username', 'username');
    echo "<br />";
    echo form_input($username);
    echo "<br />";
    echo form_label('First Name', 'firstname');
    echo "<br />";
    echo form_input($firstname);
    echo "<br />";
    echo form_label('Surname', 'surname');
    echo "<br />";
    echo form_input($surname);
    echo "<br />";
    echo form_label('Email', 'email');
    echo "<br />";
    echo form_input($email);
    echo "<br />";
    echo form_label('Password', 'password');
    echo "<br />";
    echo form_password($password);
    echo "<br />";
    echo form_label('Password Confirm', 'password');
    echo "<br />";
    echo form_password($password_conf);
    echo "<br />";
    //echo form_upload($upload_data);
    echo "<br />";
    echo form_submit($submit);
    echo form_close();
    ?>
    </div>
    <div id="product_list">
        <?php
            $this->load->view('admin/user_list');
        ?>
    
        </div>
</div>
<?php
    $this->load->view('footer');
?>