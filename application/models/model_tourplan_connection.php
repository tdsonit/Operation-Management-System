<?php
class Model_tourplan_connection extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function GetBookingsByDateOnwards($date)
    {
        $date_to = strtotime("+30 days", strtotime($date));
        
		$querry_string = "spOPS_GetBookings 'VN','$date','".date("Ymd",$date_to)."'";
        //$querry_string = "select * from View_Operations_Vietnam where FirstDate_Vietnam >= '20151210' order by FirstDate_Vietnam asc";
        $query = $this->db->query($querry_string);
        return ($query->result_array());
    }
    
    function GetBookingsInRange($country, $date_from, $date_to, $office = '', $reference = '')
    {
		$querry_string = "spOPS_GetBookings '$country',".($date_from=='' || $date_from==null? "null":"'$date_from'").",".($date_to=='' || $date_to==null? "null":"'$date_to'").",'$office','$reference'";
        $query = $this->db->query($querry_string);
        return $query->result_array();
    }
}
?>