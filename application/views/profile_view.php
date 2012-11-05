<?php
    $this->load->view('head');
    $this->load->view('header');  
?>
       
<?php
    $formattributes = array(
        'id' => 'myform',
        'autocomplete' => 'off'
    );
        $hidden = array(
            'id_from' => '', 
            'id_to' => '');
        $from = array(
            'name' => 'from',
            'id' => 'from',
            'value' => 'Start here'
        );
        $to = array(
            'name' => 'to',
            'id' => 'to',
            'value' => 'End here'
        );
        $datestring = "%d/%m/%Y";
        $time = time();
        $when = array(
            'name' => 'when',
            'id' => 'when',
            'value' => mdate($datestring, $time)
        );
        $submit = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Search'
        );
        ?> 
        <div id="indexsearch">
            SEARCH TRIP
            <?php echo form_open('searchtrip',$formattributes,$hidden); ?> 
            <div class="input_wrapper" /><?php echo form_input($from); ?>
                <div class="suggest"></div>
            </div>
            <div class="input_wrapper" /><?php echo form_input($to); ?>
                <div class="suggest"></div>
            </div>
            <?php echo form_input($when); ?>
            <?php echo form_submit($submit); ?>
        
            <a href="createtrip">Create Trip</a>
            <?php echo form_close(); ?>
        </div>
        
    <div id="profile">
        PROFILE PAGE
        <br />
        
        <ul>
            <li><a href="users/messages">Messages</a></li>
            <li><a href="trips/mytrips">My Trips</a></li>
            <li><a href="users/contacts">My Contacts</a></li>
            <li><a href="<?php $this->config->item('base_url');?>/carshare/users/picture">Upload my picture</a></li>
        </ul>
    </div>
<?php
    $this->load->view('footer');  
?>