<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Cron extends BaseController
{

    public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        $this->load->model('admin/common_model');
        $this->global['tis'] = $this;
    }

	
	function cron_job()
    {
		
		$this->common_model->delete_data("tbl_template_assign","(status =0 or status = 1)");
        $this->common_model->delete_data("tbl_admin_copy_template_fields","(status =0 or status = 1)");
        $this->common_model->delete_data("tbl_copy_input_options","(status =0 or status = 1)");
        $this->common_model->delete_data("tbl_copy_main_title","(status =0 or status = 1)");
       
        $this->common_model->delete_data("tbl_template_logs","(status =0 or status = 1)");
        $this->common_model->delete_data("tbl_template_values","(status =0 or status = 1)");
	
		$this->assigned_template_admin();
    }
	
	function assigned_template_admin()
    {
		$template_id = $this->common_model->get_records('tbl_category_with_form', "status='0'");
		foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='3'") as $admin)
		{
			for ($k = 0; $k < sizeof($template_id); $k++) 
			{
				$info['template_id'] = $template_id[$k]->id;
				$info['assigned_from'] = 2;
				$info['assigned_to'] = $admin->userId;
				$info['group_id'] = 1;
				$table_name = "tbl_template_assign";
				$this->common_model->insert($table_name, $info);
			
				foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$admin->userId' and created_by ='2' and template_id='". $template_id[$k]->id. "'") as $assign_id)
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
					foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$assign_id->template_id'") as $exit_template) {
						for ($i = 0; $i < sizeof($exit_template->id); $i++) {
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
		$this->assigned_template_admin_scribe();
		
    }
	
	public function assigned_template_admin_scribe()
    {
		$data['result'] = 0;
		foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='3'") as $admin)
		{
			$template_id = $this->common_model->get_records('tbl_template_assign', "status='0' and  assigned_to='$admin->userId'");
			foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='4' and createdBy ='".$admin->userId."'") as $admin_scribe)
			{
				$assign_to_id = $admin_scribe->userId;
				for ($p = 0; $p < sizeof($template_id); $p++) 
				{
					$info['template_id'] = $template_id[$p]->template_id;
					$info['assigned_from'] = $admin->userId;
					$info['assigned_to'] = $admin_scribe->userId;
					$info['group_id'] = 2;
					$table_name = "tbl_template_assign";
					$this->common_model->insert($table_name, $info);
					foreach($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='$assign_to_id' and created_by ='".$admin->userId."' and template_id='". $template_id[$p]->template_id. "'") as $assign_id)
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
		$data['result'] = 1;
            

        echo json_encode($data);
    }
}
