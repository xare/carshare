<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchtrip extends CI_Controller {

    
        function __construct(){
            parent::__construct();
            $this->load->model('trips_model');
            $this->load->model('users_model'); 
        }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //We check if the user is logged in.
                $data['logged_in'] = $this->session->userdata('logged_in');
                $data['username'] = $this->session->userdata('username');
                $data['id_user'] = $this->session->userdata('id_user');
                
                $trip['id_from'] = $this->input->post('id_from');
                $trip['id_to'] = $this->input->post('id_to');
                $trip['when'] = $this->input->post('when');
                
                $data['trips'] = $this->trips_model->search_trips($trip);
		$this->load->view('show_trips',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */