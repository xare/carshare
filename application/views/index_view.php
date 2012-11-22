<?php
/*The head view contains all the head tag. call to meta tags, title, css, js */
    $this->load->view('includes/head');
/*Top part of the page common to all pages*/
    $this->load->view('includes/header');  
?>
       
<?php
/*We declare all arrays that contain the attributes needed to create the form Code Igniter Style - 
 * using the form helper loaded in the home controller */
/* Form id and autocomplete=property to off in order to not to conflict with our own autocomplete.*/
        $formattributes = array(
            'id' => 'myform',
            'autocomplete' => 'off'
        );
        /*Actually the data we are looking for is the id of the locations that will both be hidden fields.*/
        $hidden = array(
            'id_from' => '', 
            'id_to' => '',
            'fromLatLon' =>'',
            'toLatLon' => ''
            );
        
        /*The 'from' input's attributes. The class is necessary for the gmapi location suggest plugin */
        $from = array(
            'name' => 'from',
            'id' => 'from',
            'value' => 'Start here',
            'class' => 'location-suggest'
        );
        /*The 'to' input's attributes. The class is necessary for the gmapi location suggest plugin */
        $to = array(
            'name' => 'to',
            'id' => 'to',
            'value' => 'End here',
            'class' => 'location-suggest'
        );
        
        /*The 'when' input attribute which will contain todays date in it*/
        $dateformat = "%d/%m/%Y";
        $time = time();
        $when = array(
            'name' => 'when',
            'id' => 'when',
            'value' => mdate($dateformat, $time)
        );
        
        /* The 'submit' button */
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
            <!-- The suggest invisible div where locations are loaded via ajax. NOTE now this div is not in use as we are using gmapi suggest javascript alternative we keep this in for backward compatibility -->
                <div class="suggest"></div>
            </div>
            <div class="input_wrapper" /><?php echo form_input($to); ?>
            <!-- The suggest invisible div where locations are loaded via ajax. NOTE now this div is not in use as we are using gmapi suggest javascript alternative we keep this in for backward compatibility -->
                <div class="suggest"></div>
            </div>
            <?php echo form_input($when); ?>
            <?php echo form_submit($submit); ?>
        
            <a href="trips/create">Create Trip</a>
            <?php echo form_close(); ?>
        </div>
    <!-- Google Map -->
    <!--div id="map_canvas" style="width:100%; height:200px">
        
    </div-->
    <!-- Trip List -->
    <ul id="trips_list">
        <?php  if(count($trips) == 0){ ?>
        No trips available at the time
            
        <?php }   else {   
            foreach($trips as $trip):
        ?>
            <li>
                <div class="trip-driver">
                    <img src="uploads/<?php echo $trip['username']; ?>_thumb.jpg" />
                    <span><?php echo $trip['username']; ?></span><br />
                    
                </div>
                <div class="trip-info">
                <span class="trip_title"><?php echo $trip['origin']; ?> - <?php echo $trip['destination']; ?> - <?php echo $trip['when']; ?></span><br />
                <strong>Number of Places:</strong> <?php echo $trip['places']; ?><br />
                <strong>Luggage:</strong> <?php echo $trip['luggage']; ?><br />
                </div>
                
                <div class="trip-actions"><?php if($logged_in == TRUE): ?><a href="trips/see_trip/<?php echo $trip['id']; ?>">See Trip</a><?php endif; ?></div>
            </li>
        <?php endforeach;
        }
        ?>
<!-- FOOTER BEGINS HERE -->
<?php
    $this->load->view('includes/footer');  
?>