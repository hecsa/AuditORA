<?php 
/**
 * Compute_boot_volumes Page Controller
 * @category  Controller
 */
class Compute_boot_volumesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "compute_boot_volumes";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("compute_boot_volumes.rowid", 
			"compute.display_name AS compute_display_name", 
			"compute_boot_volumes.boot_volume_id", 
			"compute_boot_volumes.lifecycle_state", 
			"compute_boot_volumes.time_created", 
			"compute_boot_volumes.time_destroyed", 
			"compute_boot_volumes.last_check");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				compute_boot_volumes.rowid LIKE ? OR 
				compute.display_name LIKE ? OR 
				compute_boot_volumes.availability_domain LIKE ? OR 
				compute_boot_volumes.compartment_id LIKE ? OR 
				compute_boot_volumes.boot_volume_id LIKE ? OR 
				compute_boot_volumes.instance_id LIKE ? OR 
				compute_boot_volumes.lifecycle_state LIKE ? OR 
				compute_boot_volumes.time_created LIKE ? OR 
				compute_boot_volumes.time_destroyed LIKE ? OR 
				compute_boot_volumes.last_check LIKE ? OR 
				compute.rowid LIKE ? OR 
				compute.adid LIKE ? OR 
				compute.compid LIKE ? OR 
				compute.id LIKE ? OR 
				compute.lifecycle_state LIKE ? OR 
				compute.time_created LIKE ? OR 
				compute.time_destroyed LIKE ? OR 
				compute.last_check LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "compute_boot_volumes/search.php";
		}
		$db->join("compute", "compute_boot_volumes.instance_id = compute.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("compute_boot_volumes.rowid", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Compute Boot Volumes";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("compute_boot_volumes/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("compute_boot_volumes.rowid", 
			"compute_boot_volumes.availability_domain", 
			"compute_boot_volumes.compartment_id", 
			"compute_boot_volumes.boot_volume_id", 
			"compute_boot_volumes.instance_id", 
			"compute_boot_volumes.lifecycle_state", 
			"compute_boot_volumes.time_created", 
			"compute_boot_volumes.time_destroyed", 
			"compute_boot_volumes.last_check", 
			"compute.compid AS compute_compid", 
			"compute.display_name AS compute_display_name", 
			"compute.id AS compute_id", 
			"compute.lifecycle_state AS compute_lifecycle_state", 
			"compute.time_created AS compute_time_created", 
			"compute.time_destroyed AS compute_time_destroyed", 
			"compute.last_check AS compute_last_check", 
			"compute.adname AS compute_adname");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("compute_boot_volumes.rowid", $rec_id);; //select record based on primary key
		}
		$db->join("compute", "compute_boot_volumes.instance_id = compute.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Compute Boot Volumes";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("compute_boot_volumes/view.php", $record);
	}
}
