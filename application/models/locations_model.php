<?php 

    if(!defined('BASEPATH')) exit('No direct Script Allowed');
    
    class Locations_model extends CI_Model 
    {
        function __construct(){
            $this->load->model('general_model');
        }
        
        function get_locations(){
            return $this->general_model->get_table('cities');
        }
        function get_location($id){
            return $this->general_model->get_row_field($id,'cities','city_en');
        }
        
        function get_cities(){
            $cities = $this->general_model->get_table('cities');
            //$i=0;
            //foreach($cities as $city){
              //  $citydata[$i] = $this->get_area_x_city($city['id']);
                //echo $citydata[$i]['area_en'];
                //$cities[$i]['area_el'] = $citydata[$i]['area_el'];
                //$i++;
            //}
            
            //echo "<pre>";
            //print_r ($citydata);
            //echo "</pre>";
        }
        
        function get_area_x_city($id_city){
            //obtain id_area for a given id_city
            $this->db->select('id_district');
            $this->db->from('cities');
            $this->db->where('id',$id_city);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0){
                $row = $query->row();
                $id_area= $row->id_district;
            } 
            
            //obtain area names for a given id_are
            return $this->general_model->get_row($id_area,'areas');
        }
        
        function get_locations_suggest($searchterm=''){
                $this->db->select('id,city_en');
                $query = $this->db->from('cities');
                $this->db->like('city_en',$searchterm,'after');
                $query = $this->db->get();
                //echo $this->db->last_query();
                $result = $query->result();
                return $result;
        }
        
        function add_area($name){
        $data = array(
            'area_en' => $name
        );
        $this->db->insert('areas',$data);
    }
        
    }