<?php echo form_open('users/register'); ?>
<?php echo validation_errors(); ?>
    <label for="firstname">First Name</label>
    <?php 
    $firstname = array(
        'name' => 'firstname',
        'id' => 'firstname',
        'value' => set_value('firstname')
    );
    $surname = array(
        'name' => 'surname',
        'id' => 'surname',
        'value' => set_value('surname')
    );
    $username = array(
        'name' => 'username',
        'id' => 'username',
        'value' => set_value('username')
    );
    $email = array(
        'name' => 'email',
        'id' => 'email',
        'value' => set_value('email')
    );
    $password = array(
        'name' => 'password',
        'id' => 'password',
        'value' => ''
    );
    $password_conf = array(
        'name' => 'password_conf',
        'id' => 'password_conf',
        'value' => ''
    );
    ?>
    
    <?php echo form_input($firstname); ?>
    <label for="surname">Surname</label>
    <?php echo form_input($surname); ?>
    <label for="email">Email</label>
    <?php echo form_input($email); ?>
    <label for="username">Username</label>
    <?php echo form_input($username); ?>
    <label for="password">Password</label>
    <?php echo form_password($password); ?>
    <label for="password_conf">Password Repeat</label>
    <?php echo form_password($password_conf); ?>
    <?php echo form_submit(array('name'=>'register'),'register'); ?>
<?php echo form_close(); ?>

    <a href="#" id="login_link">Login</a>
