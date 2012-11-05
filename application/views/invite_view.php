<!-- This is an ajax View to be loaded in the right side column user's block -->

<?php echo form_open('users/invite'); ?>
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
    ?>
    
    <?php echo form_input($firstname); ?>
    <label for="surname">Surname</label>
    <?php echo form_input($surname); ?>
    <label for="email">Email</label>
    <?php echo form_input($email); ?>
    <?php echo form_submit(array('name'=>'invite'),'invite'); ?>
<?php echo form_close(); ?>

    <!--a href="#" id="login_link">Login</a-->
