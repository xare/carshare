<?php echo form_open('users/login'); ?>

<?php echo validation_errors(); ?>
<?php 
    $username = array(
        'id' => 'username',
        'name' => 'username',
        'value' => 'username'
    );
    $password = array(
        'id' => 'password',
        'name' => 'password',
        'value' => 'password'
        
    );
    echo form_input($username);
    echo form_password($password);
?>

<?php echo form_submit(array('name'=> 'submit', 'value'=>'login')); ?>
<?php echo form_close(); ?>

<!--a id="register_link" href="#">Register</a-->

