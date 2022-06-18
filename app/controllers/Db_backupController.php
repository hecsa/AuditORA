<?php 
/**
 * Db_backup Page Controller
 * @category  Controller
 */
class Db_backupController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "db_backup";
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
		$fields = array("db_backup.rowid", 
			"db.db_name AS db_db_name", 
			"db.pdb_name AS db_pdb_name", 
			"db_backup.id", 
			"db_backup.display_name", 
			"db_backup.lifecycle_state", 
			"db_backup.time_started", 
			"db_backup.time_ended", 
			"db_backup.type", 
			"db_backup.last_check");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				db_backup.rowid LIKE ? OR 
				db_backup.availability_domain LIKE ? OR 
				db_backup.compartment_id LIKE ? OR 
				db_backup.database_id LIKE ? OR 
				db.db_name LIKE ? OR 
				db.pdb_name LIKE ? OR 
				db_backup.id LIKE ? OR 
				db_backup.display_name LIKE ? OR 
				db_backup.lifecycle_state LIKE ? OR 
				db_backup.time_started LIKE ? OR 
				db_backup.time_ended LIKE ? OR 
				db_backup.type LIKE ? OR 
				db_backup.time_destroyed LIKE ? OR 
				db_backup.last_check LIKE ? OR 
				db.rowid LIKE ? OR 
				db.compartment_id LIKE ? OR 
				db.db_home_id LIKE ? OR 
				db.db_unique_name LIKE ? OR 
				db.id LIKE ? OR 
				db.time_created LIKE ? OR 
				db.time_destroyed LIKE ? OR 
				db.last_check LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "db_backup/search.php";
		}
		$db->join("db", "db_backup.database_id = db.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("db_backup.rowid", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->db_backup_time_started)){
			$vals = explode("-to-", str_replace(" ", "", $request->db_backup_time_started));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("db_backup.time_started BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Db Backup";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("db_backup/list.php", $data); //render the full page
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
		$fields = array("db_backup.rowid", 
			"db_backup.availability_domain", 
			"db_backup.compartment_id", 
			"db_backup.database_id", 
			"db_backup.display_name", 
			"db_backup.id", 
			"db_backup.lifecycle_state", 
			"db_backup.time_started", 
			"db_backup.time_ended", 
			"db_backup.type", 
			"db_backup.time_destroyed", 
			"db_backup.last_check", 
			"db.rowid AS db_rowid", 
			"db.compartment_id AS db_compartment_id", 
			"db.db_home_id AS db_db_home_id", 
			"db.db_name AS db_db_name", 
			"db.db_unique_name AS db_db_unique_name", 
			"db.id AS db_id", 
			"db.pdb_name AS db_pdb_name");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("db_backup.rowid", $rec_id);; //select record based on primary key
		}
		$db->join("db", "db_backup.database_id = db.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Db Backup";
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
		return $this->render_view("db_backup/view.php", $record);
	}
}
