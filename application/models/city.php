<?php

class City extends DataMapper {
    var $table = "cities";
       
    var $has_one = array(
        'origin_city' => array(
            'class' => 'trip',
            'other_field' => 'origin',
        ),
        'destination_city' => array(
            'class' => 'trip',
            'other_field'=> 'destination',
        )        
        );
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    /*function __construct($id = NULL){
        parent::construct($id);
    }*/
}