<?php

class Trip extends DataMapper {
    var $table="trips";
    
    var $has_many = array('city','user','request');
    
    /*function __construct($id = NULL){
        parent::construct($id);
    }*/
}
