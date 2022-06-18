<?php 
/**
 * Compute_boot_volume_backups Page Controller
 * @category  Controller
 */
class Compute_boot_volume_backupsController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "compute_boot_volume_backups";
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
		$fields = array("rowid", 
			"boot_volume_id", 
			"id", 
			"display_name", 
			"lifecycle_state", 
			"source_type", 
			"time_request_received", 
			"time_created", 
			"time_destroyed", 
			"last_check");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				compute_boot_volume_backups.rowid LIKE ? OR 
				compute_boot_volume_backups.boot_volume_id LIKE ? OR 
				compute_boot_volume_backups.compartment_id LIKE ? OR 
				compute_boot_volume_backups.id LIKE ? OR 
				compute_boot_volume_backups.display_name LIKE ? OR 
				compute_boot_volume_backups.lifecycle_state LIKE ? OR 
				compute_boot_volume_backups.source_type LIKE ? OR 
				compute_boot_volume_backups.time_request_received LIKE ? OR 
				compute_boot_volume_backups.time_created LIKE ? OR 
				compute_boot_volume_backups.time_destroyed LIKE ? OR 
				compute_boot_volume_backups.unique_size_in_gbs LIKE ? OR 
				compute_boot_volume_backups.last_check LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "compute_boot_volume_backups/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("compute_boot_volume_backups.rowid", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->compute_boot_volume_backups_time_created)){
			$vals = explode("-to-", str_replace(" ", "", $request->compute_boot_volume_backups_time_created));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("compute_boot_volume_backups.time_created BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Compute Boot Volume Backups";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("compute_boot_volume_backups/list.php", $data); //render the full page
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
		$fields = array("rowid", 
			"boot_volume_id", 
			"compartment_id", 
			"display_name", 
			"id", 
			"lifecycle_state", 
			"source_type", 
			"time_request_received", 
			"time_created", 
			"time_destroyed", 
			"unique_size_in_gbs", 
			"last_check");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("compute_boot_volume_backups.rowid", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Compute Boot Volume Backups";
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
		return $this->render_view("compute_boot_volume_backups/view.php", $record);
	}
}
