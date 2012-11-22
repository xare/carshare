<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
        
    var $data = array();
        
    function __construct(){
            parent::__construct();
            $this->load->model('general_model');
            $this->load->model('trips_model');
            $this->load->model('users_model'); 
            
            //We check if the user is logged in.
            $this->data['logged_in'] = $this->session->userdata('logged_in');
            $this->data['username'] = $this->session->userdata('username');
            $this->data['id_user'] = $this->session->userdata('id_user');
            
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -  
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($page = "0")
	{       
                //We load the pagination library in order to set a max number of trips displayed and then to offer pagination for the rest of trips.
                $this->load->library('pagination');
               
                //We create a number of config variables.
                // We call for the base url
                $config['base_url'] = "http://localhost/carshare/home/index";
                //We make a delimitation of the number of trips we will show in every page.
                $config['per_page'] = '5';
                // We look for the total number of trips
                
                $t = new Trip();
                //$config['total_rows'] = $this->trips_model->get_number_trips($page,$config['per_page']);
                $config['total_rows'] = $t->count();
                //the uri segment where the trip variable will be located
                $config['uri_segment'] = '3';
                //With this data we can initialize the pagination library.
                $this->pagination->initialize($config);
                
                //We obtain the trips from the database.
                //$this->data['trips'] = $t->include_related('city')->get($config['per_page'],$page);
                                
                $this->data['trips'] = $this->trips_model->get_trips($page,$config['per_page']);
                //$this->trips_model->get_trips($page,$config['per_page']);
                
                //WE call the index view to show the results
		$this->load->view('index_view',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */