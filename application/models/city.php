<?php

class City extends DataMapper {
    var $table = "cities";
    
    var $has_many = array(
        'trip'
        );
    
    /*function __construct($id = NULL){
        parent::construct($id);
    }*/
}