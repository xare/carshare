<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carshare extends CI_Controller {
    var $data = array();
    
    public function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->model('general_model');
            $this->load->model('users_model');
            $this->load->model('locations_model');
            $this->load->model('trips_model');
            
        $this->data['logged_in'] = $this->session->userdata('logged_in');
        $this->data['username'] = $this->session->userdata('username');
        }
    
    public function index(){
        
    }
    
    public function area_add(){
        $a = new Area();
        $this->data['areas'] = $this->general_model->get_table('areas');
        
        $this->load->view('admin/areas_add', $this->data);
    }
    
    public function city_add(){
                
        $this->data['areas'] = $this->general_model->get_table('areas');
        $this->data['cities'] = $this->general_model->get_table('cities');
        
        $this->load->view('admin/cities_add', $this->data);
    }
    
    public function car_add(){
        $c = new Car();
        $this->data['cars'] = $c->get();
        
        $this->load->view('admin/cars_add', $this->data);
    }
    
     /* FUNCTION CALLED FROM Admin's Add Category View */
     public function add_area(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        $this->form_validation->set_rules('area','Area','trim|required|xss_clean|callback_area_not_exists');
        $id = $this->locations_model->add_area($this->input->post('area'));
        $this->picture_upload($id);
        
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        
        $data['areas'] = $this->general_model->get_table('areas');
        
        $this->load->view('admin/area_add', $data);
    }
    function add_car(){
        $c = new Car();
        $c->make = $this->input->post('make');
        $c->model = $this->input->post('make');
        $c->places = $this->input->post('places');
        $c->user_id = $this->session->userdata('id_user');
        $c->save();
        $this->load->view('admin/cars_add', $this->data);
    }
    
    function edit_car($id){
        $c = new Car();
        $this->data['car'] = $c->get_by_id($id);
        $this->load->view('admin/edit_car',$this->data);
    }
    function edit_area($id){
        
        $data['id'] = $id;
        $data['area_el'] = $this->general_model->get_row_field($id,'areas','area_el');
        $data['area_en'] = $this->general_model->get_row_field($id,'areas','area_en');
        
        $this->load->view('admin/edit_area',$data);
    }
    
    function edit_city($id){
        
        $data['id'] = $id;
        $data['area_el'] = $this->general_model->get_row_field($id,'cities','city_el');
        $data['area_en'] = $this->general_model->get_row_field($id,'cities','city_en');
        
        $this->load->view('admin/edit_area',$data);
    }
    
   
}    
?>
