<?php if ($role == ROLE_RAD_ADMIN || $role == ROLE_SUPER_ADMIN) : ?>
<div id="div1" >
	<div class="col-md-6">
		<h3 class="temp">FINDINGS</h3> 
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content1" class="impressions_text text-box-border">
			<div id="content3">
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history");
					$radiation_dose = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose");
					$description = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description");
					$clinic_indications = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction"); 
					$new_template = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","new_template"); 
					$contrast = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast"); 
				if($date != ""):
				?>
				<b>HISTORY: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php if($new_template == 1):?>
					<?php if($description != ""):?>
						<b>TEMPLATE NAME: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description")?><br><br>
					<?php else: ?>
						<b>TEMPLATE NAME: </b><br><br>
					<?php endif?>
					<?php if($description != ""):?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php else: ?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php endif?>
					<?php if($clinic_indications != ""):?>
						<b>CLINICAL INDICATION: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction")?><br><br>
					<?php else: ?>
						<b>CLINICAL INDICATION: </b><br><br>
					<?php endif?>
				<?php endif?>
				
				<b>TECHNIQUE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","techniques")?><br><br>
				<?php if($contrast != ""):?>
					<b>CONTRAST: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date");
					
				if($date != "0000-00-00"):
				?>
					<b>COMPARISON: </b> <?= date("m-d-Y", strtotime($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date")))?><br><br>
				<?php else: ?>
					<b>COMPARISON:</b> None available</br></br>
				<?php endif?>
				<?php if($radiation_dose != ""):?>
					<b>RADIATION DOSE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				
				<?php 
					$finding_text = "FINDINGS";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$finding_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text1"));
					}
				?>
				<b><?=$finding_text?>:</b><br>
				
					<?php 
						//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
					?>
					<?php 
						$answer_id = array();
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_input_options as b , tbl_form_template_fields as c where a.option_name = b.id and b.input_id = c.id and c.template_form_id = '$template_form_id' and a.option_name != '' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template) 
						{ 
							$answer_id[] = $template->form_fields_id;
						}
						$answer_id1 = array();
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_input_options as b , tbl_form_template_fields as c where a.option_name = b.id and b.input_id = c.id and c.template_form_id = '$template_form_id' and a.option_name = '' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template1) 
						{ 
							$answer_id1[] = $template1->form_fields_id;
						}
						
						
						$answer_option = array();
						$missing = array();
						$missing_1 = array();
						foreach ($this->common_model->get_records('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' and user_id = '". $_SESSION['userId']. "'") as $template_answer) 
						{
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
							if(sizeof($this->common_model->get_records('tbl_input_options', "status='0' and id='$template_answer->option_name' and template_form_id ='$template_form_id'")) == 0)
							{
								$answer_option[] = $template_answer->option_name;
								$answer_id[] = $this->common_model->get_record("tbl_form_template_fields","status=0 and id='$template_answer->label_id'","form_fields_id");
							}
							else
							{
								foreach ($this->common_model->get_records('tbl_input_options', "status='0' and id='$template_answer->option_name' and template_form_id ='$template_form_id'") as $template_value) 
								{ 
									
									$missing[] = $template_value->finding_text;
									
									if($template_value->finding_text == "")
									{
										if(sizeof($title_answer) > 0) 
										{
											$answer_option[] = $template_value->name;
										}
										
									}
									else
									{
										$answer_option[] = $template_value->finding_text;
									}
								}
							}
							
						}
						$answer_id1 = array();
						$answer_find=array();
						$not=array();
						$all=array();
						$data_find2 =array();
						$data_find3 =array();
						$data_find4 =array();
						$data_find5 =array();
						$formfields =$this->common_model->get_records("tbl_form_template_fields","status = 0 and template_form_id ='$template_form_id' and title != '0' group by order_by");
						$i = 0;
						foreach($formfields as $form)
						{
							if($form->type == 13 || $form->type == 14 ) 
							{
								
								
								$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
								
								
								$collapse = explode("," , $collapse_section->select_fields_id);
								$collapse_title = explode("," , $collapse_section->select_title);
								$selected1 = array();
								foreach($collapse_title as $title_collapse)
								{
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id = '". $_SESSION['userId'] . "'") as $select)
									{
										$selected1[] = $select->label_id;
									}

								}
								$selected12 = array();
								foreach($collapse_title as $title_collapse)
								{
									$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id = '". $_SESSION['userId'] . "'")[0];
								
									$selected12[] = $select->label_id;
								}
								
								$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
								$all_new = array();
								foreach($selected1 as $selected_all)
								{
									$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
									
								}
								$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='14' and user_id = '" . $_SESSION['userId'] . "'","label_id");
								$notselected = array_diff($collapse,$selected1);
								
								if(sizeof($all_new) == 0 )
								{
									
									$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name = ' ' and user_id = '".$_SESSION['userId']."'","title_id");
									$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
									$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
								}
								else
								{ 
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
									
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
									{
										
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
										{
											$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
										}
									}
									$data = array();
									$data1 = array();
									foreach($selected12 as $sel)
									{
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
										foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
										{
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
													{
														//$answer_find[]=$title_answer->finding_text;
														$data1[] = array("value"=>$title_answer->finding_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
													}
												}
												
											}
											else
											{
												
												$data[] = array("value"=>$option_find->finding_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
												
												// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data), SORT_ASC, $data);
												  
												//print_r($data);
												//$answer_find[]= $data;
											}
											
										}
										
									}
									// $data1 = array();
									// foreach($notselected as $not)
									// {
										
										// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
										
										// //$answer_find[]=$alltitle->finding_collapse;
										// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
										
										  
										// //print_r($data1);
									// }
									$data2=array_merge($data, $data1);
									
									array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data2), SORT_ASC, $data2);
									  
									  foreach($data2 as $answer_finding)
									  {
										 $answer_find[] = $answer_finding['value'];
									  }
									//print_r($answer_find); 
								}
								
							}  
							// elseif($form->type == 15 ) 
							// {
									
								// if($form->type == 17)
								// {
									// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
									
									// $collapse = explode("," , $collapse_section->select_fields_id_child);
									// $collapse_title = explode("," , $collapse_section->select_title);
									// $selected1 = array();
									// foreach($collapse_title as $title_collapse)
									// {
										// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'") as $select)
										// {
											// $selected1[] = $select->label_id;
										// }

									// }
									// $selected12 = array();
									// foreach($collapse_title as $title_collapse)
									// {
										// $select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'")[0];
									
										// $selected12[] = $select->label_id;
									// }
									
									// $collapse1 = explode("," , $collapse_section->select_fields_id)[0];
									// $all_new = array();
									// foreach($selected1 as $selected_all)
									// {
										// $all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='17' and user_id = '" . $_SESSION['userId'] . "'")[0];
										
									// }
									// $select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='17' and user_id = '" . $_SESSION['userId'] . "'","label_id");
									// $notselected = array_diff($collapse,$selected1);
									// if($form->title != 0)
									// {
										// $template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
										
										// //$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
										
										// foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
										// {
											
											// if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
											// {
												
												
												// // if($hide_finding_answer->input_id == $template_values_hide->label_id)
												// // {
													
													// if($form->title != 0)
													// {
														// $hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
														// $hide_answer_master = $hide_answer_find->title_id;
														// $answer_find[] = $hide_answer_find->hide_text_finding;
													// }
												// // }
												// // else
												// // {
													
													// // if($form->title != 0)
													// // {
														// // $hide_answer_master = 0;
														
													// // }
												// // }
											// }
										// }
									// }
									// if(sizeof($all_new) == 0 )
									// {
										
										// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name =' ' and user_id = '".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec' and title_id != '$hide_answer_master'")[0];
										
										// $answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
									// }
									// else
									// { 
										// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
										
										// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
										// {
											
											// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
											// {
												// $answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
											// }
										// }
										// $data = array();
										// $data1 = array();
										// foreach($selected12 as $sel)
										// {
											// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
											// foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
											// {
												// if($option_find->finding_text == "")
												// {
													// if($form->title != 0)
													// {
														// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
														// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
														// {
															// //$answer_find[]=$title_answer->finding_text;
															// $data1[] = array("value"=>$title_answer->finding_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
														// }
													// }
													
												// }
												// else
												// {
													
													// $data[] = array("value"=>$option_find->finding_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
													
													// // array_multisort(array_map(function($element) {
														  // // return $element['order'];
													  // // }, $data), SORT_ASC, $data);
													  
													// //print_r($data);
													// //$answer_find[]= $data;
												// }
												
											// }
											
										// }
										// // $data1 = array();
										// // foreach($notselected as $not)
										// // {
											
											// // $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
											// // $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
											
											// // //$answer_find[]=$alltitle->finding_collapse;
											// // $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
											
											  
											// // //print_r($data1);
										// // }
										// $data2=array_merge($data, $data1);
										
										// array_multisort(array_map(function($element) {
												  // return $element['order'];
											  // }, $data2), SORT_ASC, $data2);
										  
										  // foreach($data2 as $answer_finding)
										  // {
											 // $answer_find[] = $answer_finding['value'];
										  // }
										// //print_r($answer_find);
									// }
								// }
								// elseif($form->type == 16)
								// {
									// $collapse_section = $this->common_model->get_records("tbl_collapse_section_main","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
									
									// $collapse = explode("," , $collapse_section->select_fields_id_child);
									// $collapse_title = explode("," , $collapse_section->select_title);
									// $selected1 = array();
									// foreach($collapse_title as $title_collapse)
									// {
										// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'") as $select)
										// {
											// $selected1[] = $select->label_id;
										// }

									// }
									// $selected12 = array();
									// foreach($collapse_title as $title_collapse)
									// {
										// $select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'")[0];
									
										// $selected12[] = $select->label_id;
									// }
									
									// $collapse1 = explode("," , $collapse_section->select_fields_id)[0];
									// $all_new = array();
									// foreach($selected1 as $selected_all)
									// {
										// $all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='17' and user_id = '" . $_SESSION['userId'] . "'")[0];
										
									// }
									// $select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='17' and user_id = '" . $_SESSION['userId'] . "'","label_id");
									// $notselected = array_diff($collapse,$selected1);
									// if($form->title != 0)
									// {
										// $template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
										
										// //$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
										
										// foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
										// {
											
											// if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
											// {
												
												
												// // if($hide_finding_answer->input_id == $template_values_hide->label_id)
												// // {
													
													// if($form->title != 0)
													// {
														// $hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
														// $hide_answer_master = $hide_answer_find->title_id;
														// $answer_find[] = $hide_answer_find->hide_text_finding;
													// }
												// // }
												// // else
												// // {
													
													// // if($form->title != 0)
													// // {
														// // $hide_answer_master = 0;
														
													// // }
												// // }
											// }
										// }
									// }
									// if(sizeof($all_new) == 0 )
									// {
										
										// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name = ' ' and user_id = '".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec' and title_id != '$hide_answer_master'")[0];
										
										// $answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
									// }
									// else
									// { 
										// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
										
										// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
										// {
											
											// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
											// {
												// $answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
											// }
										// }
										// $data = array();
										// $data1 = array();
										// foreach($selected12 as $sel)
										// {
											// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
											// foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
											// {
												// if($option_find->finding_text == "")
												// {
													// if($form->title != 0)
													// {
														// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
														// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
														// {
															// //$answer_find[]=$title_answer->finding_text;
															// $data1[] = array("value"=>$title_answer->finding_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
														// }
													// }
													
												// }
												// else
												// {
													
													// $data[] = array("value"=>$option_find->finding_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
													
													// // array_multisort(array_map(function($element) {
														  // // return $element['order'];
													  // // }, $data), SORT_ASC, $data);
													  
													// //print_r($data);
													// //$answer_find[]= $data;
												// }
												
											// }
											
										// }
										// // $data1 = array();
										// // foreach($notselected as $not)
										// // {
											
											// // $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
											// // $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
											
											// // //$answer_find[]=$alltitle->finding_collapse;
											// // $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
											
											  
											// // //print_r($data1);
										// // }
										// $data2=array_merge($data, $data1);
										
										// array_multisort(array_map(function($element) {
												  // return $element['order'];
											  // }, $data2), SORT_ASC, $data2);
										  
										  // foreach($data2 as $answer_finding)
										  // {
											 // $answer_find[] = $answer_finding['value'];
										  // }
										// //print_r($answer_find);
									// }
								// }
								
							// }
							else
							{
								$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and option_name = '' and user_id = '". $_SESSION['userId']. "'");
								$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id = '". $_SESSION['userId']. "'");
								if($form->title != 0)
								{
									$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									{
										if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '' and user_id='".$_SESSION['userId']."'")) != 0)
										{
											
											if($hide_finding_answer->input_id == $template_values_hide->label_id)
											{
												
												if($form->title != 0)
												{
													$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													$hide_answer_master = $hide_answer_find->title_id;
													$answer_find[] = $hide_answer_find->hide_text_finding;
												}
											}
											else
											{
												
												if($form->title != 0)
												{
													$hide_answer_master = 0;
													
												}
											}
										}
									}
								}
								
								
								if(sizeof($not_selected) == sizeof($all))
								{
									if($form->title != 0)
									{
									   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
									   //$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
											$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
											
									}
								}
								else
								{
							
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id='$form->title' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id")as $selected)
									{
										if(sizeof($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected->option_name' and template_form_id ='$template_form_id'")) == 0)
										{
											foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")as $title_answer)
											{
												$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
											}
										} 
										else
										{
											foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected->option_name'")as $option_find)
											{
												
												if($option_find->finding_text == "")
												{
													if($form->title != 0)
													{
														foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")as $title_answer)
														{
															$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
														}
													}
													
												}
												else
												{
													$answer_find[]=$option_find->finding_text."$#".$option_find->template_order_number;
												}
												
											}
										}
										
									}
								}
								
								$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id = c.id and c.template_form_id ='$template_form_id' and a.option_name = '' and c.status='0' and a.status='0'  and a.user_id = '". $_SESSION['userId']. "'");
								
								foreach($test1 as $t)
								{
									$answer_id1[] =$t->form_fields_id;
									
								}
							}
							$i++;
						}
						//print_r($answer_find);
						
						$final_result = str_replace($answer_id, $answer_option, $answer_find);
						$final_result1 = str_replace($answer_id1, "" , $final_result);
						// $final_result2 = str_replace(". ", "." , $final_result1);
						// $final_result3 = str_replace(".", ". " , $final_result2);
						// $final_result4 = str_replace(",", ", " , $final_result3);
						
						$j= 0;
						
						$data10 = array();
						foreach(array_unique($final_result1) as $final)
						{
							
							$number = explode("$#",$final); // return 1234
							$ordernumber = preg_replace("/[^0-9 .]/", "",$number[1]);
							//$letters = str_replace($number, "" , $final);
							//$letters = str_replace(' ', "" , $number[1]);
							$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
							//echo $final;
							$j++;
							
						}
						// foreach($data10  as $final1)
						// {
							// print_r($final1['order']);
						// }
						
						array_multisort(array_map(function($element) {
							  return $element['order'];
						  }, $data10),SORT_ASC, $data10);
						  
						foreach($data10  as $final1)
						{
							// print_r($final1['value']);
							//print_r($final1['order']);
							// echo "<br>";
							//print_r($final1);
							if($final1['value'] != '')
							{
								echo $final1['value']." ";
							}
							
						}
					?>
					<?php //} else { ?>
						<?php 
							//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
						?>
							<?php 
								//echo 1 .". " ;
								//echo $empty_result->finding_text  
							?>
						
					<?php// } ?>
				</div>
			</div>
			
	</div>

	<div class="col-md-6">
		<h3 class="temp">IMPRESSION</h3>
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
			<div contentEditable="true" id="content2" class="text-box-border">
				<div id="content4" >
				<?php 
					$impressison_text = "IMPRESSION";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$impressison_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text2"));
					}
				?>
				<br><b><?=$impressison_text?>:</b> <br>
					<?php 
						//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
					?>
						<?php 
							$answer_id_imp = array();
							foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id = c.id and c.template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != 0  and c.status='0' and a.status='0'  and a.user_id = '". $_SESSION['userId']. "'") as $template) 
							{ 
								$answer_id_imp[] = $template->form_fields_id;
							}
							$answer_id1_imp = array();
							foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_input_options as b , tbl_form_template_fields as c where a.option_name = b.id and b.input_id = c.id and c.template_form_id = '$template_form_id' and a.option_name = '' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template1) 
							{ 
								$answer_id1_imp[] = $template1->form_fields_id;
							}
							
							
							$answer_option_imp = array();
							$missing = array();
							$missing_1 = array();
							//$score = array();
							//$score = 0;
							foreach ($this->common_model->get_records('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name !='' and user_id = '". $_SESSION['userId']. "'") as $template_answer) 
							{
								$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
								if(sizeof($this->common_model->get_records('tbl_input_options', "status='0' and id='$template_answer->option_name' and template_form_id ='$template_form_id'")) == 0)
								{
									$answer_option_imp[] = $template_answer->option_name;
									$answer_id_imp[] = $this->common_model->get_record("tbl_form_template_fields","status=0 and id='$template_answer->label_id'","form_fields_id");
								}
								else
								{
									foreach ($this->common_model->get_records('tbl_input_options', "status='0' and id='$template_answer->option_name'") as $template_value) 
									{ 
										$missing[] = $template_value->impression_text;
										
										if($template_value->impression_text == "")
										{
											if(sizeof($title_answer) > 0)
											{
												$answer_option_imp[] = $template_value->name;
											}
											else
											{
												$answer_option_imp[] = "";
											}
										}
										else
										{
											$answer_option_imp[] = $template_value->impression_text;
										}
										//$score += $template_value->score;
									}
								}
								
							}
							
							
							$answer_id1 = array();
							$answer_find_imp=array();
							$not=array();
							$all=array();
							
							$formfields =$this->common_model->get_records("tbl_form_template_fields","status = 0 and template_form_id ='$template_form_id' group by order_by");
							
							
							$j = 0;
							$formtype = array();
							$answer_find_array1 = array();
							$answer_sub_title = array();
							foreach($formfields as $form)
							{
								array_push($formtype,$form->type);
								
								// if($form->title != 0)
								// {
									// $template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									// //$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									// foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									// {
										// if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
										// {
											
											// if($hide_finding_answer->input_id == $template_values_hide->label_id)
											// {
												
												// if($form->title != 0)
												// {
													// $hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													// $hide_answer_master = $hide_answer_find->title_id;
													// $answer_find[] = $hide_answer_find->hide_text_finding;
												// }
											// }
											// else
											// {
												
												// if($form->title != 0)
												// {
													// $hide_answer_master = 0;
													
												// }
											// }
										// }
									// }
								// }
								if($form->type == 13 || $form->type == 14 ) 
								{
									
									
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
									
									
									$collapse = explode("," , $collapse_section->select_fields_id);
									$collapse_title = explode("," , $collapse_section->select_title);
									$selected1 = array();
									foreach($collapse_title as $title_collapse)
									{
										foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id = '". $_SESSION['userId'] . "'") as $select)
										{
											$selected1[] = $select->label_id;
										}

									}
									$selected12 = array();
									foreach($collapse_title as $title_collapse)
									{
										$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id = '". $_SESSION['userId'] . "'")[0];
									
										$selected12[] = $select->label_id;
									}
									
									$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
									$all_new = array();
									foreach($selected1 as $selected_all)
									{
										$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
										
									}
									$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='14' and user_id = '" . $_SESSION['userId'] . "'","label_id");
									$notselected = array_diff($collapse,$selected1);
									
									if(sizeof($all_new) == 0 )
									{
										
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name ='' and user_id = '".$_SESSION['userId']."'","title_id");
										$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
										$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
										
										
									}
									else
									{ 
										$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
										
										foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
										{
											$num1 =2;
											$numbernew =array();
											foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
											{
												
												$numbernew1[]= $title_answer->impressing_text."$#".$title_answer->finding_collapse;
												// //$num1++;
												array_push($numbernew,$numbernew1);
												//$answer_find_imp[]=$title_answer->impressing_text;
												
												//print_r($title_answer->impressing_text);
											}
											
										}
										
										
										foreach($numbernew as $numeric)
										{
											$num2 =3;
											foreach($numeric as $numericnew)
											{
												
												$answer_find_imp[]=str_replace("number",$num2 .". ",$numericnew);
												
												$num2++;
											}
										}
										//$answer_find_imp[]
										$data = array();
										$data1 = array();
										foreach($selected12 as $sel)
										{
											$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
											foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
											{
												if($option_find->impression_text == "")
												{
													if($form->title != 0)
													{
														$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
														foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
														{
															//$answer_find_imp[]=$title_answer->impressing_text;
															$data1[] = array("value"=>$title_answer->impressing_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
														}
													}
													
												}
												else
												{
													
													$data[] = array("value"=>$option_find->impression_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
													
													// array_multisort(array_map(function($element) {
														  // return $element['order'];
													  // }, $data), SORT_ASC, $data);
													  
													//print_r($data);
													//$answer_find[]= $data;
												}
												
											}
											
										}
										// $data1 = array();
										// foreach($notselected as $not)
										// {
											
											// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
											// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
											
											// //$answer_find[]=$alltitle->finding_collapse;
											// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
											
											  
											// //print_r($data1);
										// }
										$data2=array_merge($data, $data1);
										
										array_multisort(array_map(function($element) {
												  return $element['order'];
											  }, $data2), SORT_ASC, $data2);
										  
										  foreach($data2 as $answer_finding)
										  {
											 $answer_find_imp[] = $answer_finding['value'];
										  }
										//print_r($answer_find);
									}
									
								}
								// elseif($form->type == 15 )
								// {
									
									// if($form->type == 17)
									// {
										// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
										
										
										// $collapse = explode("," , $collapse_section->select_fields_id_child);
										// $collapse_title = explode("," , $collapse_section->select_title);
										// $selected1 = array();
										// foreach($collapse_title as $title_collapse)
										// {
											// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'") as $select)
											// {
												// $selected1[] = $select->label_id;
											// }

										// }
										// $selected12 = array();
										// foreach($collapse_title as $title_collapse)
										// {
											// $select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'")[0];
										
											// $selected12[] = $select->label_id;
										// }
										
										// $collapse1 = explode("," , $collapse_section->select_fields_id)[0];
										// $all_new = array();
										// foreach($selected1 as $selected_all)
										// {
											// $all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='17' and user_id = '" . $_SESSION['userId'] . "'")[0];
											
										// }
										// $select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='17' and user_id = '" . $_SESSION['userId'] . "'","label_id");
										// $notselected = array_diff($collapse,$selected1);
										// if($form->title != 0)
										// {
											// $template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
											
											// //$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
											
											// foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
											// {
												
												// if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
												// {
													
													
													// // if($hide_finding_answer->input_id == $template_values_hide->label_id)
													// // {
														
														// if($form->title != 0)
														// {
															// $hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
															// $hide_answer_master = $hide_answer_find->title_id;
															// $answer_find[] = $hide_answer_find->hide_text_finding;
														// }
													// // }
													// // else
													// // {
														
														// // if($form->title != 0)
														// // {
															// // $hide_answer_master = 0;
															
														// // }
													// // }
												// }
											// }
										// }
										// if(sizeof($all_new) == 0 )
										// {
											
											// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name ='0' and user_id = '".$_SESSION['userId']."'","title_id");
											// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec' and title_id != '$hide_answer_master'")[0];
											// $answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
										// }
										// else
										// { 
											// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
											
											// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
											// {
												
												// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
												// {
													// $answer_find_imp[]=$title_answer->impressing_text."$#".$title_answer->finding_collapse;
												// }
											// }
											// $data = array();
											// $data1 = array();
											// foreach($selected12 as $sel)
											// {
												// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
												// foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
												// {
													// if($option_find->impression_text == "")
													// {
														// if($form->title != 0)
														// {
															// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
															// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
															// {
																// //$answer_find_imp[]=$title_answer->impressing_text;
																// $data1[] = array("value"=>$title_answer->impressing_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
															// }
														// }
														
													// }
													// else
													// {
														
														// $data[] = array("value"=>$option_find->impression_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
														
														// // array_multisort(array_map(function($element) {
															  // // return $element['order'];
														  // // }, $data), SORT_ASC, $data);
														  
														// //print_r($data);
														// //$answer_find[]= $data;
													// }
													
												// }
												
											// }
											// // $data1 = array();
											// // foreach($notselected as $not)
											// // {
												
												// // $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
												// // $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
												
												// // //$answer_find[]=$alltitle->finding_collapse;
												// // $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
												
												  
												// // //print_r($data1);
											// // }
											// $data2=array_merge($data, $data1);
											
											// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data2), SORT_ASC, $data2);
											  
											  // foreach($data2 as $answer_finding)
											  // {
												 // $answer_find_imp[] = $answer_finding['value'];
											  // }
											// //print_r($answer_find);
										// }
									// }
									// elseif($form->type == 16)
									// {
										// $collapse_section = $this->common_model->get_records("tbl_collapse_section_main","status = 0 and template_id = '$template_form_id' and input_id = $form->id")[0];
										
										
										// $collapse = explode("," , $collapse_section->select_fields_id_child);
										// $collapse_title = explode("," , $collapse_section->select_title);
										// $selected1 = array();
										// foreach($collapse_title as $title_collapse)
										// {
											// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'") as $select)
											// {
												// $selected1[] = $select->label_id;
											// }

										// }
										// $selected12 = array();
										// foreach($collapse_title as $title_collapse)
										// {
											// $select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='17' and user_id = '". $_SESSION['userId'] . "'")[0];
										
											// $selected12[] = $select->label_id;
										// }
										
										// $collapse1 = explode("," , $collapse_section->select_fields_id)[0];
										// $all_new = array();
										// foreach($selected1 as $selected_all)
										// {
											// $all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='17' and user_id = '" . $_SESSION['userId'] . "'")[0];
											
										// }
										// $select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = ' ' and label_id = '$collapse' and type='17' and user_id = '" . $_SESSION['userId'] . "'","label_id");
										// $notselected = array_diff($collapse,$selected1);
										// if($form->title != 0)
										// {
											// $template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
											
											// //$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
											
											// foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
											// {
												
												// if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
												// {
													
													
													// // if($hide_finding_answer->input_id == $template_values_hide->label_id)
													// // {
														
														// if($form->title != 0)
														// {
															// $hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
															// $hide_answer_master = $hide_answer_find->title_id;
															// $answer_find[] = $hide_answer_find->hide_text_finding;
														// }
													// // }
													// // else
													// // {
														
														// // if($form->title != 0)
														// // {
															// // $hide_answer_master = 0;
															
														// // }
													// // }
												// }
											// }
										// }
										// if(sizeof($all_new) == 0 )
										// {
											
											// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->id' and option_name ='0' and user_id = '".$_SESSION['userId']."'","title_id");
											// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec' and title_id != '$hide_answer_master'")[0];
											// $answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
										// }
										// else
										// { 
											// $collapse_section = $this->common_model->get_records("tbl_collapse_section_sub","status = 0 and template_id = '$template_form_id' and input_id ='$form->id'")[0];
											
											// foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id = '". $_SESSION['userId'] ."' group by title_id") as $selected)
											// {
												
												// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
												// {
													// $answer_find_imp[]=$title_answer->impressing_text."$#".$title_answer->finding_collapse;
												// }
											// }
											// $data = array();
											// $data1 = array();
											// foreach($selected12 as $sel)
											// {
												// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '".$_SESSION['userId']."'","option_name");
												// foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selec' and template_form_id ='$template_form_id'")as $option_find)
												// {
													// if($option_find->impression_text == "")
													// {
														// if($form->title != 0)
														// {
															// $selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id = '" . $_SESSION['userId'] . "'","title_id");
															// foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
															// {
																// //$answer_find_imp[]=$title_answer->impressing_text;
																// $data1[] = array("value"=>$title_answer->impressing_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
															// }
														// }
														
													// }
													// else
													// {
														
														// $data[] = array("value"=>$option_find->impression_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$option_find->input_id'","order_by"));
														
														// // array_multisort(array_map(function($element) {
															  // // return $element['order'];
														  // // }, $data), SORT_ASC, $data);
														  
														// //print_r($data);
														// //$answer_find[]= $data;
													// }
													
												// }
												
											// }
											// // $data1 = array();
											// // foreach($notselected as $not)
											// // {
												
												// // $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id = '" . $_SESSION['userId'] . "'","title_id");
												// // $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
												
												// // //$answer_find[]=$alltitle->finding_collapse;
												// // $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id = '$not'","order_by"));
												
												  
												// // //print_r($data1);
											// // }
											// $data2=array_merge($data, $data1);
											
											// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data2), SORT_ASC, $data2);
											  
											  // foreach($data2 as $answer_finding)
											  // {
												 // $answer_find_imp[] = $answer_finding['value'];
											  // }
											// //print_r($answer_find);
										// }
									// }
									
								// }
								else
								{
									$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and option_name = '' and user_id = '". $_SESSION['userId']. "'");
									$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id = '". $_SESSION['userId']. "'");
									if($form->title != 0)
									{
										$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
										//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
										
										foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
										{
											if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '' and user_id='".$_SESSION['userId']."'")) != 0)
											{
												
												if($hide_finding_answer->input_id == $template_values_hide->label_id)
												{
													
													if($form->title != 0)
													{
														$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
														$hide_answer_master = $hide_answer_find->title_id;
														$answer_find_imp[] = $hide_answer_find->show_finding_answer; 
													}
												}
												else
												{
													
													if($form->title != 0)
													{
														$hide_answer_master = 0;
														
													}
												}
											}
										}
									}
									
									if(sizeof($not_selected)== sizeof($all))
									{
										if($form->title != 0)
										{
										   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
											$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
										}
									}
									else
									{
										
										$joinimpression = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->id'");
										
										if(sizeof($joinimpression) > 0 )
										{
											
											$join = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->id'")[0];
											
											$sub = explode(",",$this->common_model->get_records("tbl_collapse_section_sub","status=0 and template_id='$template_form_id' and input_id='$join->collapse_sub'")[0]->select_title);
											
											$data1 = array();
											foreach ($sub as $val)
											{
												$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and title='$val'","order_by"));
												  
											}
											array_multisort(array_map(function($element) {
												  return $element['order'];
											  }, $data1), SORT_ASC, $data1);
											$newarray= array();	
											
											$sub_title = $this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$template_form_id' and id='$join->collapse_sub'","title");
											
											
											$answer_sub_title =$this->common_model->get_record('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sub_title'","impressing_text");
											
											array_push($newarray,$answer_sub_title);
											$p=0;
											foreach($data1 as $s)	
											{			
												
												$total = sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id"));
												
												foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='".$s['value'] ."' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id") as $selected)
												{
													
													$answer_find_array2 = array();
													
													
													foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected->option_name'")as $option_find)
													{
														
														if($option_find->impression_text == "")
														{
															if(sizeof($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")) > 0 ){
																foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
																{
																	
																	if($title_answer->impressing_text != '') 
																	{
																		$answer_find_array2[] =$title_answer->impressing_text;
																		$answer_find_array1[] = "$#".$title_answer->finding_collapse;
																	}
																}
															}
															else
															{
																$answer_find_array2[] ="";
															}
														}
														else
														{
															
															if(sizeof($answer_find_array1) >=  0)
															{
																$answer_find_array2[] =$option_find->impression_text;
																$answer_find_array1[] = "$#".$title_answer->finding_collapse;
															}
															else
															{
																$answer_find_array2[] =$option_find->impression_text;
															}
														}
														array_push($newarray,$answer_find_array2[0]);
													}
													
													
													//$answer_find_array2 = "$#".$option_find->template_order_number;//array_push($answer_find_array1,$answer_find_array2);
													
												} 
												
												$p++;
											}
											//print_r($newarray);
											
											array_push($newarray,$answer_find_array1[0]);
											$answer_find_array1[] = implode(" ",array_unique($newarray));
									
											
										}
										else
										{
											
											foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='$form->title' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id") as $selected)
											{
												foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected->option_name'")as $option_find)
												{
													if($option_find->impression_text == "")
													{
														
														foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id' and title_id != 0") as $title_answer)
														{
															
															$answer_find_imp[]=$title_answer->impressing_text."$#".$title_answer->finding_collapse;
															
														}
													}
													else
													{
													
														$answer_find_imp[]=$option_find->impression_text."$#".$option_find->template_order_number;
													}	
													
												}
												
											}
										}
									}
									
									
									$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id = c.id and c.template_form_id ='$template_form_id' and a.option_name = ' ' and c.status='0' and a.status='0'  and a.user_id = '". $_SESSION['userId']. "'");
									foreach($test1 as $t)
									{
										$answer_id1_imp[] =$t->form_fields_id;
											
									}
									
								}
								$j++;
							}
							//print_r($answer_find_imp);
							
							$answer_find_imp = array_merge($answer_find_imp,$answer_find_array1);
							$formtype1 = array_unique($formtype);
							$formcollapse = array();
							foreach($formtype1 as  $formtype2)
							{
								if($formtype2 == 13 || $formtype2 == 14)
								{
									array_push($formcollapse,$formtype2);
								}
							}
							
							// print_r($answer_option_imp);
							// echo "<br>";
							$final_result = str_replace($answer_id_imp, $answer_option_imp, $answer_find_imp);
							
							$final_result1 = str_replace($answer_id1_imp, "" , $final_result);
							
							$data10 = array();
							foreach(array_unique($final_result1) as $final)
							{
								$number = explode("$#",$final); // return 1234
								$ordernumber = preg_replace("/[^0-9 .]/", "",$number[1]);
								//$letters = str_replace($number, "" , $final);
								//$letters = str_replace(' ', "" , $number[1]);
								$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
								//echo $final;
								$j++;
							}
							array_multisort(array_map(function($element) {
								  return $element['order'];
							  }, $data10), SORT_ASC, $data10);
							  
							  
							$score = array();
							foreach($this->common_model->get_custom_query("SELECT sum(b.score) as score FROM tbl_template_values as a, tbl_input_options as b where a.option_name = b.id and b.input_id = a.label_id and a.template_form_id = '$template_form_id' and a.option_name != '' and a.status='0' and a.user_id = '". $_SESSION['userId']. "' group by a.title_id") as $sec)
							{
								$score[] = $sec->score;
								
							}
							if(sizeof($formcollapse) > 1)
							{
								
								if($_POST['order_by'] == 1)
								{
									
									$i=1;
									$j=0;
									$age = array();
									foreach($final_result1 as $final)
									{	
										if(!empty($final))
										{
											
											$age[] = array("final"=>$final,"score"=>$score[$j]);
											$i++;
											$j++;
											
										}
									
									}
									array_multisort(array_map(function($element) {
										  return $element['score'];
									  }, $age), SORT_ASC, $age);
									  
									$m=1;
									foreach($age as $as) 
									{
										echo $m .".";
										echo  $as['final'] ." ". $as['score'] ;
										echo "<br>";
										$m++;
									}
										
								}
								else
								{
									
									$i=1;
									$j=0;
									
									foreach($data10 as $final1)
									{	
										
										// if(!empty($final))
										// {
											
											// if($i == 1)
											// {
												// echo $i .". ";
												// echo ucfirst($final) ." ". $condition_name ." ";
												// //echo "</br>";
												// //echo $score[$j] .  "</br>";
											// }
											// else 
											// { 
												// echo $i .". ";
												// echo str_replace("number",(2).".",$final);
												// //echo ucfirst($final);
											// }
											// $i++;
											// $j++;
											// //print_r($final_result1[$i]);
											// //array_shift($number12);
										// }
										
										if($final1['value'] != '')
										{
											if($i == 1)
											{
												echo $i .". ";
												echo ucfirst($final1['value']).". </br>";
											}
											else
											{
												echo $i .". ";
												echo ucfirst($final1['value']).". </br>";
											}
											$i++;
											$j++;
										}
											
										
										
									}
								}
							}
							else
							{
								if($_POST['order_by'] == 1)
								{
									
									$i=1;
									$j=0;
									$age = array();
									foreach($final_result1 as $final)
									{	
										if(!empty($final))
										{
											
											$age[] = array("final"=>$final,"score"=>$score[$j]);
											$i++;
											$j++;
											
										}
									
									}
									array_multisort(array_map(function($element) {
										  return $element['score'];
									  }, $age), SORT_ASC, $age);
									  
									$m=1;
									foreach($age as $as) 
									{
										echo $m .".";
										echo  $as['final'] ." ". $as['score'] ;
										echo "<br>";
										$m++;
									}
										
								}
								else
								{
									$i=1;
									$j=0;
									// foreach($final_result1 as $final)
									// {	
										
										// if(!empty($final))
										// {
											// if($i == 1)
											// {
												// echo $i .". "; 
												// echo ucfirst($final) ." ". $condition_name ." ";
												// echo $score[$j] .  "</br>";
											// }
											// else
											// {
												// echo $i .". ";
												// echo ucfirst($final)." ";
												// echo $score[$j] .  "</br>";
											// }
											
											// $i++;
											// $j++;
											// //print_r($final_result1[$i]);
										// }
									// }
									foreach($data10  as $final1)
									{
										if($final1['value'] != '')
										{
											if($i == 1)
											{
												echo $i .". ";
												echo ucfirst($final1['value'])."</br>";
											}
											else
											{
												echo $i .". ";
												echo ucfirst($final1['value'])."</br>";
											}
											$i++;
											$j++;
										}
										
									}
								}
							}
							
							
						?>
					<?php //} else { ?>
						<?php 
							//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
						?>
							<?php 
								//echo 1 .". " ;
								//echo $empty_result->impressing_text  
							?>
						
					<?php //} ?>
					
				</div>
			</div>
		</div>
	
</div>
<?php elseif ($role == ROLE_ADMIN) : ?>
<div id="div1" >
	<div class="col-md-6">
		<h3 class="temp">FINDINGS</h3> 
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content1"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content1" class="impressions_text text-box-border">
			<div id="content3" ondblclick="content3()">
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history");
					$radiation_dose = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose");
					$description = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description");
					$clinic_indications = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction");
					$new_template = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","new_template"); 
					$contrast = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast"); 
				if($date != ""):
				?>
				<b>HISTORY: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php if($new_template == 1):?>
					<?php if($description != ""):?>
						<b>TEMPLATE NAME: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description")?><br><br>
					<?php else: ?>
						<b>TEMPLATE NAME: </b><br><br>
					<?php endif?>
					<?php if($description != ""):?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php else: ?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php endif?>
					<?php if($clinic_indications != ""):?>
						<b>CLINICAL INDICATION: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction")?><br><br>
					<?php else: ?>
						<b>CLINICAL INDICATION: </b><br><br>
					<?php endif?>
				<?php endif?>
				<b>TECHNIQUE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "' ","techniques")?><br><br>
				<?php if($contrast != ""):?>
					<b>CONTRAST: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<input type='hidden' name='techniques' value='<?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","techniques")?>'>
				<input type='hidden' name='template_form_id' value='<?=$template_form_id?>'>
				<input type='hidden' name='assign_id' value='<?=$_SESSION['userId']?>'>
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date");
				if($date != "0000-00-00"):
				?>
					<b>COMPARISON: </b> <?= date("m-d-Y", strtotime($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date")))?><br><br>
					<input type='hidden' name='comparision_date' value='<?= date("d-m-Y", strtotime($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date")))?>'>
				<?php else: ?>
					<b>COMPARISON:</b> None available</br></br>
					<input type='hidden' name='comparision_date' value=''>
				<?php endif?>
				<?php if($radiation_dose != ""):?>
					<b>RADIATION DOSE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php 
					$finding_text = "FINDINGS";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$finding_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text1"));
					}
				?>
				<b><?=$finding_text?>:</b><br>
					
				<?php 
						//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
					?>
					<?php 
						$answer_id = array();
						
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template) 
						{ 
							$answer_id[] = $template->copy_form_field_id;
						}
						// foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_copy_input_options as b , tbl_admin_copy_template_fields as c where a.option_name = b.input_option_id and b.input_id = c.form_fields_id and c.copy_template_form_id = '$template_form_id' and a.option_name != ''  and a.option_name != '0' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template) 
						// { 
							// $answer_id[] = $template->form_fields_id;
						// }
						
						
						$answer_option = array();
						$missing = array();
						$missing_1 = array();
						foreach ($this->common_model->get_custom_query("SELECT a.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template_answer) 
						{
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
							if(sizeof($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'")) == 0)
							{
								$answer_option[] = $template_answer->option_name;
								//$answer_id[] = $this->common_model->get_record("tbl_admin_copy_template_fields","status=0 and form_fields_id='$template_answer->label_id'","copy_form_field_id");
							}
							else
							{
								foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'") as $template_value) 
								{ 
									$missing[] = $template_value->finding_text;
									
									if($template_value->finding_text == "")
									{
										if(sizeof($title_answer) > 0) 
										{
											$answer_option[] = $template_value->name;
										}
										else
										{
											$answer_option[] = '';
										}
										
									}
									else
									{
										$answer_option[] = $template_value->finding_text;
									}
								}
							}
							
						}
						$answer_id1 = array();
						$answer_find=array();
						$not=array();
						$all=array();
						$data_find2 =array();
						$data_find3 =array();
						$data_find4 =array();
						$data_find5 =array();
						$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and copy_template_form_id ='$template_form_id' and title != '0' and assign_id='".$_SESSION['userId']."' group by order_by");
						$i = 0;
						foreach($formfields as $form)
						{
							if($form->type == 13 || $form->type == 14 ) 
							{
								
								
								$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->form_fields_id")[0];
								
								
								$collapse = explode("," , $collapse_section->select_fields_id);
								$collapse_title = explode("," , $collapse_section->select_title);
								$selected1 = array();
								foreach($collapse_title as $title_collapse)
								{
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'") as $select)
									{
										$selected1[] = $select->label_id;
									}
								}
								
								$selected12 = array();
								foreach($collapse_title as $title_collapse)
								{
									$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'")[0];
							
										$selected12[] = $select->label_id;
									
								}
								$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
								$all_new = array();
								foreach($selected1 as $selected_all)
								{
									$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
									
								}
								
								$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = '' and label_id = '$collapse' and type='14' and user_id='".$_SESSION['userId']."'","label_id");
								$notselected = array_diff($collapse,$selected1);
								if(sizeof($all_new) == 0 )
								{
									$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->form_fields_id' and option_name ='' and user_id = '".$_SESSION['userId']."'","title_id");
									$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
									$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
								}
								else
								{ 
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->form_fields_id'")[0];
									
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
									{
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
										{
											$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
										}
									}
									$data = array();
									$data1 = array();
									foreach($selected12 as $sel)
									{
										
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","option_name");
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selec' and template_form_id ='$template_form_id' and assign_id ='" . $_SESSION['userId'] ."'")as $option_find)
										{
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","title_id");
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
													{
														//$answer_find[]=$title_answer->finding_text;
														$data1[] = array("value"=>$title_answer->finding_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by"));
													}
												}
												
											}
											else
											{
												
												$data[] = array("value"=>$option_find->finding_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
												     
												// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data), SORT_ASC, $data);
												  
												//print_r($data);
												//$answer_find[]= $data;
											}
											
										}
										
									}
									// $data1 = array();
									// foreach($notselected as $not)
									// {
										
										// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id='".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
										
										// //$answer_find[]=$alltitle->finding_collapse;
										// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$not' and assign_id='".$_SESSION['userId']."'","order_by"));
										
										  
										// //print_r($data1);
									// }
									$data2=array_merge($data, $data1);
									
									array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data2), SORT_ASC, $data2);
									  
									  foreach($data2 as $answer_finding)
									  {
										 $answer_find[] = $answer_finding['value'];
									  }
								}
								
							}
							
							else
							{
								$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and option_name = ''  and user_id='".$_SESSION['userId']."'");
								$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'");
								
								if($form->title != 0)
								{
									$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									{
										if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != ''  and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
										{
											
											if($hide_finding_answer->input_id == $template_values_hide->label_id)
											{
												
												if($form->title != 0)
												{
													$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													$hide_answer_master = $hide_answer_find->title_id;
													$answer_find[] = $hide_answer_find->hide_text_finding;
												}
											}
											else
											{
												
												if($form->title != 0)
												{
													$hide_answer_master = 0;
													
												}
											}
										}
									}
								}
								if(sizeof($not_selected) == sizeof($not_selected))
								{
									if($form->title != 0)
									{
										
									   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
										$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
									}
								}
								else
								{
							

									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id='$form->title' and option_name != '' and option_name != '0' and user_id='".$_SESSION['userId']."' group by title_id")as $selected)
									{
									  
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."'")as $option_find)
										{
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")as $title_answer)
													{
														$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
													}
												}
												
											}
											else
											{
												$answer_find[]=$option_find->finding_text."$#".$option_find->template_order_number;
											}
										}
										
									}
								}
								
								
							}
							$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name = ''   and a.option_name = 0   and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc");
								
							foreach($test1 as $t)
							{
								$answer_id1[] =$t->copy_form_field_id;
								
							}
							$i++;
						}
						$final_result = str_replace($answer_id, $answer_option, $answer_find);
						$final_result1 = str_replace($answer_id1, "" , $final_result);
						$final_result2 = str_replace(". ", "." , $final_result1);
						$final_result3 = str_replace(".", ". " , $final_result2);
						$final_result4 = str_replace(",", ", " , $final_result3);
						$j= 0;
						$data10 = array();
						foreach(array_unique($final_result4) as $final)
						{
							$number = explode("$#",$final); // return 1234
							$ordernumber = preg_replace("/[^0-9.]/", "",$number[1]);
							//$letters = str_replace($number, "" , $final);
							//$letters = str_replace(' ', "" , $number[1]);
							$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
							//echo $final;
							$j++;
						}
						array_multisort(array_map(function($element) {
							  return $element['order'];
						  }, $data10), SORT_ASC, $data10);
						foreach($data10  as $final1)
						{
							if($final1['value'] != '')
							{
								echo $final1['value']." ";
							}
							
						}
					?>
					<?php// } else { ?>
						<?php 
							//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
						?>
							<?php 
								//echo 1 .". " ;
								//echo $empty_result->finding_text  
							?>
						
					<?php// } ?>
				
			</div>
		</div>
			<!--<div contentEditable="true" id="content1" class="impressions_text text-box-border">
				<b>Finding:</b><br>
				 <?php  echo $empty_result->finding_text ?>
				<input type='hidden' name='template_form_id' value='<?=$template_form_id?>'>
				<input type='hidden' name='assign_id' value='<?=$_SESSION['userId']?>'>
			</div>-->
	</div>
	<div class="col-md-6" >
		<h3 class="temp">IMPRESSION</h3>
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content2"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content2" class="text-box-border">
			<div id="content4" ondblclick="content4()">
				<?php 
					$impressison_text = "IMPRESSION";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$impressison_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text2"));
					}
				?>
				<br><b><?=$impressison_text?>:</b> <br>
				<div id="content5" class="finding" >
				<?php 
					//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
				?>
					<?php 
						$answer_id_imp = array();
						
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != 0 and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template)  
						{ 
							$answer_id_imp[] = $template->copy_form_field_id;
						}
						
						$answer_option_imp = array();
						$missing = array();
						$missing_1 = array();
						//$score = array();
						//$score = 0;
						foreach ($this->common_model->get_custom_query("SELECT a.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template_answer) 
						{
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
							if(sizeof($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'")) == 0)
							{
								$answer_option_imp[] = $template_answer->option_name;
								$answer_id_imp[] = $this->common_model->get_record("tbl_admin_copy_template_fields","status=0 and form_fields_id='$template_answer->label_id'","copy_form_field_id");
							}
							else
							{
								foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name' and assign_id='".$_SESSION['userId']."'") as $template_value) 
								{ 
									$missing[] = $template_value->impression_text;
									
									if($template_value->impression_text == "")
									{
										if(sizeof($title_answer) > 0)
										{
											$answer_option_imp[] = $template_value->name;
										}
										else
										{
											$answer_option_imp[] = "";
										}
									}
									else
									{
										$answer_option_imp[] = $template_value->impression_text;
									}
									//$score += $template_value->score;
								}
							}
							
						}
						
						
						$answer_id1 = array();
						$answer_id1_imp = array();
						$answer_find_imp=array();
						$not=array();
						$all=array();
						$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and copy_template_form_id ='$template_form_id' and assign_id='".$_SESSION['userId']."' group by order_by ");
						
						$j = 0;
						$formtype = array();
						$answer_find_array1 = array();
						$answer_sub_title = array();	
						foreach($formfields as $form)
						{
							array_push($formtype,$form->type);
							if($form->type == 13 || $form->type == 14 ) 
							{
								
								
								$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->form_fields_id")[0];
								
								
								$collapse = explode("," , $collapse_section->select_fields_id);
								$collapse_title = explode("," , $collapse_section->select_title);
								$selected1 = array();
								foreach($collapse_title as $title_collapse)
								{
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'") as $select)
									{
										$selected1[] = $select->label_id;
									}
								}
								
								$selected12 = array();
								foreach($collapse_title as $title_collapse)
								{
									$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'")[0];
							
										$selected12[] = $select->label_id;
									
								}
								$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
								$all_new = array();
								foreach($selected1 as $selected_all)
								{
									$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
									
								}
								
								$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = '' and label_id = '$collapse' and type='14' and user_id='".$_SESSION['userId']."'","label_id");
								$notselected = array_diff($collapse,$selected1);
								if(sizeof($all_new) == 0 )
								{
									$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->form_fields_id' and option_name ='' and user_id = '".$_SESSION['userId']."'","title_id");
									$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
									$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
								}
								else
								{ 
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->form_fields_id'")[0];
									
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
									{
										$num1 =2;
										$numbernew =array();
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
										{
											//$answer_find_imp[]=$title_answer->impressing_text;
											$numbernew1[]= $title_answer->impressing_text."$#".$title_answer->finding_collapse;
												// //$num1++;
											array_push($numbernew,$numbernew1);
										}
									}
									
									foreach($numbernew as $numeric)
									{
										$num2 =2;
										foreach($numeric as $numericnew)
										{
											
											$answer_find_imp[]=str_replace("number",$num2 .". ",$numericnew);
											
											$num2++;
										}
									}
									$data = array();
									$data1 = array();
									foreach($selected12 as $sel)
									{
										
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","option_name");
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selec' and template_form_id ='$template_form_id' and assign_id ='" . $_SESSION['userId'] ."'")as $option_find)
										{
											if($option_find->impression_text == "")
											{
												if($form->title != 0)
												{
													$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","title_id");
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
													{
														//$answer_find_imp[]=$title_answer->impressing_text;
														$data1[] = array("value"=>$title_answer->impressing_text."$#".$title_answer->finding_collapse, "order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
													}
												}
												
											}
											else
											{
												
												$data[] = array("value"=>$option_find->impression_text."$#".$option_find->template_order_number, "order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
												     
												// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data), SORT_ASC, $data);
												  
												//print_r($data);
												//$answer_find[]= $data;
											}
											
										}
										
									}
									// $data1 = array();
									// foreach($notselected as $not)
									// {
										
										// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id='".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
										
										// //$answer_find[]=$alltitle->finding_collapse;
										// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$not' and assign_id='".$_SESSION['userId']."'","order_by"));
										
										  
										// //print_r($data1);
									// }
									$data2=array_merge($data, $data1);
									
									array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data2), SORT_ASC, $data2);
									  
									  foreach($data2 as $answer_finding)
									  {
										 $answer_find_imp[] = $answer_finding['value'];
									  }
								}
								
							}
							
							else
							{
							
								$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and option_name = '' and user_id='".$_SESSION['userId']."'");
								$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'");
								if($form->title != 0)
								{
									$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									{
										if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '' and user_id='".$_SESSION['userId']."'")) != 0)
										{
											
											if($hide_finding_answer->input_id == $template_values_hide->label_id)
											{
												
												if($form->title != 0)
												{
													$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													$hide_answer_master = $hide_answer_find->title_id;
													$answer_find_imp[] = $hide_answer_find->show_finding_answer;  
												}
											}
											else
											{
												
												if($form->title != 0)
												{
													$hide_answer_master = 0;
													
												}
											}
										}
									}
								}
								if(sizeof($not_selected)== sizeof($all))
								{
									if($form->title != 0)
									{
									   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and testing_impressing != '' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
										$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
									}
								}
								else
								{
									$joinimpression = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->form_fields_id'");
									if(sizeof($joinimpression) > 0 )
									{
										
										$join = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->form_fields_id'")[0];
										
										$sub = explode(",",$this->common_model->get_records("tbl_collapse_section_sub","status=0 and template_id='$template_form_id' and input_id='$join->collapse_sub'")[0]->select_title);
										
										$data1 = array();
										foreach ($sub as $val)
										{
											$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and title='$val'","order_by"));
											  
										}
										array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data1), SORT_ASC, $data1);
										$newarray= array();	
										
										$sub_title = $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id='$join->collapse_sub'","title");
										
										
										$answer_sub_title =$this->common_model->get_record('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sub_title'","impressing_text");
										
										array_push($newarray,$answer_sub_title);
										$p=0;
										foreach($data1 as $s)	
										{			
											
											$total = sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id"));
											
											foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='".$s['value'] ."' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id") as $selected)
											{
												
												$answer_find_array2 = array();
												
												
												foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."' ")as $option_find)
												{
													
													if($option_find->impression_text == "")
													{
														if(sizeof($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")) > 0 ){
															foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
															{
																
																if($title_answer->impressing_text != '') 
																{
																	$answer_find_array2[] =$title_answer->impressing_text;
																	$answer_find_array1[] = "$#".$title_answer->finding_collapse;
																}
															}
														}
														else
														{
															$answer_find_array2[] ="";
														}
													}
													else
													{
														
														if(sizeof($answer_find_array1) >=  0)
														{
															$answer_find_array2[] =$option_find->impression_text;
															$answer_find_array1[] = "$#".$title_answer->finding_collapse;
														}
														else
														{
															$answer_find_array2[] =$option_find->impression_text;
														}
													}
													array_push($newarray,$answer_find_array2[0]);
												}
												
												
												//$answer_find_array2 = "$#".$option_find->template_order_number;//array_push($answer_find_array1,$answer_find_array2);
												
											} 
											
											$p++;
										}
										//print_r($newarray);
										
										array_push($newarray,$answer_find_array1[0]);
										$answer_find_array1[] = implode(" ",array_unique($newarray));
								
									}
									else
									{
										foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='$form->title' and option_name != '' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
										{
											
											foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."' ")as $option_find)
											{
												if($option_find->impression_text == "")
												{
													
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id' and title_id != 0") as $title_answer)
													{
														
														$answer_find_imp[]=$title_answer->impressing_text."$#".$title_answer->finding_collapse;
														
													}
												}
												else
												{
												
													$answer_find_imp[]=$option_find->impression_text."$#".$option_find->template_order_number;
												}	
												
											}
											
										}
									}
								}
								
								$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name = '' and a.option_name = 0 and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."'");
								foreach($test1 as $t)
								{
									$answer_id1_imp[] =$t->copy_form_field_id;
										
								}
							}
							$j++;
						}
						$answer_find_imp = array_merge($answer_find_imp,$answer_find_array1);
						// print_r($answer_option_imp);
						// echo "<br>";
						$formtype1 = array_unique($formtype);
						$formcollapse = array();
						foreach($formtype1 as  $formtype2)
						{
							if($formtype2 == 13 || $formtype2 == 14)
							{
								array_push($formcollapse,$formtype2);
							}
						}
						$final_result = str_replace($answer_id_imp, $answer_option_imp, $answer_find_imp);
						$final_result1 = str_replace($answer_id1_imp, "" , $final_result);
						
						$data10 = array();
						foreach(array_unique($final_result1) as $final)
						{
							$number = explode("$#",$final); // return 1234
							$ordernumber = preg_replace("/[^0-9 .]/", "",$number[1]);
							//$letters = str_replace($number, "" , $final);
							//$letters = str_replace(' ', "" , $number[1]);
							$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
							//echo $final;
							$j++;
						}
						array_multisort(array_map(function($element) {
							  return $element['order'];
						  }, $data10), SORT_ASC, $data10);
						
						
						$score = array();
						foreach($this->common_model->get_custom_query("SELECT sum(b.score) as score FROM tbl_template_values as a, tbl_input_options as b where a.option_name = b.id and b.input_id = a.label_id and a.template_form_id = '$template_form_id' and a.option_name != '' and a.status='0' and a.user_id='".$_SESSION['userId']."' group by a.title_id") as $sec)
						{
							$score[] = $sec->score;
							
						}
						
						if(sizeof($formcollapse) > 1)
						{
							if($_POST['order_by'] == 1)
							{
								
								$i=1;
								$j=0;
								$age = array();
								foreach($final_result1 as $final)
								{	
									if(!empty($final))
									{
										
										$age[] = array("final"=>$final,"score"=>$score[$j]);
										$i++;
										$j++;
										
									}
								
								}
								array_multisort(array_map(function($element) {
									  return $element['score'];
								  }, $age), SORT_ASC, $age);
								  
								$m=1;
								foreach($age as $as) 
								{
									echo $m .".";
									echo  $as['final'] ." ". $as['score'] ;
									echo "<br>";
									$m++;
								}
									
							}
							else
							{
								$i=1;
								$j=0;
								foreach($data10 as $final1)
								{	
									// if(!empty($final))
									// {
										// if($i == 1)
										// {
											// echo $i .". ";
											// echo ucfirst($final) ." ". $condition_name ." ";
											// //echo "</br>";
											// //echo $score[$j] .  "</br>";
										// }
										// else 
										// { 
											// //echo $i .". ";   
											// echo str_replace("number",(2).".",$final);
										// }
										
										// $i++;
										// $j++;
										// //print_r($final_result1[$i]);
									// }
									if($final1['value'] != '')
									{
										if($i == 1)
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										else
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										$i++;
										$j++;
									}
								}
							}
						}
						else
						{
							if($_POST['order_by'] == 1)
							{
								
								$i=1;
								$j=0;
								$age = array();
								foreach($final_result1 as $final)
								{	
									if(!empty($final))
									{
										
										$age[] = array("final"=>$final,"score"=>$score[$j]);
										$i++;
										$j++;
										
									}
								
								}
								array_multisort(array_map(function($element) {
									  return $element['score'];
								  }, $age), SORT_ASC, $age);
								  
								$m=1;
								foreach($age as $as) 
								{
									echo $m .".";
									echo  $as['final'] ." ". $as['score'] ;
									echo "<br>";
									$m++;
								}
									
							}
							else
							{
								$i=1;
								$j=0;
								// foreach($final_result1 as $final)
								// {	
									// if(!empty($final))
									// {
										// if($i == 1)
										// {
											// echo $i .". ";
											// echo ucfirst($final) ." ". $condition_name ." ";
											// //echo $score[$j] .  "</br>";
											// echo "</br>";
										// }
										// else
										// {
											// echo $i .". ";
											// echo ucfirst($final)." ";
											// //echo $score[$j] .  "</br>";
											// echo "</br>";
										// }
										
										// $i++;
										// $j++;
										// //print_r($final_result1[$i]);
									// }
								// }
								foreach($data10  as $final1)
								{
									if($final1['value'] != '')
									{
										if($i == 1)
										{
											echo $i .". ";
											echo ucfirst($final1['value'])." ". $condition_name ." ";
											echo "</br>";
										}
										else
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										$i++;
										$j++;
									}
									
								}
							}
						}
						
					?>
				<?php //} else { ?>
					<?php 
						//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
					?>
						<?php 
							//echo 1 .". " ;
							//echo $empty_result->impressing_text  
						?>
					
				<?php //} ?>
			</div>
			</div>
			</div>
		</div>
			
	</div>
</div>
<?php elseif ($role == ROLE_SCRIBE) : ?>
<div id="div1" >
	<div class="col-md-6">
		<h3 class="temp">FINDINGS</h3> 
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content1"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content1" class="impressions_text text-box-border">
			<div id="content3" ondblclick="content3()">
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history");
					$radiation_dose = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose");
					$description = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description");
					$clinic_indications = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction");
					$new_template = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","new_template"); 
					$contrast = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast"); 
				if($date != ""):
				?>
				<b>HISTORY: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","history")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php if($new_template == 1):?>
					<?php if($description != ""):?>
						<b>TEMPLATE NAME: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","description")?><br><br>
					<?php else: ?>
						<b>TEMPLATE NAME: </b><br><br>
					<?php endif?>
					<?php if($description != ""):?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php else: ?>
						<b>DESCRIPTION: </b><?=$this->common_model->get_record('tbl_category_with_form', "id='$template_form_id'","name");?><br><br>
					<?php endif?>
					<?php if($clinic_indications != ""):?>
						<b>CLINICAL INDICATION: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","clinic_indiction")?><br><br>
					<?php else: ?>
						<b>CLINICAL INDICATION: </b><br><br>
					<?php endif?>
				<?php endif?>
				<b>TECHNIQUE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "' ","techniques")?><br><br>
				<?php if($contrast != ""):?>
					<b>CONTRAST: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","contrast")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<input type='hidden' name='techniques' value='<?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","techniques")?>'>
				<input type='hidden' name='template_form_id' value='<?=$template_form_id?>'>
				<input type='hidden' name='assign_id' value='<?=$_SESSION['userId']?>'>
				<?php 
					$date = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date");
				if($date != "0000-00-00"):
				?>
					<b>COMPARISON: </b> <?= date("m-d-Y", strtotime($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date")))?><br><br>
					<input type='hidden' name='comparision_date' value='<?= date("d-m-Y", strtotime($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","comparison_date")))?>'>
				<?php else: ?>
					<b>COMPARISON:</b> None available</br></br>
					<input type='hidden' name='comparision_date' value=''>
				<?php endif?>
				<?php if($radiation_dose != ""):?>
					<b>RADIATION DOSE: </b><?=$this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and user_id = '". $_SESSION['userId']. "'","radiation_dose")?><br><br>
				<?php else: ?>
				
				<?php endif?>
				<?php 
					$finding_text = "FINDINGS";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$finding_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text1"));
					}
				?>
				<b><?=$finding_text?>:</b><br>
					
				<?php 
						//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
					?>
					<?php 
						$answer_id = array();
						
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template) 
						{ 
							$answer_id[] = $template->copy_form_field_id;
						}
						// foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_copy_input_options as b , tbl_admin_copy_template_fields as c where a.option_name = b.input_option_id and b.input_id = c.form_fields_id and c.copy_template_form_id = '$template_form_id' and a.option_name != ''  and a.option_name != '0' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template) 
						// { 
							// $answer_id[] = $template->form_fields_id;
						// }
						
						
						$answer_option = array();
						$missing = array();
						$missing_1 = array();
						foreach ($this->common_model->get_custom_query("SELECT a.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template_answer) 
						{
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
							if(sizeof($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'")) == 0)
							{
								$answer_option[] = $template_answer->option_name;
								//$answer_id[] = $this->common_model->get_record("tbl_admin_copy_template_fields","status=0 and form_fields_id='$template_answer->label_id'","copy_form_field_id");
							}
							else
							{
								foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'") as $template_value) 
								{ 
									$missing[] = $template_value->finding_text;
									
									if($template_value->finding_text == "")
									{
										if(sizeof($title_answer) > 0) 
										{
											$answer_option[] = $template_value->name;
										}
										else
										{
											$answer_option[] = '';
										}
										
									}
									else
									{
										$answer_option[] = $template_value->finding_text;
									}
								}
							}
							
						}
						$answer_id1 = array();
						$answer_find=array();
						$not=array();
						$all=array();
						$data_find2 =array();
						$data_find3 =array();
						$data_find4 =array();
						$data_find5 =array();
						$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and copy_template_form_id ='$template_form_id' and title != '0' and assign_id='".$_SESSION['userId']."' group by order_by");
						$i = 0;
						foreach($formfields as $form)
						{
							if($form->type == 13 || $form->type == 14 ) 
							{
								
								
								$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->form_fields_id")[0];
								
								
								$collapse = explode("," , $collapse_section->select_fields_id);
								$collapse_title = explode("," , $collapse_section->select_title);
								$selected1 = array();
								foreach($collapse_title as $title_collapse)
								{
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'") as $select)
									{
										$selected1[] = $select->label_id;
									}
								}
								
								$selected12 = array();
								foreach($collapse_title as $title_collapse)
								{
									$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'")[0];
							
										$selected12[] = $select->label_id;
									
								}
								$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
								$all_new = array();
								foreach($selected1 as $selected_all)
								{
									$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
									
								}
								
								$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = '' and label_id = '$collapse' and type='14' and user_id='".$_SESSION['userId']."'","label_id");
								$notselected = array_diff($collapse,$selected1);
								if(sizeof($all_new) == 0 )
								{
									$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->form_fields_id' and option_name ='' and user_id = '".$_SESSION['userId']."'","title_id");
									$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
									$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
								}
								else
								{ 
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->form_fields_id'")[0];
									
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
									{
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
										{
											$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
										}
									}
									$data = array();
									$data1 = array();
									foreach($selected12 as $sel)
									{
										
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","option_name");
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selec' and template_form_id ='$template_form_id' and assign_id ='" . $_SESSION['userId'] ."'")as $option_find)
										{
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","title_id");
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
													{
														//$answer_find[]=$title_answer->finding_text;
														$data1[] = array("value"=>$title_answer->finding_text."$#".$title_answer->finding_collapse, "order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by"));
													}
												}
												
											}
											else
											{
												
												$data[] = array("value"=>$option_find->finding_text."$#".$option_find->template_order_number, "order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
												     
												// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data), SORT_ASC, $data);
												  
												//print_r($data);
												//$answer_find[]= $data;
											}
											
										}
										
									}
									// $data1 = array();
									// foreach($notselected as $not)
									// {
										
										// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id='".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
										
										// //$answer_find[]=$alltitle->finding_collapse;
										// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$not' and assign_id='".$_SESSION['userId']."'","order_by"));
										
										  
										// //print_r($data1);
									// }
									$data2=array_merge($data, $data1);
									
									array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data2), SORT_ASC, $data2);
									  
									  foreach($data2 as $answer_finding)
									  {
										 $answer_find[] = $answer_finding['value'];
									  }
								}
								
							}
							
							else
							{
								$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and (option_name = 0 or option_name = '')  and user_id='".$_SESSION['userId']."'");
								$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'");
								
								if($form->title != 0)
								{
									$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									{
										if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != ''  and option_name != '0' and user_id='".$_SESSION['userId']."'")) != 0)
										{
											
											if($hide_finding_answer->input_id == $template_values_hide->label_id)
											{
												
												if($form->title != 0)
												{
													$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													$hide_answer_master = $hide_answer_find->title_id;
													$answer_find[] = $hide_answer_find->hide_text_finding;
												}
											}
											else
											{
												
												if($form->title != 0)
												{
													$hide_answer_master = 0;
													
												}
											}
										}
									}
								}
								
								if(sizeof($not_selected) == sizeof($all))
								{
									if($form->title != 0)
									{
									   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
										$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
									}
								}
								else
								{
							
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id='$form->title' and option_name != '' and option_name != '0' and user_id='".$_SESSION['userId']."' group by title_id")as $selected)
									{
									  
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."'")as $option_find)
										{
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")as $title_answer)
													{
														$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
													}
												}
												
											}
											else
											{
												$answer_find[]=$option_find->finding_text."$#".$option_find->template_order_number;
											}
										}
										
									}
								}
								
								
							}
							$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name = ''   and a.option_name = 0   and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc");
								
							foreach($test1 as $t)
							{
								$answer_id1[] =$t->copy_form_field_id;
								
							}
							$i++;
						}
						$final_result = str_replace($answer_id, $answer_option, $answer_find);
						$final_result1 = str_replace($answer_id1, "" , $final_result);
						$final_result2 = str_replace(". ", "." , $final_result1);
						$final_result3 = str_replace(".", ". " , $final_result2);
						$final_result4 = str_replace(",", ", " , $final_result3);
						$j= 0;
						$data10 = array();
						foreach(array_unique($final_result4) as $final)
						{
							$number = explode("$#",$final); // return 1234
							$ordernumber = preg_replace("/[^0-9.]/", "",$number[1]);
							//$letters = str_replace($number, "" , $final);
							//$letters = str_replace(' ', "" , $number[1]);
							$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
							//echo $final;
							$j++;
						}
						array_multisort(array_map(function($element) {
							  return $element['order'];
						  }, $data10), SORT_ASC, $data10);
						foreach($data10  as $final1)
						{
							if($final1['value'] != '')
							{
								echo $final1['value']." ";
							}
							
						}
					?>
					<?php// } else { ?>
						<?php 
							//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
						?>
							<?php 
								//echo 1 .". " ;
								//echo $empty_result->finding_text  
							?>
						
					<?php// } ?>
				
			</div>
		</div>
			<!--<div contentEditable="true" id="content1" class="impressions_text text-box-border">
				<b>Finding:</b><br>
				 <?php  echo $empty_result->finding_text ?>
				<input type='hidden' name='template_form_id' value='<?=$template_form_id?>'>
				<input type='hidden' name='assign_id' value='<?=$_SESSION['userId']?>'>
			</div>-->
	</div>
	<div class="col-md-6" >
		<h3 class="temp">IMPRESSION</h3>
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content2"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content2" class="text-box-border">
			<div id="content4" ondblclick="content4()">
				<?php 
					$impressison_text = "IMPRESSION";
					if(sizeof($this->common_model->get_records("tbl_main_answer_heading","status =0 and template_id='$template_form_id'")) > 0)
					{
						$impressison_text = strtoupper($this->common_model->get_record("tbl_main_answer_heading","status =0 and template_id='$template_form_id'","answer_text2"));
					}
				?>
				<br><b><?=$impressison_text?>:</b> <br>
				<div id="content5" class="finding" >
				<?php 
					//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
				?>
					<?php 
						$answer_id_imp = array();
						
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != 0 and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template)  
						{ 
							$answer_id_imp[] = $template->copy_form_field_id;
						}
						
						$answer_option_imp = array();
						$missing = array();
						$missing_1 = array();
						//$score = array();
						//$score = 0;
						foreach ($this->common_model->get_custom_query("SELECT a.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name != '' and a.option_name != '0' and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."' order by c.order_by asc") as $template_answer) 
						{
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'");
							if(sizeof($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name'  and assign_id='".$_SESSION['userId']."'")) == 0)
							{
								$answer_option_imp[] = $template_answer->option_name;
								$answer_id_imp[] = $this->common_model->get_record("tbl_admin_copy_template_fields","status=0 and form_fields_id='$template_answer->label_id'","copy_form_field_id");
							}
							else
							{
								foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id='$template_answer->option_name' and assign_id='".$_SESSION['userId']."'") as $template_value) 
								{ 
									$missing[] = $template_value->impression_text;
									
									if($template_value->impression_text == "")
									{
										if(sizeof($title_answer) > 0)
										{
											$answer_option_imp[] = $template_value->name;
										}
										else
										{
											$answer_option_imp[] = "";
										}
									}
									else
									{
										$answer_option_imp[] = $template_value->impression_text;
									}
									//$score += $template_value->score;
								}
							}
							
						}
						
						
						$answer_id1 = array();
						$answer_id1_imp = array();
						$answer_find_imp=array();
						$not=array();
						$all=array();
						$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and copy_template_form_id ='$template_form_id' and assign_id='".$_SESSION['userId']."' group by order_by ");
						
						$j = 0;
						$formtype = array();
						$answer_find_array1 = array();
						$answer_sub_title = array();	
						foreach($formfields as $form)
						{
							array_push($formtype,$form->type);
							if($form->type == 13 || $form->type == 14 ) 
							{
								
								
								$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id = $form->form_fields_id")[0];
								
								
								$collapse = explode("," , $collapse_section->select_fields_id);
								$collapse_title = explode("," , $collapse_section->select_title);
								$selected1 = array();
								foreach($collapse_title as $title_collapse)
								{
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'") as $select)
									{
										$selected1[] = $select->label_id;
									}
								}
								
								$selected12 = array();
								foreach($collapse_title as $title_collapse)
								{
									$select = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and title_id = '$title_collapse'  and type='14' and user_id='".$_SESSION['userId']."'")[0];
							
										$selected12[] = $select->label_id;
									
								}
								$collapse1 = explode("," , $collapse_section->select_fields_id)[0];
								$all_new = array();
								foreach($selected1 as $selected_all)
								{
									$all_new[] = $this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and label_id = '$selected_all' and option_name != '' and type='14' and user_id = '" . $_SESSION['userId'] . "'")[0];
									
								}
								
								$select= $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name = '' and label_id = '$collapse' and type='14' and user_id='".$_SESSION['userId']."'","label_id");
								$notselected = array_diff($collapse,$selected1);
								if(sizeof($all_new) == 0 )
								{
									$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$form->form_fields_id' and option_name ='' and user_id = '".$_SESSION['userId']."'","title_id");
									$alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")[0];
									$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
								}
								else
								{ 
									$collapse_section = $this->common_model->get_records("tbl_collapse_section","status = 0 and template_id = '$template_form_id' and input_id ='$form->form_fields_id'")[0];
									
									foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and option_name = '' and title_id = '$form->title' and label_id ='$collapse_section->input_id' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
									{
										$num1 =2;
										$numbernew =array();
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
										{
											//$answer_find_imp[]=$title_answer->impressing_text;
											$numbernew1[]= $title_answer->impressing_text."$#".$title_answer->finding_collapse;
												// //$num1++;
											array_push($numbernew,$numbernew1);
										}
									}
									
									foreach($numbernew as $numeric)
									{
										$num2 =2;
										foreach($numeric as $numericnew)
										{
											
											$answer_find_imp[]=str_replace("number",$num2 .". ",$numericnew);
											
											$num2++;
										}
									}
									$data = array();
									$data1 = array();
									foreach($selected12 as $sel)
									{
										
										$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","option_name");
										foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selec' and template_form_id ='$template_form_id' and assign_id ='" . $_SESSION['userId'] ."'")as $option_find)
										{
											if($option_find->impression_text == "")
											{
												if($form->title != 0)
												{
													$selec = $this->common_model->get_record('tbl_template_values', "status='0' and template_form_id='$template_form_id' and label_id = '$sel' and user_id='".$_SESSION['userId']."'","title_id");
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selec'")as $title_answer)
													{
														//$answer_find_imp[]=$title_answer->impressing_text;
														$data1[] = array("value"=>$title_answer->impressing_text."$#".$title_answer->finding_collapse, "order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
													}
												}
												
											}
											else
											{
												
												$data[] = array("value"=>$option_find->impression_text."$#".$option_find->template_order_number, "order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$option_find->input_id' and assign_id ='".$_SESSION['userId'] . "'","order_by")); 
												     
												// array_multisort(array_map(function($element) {
													  // return $element['order'];
												  // }, $data), SORT_ASC, $data);
												  
												//print_r($data);
												//$answer_find[]= $data;
											}
											
										}
										
									}
									// $data1 = array();
									// foreach($notselected as $not)
									// {
										
										// $sel = $this->common_model->get_record("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and type='14' and label_id ='$not' and user_id='".$_SESSION['userId']."'","title_id");
										// $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sel'")[0];
										
										// //$answer_find[]=$alltitle->finding_collapse;
										// $data1[] = array("value"=>$alltitle->finding_collapse,"order"=>(int)$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id = '$not' and assign_id='".$_SESSION['userId']."'","order_by"));
										
										  
										// //print_r($data1);
									// }
									$data2=array_merge($data, $data1);
									
									array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data2), SORT_ASC, $data2);
									  
									  foreach($data2 as $answer_finding)
									  {
										 $answer_find_imp[] = $answer_finding['value'];
									  }
								}
								
							}
							
							else
							{
							
								$not_selected=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and option_name = '' and user_id='".$_SESSION['userId']."'");
								$all=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'");
								if($form->title != 0)
								{
									$template_values_hide=$this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$form->title' and user_id='".$_SESSION['userId']."'")[0];
									//$hide_finding_answer = $this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id")[0];
									
									foreach($this->common_model->get_records("tbl_hide_finding_answer","status =0 and template_id='$template_form_id' and title_id='$form->title' group by id") as $hide_finding_answer)
									{
										if(sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and title_id='$hide_finding_answer->title_id_hide' and option_name != '' and user_id='".$_SESSION['userId']."'")) != 0)
										{
											
											if($hide_finding_answer->input_id == $template_values_hide->label_id)
											{
												
												if($form->title != 0)
												{
													$hide_answer_find = $this->common_model->get_records('tbl_hide_finding_answer', "status='0' and template_id='$template_form_id' and title_id = '$form->title'")[0];
													$hide_answer_master = $hide_answer_find->title_id;
													$answer_find_imp[] = $hide_answer_find->show_finding_answer;  
												}
											}
											else
											{
												
												if($form->title != 0)
												{
													$hide_answer_master = 0;
													
												}
											}
										}
									}
								}
								if(sizeof($not_selected)== sizeof($all))
								{
									if($form->title != 0)
									{
									   $alltitle=$this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and testing_impressing != '' and title_id = '$form->title' and title_id != '$hide_answer_master'")[0];
										$answer_find_imp[]=$alltitle->testing_impressing."$#".$alltitle->finding_collapse;
									}
								}
								else
								{
									$joinimpression = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->form_fields_id'");
									if(sizeof($joinimpression) > 0 )
									{
										
										$join = $this->common_model->get_records("tbl_collapse_join_impression","status=0 and template_id='$template_form_id' and collapse_child='$form->form_fields_id'")[0];
										
										$sub = explode(",",$this->common_model->get_records("tbl_collapse_section_sub","status=0 and template_id='$template_form_id' and input_id='$join->collapse_sub'")[0]->select_title);
										
										$data1 = array();
										foreach ($sub as $val)
										{
											$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and title='$val'","order_by"));
											  
										}
										array_multisort(array_map(function($element) {
											  return $element['order'];
										  }, $data1), SORT_ASC, $data1);
										$newarray= array();	
										
										$sub_title = $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$template_form_id' and form_fields_id='$join->collapse_sub'","title");
										
										
										$answer_sub_title =$this->common_model->get_record('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$sub_title'","impressing_text");
										
										array_push($newarray,$answer_sub_title);
										$p=0;
										foreach($data1 as $s)	
										{			
											
											$total = sizeof($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id"));
											
											foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='".$s['value'] ."' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id") as $selected)
											{
												
												$answer_find_array2 = array();
												
												
												foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."' ")as $option_find)
												{
													
													if($option_find->impression_text == "")
													{
														if(sizeof($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'")) > 0 ){
															foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id'") as $title_answer)
															{
																
																if($title_answer->impressing_text != '') 
																{
																	$answer_find_array2[] =$title_answer->impressing_text;
																	$answer_find_array1[] = "$#".$title_answer->finding_collapse;
																}
															}
														}
														else
														{
															$answer_find_array2[] ="";
														}
													}
													else
													{
														
														if(sizeof($answer_find_array1) >=  0)
														{
															$answer_find_array2[] =$option_find->impression_text;
															$answer_find_array1[] = "$#".$title_answer->finding_collapse;
														}
														else
														{
															$answer_find_array2[] =$option_find->impression_text;
														}
													}
													array_push($newarray,$answer_find_array2[0]);
												}
												
												
												//$answer_find_array2 = "$#".$option_find->template_order_number;//array_push($answer_find_array1,$answer_find_array2);
												
											} 
											
											$p++;
										}
										//print_r($newarray);
										
										array_push($newarray,$answer_find_array1[0]);
										$answer_find_array1[] = implode(" ",array_unique($newarray));
								
									}
									else
									{
										foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id ='$form->title' and option_name != '' and user_id='".$_SESSION['userId']."' group by title_id") as $selected)
										{
											
											foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_option_id ='$selected->option_name' and assign_id='".$_SESSION['userId']."' ")as $option_find)
											{
												if($option_find->impression_text == "")
												{
													
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected->title_id' and title_id != 0") as $title_answer)
													{
														
														$answer_find_imp[]=$title_answer->impressing_text."$#".$title_answer->finding_collapse;
														
													}
												}
												else
												{
												
													$answer_find_imp[]=$option_find->impression_text."$#".$option_find->template_order_number;
												}	
												
											}
											
										}
									}
								}
								
								$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_admin_copy_template_fields as c where a.label_id = c.form_fields_id and c.copy_template_form_id ='$template_form_id' and a.option_name = '' and a.option_name = 0 and c.status='0' and a.status='0'  and c.assign_id='".$_SESSION['userId']."' and a.user_id='".$_SESSION['userId']."'");
								foreach($test1 as $t)
								{
									$answer_id1_imp[] =$t->copy_form_field_id;
										
								}
							}
							$j++;
						}
						$answer_find_imp = array_merge($answer_find_imp,$answer_find_array1);
						// print_r($answer_option_imp);
						// echo "<br>";
						$formtype1 = array_unique($formtype);
						$formcollapse = array();
						foreach($formtype1 as  $formtype2)
						{
							if($formtype2 == 13 || $formtype2 == 14)
							{
								array_push($formcollapse,$formtype2);
							}
						}
						$final_result = str_replace($answer_id_imp, $answer_option_imp, $answer_find_imp);
						$final_result1 = str_replace($answer_id1_imp, "" , $final_result);
						
						$data10 = array();
						foreach(array_unique($final_result1) as $final)
						{
							$number = explode("$#",$final); // return 1234
							$ordernumber = preg_replace("/[^0-9 .]/", "",$number[1]);
							//$letters = str_replace($number, "" , $final);
							//$letters = str_replace(' ', "" , $number[1]);
							$data10[] = array("value"=>$number[0], "order"=>$ordernumber);
							//echo $final;
							$j++;
						}
						array_multisort(array_map(function($element) {
							  return $element['order'];
						  }, $data10), SORT_ASC, $data10);
						
						
						$score = array();
						foreach($this->common_model->get_custom_query("SELECT sum(b.score) as score FROM tbl_template_values as a, tbl_input_options as b where a.option_name = b.id and b.input_id = a.label_id and a.template_form_id = '$template_form_id' and a.option_name != '' and a.status='0' and a.user_id='".$_SESSION['userId']."' group by a.title_id") as $sec)
						{
							$score[] = $sec->score;
							
						}
						
						if(sizeof($formcollapse) > 1)
						{
							if($_POST['order_by'] == 1)
							{
								
								$i=1;
								$j=0;
								$age = array();
								foreach($final_result1 as $final)
								{	
									if(!empty($final))
									{
										
										$age[] = array("final"=>$final,"score"=>$score[$j]);
										$i++;
										$j++;
										
									}
								
								}
								array_multisort(array_map(function($element) {
									  return $element['score'];
								  }, $age), SORT_ASC, $age);
								  
								$m=1;
								foreach($age as $as) 
								{
									echo $m .".";
									echo  $as['final'] ." ". $as['score'] ;
									echo "<br>";
									$m++;
								}
									
							}
							else
							{
								$i=1;
								$j=0;
								foreach($data10 as $final1)
								{	
									// if(!empty($final))
									// {
										// if($i == 1)
										// {
											// echo $i .". ";
											// echo ucfirst($final) ." ". $condition_name ." ";
											// //echo "</br>";
											// //echo $score[$j] .  "</br>";
										// }
										// else 
										// { 
											// //echo $i .". ";   
											// echo str_replace("number",(2).".",$final);
										// }
										
										// $i++;
										// $j++;
										// //print_r($final_result1[$i]);
									// }
									if($final1['value'] != '')
									{
										if($i == 1)
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										else
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										$i++;
										$j++;
									}
								}
							}
						}
						else
						{
							if($_POST['order_by'] == 1)
							{
								
								$i=1;
								$j=0;
								$age = array();
								foreach($final_result1 as $final)
								{	
									if(!empty($final))
									{
										
										$age[] = array("final"=>$final,"score"=>$score[$j]);
										$i++;
										$j++;
										
									}
								
								}
								array_multisort(array_map(function($element) {
									  return $element['score'];
								  }, $age), SORT_ASC, $age);
								  
								$m=1;
								foreach($age as $as) 
								{
									echo $m .".";
									echo  $as['final'] ." ". $as['score'] ;
									echo "<br>";
									$m++;
								}
									
							}
							else
							{
								$i=1;
								$j=0;
								// foreach($final_result1 as $final)
								// {	
									// if(!empty($final))
									// {
										// if($i == 1)
										// {
											// echo $i .". ";
											// echo ucfirst($final) ." ". $condition_name ." ";
											// //echo $score[$j] .  "</br>";
											// echo "</br>";
										// }
										// else
										// {
											// echo $i .". ";
											// echo ucfirst($final)." ";
											// //echo $score[$j] .  "</br>";
											// echo "</br>";
										// }
										
										// $i++;
										// $j++;
										// //print_r($final_result1[$i]);
									// }
								// }
								foreach($data10  as $final1)
								{
									if($final1['value'] != '')
									{
										if($i == 1)
										{
											echo $i .". ";
											echo ucfirst($final1['value'])." ". $condition_name ." ";
											echo "</br>";
										}
										else
										{
											echo $i .". ";
											echo ucfirst($final1['value'])."</br>";
										}
										$i++;
										$j++;
									}
									
								}
							}
						}
						
					?>
				<?php //} else { ?>
					<?php 
						//$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id = 0")[0];
					?>
						<?php 
							//echo 1 .". " ;
							//echo $empty_result->impressing_text  
						?>
					
				<?php //} ?>
			</div>
			</div>
			</div>
		</div>
			
	</div>
</div>
<?php endif;?>
