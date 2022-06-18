<?php 
/**
 * Compute Page Controller
 * @category  Controller
 */
class ComputeController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "compute";
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
		$fields = array("compute.rowid", 
			"compute.display_name", 
			"compute.id", 
			"compartments.name AS compartments_name", 
			"compute.lifecycle_state", 
			"compute.time_created", 
			"compute.time_destroyed", 
			"compute.last_check", 
			"compute.adname");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				compute.rowid LIKE ? OR 
				compute.display_name LIKE ? OR 
				compute.id LIKE ? OR 
				compartments.name LIKE ? OR 
				compute.compid LIKE ? OR 
				compute.lifecycle_state LIKE ? OR 
				compute.time_created LIKE ? OR 
				compute.time_destroyed LIKE ? OR 
				compute.last_check LIKE ? OR 
				compartments.rowid LIKE ? OR 
				compartments.id LIKE ? OR 
				compartments.time_created LIKE ? OR 
				compartments.time_destroyed LIKE ? OR 
				compartments.lifecycle_state LIKE ? OR 
				compartments.last_check LIKE ? OR 
				compute.adname LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "compute/search.php";
		}
		$db->join("compartments", "compute.compid = compartments.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("compute.rowid", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Compute";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("compute/list.php", $data); //render the full page
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
		$fields = array("compute.rowid", 
			"compute.display_name", 
			"compute.id", 
			"compartments.name AS compartments_name", 
			"compute.compid", 
			"compute.lifecycle_state", 
			"compute.time_created", 
			"compute.time_destroyed", 
			"compute.last_check", 
			"compute.adname");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("compute.rowid", $rec_id);; //select record based on primary key
		}
		$db->join("compartments", "compute.compid = compartments.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Compute";
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
		return $this->render_view("compute/view.php", $record);
	}
}
