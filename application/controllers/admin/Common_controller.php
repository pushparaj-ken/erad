<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Common_controller extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/common_model');
        $this->isLoggedIn();
        $this->global['tis'] = $this;
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard : ' . $this->config->item('app_name');

        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    function file_manager()
    {
        $this->global['records'] = $this->common_model->get_records("tbl_files", "status = '0' order by id desc");
        $this->global['pageTitle'] = 'File Manager : ' . $this->config->item('app_name');
        $this->loadViews("file-manager", $this->global, NULL, NULL);
    }

    public function condition_master()
    {
        $this->global['pageTitle'] = '  Condition : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records("tbl_condition", "status = '0' order by id desc");
        $this->loadViews("masters/condition", $this->global, NULL, NULL);
    }
	
	public function condition_option_master()
    {
        $this->global['pageTitle'] = '  Condition : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records("tbl_condition_option", "status = '0' order by id desc");
        $this->loadViews("masters/condition-option", $this->global, NULL, NULL);
    }
	
	public function instant_click_master()
    {
        $this->global['pageTitle'] = '  Instant Click : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records("tbl_instant_click", "status = '0' order by id desc");
        $this->loadViews("masters/instant-click", $this->global, NULL, NULL);
    }
	
	public function get_condition($id)
	{
		$data['record'] = $this->common_model->get_records('tbl_condition_option', "status='0' and condition_id='$id'");
		$data['result'] = 1;
		echo json_encode($data);
	}
	
	public function category()
    {
        $this->global['pageTitle'] = ' Category : ' . $this->config->item('app_name');
		
        $this->global['records'] = $this->common_model->get_records("tbl_category", "status = '0' order by id desc");
        $this->global['users'] = $this->common_model->get_records("tbl_users", "isDeleted = '0' and (roleId= '3' or  roleId= '4') order by roleId asc");

        $this->loadViews("masters/category", $this->global, NULL, NULL);
    }

    public function sub_category()
    {
        $this->global['pageTitle'] = 'Sub Category : ' . $this->config->item('app_name');
		
		
        $this->global['records'] = $this->common_model->get_records("tbl_sub_category", "status = '0' order by id desc");

        $this->loadViews("masters/sub-category", $this->global, NULL, NULL);
    }

    public function child_category()
    {
        $this->global['pageTitle'] = 'Child Category : ' . $this->config->item('app_name');

        $this->global['records'] = $this->common_model->get_records("tbl_child_category", "status = '0' order by id desc");

        $this->loadViews("masters/child-category", $this->global, NULL, NULL);
    }

    public function form_fields()
    {
        $this->global['pageTitle'] = 'Form Fields Module : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records("tbl_form_fields", "status = '0'");
        $this->loadViews("form-template-module/form-fields", $this->global, NULL, NULL);
    } 
	
	public function generate_report_template()
    {
        $this->global['pageTitle'] = 'Generate Report : ' . $this->config->item('app_name');
        $this->loadViews("generate-report", $this->global, NULL, NULL);
    }
	
	public function answer_report_master()
    {
        $this->global['pageTitle'] = 'Answer Report Master : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records("tbl_answer_report", "status = '0'");
        $this->loadViews("masters/answer-report", $this->global, NULL, NULL);
    }

    public function add_select_options($id,$template_id)
    {
        $this->global['pageTitle'] = 'Form Select Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template'] = $template_id;
        $this->global['records'] = $this->common_model->get_records("tbl_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id'");
        $this->global['copy_options'] = $this->common_model->get_records("tbl_copy_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id' and assign_id = '". $_SESSION['userId'] . "'");
        $this->global['form_records'] = $this->common_model->get_records("tbl_form_template_fields", "status = '0' and template_form_id = '$id' and id='$template_id'")[0];
		$this->global['copy_form_records'] = $this->common_model->get_records("tbl_admin_copy_template_fields", "status = '0' and copy_template_form_id = '$id' and form_fields_id='$template_id' and assign_id = '".$_SESSION['userId']."'")[0];
        $this->loadViews("form-template-module/select-option", $this->global, NULL, NULL);
    }

    public function add_checkbox_options($id,$template_id)
    {
        $this->global['pageTitle'] = 'Form Checkbox Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
		$this->global['template'] = $template_id;
        $this->global['records'] = $this->common_model->get_records("tbl_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id'");
		$this->global['copy_options'] = $this->common_model->get_records("tbl_copy_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id' and assign_id = '". $_SESSION['userId'] . "'");
		$this->global['form_records'] = $this->common_model->get_records("tbl_form_template_fields", "status = '0' and template_form_id = '$id' and id='$template_id'")[0];
		$this->global['copy_form_records'] = $this->common_model->get_records("tbl_admin_copy_template_fields", "status = '0' and copy_template_form_id = '$id' and form_fields_id='$template_id' and assign_id = '".$_SESSION['userId']."'")[0];
        $this->loadViews("form-template-module/select-option", $this->global, NULL, NULL);
    }

    public function add_radio_options($id,$template_id)
    {
        $this->global['pageTitle'] = 'Form Radio Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['records'] = $this->common_model->get_records("tbl_input_options", "status = '0' and input_id='$id'");
        $this->loadViews("form-template-module/select-option", $this->global, NULL, NULL);
    }

    public function add_segment_options($id)
    {
        $this->global['pageTitle'] = 'Form Segment Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['records'] = $this->common_model->get_records("tbl_input_options", "status = '0' and input_id='$id'");
        $this->loadViews("form-template-module/segment-option", $this->global, NULL, NULL);
    }

    public function select_options($id)
    {
        $this->global['pageTitle'] = 'Form Segment Select Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['records'] = $this->common_model->get_records("tbl_select_options", "status = '0' and input_id='$id'");
        $this->loadViews("form-template-module/segment-select-option", $this->global, NULL, NULL);
    }

    public function templates_form()
    {
        $this->global['pageTitle'] = 'Form Template with Child Category : ' . $this->config->item('app_name');
        $this->global['child_categorys'] = $this->common_model->get_records("tbl_child_category", "status = '0'");
        $this->global['records'] = $this->common_model->get_records("tbl_category_with_form", "status = '0'");
        $this->loadViews("form-template-module/form-templates", $this->global, NULL, NULL);
    }

    public function view_form_template($id)
    {
        $this->global['pageTitle'] = 'Form Templates : ' . $this->config->item('app_name');
        $this->global['temp_id'] = $this->common_model->get_records('tbl_category_with_form', "id='$id'")[0];
        $this->loadViews("templates", $this->global, NULL, NULL);
    }

    public function form_template_assign()
    {
        $this->global['pageTitle'] = 'Form Template Assign : ' . $this->config->item('app_name');
		$this->global['records'] = $this->common_model->get_records('tbl_template_assign', "status='0' and assigned_from='".$_SESSION['userId'] ."' group by assigned_to");
        $this->loadViews("admin-assigned-module/assign-templates", $this->global, NULL, NULL);
    }
	
	public function edit_assigned_template() 
	{
		$this->global['product_id'] = $_POST['product_id'];
		$this->global['record'] = $this->common_model->get_records("tbl_template_assign", "id = '" . $this->global['product_id'] . "' and status = '0' and assigned_from='".$_SESSION['userId'] ."'")[0];
		
        $this->load->view("admin/admin-assigned-module/edit-assign-templates", $this->global);
    }

    public function group_master()
    {
        $this->global['pageTitle'] = 'Group Create Page : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_group', "status='0'");
        $this->loadViews("masters/group", $this->global, NULL, NULL);
    }
	
	public function main_title()
    {
        $this->global['pageTitle'] = 'Main Title Create Page : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_main_title', "status='0' order by id desc");
        $this->loadViews("masters/main-title", $this->global, NULL, NULL);
    }

    public function get_value($id)
    {
        $data['result'] = 0;
        $input_id = $this->common_model->get_record('tbl_input_options', "status='0' and id='$id'", "input_id");
        $data['records'] = $this->common_model->get_records('tbl_hide_show_section', "status='0' and input_id ='$input_id'");
        $data['result'] = 1;
        echo json_encode($data);
    }
	
	public function collapse_option($id)
    {
        $data['result'] = 0;
       
        $data['records'] = $this->common_model->get_records('tbl_collapse_section', "status='0' and option_id ='$id'");
        $data['result'] = 1;
        echo json_encode($data);
    }

    // public function reports() {
    //     $this->global['pageTitle'] = 'Templates Reports : ' . $this->config->item('app_name');
    //     $this->global['records'] = $this->common_model->get_records('tbl_hide_show_section', "status='0'");
    // }

    public function delete_assign_template()
    {
        $data['result'] = 0;

		$temp_id = $_POST['template_id'];
		$assign_to_id = $_POST['assign_id'];
		//print_r[$_POST];
		$info1['status'] = 1;
		if ($this->common_model->update("tbl_template_assign",$info1 ,"template_id='$temp_id' and assigned_to ='$assign_to_id'")) 
		{
		   $info2['status'] = 1;
		   if ($this->common_model->update("tbl_admin_copy_template_fields",$info2 ,"copy_template_form_id='$temp_id' and assign_id ='$assign_to_id'"))
		   {
			   $info3['status'] = 1;
			   if($this->common_model->update("tbl_copy_input_options",$info3,"template_form_id='$temp_id' and assign_id ='$assign_to_id'"))
			   {
				   $info3['status'] = 1;
				   $this->common_model->update("tbl_copy_main_title",$info3,"template_form_id='$temp_id' and assign_id ='$assign_to_id'");
					$data['result'] = 1;
			   }					
		   }				   
		}
        echo json_encode($data);
    }
	
	public function assigned_template_admin()
    {
        $data['result'] = 0;
		
        if ($this->input->post('template_id')[0] != "All") {

            $temp_id = $this->input->post('template_id')[0];
            $assign_to_id = $this->input->post('assigned_to');
			//print_r[$_POST];
            $exit_data = $this->common_model->get_records('tbl_template_assign', "status='0' and template_id='$temp_id' and assigned_to='$assign_to_id' and created_by ='".$_SESSION['userId']."'");
            if (!empty($exit_data)) {
                $data['result'] = 2;
            } else {
                for ($k = 0; $k < sizeof($_POST['template_id']); $k++) 
				{
					$info['template_id'] = $_POST['template_id'][$k];
					$info['assigned_from'] = $this->input->post('assigned_from');
					$info['assigned_to'] = $this->input->post('assigned_to');
					$info['group_id'] = $this->input->post('group_id');
					$table_name = $this->input->post('table_name');
					$this->common_model->insert($table_name, $info);
				
					foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$assign_to_id' and created_by ='".$_SESSION['userId']."' and template_id='". $_POST['template_id'][$k]. "'") as $assign_id)
					{
						$copy_title = $this->common_model->get_records('tbl_main_title', "status='0' and template_form_id='$assign_id->template_id'");
						foreach ($copy_title as $copy_title_input) {
							//for ($j = 0; $j < sizeof($copy_title_input->id); $j++) {	
								$info3['template_form_id'] = $copy_title_input->template_form_id;
								$info3['title'] = $copy_title_input->title;
								$info3['title_id'] = $copy_title_input->id;
								$info3['assign_id'] = $info['assigned_to'];
								$info3['created_by'] = $_SESSION['userId'];
								$this->common_model->insert('tbl_copy_main_title', $info3);
							//}
						}
						foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$assign_id->template_id'") as $exit_template) {
							//for ($i = 0; $i < sizeof($exit_template->id); $i++) {
								$info1['name'] = $exit_template->name;
								$info1['form_fields_id'] = $exit_template->id;
								$info1['assign_id'] = $info['assigned_to'];
								$info1['slug'] = $exit_template->slug;
								$info1['type'] = $exit_template->type;
								$info1['title'] = $exit_template->title;
								$info1['copy_form_field_id'] = $exit_template->form_fields_id;
								$info1['copy_form_field_class'] = $exit_template->form_field_class;
								$info1['order_by'] = $exit_template->order_by;
								$info1['copy_template_form_id'] = $exit_template->template_form_id;
								$info1['created_by'] = $_SESSION['userId'];
								if ($this->common_model->insert('tbl_admin_copy_template_fields', $info1)) {
									$data['result'] = 1;
									$copy_input_id = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$exit_template->id'");
									foreach ($copy_input_id as $copy_input) {
										//for ($s = 0; $s < sizeof($copy_input->id); $s++) {
											$info2['input_id'] = $copy_input->input_id;
											$info2['name'] = $copy_input->name;
											$info2['slug'] = $copy_input->slug;
											$info2['template_form_id'] = $copy_input->template_form_id;
											$info2['input_option_id'] = $copy_input->id;
											$info2['assign_id'] = $info['assigned_to'];
											$info2['finding_text'] = $copy_input->finding_text;
											$info2['impression_text'] = $copy_input->impression_text;
											$info2['template_order_number'] = $copy_input->template_order_number;
											$info2['order_by'] = $copy_input->order_by;
											if ($this->common_model->insert('tbl_copy_input_options', $info2)) {
												$data['result'] = 1;
											}
										//}
									}
								}
							//}
						}
					}
				}
                
            }
        }
		else
		{
			
			$template = $this->common_model->get_records('tbl_category_with_form', "status='0'");
			$assign_to_id = $this->input->post('assigned_to');
			for ($k = 0; $k < sizeof($template); $k++) 
			{
				
				$info['template_id'] = $template[$k]->id;
				$info['assigned_from'] = $this->input->post('assigned_from');
				$info['assigned_to'] = $this->input->post('assigned_to');
				$info['group_id'] = $this->input->post('group_id');
				$table_name = $this->input->post('table_name');
				$this->common_model->insert($table_name, $info);
			
				foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$assign_to_id' and created_by ='".$_SESSION['userId']."' and template_id='" . $template[$k]->id . "'") as $assign_id)
				{
					$copy_title = $this->common_model->get_records('tbl_main_title', "status='0' and template_form_id='$assign_id->template_id'");
					foreach ($copy_title as $copy_title_input) {
						//for ($j = 0; $j < sizeof($copy_title_input->id); $j++) {	
							$info3['template_form_id'] = $copy_title_input->template_form_id;
							$info3['title'] = $copy_title_input->title;
							$info3['title_id'] = $copy_title_input->id;
							$info3['assign_id'] = $info['assigned_to'];
							$info3['created_by'] = $_SESSION['userId'];
							$this->common_model->insert('tbl_copy_main_title', $info3);
						//}
					}
					foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$assign_id->template_id'") as $exit_template) {
						//for ($i = 0; $i < sizeof($exit_template->id); $i++) {
							$info1['name'] = $exit_template->name;
							$info1['form_fields_id'] = $exit_template->id;
							$info1['assign_id'] = $info['assigned_to'];
							$info1['slug'] = $exit_template->slug;
							$info1['type'] = $exit_template->type;
							$info1['title'] = $exit_template->title;
							$info1['copy_form_field_id'] = $exit_template->form_fields_id;
							$info1['copy_form_field_class'] = $exit_template->form_field_class;
							$info1['order_by'] = $exit_template->order_by;
							$info1['copy_template_form_id'] = $exit_template->template_form_id;
							$info1['created_by'] = $_SESSION['userId'];
							if ($this->common_model->insert('tbl_admin_copy_template_fields', $info1)) {
								$data['result'] = 1;
								$copy_input_id = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$exit_template->id'");
								foreach ($copy_input_id as $copy_input) {
									//for ($s = 0; $s < sizeof($copy_input->id); $s++) {
										$info2['input_id'] = $copy_input->input_id;
										$info2['name'] = $copy_input->name;
										$info2['slug'] = $copy_input->slug;
										$info2['template_form_id'] = $copy_input->template_form_id;
										$info2['input_option_id'] = $copy_input->id;
										$info2['assign_id'] = $info['assigned_to'];
										$info2['finding_text'] = $copy_input->finding_text;
										$info2['impression_text'] = $copy_input->impression_text;
										$info2['template_order_number'] = $copy_input->template_order_number;
										$info2['order_by'] = $copy_input->order_by;
										if ($this->common_model->insert('tbl_copy_input_options', $info2)) {
											$data['result'] = 1;
										}
									//}
								}
							}
						//}
					}
				}
			}
			
		}
        echo json_encode($data);
    }
	
	public function assigned_template_admin_scribe()
    {
        $data['result'] = 0;
        if ($this->input->post('template_id')[0] != "All") {

            $temp_id = $this->input->post('template_id')[0];
            $assign_to_id = $this->input->post('assigned_to');

            $exit_data = $this->common_model->get_records('tbl_template_assign', "status='0' and template_id='$temp_id' and assigned_to='$assign_to_id'");
            if (!empty($exit_data)) {
                $data['result'] = 2;
            } else {
				for ($p = 0; $p < sizeof($_POST['template_id']); $p++) 
				{
					$info['template_id'] = $_POST['template_id'][$p];
					$info['assigned_from'] = $this->input->post('assigned_from');
					$info['assigned_to'] = $this->input->post('assigned_to');
					$info['group_id'] = $this->input->post('group_id');
					$table_name = $this->input->post('table_name');
					$this->common_model->insert($table_name, $info);
					foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$assign_to_id' and created_by ='".$_SESSION['userId']."' and template_id='". $_POST['template_id'][$p]. "'") as $assign_id)
					{
						
						$copy_title = $this->common_model->get_records('tbl_main_title', "status='0' and template_form_id='$assign_id->template_id'");
						foreach ($copy_title as $copy_title_input) {
							for ($j = 0; $j < sizeof($copy_title_input->id); $j++) {	
								$info3['template_form_id'] = $copy_title_input->template_form_id;
								$info3['title'] = $copy_title_input->title;
								$info3['title_id'] = $copy_title_input->id;
								$info3['assign_id'] = $info['assigned_to'];
								$info3['created_by'] = $_SESSION['userId'];
								$this->common_model->insert('tbl_copy_main_title', $info3);
							}
						}		
						foreach ($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$assign_id->template_id' and assign_id = '".$_SESSION['userId']."'") as $exit_template) {
							for ($i = 0; $i < sizeof($exit_template->id); $i++) {
								$info1['name'] = $exit_template->name;
								$info1['form_fields_id'] = $exit_template->form_fields_id;
								$info1['assign_id'] = $info['assigned_to'];
								$info1['slug'] = $exit_template->slug;
								$info1['type'] = $exit_template->type;
								$info1['title'] = $exit_template->title;
								$info1['copy_form_field_id'] = $exit_template->copy_form_field_id;
								$info1['copy_form_field_class'] = $exit_template->copy_form_field_class;
								$info1['order_by'] = $exit_template->order_by;
								$info1['copy_template_form_id'] = $exit_template->copy_template_form_id;
								$info1['created_by'] = $_SESSION['userId'];
								if ($this->common_model->insert('tbl_admin_copy_template_fields', $info1)) {
									$data['result'] = 1;
									$copy_input_id = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$exit_template->form_fields_id'");
									foreach ($copy_input_id as $copy_input) {
										for ($s = 0; $s < sizeof($copy_input->id); $s++) {
											$info2['input_id'] = $copy_input->input_id;
											$info2['name'] = $copy_input->name;
											$info2['slug'] = $copy_input->slug;
											$info2['template_form_id'] = $copy_input->template_form_id;
											$info2['input_option_id'] = $copy_input->id;
											$info2['assign_id'] = $info['assigned_to'];
											$info2['finding_text'] = $copy_input->finding_text;
											$info2['impression_text'] = $copy_input->impression_text;
											$info2['template_order_number'] = $copy_input->template_order_number;
											$info2['order_by'] = $copy_input->order_by;
											if ($this->common_model->insert('tbl_copy_input_options', $info2)) {
												$data['result'] = 1;
												
											}
										}
									}
								}
							}
						}
					}
				}
            }
        }
		else
		{
			
			$template = $this->common_model->get_records('tbl_template_assign', "status='0' and  assigned_to='".$_SESSION['userId']."'");
			
			$assign_to_id = $this->input->post('assigned_to');
			for ($p = 0; $p < sizeof($template); $p++) 
			{
				
				$info['template_id'] = $template[$p]->template_id;
				$info['assigned_from'] = $this->input->post('assigned_from');
				$info['assigned_to'] = $this->input->post('assigned_to');
				$info['group_id'] = $this->input->post('group_id');
				$table_name = $this->input->post('table_name');
				$this->common_model->insert($table_name, $info);
				foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$assign_to_id' and created_by ='".$_SESSION['userId']."' and template_id='". $template[$p]->template_id . "'") as $assign_id)
				{
					
					$copy_title = $this->common_model->get_records('tbl_main_title', "status='0' and template_form_id='$assign_id->template_id'");
					foreach ($copy_title as $copy_title_input) {
						//for ($j = 0; $j < sizeof($copy_title_input->id); $j++) {	
							$info3['template_form_id'] = $copy_title_input->template_form_id;
							$info3['title'] = $copy_title_input->title;
							$info3['title_id'] = $copy_title_input->id;
							$info3['assign_id'] = $info['assigned_to'];
							$info3['created_by'] = $_SESSION['userId'];
							$this->common_model->insert('tbl_copy_main_title', $info3);
						//}
					}		
					foreach ($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$assign_id->template_id' and assign_id = '".$_SESSION['userId']."'") as $exit_template) {
						//for ($i = 0; $i < sizeof($exit_template->id); $i++) {
							$info1['name'] = $exit_template->name;
							$info1['form_fields_id'] = $exit_template->form_fields_id;
							$info1['assign_id'] = $info['assigned_to'];
							$info1['slug'] = $exit_template->slug;
							$info1['type'] = $exit_template->type;
							$info1['title'] = $exit_template->title;
							$info1['copy_form_field_id'] = $exit_template->copy_form_field_id;
							$info1['copy_form_field_class'] = $exit_template->copy_form_field_class;
							$info1['order_by'] = $exit_template->order_by;
							$info1['copy_template_form_id'] = $exit_template->copy_template_form_id;
							$info1['created_by'] = $_SESSION['userId'];
							if ($this->common_model->insert('tbl_admin_copy_template_fields', $info1)) {
								$data['result'] = 1;
								$copy_input_id = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$exit_template->form_fields_id'");
								foreach ($copy_input_id as $copy_input) {
									//for ($s = 0; $s < sizeof($copy_input->id); $s++) {
										$info2['input_id'] = $copy_input->input_id;
										$info2['name'] = $copy_input->name;
										$info2['slug'] = $copy_input->slug;
										$info2['template_form_id'] = $copy_input->template_form_id;
										$info2['input_option_id'] = $copy_input->id;
										$info2['assign_id'] = $info['assigned_to'];
										$info2['finding_text'] = $copy_input->finding_text;
										$info2['impression_text'] = $copy_input->impression_text;
										$info2['template_order_number'] = $copy_input->template_order_number;
										$info2['order_by'] = $copy_input->order_by;
										if ($this->common_model->insert('tbl_copy_input_options', $info2)) {
											$data['result'] = 1;
											
										}
									//}
								}
							}
						//}
					}
				}
			}
		}
        echo json_encode($data);
    }

    function view_assigned_template_list($id)
    {
        $this->global['pageTitle'] = 'View Assigned Templates : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_template_assign', "assigned_to='$id' and status = 0");
        $this->global['assign_id'] = $id;
        $this->loadViews("admin-assigned-module/admin-asign-form-templates-list", $this->global, NULL, NULL);
    }
	
	function update_data_post()
    {
        $data['result'] = 0;
		
		$row_id = $_POST['row_id'];
		$info2['template_form_id'] = $_POST['template_form_id'];
		$info2['form_fields_id'] = $_POST['form_fields_id'];
		$info2['form_field_class'] = $_POST['form_field_class'];
		$info2['name'] = $_POST['name'];
		$info2['type'] = $_POST['type'];
		if($_POST['title'] != "") {
			$info2['title'] = $_POST['title'];
		}
		$info2['order_by'] = $_POST['order_by'];
		if($this->common_model->update('tbl_form_template_fields', $info2, "status='0' and id='$row_id'")) {
			$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' group by assigned_to");
			if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and label_id='$row_id'")) > 0) 
			{
				foreach ($this->common_model->get_records("tbl_users" ,"roleId ='3' and isDeleted = 0 ") as $exit_template) 
				{
					for ($i = 0; $i < sizeof($exit_template); $i++) 
					{
						
						$info['template_form_id'] = $_POST['template_form_id'];
						$info['form_fields_id'] = $_POST['form_fields_id'];
						$info['form_field_class'] = $_POST['form_field_class'];
						$info['label_id'] = $_POST['row_id'];
						$info['name'] = $_POST['name'];
						$info['type'] = $_POST['type'];
						if($_POST['title'] != "") {
							$info['title'] = $_POST['title'];
						}
						$info['order_by'] = $_POST['order_by'];
						$info['assign_id'] = $exit_template->userId;
						
						$this->common_model->update('tbl_template_logs', $info, "label_id='$row_id'");
						$data['result'] = 1;
					}
				}
				
			}
			else
			{
				foreach ($this->common_model->get_records("tbl_users" ,"roleId ='3' and isDeleted = 0") as $exit_template) 
				{
					for ($i = 0; $i < sizeof($exit_template); $i++) 
					{
						
						$info['template_form_id'] = $_POST['template_form_id'];
						$info['form_fields_id'] = $_POST['form_fields_id'];
						$info['form_field_class'] = $_POST['form_field_class'];
						$info['label_id'] = $_POST['row_id'];
						$info['name'] = $_POST['name'];
						$info['type'] = $_POST['type'];
						if($_POST['title'] != "") {
							$info['title'] = $_POST['title'];
						}
						$info['order_by'] = $_POST['order_by'];
						$info['assign_id'] = $exit_template->userId;
						$this->common_model->insert('tbl_template_logs', $info);
						$data['result'] = 1;
					}
				}
			}
		}
        echo json_encode($data);
    }
	
	function insert_data_super_admin()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
		$info2['input_id'] = $_POST['input_id'];
		$info2['template_form_id'] = $_POST['template_form_id'];
		$info2['name'] = $_POST['name'];
		$info2['finding_text'] = $_POST['finding_text'];
		$info2['impression_text'] = $_POST['impression_text'];
		$info2['negative_id'] = $_POST['negative_id'];
		$info2['template_order_number'] = $_POST['template_order_number'];
		$info2['order_by'] = $_POST['order_by'];
		$info2['score'] = $_POST['score'];
		if($this->common_model->insert('tbl_input_options', $info2)) {
			$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' group by assigned_to");
			foreach($assign_exit_id as $assign_id) {
				foreach ($this->common_model->get_records('tbl_users' ,"roleId ='3' and userId='$assign_id->assigned_to'") as $exit_template) 
				{
					for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
					{
							$info['input_id'] = $row_id;
							$info['label_id'] = $_POST['input_id'];
							$info['name'] = $_POST['names'];
							$info['type'] = $_POST['type'];
							if($_POST['title'] != "") {
								$info['title'] = $_POST['title'];
							}
							$info['order_by'] = $_POST['order_by'];
							$info['form_fields_id'] = $_POST['form_fields_id'];
							$info['form_field_class'] = $_POST['form_field_class'];
							$info['template_form_id'] = $_POST['template_form_id'];
							$info['answer_name'] = $_POST['name'];
							$info['finding_text'] = $_POST['finding_text'];
							$info['impression_text'] = $_POST['impression_text'];
							$info['assign_id'] = $exit_template->userId;
						
							$this->common_model->insert('tbl_template_logs', $info);
							$data['result'] = 1;
					}
				}
			}
		}
        echo json_encode($data);
    }
	
	function update_data_option()
    {
        $data['result'] = 0;
		
		$row_id = $_POST['row_id'];
		$info2['input_id'] = $_POST['input_id'];
		$info2['template_form_id'] = $_POST['template_form_id'];
		$info2['name'] = $_POST['name'];
		$info2['finding_text'] = $_POST['finding_text'];
		$info2['impression_text'] = $_POST['impression_text'];
		$info2['negative_id'] = $_POST['negative_id'];
		$info2['score'] = $_POST['score'];
		$info2['template_order_number'] = $_POST['template_order_number'];
		$info2['order_by'] = $_POST['order_by'];
		if($this->common_model->update('tbl_input_options', $info2, "status='0' and id='$row_id'")) {
			$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' group by assigned_to");
			foreach($assign_exit_id as $assign_id) {
				foreach ($this->common_model->get_records('tbl_users' ,"roleId ='3' and userId='$assign_id->assigned_to'") as $exit_template) 
				{
					for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
					{
							$info['input_id'] = $row_id;
							$info['label_id'] = $_POST['input_id'];
							$info['name'] = $_POST['names'];
							$info['type'] = $_POST['type'];
							if($_POST['title'] != "") {
								$info['title'] = $_POST['title'];
							}
							$info['order_by'] = $_POST['order_by'];
							$info['form_fields_id'] = $_POST['form_fields_id'];
							$info['form_field_class'] = $_POST['form_field_class'];
							$info['template_form_id'] = $_POST['template_form_id'];
							$info['answer_name'] = $_POST['name'];
							$info['finding_text'] = $_POST['finding_text'];
							$info['impression_text'] = $_POST['impression_text'];
							$info['assign_id'] = $exit_template->userId;
						if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and id='$row_id'")) > 0) {
							$this->common_model->update('tbl_template_logs', $info, "id='$row_id'");
							$data['result'] = 1;
						} else {
							$this->common_model->insert('tbl_template_logs', $info);
							$data['result'] = 1;
						}
					}
				}
			}
		}
        echo json_encode($data);
    }
	
	function update_data_option_scribe()
    {
        $data['result'] = 0;
		
		$row_id = $_POST['row_id'];
		
		$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' group by assigned_to");
		//foreach($assign_exit_id as $assign_id) {
			$exit_template = $this->common_model->get_records('tbl_users' ,"roleId ='4' and userId='$_SESSION[userId]'")[0];
			//{
				//for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
				//{
						$info['input_id'] = $row_id;
						$info['label_id'] = $_POST['input_id'];
						$info['name'] = $_POST['names'];
						$info['type'] = $_POST['type'];
						if($_POST['title'] != "") {
							$info['title'] = $_POST['title'];
						}
						$info['order_by'] = $_POST['order_by'];
						$info['form_fields_id'] = $_POST['form_fields_id'];
						$info['form_field_class'] = $_POST['form_field_class'];
						$info['template_form_id'] = $_POST['template_form_id'];
						$info['answer_name'] = $_POST['name'];
						$info['finding_text'] = $_POST['finding_text'];
						$info['impression_text'] = $_POST['impression_text'];
						$info['assign_id'] = $exit_template->createdBy;
					if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and id='$row_id'")) > 0) {
						$this->common_model->update('tbl_template_logs', $info, "id='$row_id'");
						$data['result'] = 1;
					} else {
						$this->common_model->insert('tbl_template_logs', $info);
						$data['result'] = 1;
					}
				//}
			//}
		//}
        echo json_encode($data);
    }
	
	function update_data_post_template_field()
    {
        $data['result'] = 0;
		
		$row_id = $_POST['row_id'];
		
		
        // $info['input_id'] = $row_id;
		// $info['template_form_id'] = $_POST['template_form_id'];
		$info['name'] = $_POST['name'];
		$info['type'] = $_POST['type'];
		$info['title'] = $_POST['title'];
		$info['assign_id'] = $_SESSION['userId'];
		$info['order_by'] = $_POST['order_by'];
		$info['copy_template_form_id'] = $_POST['copy_template_form_id'];
		$info['form_fields_id'] = $_POST['form_fields_id'];
		$info['copy_form_field_id'] = $_POST['copy_form_field_id'];
		$info['copy_form_field_class'] = $_POST['copy_form_field_class'];
		if($this->common_model->update('tbl_admin_copy_template_fields', $info,"id='$row_id'"))
		{
			foreach($this->common_model->get_records("tbl_users","isDeleted = 0 and createdBy = '$_SESSION[userId]'")as $user_template)
			{
				$input_option_id = $this->common_model->get_record("tbl_admin_copy_template_fields","status =0 and id='$row_id'","form_fields_id");
				$info2['name'] = $_POST['name'];
				$info2['type'] = $_POST['type'];
				$info2['title'] = $_POST['title'];
				$info2['assign_id'] = $_SESSION['userId'];
				$info2['order_by'] = $_POST['order_by'];
				$info2['copy_template_form_id'] = $_POST['copy_template_form_id'];
				$info2['form_fields_id'] = $_POST['form_fields_id'];
				$info2['copy_form_field_id'] = $_POST['copy_form_field_id'];
				$info2['copy_form_field_class'] = $_POST['copy_form_field_class'];
				$info2['assign_id'] = $user_template->userId;
				$this->common_model->update('tbl_admin_copy_template_fields', $info2 ,"form_fields_id='$input_option_id' and assign_id='$user_template->userId'");
				$data['result'] = 1;
			}
		}
		echo json_encode($data);
    }
	
	function update_data_admin_option()
    {
        $data['result'] = 0;
		
		$row_id = $_POST['row_id'];
		
		
        // $info['input_id'] = $row_id;
		// $info['template_form_id'] = $_POST['template_form_id'];
		$info['finding_text'] = $_POST['finding_text'];
		$info['impression_text'] = $_POST['impression_text'];
		$info['assign_id'] = $_SESSION['userId'];
		$info['name'] = $_POST['name'];
		if($this->common_model->update('tbl_copy_input_options', $info,"id='$row_id'"))
		{
			foreach($this->common_model->get_records("tbl_users","isDeleted = 0 and createdBy = '$_SESSION[userId]'")as $user_template)
			{
				$input_option_id = $this->common_model->get_record("tbl_copy_input_options","status =0 and id='$row_id'","input_option_id");
				$info2['input_id'] = $_POST['input_id'];
				$info2['template_form_id'] = $_POST['template_form_id'];
				$info2['finding_text'] = $_POST['finding_text'];
				$info2['impression_text'] = $_POST['impression_text'];
				$info2['assign_id'] = $user_template->userId;
				$info2['name'] = $_POST['name'];
				$this->common_model->update('tbl_copy_input_options', $info2 ,"input_option_id='$input_option_id' and assign_id='$user_template->userId'");
				$data['result'] = 1;
			}
		}
		echo json_encode($data);
    }
	
	function update_data_scribe()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
		foreach ($this->common_model->get_records('tbl_users' ,"roleId ='4' and userId='".$_SESSION['userId']."'") as $exit_template) 
		{
			for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
			{
				$info['template_form_id'] = $_POST['template_form_id'];
				$info['form_fields_id'] = $_POST['form_fields_id'];
				$info['form_field_class'] = $_POST['form_field_class'];
				$info['label_id'] = $_POST['label_id'];
				$info['name'] = $_POST['name'];
				$info['type'] = $_POST['type'];
				if($_POST['title'] != "") {
					$info['title'] = $_POST['title'];
				}
				$info['order_by'] = $_POST['order_by'];
				$info['assign_id'] = $exit_template->createdBy;
				if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and label_id='$row_id'")) > 0) {
					$this->common_model->update('tbl_template_logs', $info, "label_id='$row_id'");
					$data['result'] = 1;
				} else {
					$this->common_model->insert('tbl_template_logs', $info);
					$data['result'] = 1;
				}
			}
		}
        echo json_encode($data);
    }
	
	function insert_data_option()
    {
        $data['result'] = 0;
		$info['input_id'] = $_POST['input_id'];
		$info['template_form_id'] = $_POST['template_form_id'];
		$info['finding_text'] = $_POST['finding_text'];
		$info['impression_text'] = $_POST['impression_text'];
		$info['assign_id'] = $_SESSION['userId'];
		$info['name'] = $_POST['name'];
		$random_no = '1012' . rand(1000,10000);
		$info['input_option_id'] = $random_no;
		if($insert = $this->common_model->insert('tbl_copy_input_options', $info))
		{
			
			foreach($this->common_model->get_records("tbl_users","isDeleted = 0 and createdBy = '$_SESSION[userId]'")as $user_template)
			{
				$input_option_id = $this->common_model->get_record("tbl_copy_input_options","status =0 and id='$insert'","input_option_id");
				$info2['input_id'] = $_POST['input_id'];
				$info2['template_form_id'] = $_POST['template_form_id'];
				$info2['finding_text'] = $_POST['finding_text'];
				$info2['impression_text'] = $_POST['impression_text'];
				$info2['assign_id'] = $user_template->userId;
				$info2['name'] = $_POST['name'];
				$info2['input_option_id'] = $input_option_id;
				$this->common_model->insert('tbl_copy_input_options', $info2);
			}
		}
		$data['result'] = 1;
		
        echo json_encode($data);
    }
	
	function insert_data_scribe_option()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
		foreach ($this->common_model->get_records('tbl_users' ,"roleId ='4' and userId='".$_SESSION['userId']."'") as $exit_template) 
		{
			for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
			{
				$info['label_id'] = $_POST['input_id'];
				$info['input_id'] = $row_id;
				$info['name'] = $_POST['names'];
				$info['type'] = $_POST['type'];
				if($_POST['title'] != "") {
					$info['title'] = $_POST['title'];
				}
				$info['order_by'] = $_POST['order_by'];
				$info['form_fields_id'] = $_POST['form_fields_id'];
				$info['form_field_class'] = $_POST['form_field_class'];
				$info['template_form_id'] = $_POST['template_form_id'];
				$info['answer_name'] = $_POST['name'];
				$info['finding_text'] = $_POST['finding_text'];
				$info['impression_text'] = $_POST['impression_text'];
				$info['assign_id'] = $exit_template->createdBy;
				if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and label_id='".$_POST['input_id']."'")) > 0) {
					$this->common_model->update('tbl_template_logs', $info, "label_id='$row_id'");
					$data['result'] = 1;
				} else {
					$this->common_model->insert('tbl_template_logs', $info);
					$data['result'] = 1;
				}
			}
		}
        echo json_encode($data);
    }
	
	function insert_data_scribe_main()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
		foreach ($this->common_model->get_records('tbl_users' ,"roleId ='4' and userId='".$_SESSION['userId']."'") as $exit_template) 
		{
			for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
			{
				$info['template_form_id'] = $_POST['template_form_id'];
				$info['main_title'] = $_POST['title'];
				$info['label_id'] = $_POST['row_id'];
				$info['assign_id'] = $exit_template->createdBy;
				if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and label_id='$row_id'")) > 0) {
					$this->common_model->update('tbl_template_logs', $info, "label_id='$row_id'");
					$data['result'] = 1;
				} else {
					$this->common_model->insert('tbl_template_logs', $info);
					$data['result'] = 1;
				}
			}
		}
        echo json_encode($data);
    }
	
	function update_data_scribe_main()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
		foreach ($this->common_model->get_records('tbl_users' ,"roleId ='4' and userId='".$_SESSION['userId']."'") as $exit_template) 
		{
			for ($i = 0; $i < sizeof($exit_template->userId); $i++) 
			{
				$info['template_form_id'] = $_POST['template_form_id'];
				$info['main_title'] = $_POST['title'];
				$info['label_id'] = $_POST['row_id'];
				$info['assign_id'] = $exit_template->createdBy;
				if(sizeof($this->common_model->get_records('tbl_template_logs', "status='0' and label_id='$row_id'")) > 0) {
					$this->common_model->update('tbl_template_logs', $info, "label_id='$row_id'");
					$data['result'] = 1;
				} else {
					$this->common_model->insert('tbl_template_logs', $info);
					$data['result'] = 1;
				}
			}
		}
        echo json_encode($data);
    }
	
	function approve_change_template()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
        if(($_POST['request']) == 2)
		{
			$info['status'] = 2 ;
			if($this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='".$_SESSION['userId']."' and status = 0")){
				foreach ($this->common_model->get_records('tbl_template_logs', "status='2' and assign_id ='" . $_SESSION['userId'] . "'") as $template) {
					$label_id = $template->label_id;
					$info1['name'] = $template->name;
					if($template->title != "") {
						$info1['title'] = $template->title;
					}
					$info1['order_by'] = $template->order_by;
					$info1['type'] = $template->type;
					if($this->common_model->update('tbl_admin_copy_template_fields', $info1, "status='0' and assign_id='".$_SESSION['userId']."' and copy_template_form_id='$row_id' and form_fields_id='$label_id'")) {
						$info3['name'] = $template->answer_name;
						$info3['finding_text'] = $template->finding_text;
						$info3['impression_text'] = $template->impression_text;
						$info3['input_option_id'] = $template->input_id;
						$info3['template_form_id'] = $template->template_form_id;
						$info3['assign_id'] = $template->assign_id;
						$info3['input_id'] = $template->label_id;
						$input_id = $template->input_id;
						$this->common_model->update('tbl_copy_input_options', $info3, "status='0' and assign_id='".$_SESSION['userId']."' and template_form_id='$row_id' and input_option_id='$input_id' and input_id = $label_id");
						$info['status'] = 3;
						$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='".$_SESSION['userId']."'");
					}
					$data['result'] = 1;
				}
			}
		}
		else
		{
			$info['status'] = 1 ;
			$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='".$_SESSION['userId']."'"); 
			
			$data['result'] = 0;
		}
		
		echo json_encode($data);
    }
	
	function approve_change_template_admin()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
        if(($_POST['request']) == 2)
		{
			$info['status'] = 2 ;
			$assign_exit_id = $this->common_model->get_records('tbl_users', "isDeleted='0' and roleId = '3'");
			foreach($assign_exit_id as $assign_id) {
				if($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","answer_name") == "" && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","main_title") == "")
				{
					if($this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId' and status = 0")){
						foreach ($this->common_model->get_records('tbl_template_logs', "status='2' and assign_id ='$assign_id->userId'") as $template) {
							$label_id = $template->label_id;
							$info1['name'] = $template->name;
							if($template->title != "") {
								$info1['title'] = $template->title;
							}
							$info1['order_by'] = $template->order_by;
							$info1['type'] = $template->type;
							if($this->common_model->update('tbl_admin_copy_template_fields', $info1, "status='0' and assign_id='$assign_id->userId' and copy_template_form_id='$row_id' and form_fields_id='$label_id'")) 
							{
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId'");
							}
							$data['result'] = 1;
						}
					}
				}
				elseif($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","answer_name") != "" && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","main_title") == "")
				{
					
					
					foreach ($this->common_model->get_records('tbl_template_logs', "status='0' and assign_id ='$assign_id->userId'") as $template) 
					{
						
						if($template->input_id != 0)
						{
							
							$info3['name'] = $template->answer_name;
							$info3['finding_text'] = $template->finding_text;
							$info3['impression_text'] = $template->impression_text;
							//$info3['input_option_id'] = $template->input_id;
							$info3['template_form_id'] = $template->template_form_id;
							$info3['assign_id'] = $assign_id->userId;
							$info3['input_id'] = $template->label_id;
							$input_id = $template->input_id;
							$label_id = $template->label_id;
							if($this->common_model->update('tbl_copy_input_options', $info3, "status='0' and assign_id='$assign_id->userId' and template_form_id='$row_id' and id='$input_id' and input_id = $label_id")) {
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId'");
							}
						}
						else 
						{
							
							$info4['name'] = $template->answer_name;
							$info4['finding_text'] = $template->finding_text;
							$info4['impression_text'] = $template->impression_text;
							$info4['input_option_id'] = rand(100,1000);
							$info4['template_form_id'] = $template->template_form_id;
							$info4['assign_id'] = $assign_id->userId;
							$info4['input_id'] = $template->label_id;
							$id = $template->label_id;
							if($this->common_model->insert('tbl_copy_input_options', $info4)){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId'");
							}
						}
							
					}
					$data['result'] = 1;
				}
				elseif ($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","answer_name") == ""  && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->userId'","main_title") != "" )
				{	
					foreach ($this->common_model->get_records('tbl_template_logs', "status='0' and assign_id ='$assign_id->userId'") as $template) 
					{
						
						$exit_data = $this->common_model->get_records("tbl_copy_main_title", "status='0' and template_form_id='$row_id' and id ='$template->label_id'");
						
						if($template->label_id != 0)
						{
							$info4['title'] = $template->main_title;
							$info4['template_form_id'] = $template->template_form_id;
							$info4['assign_id'] = $assign_id->userId;
							$id = $template->label_id;
							if($this->common_model->update('tbl_copy_main_title', $info4, "status='0' and assign_id='$assign_id->userId' and template_form_id='$row_id' and id='$id'")){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId'");
							}
						}
						else 
						{
							$info5['title'] = $template->main_title;
							$info5['template_form_id'] = $template->template_form_id;
							$info5['assign_id'] = $assign_id->userId;
							$id = $template->label_id;
							if($this->common_model->insert('tbl_copy_main_title', $info5)){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->userId'");
							}
						}
							
					}
					$data['result'] = 1;
				}
			}
		}
		else
		{
			$info['status'] = 1 ;
			$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' ");
			foreach($assign_exit_id as $assign_id) {
				$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->assigned_from'"); 
			}
			$data['result'] = 0;
		}
		
		echo json_encode($data);
    }
	
	function approve_change_template_scribe()
    {
        $data['result'] = 0;
		$row_id = $_POST['row_id'];
        if(($_POST['request']) == 2)
		{
			$info['status'] = 2 ;
			$assign_exit_id = $this->common_model->get_records('tbl_users', "isDeleted='0' and roleId = '4'");
			foreach($assign_exit_id as $assign_id) {
				if($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","answer_name") == "" && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","main_title") == "")
				{
					if($this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy' and status = 0")){
						foreach ($this->common_model->get_records('tbl_template_logs', "status='2' and assign_id ='$assign_id->createdBy'") as $template) {
							$label_id = $template->label_id;
							$info1['name'] = $template->name;
							if($template->title != "") {
								$info1['title'] = $template->title;
							}
							$info1['order_by'] = $template->order_by;
							$info1['type'] = $template->type;
							if($this->common_model->update('tbl_admin_copy_template_fields', $info1, "status='0' and assign_id='$assign_id->userId' and copy_template_form_id='$row_id' and form_fields_id='$label_id'")) 
							{
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy'");
							}
							$data['result'] = 1;
						}
					}
				}
				elseif($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","answer_name") != "" && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","main_title") == "")
				{
					foreach ($this->common_model->get_records('tbl_template_logs', "status='0' and assign_id ='$assign_id->createdBy'") as $template) 
					{
						
						if($template->input_id != 0)
						{
							$info3['name'] = $template->answer_name;
							$info3['finding_text'] = $template->finding_text;
							$info3['impression_text'] = $template->impression_text;
							//$info3['input_option_id'] = $template->input_id;
							$info3['template_form_id'] = $template->template_form_id;
							$info3['assign_id'] = $assign_id->userId;
							$info3['input_id'] = $template->label_id;
							$input_id = $template->input_id;
							$label_id = $template->label_id;
							if($this->common_model->update('tbl_copy_input_options', $info3, "status='0' and assign_id='$assign_id->userId' and template_form_id='$row_id' and input_option_id='$input_id' and input_id = $label_id")) {
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy'");
							}
						}
						else 
						{
							$info4['name'] = $template->answer_name;
							$info4['finding_text'] = $template->finding_text;
							$info4['impression_text'] = $template->impression_text;
							$info4['input_option_id'] = rand(100,1000);
							$info4['template_form_id'] = $template->template_form_id;
							$info4['assign_id'] = $assign_id->userId;
							$info4['input_id'] = $template->label_id;
							$id = $template->label_id;
							if($this->common_model->insert('tbl_copy_input_options', $info4)){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy'");
							}
						}
							
					}
					$data['result'] = 1;
				}
				elseif ($this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","answer_name") == ""  && $this->common_model->get_record('tbl_template_logs', "status='0' and template_form_id='$row_id' and assign_id ='$assign_id->createdBy'","main_title") != "" )
				{	
					foreach ($this->common_model->get_records('tbl_template_logs', "status='0' and assign_id ='$assign_id->createdBy'") as $template) 
					{
						
						$exit_data = $this->common_model->get_records("tbl_copy_main_title", "status='0' and template_form_id='$row_id' and id ='$template->label_id'");
						
						if($template->label_id != 0)
						{
							$info4['title'] = $template->main_title;
							$info4['template_form_id'] = $template->template_form_id;
							$info4['assign_id'] = $assign_id->userId;
							$id = $template->label_id;
							if($this->common_model->update('tbl_copy_main_title', $info4, "status='0' and assign_id='$assign_id->userId' and template_form_id='$row_id' and id='$id'")){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy'");
							}
						}
						else 
						{
							$info5['title'] = $template->main_title;
							$info5['template_form_id'] = $template->template_form_id;
							$info5['assign_id'] = $assign_id->userId;
							$id = $template->label_id;
							if($this->common_model->insert('tbl_copy_main_title', $info5)){
								$info['status'] = 3;
								$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->createdBy'");
							}
						}
							
					}
					$data['result'] = 1;
				}
			}
		}
		else
		{
			$info['status'] = 1 ;
			$assign_exit_id = $this->common_model->get_records('tbl_template_assign', "status='0' ");
			foreach($assign_exit_id as $assign_id) {
				$this->common_model->update("tbl_template_logs", $info, "template_form_id ='$row_id' and assign_id ='$assign_id->assigned_from'"); 
			}
			$data['result'] = 0;
		}
		
		echo json_encode($data);
    }
	
	function copy_record()
    {
        $data['result'] = 0;
		$exit_data = $this->common_model->get_records("tbl_generate_result", "status='0' and template_form_id='" . $_POST['template_form_id'] . "'");
        
		$info['template_form_id'] = $_POST['template_form_id'];
		$info['assign_id'] = $_POST['assign_id'];
		$info['techniques'] = $_POST['techniques'];
		$info['comparision_date'] = $_POST['comparision_date'];
		$info['finding_text'] = $_POST['finding_text'];
		$info['impressions_text'] = $_POST['impressions_text'];
		$info['created_by'] = $_SESSION['userId'];
		$this->common_model->insert("tbl_generate_result", $info);
		$data['result'] = 1;
			

        echo json_encode($data);
    }
	
	public function search_form() 
	{
		$search_text = $_POST['search'] ;
		$data['serach'] = $this->common_model->get_records("tbl_answer_report"," status= '0' and name like '%$search_text%'");
		echo json_encode($data);
	}
	
	public function insta_click_search() 
	{
		$data['result'] = 0;
		$search_click = $_POST['search_click'] ;
		$template_id = $_POST['template_id'] ;
		$data['serach'] = $this->common_model->get_records("tbl_instant_click"," status= '0' and template_id = '$template_id' and name like '%$search_click%'");
		$data['result'] = 1;
		echo json_encode($data);
	}

    function form_for_me()
    {
        $this->global['pageTitle'] = 'Form For Admin : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='" . $_SESSION['userId'] . "'");
        $this->loadViews("admin-pages/form-for-me", $this->global, NULL, NULL);
    }
	
	function change_template_request()
    {
        $this->global['pageTitle'] = 'Change Template Details : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_template_logs', "status='0' and assign_id ='" . $_SESSION['userId'] . "' group by template_form_id");
        $this->loadViews("admin-pages/change-template-details", $this->global, NULL, NULL);
    }
	
	function scribe_change_template_request()
    {
        $this->global['pageTitle'] = 'Change Template Details : ' . $this->config->item('app_name');
		
        $this->loadViews("admin-pages/scribe-change-template-details", $this->global, NULL, NULL);
    }
	
	function scribe_change_template_report()
    {
        $this->global['pageTitle'] = 'Scribe Change Template Report : ' . $this->config->item('app_name');
		$this->global['records'] = $this->common_model->get_records('tbl_generate_result', "status='0'");
        $this->loadViews("admin-pages/scribe-change-template-report", $this->global, NULL, NULL);
    }

    function template_for_me($id)
    {
        $this->global['pageTitle'] = 'Form For Admin Template : ' . $this->config->item('app_name');
        $this->global['id'] = $id;
        $this->global['category_form'] = $this->common_model->get_records('tbl_category_with_form', "status='0' and id='$id'")[0];
        $this->global['records'] = $this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$id' and assign_id ='" . $_SESSION['userId'] . "' order by order_by asc");
        $this->loadViews("admin-pages/admin-template-all-fields", $this->global, NULL, NULL);
    }

    function admin_view_form_template($id)
    {
        $this->global['pageTitle'] = 'Form Templates : ' . $this->config->item('app_name');
        $this->global['temp_id'] = $this->common_model->get_records('tbl_category_with_form', "status =0 and id='$id'")[0];
        $this->loadViews("admin-pages/view-admin-templates", $this->global, NULL, NULL);
    }
	
	
	function view_template_changes($id)
    {
        $this->global['pageTitle'] = 'Form Templates Changes : ' . $this->config->item('app_name');
        $this->global['temp_id'] = $this->common_model->get_records('tbl_category_with_form', "id='$id'")[0];
		//if(sizeof($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='" . $_SESSION['userId'] . "' and template_id='$id'")) > 0) {
		//$this->global['records'] = $this->common_model->get_records('tbl_template_logs', "status='0'");
		//}
        $this->loadViews("admin-pages/view-admin-change-templates", $this->global, NULL, NULL);
    }
	
	function view_template_changes_scribe($id)
    {
        $this->global['pageTitle'] = 'Form Templates Changes : ' . $this->config->item('app_name');
        $this->global['temp_id'] = $this->common_model->get_records('tbl_category_with_form', "id='$id'")[0];
		$this->global['records'] = $this->common_model->get_records('tbl_template_logs', "status='0'");
        $this->loadViews("admin-pages/view-admin-change-templates-scribe", $this->global, NULL, NULL);
    }

    function admin_assign_form_template($id)
    {
        $this->global['pageTitle'] = 'Assigned Particular Template : ' . $this->config->item('app_name');
        $this->global['temp_id'] = $this->common_model->get_records('tbl_category_with_form', "id='$id'")[0];
        $this->loadViews("admin-assigned-module/view-assign-templates", $this->global, NULL, NULL);
    }

    public function get_segment($id)
    {
        $data['result'] = 0;
        $input_id = $this->common_model->get_records('tbl_input_options', "status='0' and id='$id->id'")[0];
        $temp_id = $this->common_model->get_records('tbl_form_fields', "id='$input_id'")[0];
        //$data['records'] = $this->common_model->get_records('tbl_input_options', "status='0' and form_fields_id ='$id'");
        $data['result'] = 1;
        echo json_encode($data);
    }

    public function admin_form_template($id)
    {
        $this->global['pageTitle'] = 'Form Template : ' . $this->config->item('app_name');
        $this->global['id'] = $id;
        $this->global['form_fields'] = $this->common_model->get_records('tbl_form_fields', "status='0'");
        $this->global['category_form'] = $this->common_model->get_records("tbl_category_with_form", "status = '0' and id='$id'")[0];
        $this->global['records'] = $this->common_model->get_records("tbl_form_template_fields", "status = '0' and template_form_id='$id' order by order_by asc");
        $this->loadViews("form-template-module/template-form-all-fields", $this->global, NULL, NULL);
    }
	
    public function hide_show_section($template_id, $id)
    {
        $this->global['pageTitle'] = 'Hide Show Fields : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template_id'] = $template_id;
        $this->global['all_inputs'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id='$template_id'");
        $this->global['check_options'] = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$id'");
        $this->global['records'] = $this->common_model->get_records('tbl_hide_show_section', "status='0' and 	input_id='$id'");
        $this->global['template_name'] = $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$template_id'", "name");
        $this->loadViews("form-template-module/hide-show-page", $this->global, NULL, NULL);
    }
	
	public function finding_option($template_id, $id)
    {
        $this->global['pageTitle'] = 'Finding Option : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template_id'] = $template_id;
        $this->global['all_inputs'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$template_id' and title != '0'  group by title order by order_by asc");
		$this->global['all_title'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id' and template_form_id='$template_id'  group by title order by order_by asc");
        $this->global['check_options'] = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$id'");
        $this->global['records'] = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and 	input_id='$id'");
        $this->global['template_name'] = $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$template_id'", "name");
        $this->loadViews("form-template-module/finding-answer", $this->global, NULL, NULL);
    }
	
	
	
	public function add_collapse($template_id, $id)
    {
        $this->global['pageTitle'] = 'Collapse Fields : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template_id'] = $template_id;
        $this->global['all_inputs'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id'");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
        $this->global['records'] = $this->common_model->get_records('tbl_collapse_section', "status='0' and input_id='$id' and template_id='$template_id'");
        $this->global['template_name'] = $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$template_id'", "name");
        $this->loadViews("form-template-module/collapse-page", $this->global, NULL, NULL);
    }
	
	public function edit_collapse() 
	{
		$this->global['row_id'] = $_POST['row_id'];
		$row_id = $_POST['row_id'];
		$this->global['row_id'] = $_POST['row_id'];
		$template_id = $_POST['template_id'];
		$this->global['template_id'] = $_POST['template_id'];
		$id = $_POST['input_id'];
		$this->global['input_id'] = $_POST['input_id'];
		$this->global['all_inputs'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id'");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
		$this->global['records'] = $this->common_model->get_records('tbl_collapse_section', "status='0' and id='$row_id'")[0];
		
        $this->load->view("admin/form-template-module/edit-collapse-page", $this->global);
    }

    public function segment_section($form_field_id, $field_id)
    {
        $this->global['pageTitle'] = 'Segment Fields : ' . $this->config->item('app_name');
        $this->global['field_id'] = $field_id;
        $this->global['template_fileds'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$form_field_id' and form_fields_id != '$field_id'");
        $this->global['option_id'] = $this->common_model->get_records('tbl_input_options', "status='0' and input_id='$field_id'");
        $this->global['records'] = $this->common_model->get_records('tbl_segment_section', "status='0' and form_fields_id='$field_id'");
        //$this->global['options'] = $this->common_model->get_records('tbl_hide_show_section', "status='0' and option_id='$field_id'");
        $this->loadViews("form-template-module/segment-page", $this->global, NULL, NULL);
    }
	
    public function answer_master()
    {
        $this->global['pageTitle'] = 'Answer Text Page : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_title_answer_master', "status='0' order by id desc"); 
        $this->loadViews("title-answer-master", $this->global, NULL, NULL);
    }
	
	public function get_title($id)
	{
		$data['record'] = $this->common_model->get_records('tbl_main_title', "status='0' and template_form_id='$id'");
		$data['result'] = 1;
		echo json_encode($data);
	}
	
	public function get_conditionoption($id)
	{
		$data['record'] = $this->common_model->get_records('tbl_condition', "status='0' and template_id='$id'");
		$data['result'] = 1;
		echo json_encode($data);
	}

	function insert_template_data() {
		$data['result'] = 0;
		if(!empty($this->input->post('template_form_id'))) {
			$info['name'] = $this->input->post('name');
			$info['type'] = $this->input->post('type');
			$info['title'] = $this->input->post('title');
			$info['order_by'] = $this->input->post('order_by');
			$info['template_form_id'] = $this->input->post('template_form_id');
			$table = $this->input->post('table_name');
			if($insert_id = $this->common_model->insert($table, $info)) {
				$info1['form_fields_id'] = "input_" . $insert_id;
				$info1['form_field_class'] = "input_" . $insert_id . "c";
				if($this->common_model->update($table, $info1, "id='$insert_id'")) {
					$data['result'] = 1; 
				}
			}
		}
        echo json_encode($data);
	}

    function insert_hide_items()
    {
        $data['result'] = 0;
        // $exit_data = $this->common_model->get_records("tbl_hide_show_section", "status='0' and form_fields_id='" . $_POST['form_fields_id'] . "'");
        // if(sizeof($exit_data > 0)) {
        // $info1['status'] = 1;
        // $this->common_model->update('tbl_hide_show_section', $info1, "form_fields_id='". $_POST['form_fields_id'] ."'");
        // for ($i = 0; $i < sizeof($_POST['select_fields_id']); $i++) {
        // if (!empty($_POST['select_fields_id'][$i])) {
        // $info['form_fields_id'] = $_POST['form_fields_id'];
        // $info['option_id'] = $_POST['option_id'][$i];
        // $info['select_fields_id'] = $_POST['select_fields_id'][$i];
        // $this->common_model->insert("tbl_hide_show_section", $info);
        // $data['result'] = 1;
        // }
        // }
        // } else {
		if($_POST['table_name'] == "tbl_hide_show_section")
		{
			for ($i = 0; $i < sizeof($_POST['select_fields_id']); $i++) {
				if (!empty($_POST['select_fields_id'][$i])) {
					$info['input_id'] = $_POST['input_id'];
					$info['option_id'] = $_POST['option_id'];
					$info['select_fields_id'] = $_POST['select_fields_id'][$i];
					$this->common_model->insert("tbl_hide_show_section", $info);
					$data['result'] = 1;
				}
			}
		}
		elseif($_POST['table_name'] == "tbl_hide_finding_answer")
		{
			
			for ($i = 0; $i < sizeof($_POST['title_id_hide']); $i++) {
				if (!empty($_POST['title_id_hide'][$i])) {
					$info['input_id'] = $_POST['input_id'];
					$info['title_id_hide'] = $_POST['title_id_hide'][$i];
					$info['template_id'] = $_POST['template_id'];
					$info['hide_text_finding'] = $_POST['hide_text_finding'];
					$info['show_finding_answer'] = $_POST['show_finding_answer'];
					$info['title_id'] = $_POST['title_id'];
					$this->common_model->insert("tbl_hide_finding_answer", $info);
					$data['result'] = 1;
				}
			} 
			// $info['input_id'] = $_POST['input_id'];
			// $info['title_id_hide'] = $_POST['title_id_hide'];
			// $info['template_id'] = $_POST['template_id'];
			// $info['hide_text_finding'] = $_POST['hide_text_finding'];
			// $info['show_finding_answer'] = $_POST['show_finding_answer'];
			// $info['title_id'] = $_POST['title_id'];
			// $this->common_model->insert("tbl_hide_finding_answer", $info);
			// $data['result'] = 1;
				
		}
        //}

        echo json_encode($data);
    }
	
	function insert_collapse_items()
    {
        $data['result'] = 0;
		$info['input_id'] = $_POST['input_id'];
		$info['option_id'] = $_POST['option_id'];
		$info['template_id'] = $_POST['template_id'];
		$info['select_fields_id'] = implode(',' , $_POST['select_fields_id']);
		$info['select_title'] = implode(',' , $_POST['select_title']);
		$this->common_model->insert("tbl_collapse_section", $info);
		$data['result'] = 1;
            

        echo json_encode($data);
    }
	
	function condition_form()
    {
        $data['result'] = 0;
		$exit_data = $this->common_model->get_records("tbl_condition_report", "status='0' and template_id='" . $_POST['template_id'] . "'");
		if (sizeof($exit_data > 0)) 
		{
            $info1['status'] = 1;
            if($this->common_model->update('tbl_condition_report', $info1, "template_id='" . $_POST['template_id'] . "'"))
			{
				$info['condition_name_id'] = $_POST['condition_name_id'];
				$info['condition_name'] = $_POST['condition_name'];
				$info['template_id'] = $_POST['template_id'];
				$info['created_by'] = $_POST['created_by'];
				$this->common_model->insert("tbl_condition_report", $info);
				$data['result'] = 1;
			}
		}
		
        echo json_encode($data);
    }

    function insert_template()
    {	
        // for ($i = 0; $i < sizeof($_POST['option_name']); $i++) {
        // $info['template_form_id'] = $_POST['template_form_id'];
        // $info['label_name'] = $_POST['label_name'][$i];
        // $info['label_id'] = $_POST['label_id'][$i];
        // $info['option_name'] = $_POST['option_name'][$i];
        // $this->common_model->insert("tbl_template_values", $info);
        // $data['result'] = 1;
        // }
        $exit_data = $this->common_model->get_records("tbl_template_values", "status='0' and template_form_id='" . $_POST['template_form_id'] . "' and user_id = '". $_POST['user_id'] ."'");
		
        if (sizeof($exit_data) > 0) {
            $info1['status'] = 1;
            $this->common_model->delete_data('tbl_template_values', "template_form_id='" . $_POST['template_form_id'] . "' and user_id = '". $_POST['user_id'] ."'");
			
			if($_POST['option_name'] != '') {
				for ($i = 0; $i < sizeof($_POST['option_name']); $i++) {
					$info['template_form_id'] = $_POST['template_form_id'];
					$info['user_id'] = $_POST['user_id'];
					if($_POST['date'] != 0) {
						$info['comparison_date'] = $_POST['comparison_date'];
					}
					$new_twemplate = 0;
					if($_POST['new_template'] != '')
					{
						$new_twemplate = 1;
					}
					$info['new_template'] = $new_twemplate;
					$info['techniques'] = $_POST['method'][$i];
					$info['description'] = $_POST['description'][$i];
					$info['contrast'] = $_POST['contrast'][$i];
					$info['clinic_indiction'] = $_POST['clinic_indiction'][$i];
					$info['history'] = $_POST['history'][$i];
					$info['radiation_dose'] = $_POST['radiation_dose'][$i];
					$info['label_name'] = $_POST['label_name'][$i];
					$info['title_id'] = $_POST['title_id'][$i];
					$info['label_id'] = $_POST['label_id'][$i];
					$info['option_name'] = $_POST['option_name'][$i];
					$info['type'] = $_POST['type'][$i];
					$info['collapse_type'] = $_POST['collapse_type'][$i];
					//$info['type_collapse'] = $_POST['type_collapse'];
					$insert_id = $this->common_model->insert("tbl_template_values", $info);
					
						// foreach($this->common_model->get_records("tbl_template_values", "status='0' and id='$insert_id' and option_name != 0") as $var) {
							// foreach($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and assign_id='$_SESSION[userId]' and form_fields_id='$var->label_id' and type='4'")as $demo){
							
								// if($demo->type == 4){
									// $data['record'] = $demo->id;
								// }
							// }
						// }
					$data['temp_id'] = $_POST['template_form_id'];
					$data['type'] = $_POST['type'][0];
					$data['type_collapse'] = $_POST['type_collapse'][0];
					$_SESSION['title_id'] = $_POST['title_id'];
					$data['result'] = 1;
				}
			}

        }
		else
		{
			if($_POST['option_name'] != '') {
				for ($i = 0; $i < sizeof($_POST['option_name']); $i++) {
					$info['template_form_id'] = $_POST['template_form_id'];
					$info['user_id'] = $_POST['user_id'];
					if($_POST['date'] != 0) {
						$info['comparison_date'] = $_POST['comparison_date'];
					}
					$new_twemplate = 0;
					if($_POST['new_template'] != '')
					{
						$new_twemplate = 1;
					}
					$info['new_template'] = $new_twemplate;
					$info['techniques'] = $_POST['method'][$i];
					$info['description'] = $_POST['description'][$i];
					$info['clinic_indiction'] = $_POST['clinic_indiction'][$i];
					$info['history'] = $_POST['history'][$i];
					$info['radiation_dose'] = $_POST['radiation_dose'][$i];
					$info['label_name'] = $_POST['label_name'][$i];
					$info['title_id'] = $_POST['title_id'][$i];
					$info['label_id'] = $_POST['label_id'][$i];
					$info['option_name'] = $_POST['option_name'][$i];
					$info['type'] = $_POST['type'][$i];
					$info['collapse_type'] = $_POST['collapse_type'][$i];
					$insert_id = $this->common_model->insert("tbl_template_values", $info);
					// foreach($insert_id as $insert_ids) {
						// foreach($this->common_model->get_records("tbl_template_values", "status='0' and id='$insert_ids'") as $var) {
							// print_r($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and asign_id='$_SESSION[userId]' and form_field_id='$var->label_id' and type='4'"));
						// }
					// }
					$data['temp_id'] = $_POST['template_form_id'];
					$data['type'] = $_POST['type'][0];
					$data['type_collapse'] = $_POST['type_collapse'][0];
					$_SESSION['title_id'] = $_POST['title_id'];
					$data['result'] = 1;
				}
			}
		}
        echo json_encode($data);
    }

	

    function get_answer_value()
    {
		$template_form_id = $_POST['template_id'];
		$this->global['template_form_id'] = $_POST['template_id'];
		$petcttemplate = $this->common_model->get_records("tbl_category_with_form","status ='0' and id ='$template_form_id'")[0]->child_category_id;
		if($petcttemplate != 130 && $petcttemplate != 131) 
		{
			
			$type = $_POST['type'];
			$type_collapse = $_POST['type_collapse'];
			$this->global['type'] = $_POST['type'];
			$this->global['type_collapse'] = $_POST['type_collapse'];
			$this->global['condition_name'] = $_POST['condition_name'];
			$this->global['option_record'] = $this->common_model->get_records('tbl_template_values', "status='0' and template_form_id ='$template_form_id'");
			$this->global['text_find'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id'");
			$this->load->view("admin/generate_record", $this->global);
		}
		else
		{
			$this->load->view("admin/petct/generate_record", $this->global);
		}
    }

    function update_hide_items()
    {
        $data['result'] = 0;
		if($_POST['table_name'] == "tbl_hide_show_section")
		{
			$option_id = $_POST['row_id'];
			$info['form_fields_id'] = $_POST['form_fields_id'];
			$info['option_id'] = $_POST['option_id'];
			$info['input_id'] = $_POST['input_id'];
			$info['select_fields_id'] = $_POST['select_fields_id'][$i];
			$this->common_model->update("tbl_hide_show_section", $info, "id ='$option_id'");
			$data['result'] = 1;
		}
		elseif($_POST['table_name'] == "tbl_hide_finding_answer")
		{
			$option_id = $_POST['row_id'];
			$info['input_id'] = $_POST['input_id'];
			$info['option_id'] = $_POST['option_id'];
			$info['template_id'] = $_POST['template_id'];
			$info['hide_text_finding'] = $_POST['hide_text_finding'];
			$info['title_id'] = $_POST['title_id'][$i];
			$this->common_model->update("tbl_hide_finding_answer", $info,"id ='$option_id'");
			$data['result'] = 1;
			
		}
        echo json_encode($data);
    }
	
	function update_collapse_items()
    {
        $data['result'] = 0;
        $option_id = $_POST['row_id'];
		$info1['status'] = 1;
		if($this->common_model->update("tbl_collapse_section", $info1,"id ='$option_id'"))
		{
			$info['template_id'] = $_POST['template_id'];
			$info['input_id'] = $_POST['input_id'];
			$info['option_id'] = $_POST['option_id'];
			$info['select_fields_id'] = implode(',' ,$_POST['select_fields_id']);
			$info['select_title'] = implode(',' , $_POST['select_title']);
			$this->common_model->insert("tbl_collapse_section", $info);
			$data['result'] = 1;
		}

        echo json_encode($data);
    }

    function insert()
    {
		
		foreach ($_POST as $key => $value) {
			if ($key != 'table_name' && $key != 'row_id') {
				if ($key == 'slug') {
					if (strlen($value) > 0) {
						$info[$key] = $this->slugify($value);
					} else {
						$info[$key] = $this->slugify($this->input->post('name'));
					}
				} else {
					if(is_array($_POST[$key]))
					{
						$info[$key] = "";
						foreach ($_POST[$key] as $key1 => $value1) 
						{
							$info[$key] .= $value1 . ",";
						}
					}
					else
					{
						$info[$key] = $value;
					}
				}
			}
		}

		$table = $this->input->post('table_name');

		$folder_name = "common";

		foreach ($_FILES as $key => $value) {
			if (is_array($_FILES[$key]['name'])) {
				$info[$key] = "";
				$incc = 0;
				while ($incc < sizeof($_FILES[$key]['name'])) {
					if ($_FILES[$key]['error'][$incc] != 4) {
						$file_new_name = date('Ydm') . time() . uniqid() . "." . strtolower(pathinfo($_FILES[$key]["name"][$incc], PATHINFO_EXTENSION));
						if ($this->multiple_images_upload($key, $file_new_name, 'uploads/' . $folder_name . '/', $incc) == true) {
							$info[$key] .= $file_new_name . ",";
						}
					}
					$incc++;
				}
			} else {
				foreach ($_FILES as $key => $value) {
					$file_new_name = date('Ydm') . time() . uniqid() . "." . strtolower(pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION));

					if ($this->image_upload($key, $file_new_name, 'uploads/' . $folder_name . '/') == true) {
						$info[$key] = $file_new_name;
					}
				}
			}
		}

		if ($insert_id = $this->common_model->insert($table, $info)) {
			$data['result'] = 1;
			$data['insert_id'] = $insert_id;
		} else {
			$data['result'] = 0;
		}
		
        echo json_encode($data);
    }

    function update()
    {
        
            $info = array();
            foreach ($_POST as $key => $value) {
                if ($key != 'table_name' && $key != 'row_id') {
                    if ($key == 'slug') {
                        if (strlen($value) > 0) {
                            $info[$key] = $this->slugify($value);
                        } else {
                            $info[$key] = $this->slugify($this->input->post('name'));
                        }
                    } else {
						if(is_array($_POST[$key]))
						{
							$info[$key] = "";
							foreach ($_POST[$key] as $key1 => $value1) 
							{
								$info[$key] .= $value1 . ",";
							}
						}
						else
						{
							if($_POST['table_name'] != 'tbl_title_answer_master' && $_POST['table_name'] != 'tbl_hide_finding_answer' && $_POST['table_name'] != 'tbl_petct_template')
							{
								
								$info[$key] = htmlentities($value);
							}
							else
							{
								
								$info[$key] = $value;
							}
						}
						
                    }
                }
            }

            $table = $this->input->post('table_name');
            $row_id = $this->input->post('row_id');

            $folder_name = "common";

            foreach ($_FILES as $key => $value) {
                if (is_array($_FILES[$key]['name'])) {
                    $info[$key] = "";
                    $incc = 0;
                    while ($incc < sizeof($_FILES[$key]['name'])) {
                        if ($_FILES[$key]['error'][$incc] != 4) {
                            $file_new_name = date('Ydm') . time() . uniqid() . "." . strtolower(pathinfo($_FILES[$key]["name"][$incc], PATHINFO_EXTENSION));
                            if ($this->multiple_images_upload($key, $file_new_name, 'uploads/' . $folder_name . '/', $incc) == true) {
                                $info[$key] .= $file_new_name . ",";
                            }
                        }
                        $incc++;
                    }

                    if ($info[$key] == "") {
                        unset($info[$key]);
                    }
                } else {
                    foreach ($_FILES as $key => $value) {
                        $file_new_name = date('Ydm') . time() . uniqid() . "." . strtolower(pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION));

                        if ($this->image_upload($key, $file_new_name, 'uploads/' . $folder_name . '/') == true) {
                            $info[$key] = $file_new_name;
                        }
                    }
                }
            }

            if ($this->common_model->update($table, $info, "id = '" . $row_id . "'")) {
                $data['result'] = 1;
            } else {
                $data['result'] = 0;
            }
        echo json_encode($data);
    }

    function get_record($table, $row_id)
    {
        $data['result'] = 0;
        $select = "*";
        $where = "id = '$row_id'";
        $query = "select " . $select . " from " . $table . " where " . $where;

        $records = $this->common_model->get_custom_query($query);
        if (sizeof($records) > 0) {
            $data['data'] = $records[0];
            $data['result'] = 1;
        }

        echo json_encode($data);
    }

    function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    function image_upload($atr_name, $file_new_name, $target_dir)
    {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES[$atr_name]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $file_new_name;
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "PDF" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "DOCX") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($_FILES[$atr_name]["tmp_name"], $target_file)) {
                return true;
            } else {
                return false;
            }
        }
    }

    function multiple_images_upload($atr_name, $file_new_name, $target_dir, $incc)
    {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES[$atr_name]["name"][$incc], PATHINFO_EXTENSION));
        $target_file = $target_dir . $file_new_name;
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "ico" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "ICO") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($_FILES[$atr_name]["tmp_name"][$incc], $target_file)) {
                return true;
            } else {
                return false;
            }
        }
    }

    function indian_currency($amount, $o = '')
    {
        if ($amount == "") {
            return 0;
        }
        return money_format('%!i', $amount);
    }

    function is_all_ok($id, $arr)
    {
        $inc = 0;
        foreach ($arr as $key => $val) {
            if ($this->common_model->get_record("tbl_employees", "id=$id", $val) == "") {
                $inc++;
                break;
            }
        }

        if ($inc == 0) {
            return true;
        }
        return false;
    }
	
	public function document($id)
    {
        $this->global['pageTitle'] = 'document : ' . $this->config->item('app_name');
		$this->global['id'] = $id;
        $this->loadViews("document", $this->global, NULL, NULL);
    }
	
	public function add_collapse_main($template_id, $id)
    {
        $this->global['pageTitle'] = 'Collapse Fields : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template_id'] = $template_id;
        $this->global['all_inputs_sub'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type=16");
		$this->global['all_inputs_child'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type=17");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
        $this->global['records'] = $this->common_model->get_records('tbl_collapse_section_main', "status='0' and input_id='$id' and template_id='$template_id'");
        $this->global['template_name'] = $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$template_id'", "name");
        $this->loadViews("form-template-module/collapse-main-page", $this->global, NULL, NULL);
    }
	
	public function add_collapse_sub($template_id, $id)
    {
        $this->global['pageTitle'] = 'Collapse Fields : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template_id'] = $template_id;
        //$this->global['all_inputs_sub'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type=17");
		$this->global['all_inputs_child'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' ");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
        $this->global['records'] = $this->common_model->get_records('tbl_collapse_section_sub', "status='0' and input_id='$id' and template_id='$template_id'");
        $this->global['template_name'] = $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$template_id'", "name");
        $this->loadViews("form-template-module/collapse-sub-page", $this->global, NULL, NULL);
    }
	
	public function edit_collapse_main() 
	{
		$this->global['row_id'] = $_POST['row_id'];
		$row_id = $_POST['row_id'];
		$this->global['row_id'] = $_POST['row_id'];
		$template_id = $_POST['template_id'];
		$this->global['template_id'] = $_POST['template_id'];
		$id = $_POST['input_id'];
		$this->global['input_id'] = $_POST['input_id'];
		$this->global['all_inputs_sub'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type='16'");
		$this->global['all_inputs_child'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type='17'");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
		$this->global['records'] = $this->common_model->get_records('tbl_collapse_section', "status='0' and id='$row_id'")[0];
		
        $this->load->view("admin/form-template-module/edit-collapse-page-main", $this->global);
    }
	
	public function edit_collapse_sub() 
	{
		$this->global['row_id'] = $_POST['row_id'];
		$row_id = $_POST['row_id'];
		$this->global['row_id'] = $_POST['row_id'];
		$template_id = $_POST['template_id'];
		$this->global['template_id'] = $_POST['template_id'];
		$id = $_POST['input_id'];
		$this->global['input_id'] = $_POST['input_id'];
		//$this->global['all_inputs_sub'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type='16'");
		$this->global['all_inputs_child'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id !='$id' and template_form_id = '$template_id' and type='17'");
        $this->global['check_options'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and id ='$id'");
		$this->global['records'] = $this->common_model->get_records('tbl_collapse_section', "status='0' and id='$row_id'")[0];
		
        $this->load->view("admin/form-template-module/edit-collapse-page-sub", $this->global);
    }
	
	function insert_collapse_items_main()
    {
        $data['result'] = 0;
		$info['input_id'] = $_POST['input_id'];
		$info['option_id'] = $_POST['option_id'];
		$info['template_id'] = $_POST['template_id'];
		$info['select_fields_id_sub'] = implode(',' , $_POST['select_fields_id_sub']);
		//$info['select_fields_id_child'] = implode(',' , $_POST['select_fields_id_child']);
		$info['select_title'] = implode(',' , $_POST['select_title']);
		$this->common_model->insert("tbl_collapse_section_main", $info);
		$data['result'] = 1;
            

        echo json_encode($data);
    }
	
	function insert_collapse_items_sub()
    {
        $data['result'] = 0;
		$info['input_id'] = $_POST['input_id'];
		$info['option_id'] = $_POST['option_id'];
		$info['template_id'] = $_POST['template_id'];
		//$info['select_fields_id_sub'] = implode(',' , $_POST['select_fields_id_sub']);
		$info['select_fields_id_child'] = implode(',' , $_POST['select_fields_id_child']);
		$info['select_title'] = implode(',' , $_POST['select_title']);
		$this->common_model->insert("tbl_collapse_section_sub", $info);
		$data['result'] = 1;
            

        echo json_encode($data);
    }
	
	function update_collapse_items_main()
    {
        $data['result'] = 0;
        $option_id = $_POST['row_id'];
		$info1['status'] = 1;
		if($this->common_model->update("tbl_collapse_section_main", $info1,"id ='$option_id'"))
		{
			$info['template_id'] = $_POST['template_id'];
			$info['input_id'] = $_POST['input_id'];
			$info['option_id'] = $_POST['option_id'];
			$info['select_fields_id_sub'] = implode(',' ,$_POST['select_fields_id_sub']);
			//$info['select_fields_id_child'] = implode(',' ,$_POST['select_fields_id_child']);
			$info['select_title'] = implode(',' , $_POST['select_title']);
			$this->common_model->insert("tbl_collapse_section_main", $info);
			$data['result'] = 1;
		}

        echo json_encode($data);
    }
	
	function update_collapse_items_sub()
    {
        $data['result'] = 0;
        $option_id = $_POST['row_id'];
		$info1['status'] = 1;
		if($this->common_model->update("tbl_collapse_section_sub", $info1,"id ='$option_id'"))
		{
			$info['template_id'] = $_POST['template_id'];
			$info['input_id'] = $_POST['input_id'];
			$info['option_id'] = $_POST['option_id'];
			//$info['select_fields_id_sub'] = implode(',' ,$_POST['select_fields_id_sub']);
			$info['select_fields_id_child'] = implode(',' ,$_POST['select_fields_id_child']);
			$info['select_title'] = implode(',' , $_POST['select_title']);
			$this->common_model->insert("tbl_collapse_section_sub", $info);
			$data['result'] = 1;
		}

        echo json_encode($data);
    }
	
	public function petct_template()
    {
        $this->global['pageTitle'] = 'PET CT Text Page : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_petct_template', "status='0'");
        $this->loadViews("petct-template", $this->global, NULL, NULL);
    }
	
	public function edit_petct_template()
	{
		$this->global['id'] = $_POST['id'];
		$this->global['record'] = $this->common_model->get_records("tbl_petct_template", "id = '" . $_POST['id'] . "' and status = '0'")[0];

		$this->load->view("admin/edit-petct-template", $this->global);
	}
	
	public function validateDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	 
	public function add_petct_select_options($id,$template_id)
    {
		
        $this->global['pageTitle'] = 'Form Select Option Multiple : ' . $this->config->item('app_name');
        $this->global['input_id'] = $id;
        $this->global['template'] = $template_id;
        $this->global['records'] = $this->common_model->get_records("tbl_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id'");
        $this->global['copy_options'] = $this->common_model->get_records("tbl_copy_input_options", "status = '0' and template_form_id = '$id' and input_id='$template_id' and assign_id = '". $_SESSION['userId'] . "'");
        $this->global['form_records'] = $this->common_model->get_records("tbl_form_template_fields", "status = '0' and template_form_id = '$id' and id='$template_id'")[0];
		$this->global['copy_form_records'] = $this->common_model->get_records("tbl_admin_copy_template_fields", "status = '0' and copy_template_form_id = '$id' and form_fields_id='$template_id' and assign_id = '".$_SESSION['userId']."'")[0];
        $this->loadViews("petct/select-option", $this->global, NULL, NULL);
    }
	
	public function gettitle()
	{
		$this->global['id'] = $_POST['id'];
		$this->global['record'] = $this->common_model->get_records('tbl_title_answer_master', "status='0' and id='".$_POST['id']."'")[0];
		$this->load->view("admin/edit-tittle-answer-master", $this->global);
	}
	
	public function collapse_join()
    {
		
        $this->global['pageTitle'] = 'collapse_join : ' . $this->config->item('app_name');
        $this->global['records'] = $this->common_model->get_records('tbl_collapse_join_impression', "status='0' order by id desc");
        $this->loadViews("collapse/select-option", $this->global, NULL, NULL);
    }
	
	public function collapse_main()
	{
		$this->global['template_id'] = $_POST['template_id'];
		$this->global['record'] = $this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='".$_POST['template_id']."' and type='15'");
		
		$this->load->view("admin/collapse/collapse-main", $this->global);
	}
	
	public function collapse_sub()
	{
		$this->global['template_id'] = $_POST['template_id'];
		$this->global['collapse_main'] = $_POST['collapse_main'];
		$this->global['record'] = $this->common_model->get_records('tbl_collapse_section_main', "status='0' and template_id='".$_POST['template_id']."' and input_id='".$_POST['collapse_main']. "'")[0];
		
		$this->load->view("admin/collapse/collapse-sub", $this->global);
	}
	
	public function collapse_child()
	{
		$this->global['template_id'] = $_POST['template_id'];
		$this->global['collapse_sub'] = $_POST['collapse_sub'];
		$this->global['record'] = $this->common_model->get_records('tbl_collapse_section_sub', "status='0' and template_id='".$_POST['template_id']."' and input_id='".$_POST['collapse_sub']. "'")[0];
		
		$this->load->view("admin/collapse/collapse-child", $this->global);
	}
	
	function insert_data_collapse_main()
    {
        $data['result'] = 0;
		
		for($i=0;$i<sizeof($_POST['collapse_child']);$i++)
		{
			$info['template_id'] = $_POST['template_id'];
			$info['collapse_main'] = $_POST['collapse_main'];
			$info['collapse_sub'] = $_POST['collapse_sub'];
			$info['collapse_child'] = $_POST['collapse_child'][$i];
			$info['title_id'] = $this->common_model->get_record("tbl_form_template_fields","id='".$_POST['collapse_child'][$i]."'","title");
			$this->common_model->insert("tbl_collapse_join_impression", $info);
		}
		
		$data['result'] = 1;
            

        echo json_encode($data);
    }
	
	public function edit_collapse_join()
	{
		$this->global['id'] = $_POST['id'];
		$this->global['record'] = $this->common_model->get_records("tbl_collapse_join_impression", "id = '" . $_POST['id'] . "' and status = '0'")[0];

		$this->load->view("admin/collapse/edit-collapse-join", $this->global);
	}
	
	function get_answer_search()
    {
        $id = $_POST['id'];
        $template_id = $_POST['template_id'];
		$this->global['id']  = $id; 
		$this->global['template_id']  = $template_id; 
		// $id = 15625;
		// $this->global['id']  = 15625;
        $this->global['record'] = $this->common_model->get_records("tbl_admin_copy_template_fields","status=0 and assign_id='".$_SESSION['userId']."' and copy_template_form_id = '$template_id' and  form_fields_id='$id'")[0];
        
        $this->load->view("admin/generate_search_record", $this->global);
    }
	
	function get_collapse_id()
    {
        $id = $_POST['id'];
        $template_id = $_POST['template_id'];
		
		$main_collapse = $this->common_model->get_records("tbl_collapse_section_main","status =0 and template_id = '$template_id' and input_id='$id'");
		if(sizeof($main_collapse) == 0)
		{
			$sub_collapse = $this->common_model->get_records("tbl_collapse_section_sub","status =0 and template_id = '$template_id' and input_id='$id'");
			if(sizeof($sub_collapse) == 0)
			{
				$child_collapse = $this->common_model->get_records("tbl_collapse_section_sub","status =0 and template_id  = '$template_id' and find_in_set('$id',select_fields_id_child)")[0];
				$data['sub_result'] = $child_collapse->id;
				$data['main_result'] = $this->common_model->get_records("tbl_collapse_section_main","status =0 and template_id  = '$template_id' and find_in_set('$child_collapse->input_id',select_fields_id_sub)")[0]->id;
			}
			else
			{
				
				$data['sub_result'] = $sub_collapse[0]->id;
			}
			if(sizeof($this->common_model->get_records("tbl_collapse_section_main","status =0 and template_id  = '$template_id' and find_in_set('$id',select_fields_id_sub)")) != 0)
			{
				$data['main_result'] = $this->common_model->get_records("tbl_collapse_section_main","status =0 and template_id  = '$template_id' and find_in_set('$id',select_fields_id_sub)")[0]->id;
			}
		}
		else
		{
			$data['main_result'] = $main_collapse[0]->id;
		}
		echo json_encode($data);
    } 
	
	public function record()
    {
        $this->global['pageTitle'] = 'Record : ' . $this->config->item('app_name');

        $this->loadViews("record/index", $this->global, NULL, NULL);
    }
	
	public function main_answer_heading()
    {
        $this->global['pageTitle'] = '  Main Heading : ' . $this->config->item('app_name');

        $this->global['records'] = $this->common_model->get_records("tbl_main_answer_heading", "status = '0' order by id desc");

        $this->loadViews("masters/main-answer-heading", $this->global, NULL, NULL);
    }
	
	function insert_main_answer_data()
    {
        $data['result'] = 0;
		
		for($i=0;$i<sizeof($_POST['template_id']);$i++)
		{
			$info['template_id'] = $_POST['template_id'][$i];
			$info['answer_text1'] = $_POST['answer_text1'];
			$info['answer_text2'] = $_POST['answer_text2'];
			$this->common_model->insert("tbl_main_answer_heading", $info);
		}
		
		$data['result'] = 1;
            

        echo json_encode($data);
    }
}
