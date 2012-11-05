<?php
/*The head view contains all the head tag. call to meta tags, title, css, js */
    $this->load->view('head');
/*Top part of the page common to all pages*/
    $this->load->view('header');  
?>
<?php
    $formattributes = array(
            'id' => 'picture_upload',
            'autocomplete' => 'off'
        );
    $hidden = array(
            'id_user' => $id_user
            );
    $upload_data = array (
        'name'=> 'userfile'
    );
    $submit = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Submit'
        );
?>
<?php echo form_open_multipart('users/picture_upload',$formattributes,$hidden); ?>
<?php echo form_upload($upload_data); ?>
<?php echo form_submit($submit); ?>
<?php echo form_close(); ?>


<!-- FOOTER BEGINS HERE -->
<?php
    $this->load->view('footer');  
?>
