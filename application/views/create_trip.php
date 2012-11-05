<?php
/* The head view contains all the head tag. call to meta tags, title, css, js */
    $this->load->view('head');
/* Top part of the page common to all pages */
    $this->load->view('header');  
?>

<?php 
    /* All validation errors shown here when they happen */
    echo validation_errors(); 
?>
<?php 
    /*We declare all arrays that contain the attributes needed to create the form Code Igniter Style - 
    * using the form helper loaded in the home controller */
    /* Form id and autocomplete=property to off in order to not to conflict with our own autocomplete.*/
         $formattributes = array(
            'id' => 'createtrip',
            'autocomplete' => 'off'
            );
         /*Actually the data we are looking for is the id of the locations that will both be hidden fields.*/
    
         if($this->users_model->check_logged_in()){
            //add the trip
             if(!isset($id_user)) $id_user = '';
                $hidden = array(
                    'origin_id' => '', 
                    'destination_id' => '',
                    'fromLatLon' =>'',
                    'toLatLon' => '',
                    'id_user'=>$id_user);
            /*The 'from' input's attributes. The class is necessary for the gmapi location suggest plugin */
                $origin = array(
                    'name' => 'origin',
                    'id' => 'origin',
                    'placeholder' => 'Start here',
                    'class' => 'location-suggest'
                );
            /*The 'to' input's attributes. The class is necessary for the gmapi location suggest plugin */
                $destination = array(
                    'name' => 'destination',
                    'id' => 'destination',
                    'placeholder' => 'End here',
                    'class' => 'location-suggest'
                );
        
                $driver = array(
                    'name'        => 'position',
                    'id'          => 'position',
                    'placeholder'       => 'driver',
                    'checked'     => TRUE,
                    'style'       => 'margin:10px'
                );
                $passenger = array(
                    'name'        => 'position',
                    'id'          => 'position',
                    'placeholder'       => 'passenger',
                    'checked'     => FALSE,
                    'style'       => 'margin:10px',
                );
             /*The 'when' input attribute which will contain todays date in it*/
                $datestring = "%d/%m/%Y";
                $time = time();
                $when = array(
                    'name' => 'when',
                    'id' => 'when',
                    'value' => mdate($datestring, $time)
                );
        
        
                $places = array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                );
        
                $luggage = array(
                    'small' => 'Small Bag',
                    'middle' => 'Middle Bag',
                    'big' => 'Big Bag'
                );
                /* The 'submit' button */
                $submit = array(
                    'name' => 'submit',
                    'id' => 'submit',
                    'value' => 'Create Trip'
                );
?>
    <div id="indexsearch">
        CREATE TRIP
        <?php echo form_open('trips/add',$formattributes,$hidden); ?>
            <div class="input_wrapper" /><?php echo form_input($origin); ?>
            <!-- The suggest invisible div where locations are loaded via ajax. NOTE now this div is not in use as we are using gmapi suggest javascript alternative we keep this in for backward compatibility -->
                <div class="suggest" id="suggest_origin"></div>
            </div>
            <div class="input_wrapper" /><?php echo form_input($destination); ?>
            <!-- The suggest invisible div where locations are loaded via ajax. NOTE now this div is not in use as we are using gmapi suggest javascript alternative we keep this in for backward compatibility -->
                <div class="suggest" id="suggest_destination"></div>
            </div>
            <?php echo form_input($when); ?>
            <br />
            <!--Driver: <?php //echo form_radio($driver); ?>
            <br />
            Passenger: <?php //echo form_radio($passenger); ?>
            <br />-->
            Places: <?php echo form_dropdown('places',$places,'1'); ?>
            <br />  
            Accepted Luggage: <?php echo form_dropdown('luggage',$luggage,'small'); ?>
            <?php echo form_submit($submit); ?>
        <?php echo form_close(); ?>
    </div>
<?php 
if(isset($result))
echo $result;
        } else{
            // ask the user to log in but pass the data so he can recover them later.
            echo "You must log in";
        }
        ?>
<!-- FOOTER BEGINS HERE -->
<?php
    $this->load->view('footer');  
?>