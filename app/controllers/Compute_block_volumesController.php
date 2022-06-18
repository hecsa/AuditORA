<?php 
/**
 * Compute_block_volumes Page Controller
 * @category  Controller
 */
class Compute_block_volumesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "compute_block_volumes";
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
			"display_name", 
			"block_volume_id", 
			"instance_id", 
			"lifecycle_state", 
			"time_created", 
			"time_destroyed", 
			"last_check", 
			"size_in_gbs");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				compute_block_volumes.rowid LIKE ? OR 
				compute_block_volumes.display_name LIKE ? OR 
				compute_block_volumes.availability_domain LIKE ? OR 
				compute_block_volumes.compartment_id LIKE ? OR 
				compute_block_volumes.block_volume_id LIKE ? OR 
				compute_block_volumes.instance_id LIKE ? OR 
				compute_block_volumes.lifecycle_state LIKE ? OR 
				compute_block_volumes.time_created LIKE ? OR 
				compute_block_volumes.time_destroyed LIKE ? OR 
				compute_block_volumes.last_check LIKE ? OR 
				compute_block_volumes.size_in_gbs LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "compute_block_volumes/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("compute_block_volumes.rowid", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Compute Block Volumes";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("compute_block_volumes/list.php", $data); //render the full page
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
			"availability_domain", 
			"compartment_id", 
			"block_volume_id", 
			"instance_id", 
			"lifecycle_state", 
			"time_created", 
			"time_destroyed", 
			"last_check", 
			"display_name", 
			"size_in_gbs");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("compute_block_volumes.rowid", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Compute Block Volumes";
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
		return $this->render_view("compute_block_volumes/view.php", $record);
	}
}
