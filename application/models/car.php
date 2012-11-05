<?php

class Car extends DataMapper {
    var $table = "cars";
    
    var $has_one = array(
        'user'
        );
    
    /*function __construct($id = NULL){
        parent::construct($id);
    }*/
}
