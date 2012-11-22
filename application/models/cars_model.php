<?php 
/*** TRIPS MODEL ****/
    if(!defined('BASEPATH')) exit('No direct Script Allowed');
    
    class Trips_model extends CI_Model {
        /*LOADING OF OTHER MODULES.
         We load the "general", the "users" and the "locations" models to make them accessible to the trips model
         */
        function __construct(){
            $this->load->model('general_model');
            $this->load->model('users_model');
            $this->load->model('locations_model');
        }
    
        function get_car($user_id){
            $this->db->select('*');
            $this->db->from('cars');
            $this->db->join('join_cars_users', 'join_cars_users.car_id = cars.id');
            $this->db->join('users', 'join_cars_users.car_id =users.id');
            $this->db->where('users.id = '.$user_id);
            $query = $this->db->get();
        }
    }
