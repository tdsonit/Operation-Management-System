<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tourplan extends CI_Controller {

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
	}
    
    public function getBooking($date){
        $this->load->model('Model_tourplan_connection');
        $records = $this->Model_tourplan_connection->GetBookingsByDateOnwards($date);
        $records = array_slice($records, 0, 50);
        $result = array();
        $result["total"] = count($records);
        $result["rows"] = $records;
        echo json_encode($result);
    }
    
    public function getBookingInPeriod(){
        $country = $this->input->post('country');
        $date_from = $this->input->post('datefrom');
        $date_to = $this->input->post('dateto');
        $office = $this->input->post('office');
        $reference = $this->input->post('code');
        
        $this->load->model('Model_tourplan_connection');
        if($office == 'ALL')
            $records = $this->Model_tourplan_connection->GetBookingsInRange($country,$date_from,$date_to,'',$reference);
        else 
            $records = $this->Model_tourplan_connection->GetBookingsInRange($country,$date_from,$date_to,$office,$reference);
        $records = array_slice($records, 0, 50);
        $result = array();
        $result["total"] = count($records);
        $result["rows"] = $records;
        echo json_encode($result);
    }
}
