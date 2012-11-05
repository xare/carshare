<?php

class Area extends DataMapper {
    var $table = "areas";
    
    var $has_many = array('city');
}
