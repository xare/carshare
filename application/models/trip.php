<?php

class Trip extends DataMapper {
    var $table="trips";
    var $has_one = array(
        'origin' => array(
            'class' => 'city',
            'other_field'=> 'origin_city',
        ),
        'destination'=>array(
            'class' => 'city',
            'other_field'=>'destination_city',
        )        
    );
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    //var $has_many = array('user','request');
    
    /*function __construct($id = NULL){
        parent::construct($id);
    }*/
}
