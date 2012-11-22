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
        
        /** GET A LIST OF TRIPS
         * We get a list of trips which date is predicted to happen from the moment the user gets into the page.
         *      when > date()
         * We limit the uses to 5 and we provide the $page number in case the user browses to see trips that are before or after the 5 shown on screen.
         * Then we bring all the results to the $data array and we simply return the value.
         * 
         *  **/
        function get_trips($page, $limit){
            // MYSQL QUERY 
            // SELECT * FROM trips WHERE when > .'date('Y-m-d h:m:s') OFFSET $page*5 LIMIT 5
            $this->db->select('*');
            $this->db->from('trips');
            $this->db->where('when >', date('Y-m-d h:m:s'));
            $this->db->limit(5, $page);
            $query = $this->db->get();
            
            //LOOP through the results to pass the data to the $data array.
            $i=0;
            if($query->num_rows >0 ) {
                foreach($query->result() as $row){
                    $data[$i]['id'] = $row->id;
                    $data[$i]['origin'] = $this->get_cityname($row->origin_id);
                    $data[$i]['destination'] = $this->get_cityname($row->destination_id);
                    $data[$i]['when'] = $row->when;
                    $data[$i]['id_driver'] = $row->id_driver;
                    $data[$i]['places'] = $row->places;
                    $data[$i]['luggage'] = $row->luggage;
                    $data[$i]['username'] = $this->users_model->get_username($row->id_driver);
                    $data[$i]['picture'] = $this->users_model->get_user_picture($row->id_driver);
                    $i++;
                   
                }
                //print_r($from);
                //print_r($data);
                //exit;
                return $data;
            }
        }
        
        /*GET THE NUMBER OF TRIPS IN LIST ??? */
        function get_number_trips($page, $limit){
            $this->db->select('*');
            $this->db->from('trips');
            $this->db->limit(5, $page);
            $query = $this->db->get();
            return $query->num_rows();    
        }
        
        /* SEARCH TRIPS
         * Give a result of searched trips. */
        function search_trips($trip){
            /*MYSQL QUERY
             * SELECT * FROM trips WHERE id_from = $trip['id_from'] OR WHERE id_to = $trip['id_to'] OR WHERE when=$trip['when']
             */
            $this->db->select('*');
            $this->db->from('trips');
            $this->db->where('id_from',$trip['id_from']);
            $this->db->where('id_to',$trip['id_to']);
            $this->db->where('when <','DATE('.$trip['when'].')');
            $query = $this->db->get();
            //echo $this->db->last_query();
            
            //LOOP through the results to pass the data to the $data array.
            $i=0;
            if($query->num_rows()>0){
                foreach($query->result() as $row){
                    $from=$this->general_model->get_row_field($row->id_from,'cities','city_en');
                    $to=$this->general_model->get_row_field($row->id_to,'cities','city_en');
                    $data[$i]['from'] = $from;
                    $data[$i]['to'] = $to;
                    $data[$i]['id'] = $row->id;
                    $data[$i]['when'] = $row->when;
                    $i++;
                }
                return $data;
               
            } else{
                return false;
            }
        }
        
        /*OBTAIN THE NAME OF A CITY GIVEN THE id number for the cities table. Now works for Greeklish. 
         * TODO: Add a $lang variable and transform the name of the field to 'city_'.$lang
         */
        function get_cityname($id){ 
            return $this->general_model->get_row_field($id,'cities','city_en');
        }
        
        /*Create a Trip and add it to the database*/
        function add_trip(){
            $CI =& get_instance();
            $data['when'] = $CI->input->post('when');
            $data['id_driver'] = $CI->session->userdata('id_user');
            $data['places'] = $CI->input->post('places');
            $data['luggage'] = $CI->input->post('luggage');
            $data['origin_id'] = $CI->input->post('origin_id');
            $data['destination_id'] = $CI->input->post('destination_id');
            
            $result = 0;
            if(!empty($data)){
                $result = $CI->db->insert('trips',$data);
            }
            return $result;
        }
        
        function delete_trip($id){   
            $this->general_model->delete_row($id,'trips');
        }
        
        function select_trip($id){
            return $this->general_model->get_row($id,'trips');
        }
        function select_trips(){
            return $this->general_model->get_table('trips');
        }
        function update_trip($id,$data){
            $this->db->where('id', $id);
            $this->db->update('trips', $data);    
        }
        
        /***ADDS A TRAVELLER TO A TRIP ***/
        function add_request($id_trip,$id_user) {
            $data['id_trip'] = $id_trip;
            $data['id_user'] = $id_user;
            $result = 0;
            if(!empty($data)){
                $result = $this->db->insert('requests',$data);
            }
            return $result;
        }
        
        function accept_request($id_request){
            
        }
        
        function deny_request($id_request){
            
        }
       
    }
