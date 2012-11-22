<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trips extends CI_Controller {
         var $data = array();

        function __construct(){
            parent::__construct();
            $this->load->model('trips_model');
            $this->load->model('users_model');
            
            $this->data['logged_in'] = $this->session->userdata('logged_in');
            $this->data['username'] = $this->session->userdata('username');
            $this->data['id_user'] = $this->session->userdata('id_user');
            $this->data['language'] = $this->session->userdata('language');
        }
	public function index(){
	}
        
        public function create(){
            $this->load->view('create_trip', $this->data);
        }
        
        public function add(){

            if($this->data['logged_in'] == FALSE){
                $this->data['result'] = "You are not logged In";
            } else {
               
                
                $this->trips_model->add_trip();
                $this->data['result']="Your trip has been succesfully saved";
            }
            $this->load->view('create_trip',$this->data);
        }

        function add_traveller($id_trip){
            $t = new Trip();
            $t = $t->where('id',$id_trip);
            $u = new User();
            $u = $t->where('id',$this->data['id_user']);
            $t = save($u);
            
            //$this->trips_model->add_traveller($id_trip,$id_user);
            $this->load->view('index_view',$this->data);
        }
        function see_trip($id_trip,$reserved=0){
            //$t = new Trip();
            //$this->data['trip'] = $t->include_related('city', array('name'))->include_related('user',array('name'))->get_by('id',$id_trip);
            //$c = new Cities();
            //$this->data['trip']['city_from'] = $t->city_from->name;
            //$this->data['trip']['city_to'] = $c->select('name')->get_by('id',$t->id_to);
            //$u = new User;
            //$this->data['trip']['driver'] = $u->select('name')->get_by('id_user',$this->data['id_user']);
            
            $this->data['trip'] = $this->general_model->get_row($id_trip,'trips');
            $this->data['trip']['city_from'] = $this->trips_model->get_cityname($this->data['trip']['origin_id']);
            $this->data['trip']['city_to'] = $this->trips_model->get_cityname($this->data['trip']['destination_id']);
            $this->data['trip']['driver'] = $this->users_model->get_username($this->data['trip']['id_driver']);
            $this->data['trip']['reserved'] = $reserved;
            $this->data['trip']['picture'] = $this->users_model->get_user_picture($this->data['trip']['id_driver']);
            $this->load->view('trip_view',$this->data);
        }
        
        function make_request($id_trip){
            $id_user = $this->session->userdata('id_user');
            $logged_in = $this->session->userdata('logged_in');
            
            $this->trips_model->add_request($id_trip,$id_user);
            $reserved=1;
            $this->see_trip($id_trip,$reserved);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */