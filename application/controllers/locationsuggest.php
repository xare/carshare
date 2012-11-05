<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locationsuggest extends CI_Controller {

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
                $this->load->model('locations_model');
                if($this->input->post('origin') !=''){
                    $searchterm=$this->input->post('origin');
                }elseif($this->input->post('destination') !=''){
                    $searchterm=$this->input->post('destination');
                } else {
                    $searchterm = '';
                }
                $data['locations'] = $this->locations_model->get_locations_suggest($searchterm);
		$this->load->view('locationssugest_view',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */