<?php

class User extends DataMapper {
    var $table="users";

    var $has_many = array('trip','request');
    
    
}
