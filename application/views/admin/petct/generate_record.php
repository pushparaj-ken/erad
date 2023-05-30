<div id="div1" >
	<div class="col-md-6">
		<h3 class="temp">FINDINGS</h3> 
		
		<div contentEditable="true" id="content1" class="impressions_text text-box-border">
			<div id="content3">	
				<h3><?=$this->common_model->get_record("tbl_category_with_form","status=0 and id='$template_form_id'","name")?></h3>
				<?php 
					$answer_id = array();
					foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id=c.id  and  c.template_form_id = '$template_form_id' and a.option_name != '' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "' group by c.id order by c.order_by asc ") as $template) 
					{ 
						$answer_id[] = $template->form_fields_id ;
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
						$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'")[0];
						if(sizeof($this->common_model->get_records('tbl_input_options', "status='0' and id='$template_answer->option_name' and template_form_id ='$template_form_id'")) == 0)
						{
							$date = $tis->validateDate($template_answer->option_name);
							if($date == 1)
							{	
								$answer_option[] = date("d-m-Y",strtotime($template_answer->option_name));
							}
							else
							{
								$answer_option[] = $template_answer->option_name;
							}
							//$answer_id[] = $this->common_model->get_record("tbl_form_template_fields","status=0 and id='$template_answer->label_id' order by order_by asc ","form_fields_id");
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
					$new_array=[];
					foreach($formfields as $form)
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
								$answer_find[]=$alltitle->testing_finding."$#".$alltitle->finding_collapse;
							}
							
						}
						else
						{

							
							foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id='$form->title' and option_name != '' and user_id = '". $_SESSION['userId']. "' group by title_id")as $selected)
							{
								
								
								foreach($this->common_model->get_records("tbl_template_values","status = 0 and template_form_id ='$template_form_id'  and title_id='$selected->title_id' and option_name != '' and user_id = '". $_SESSION['userId']. "'") as $selected1)
								{
									
									if(sizeof($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected1->option_name' and template_form_id ='$template_form_id'")) == 0)
									{
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected1->title_id'")as $title_answer)
										{
											
											$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
										}
									} 
									else
									{
										
										foreach($this->common_model->get_records('tbl_input_options', "status='0' and id='$selected1->option_name'")as $option_find)
										{
											
											if($option_find->finding_text == "")
											{
												if($form->title != 0)
												{
													foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$template_form_id' and title_id = '$selected1->title_id'")as $title_answer)
													{
														$answer_find[]=$title_answer->finding_text."$#".$title_answer->finding_collapse;
													}
												}
												
											}
											else
											{
												$answer_find[]=$option_find->finding_text."$#".$option_find->order_by;
											}
											if($option_find->negative_id != 0 && $option_find->negative_id != '')
											{
												$new_array[] = $option_find->negative_id;
												
											}
											
										}
										
									}
									
								}
								
								
							}
							
							
						}
						
						$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id = c.id and c.template_form_id ='$template_form_id' and a.option_name = '' and c.status='0' and a.status='0'  and a.user_id = '". $_SESSION['userId']. "' group by c.id order by order_by asc");
						
						foreach($test1 as $t)
						{
							$answer_id1[] =$t->form_fields_id;
							
						}
						
					}
					$new_array2 = implode(",",array_unique($new_array));
					foreach($this->common_model->get_records('tbl_petct_template', "status='0' and  NOT find_in_set(id,'$new_array2') and template_id='$template_form_id'")as $option_find)
					{
						$answer_find[]=$option_find->finding_text."$#".$option_find->order_by;
					}
					$final_result = str_replace($answer_id, $answer_option, $answer_find);
					$final_result1 = str_replace($answer_id1, "" , $final_result);

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
			<br><b>IMPRESSION:</b> <br>
				<?php 
					//if($this->common_model->get_record('tbl_template_values', "status='0' and template_form_id ='$template_form_id' and option_name != '' ","option_name") != "") {  
				?>
					<?php 
						$answer_id_imp = array();
						foreach ($this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_input_options as b , tbl_form_template_fields as c where a.option_name = b.id and b.input_id = c.id and c.template_form_id = '$template_form_id' and a.option_name != '' and c.status='0' and a.status='0' and a.user_id = '". $_SESSION['userId']. "'") as $template) 
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
							$title_answer = $this->common_model->get_records("tbl_title_answer_master","status=0 and template_id='$template_form_id' and title_id='$template_answer->title_id'")[0];
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
						foreach($formfields as $form)
						{
							array_push($formtype,$form->type);
							
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
							
							$test1 = $this->common_model->get_custom_query("SELECT c.* FROM tbl_template_values as a, tbl_form_template_fields as c where a.label_id = c.id and c.template_form_id ='$template_form_id' and a.option_name = ' ' and c.status='0' and a.status='0'  and a.user_id = '". $_SESSION['userId']. "'");
							foreach($test1 as $t)
							{
								$answer_id1_imp[] =$t->form_fields_id;
									
							}
							
						$j++;
						}
						$formtype1 = array_unique($formtype);
						$formcollapse = array();
						foreach($formtype1 as  $formtype2)
						{
							if($formtype2 == 13 || $formtype2 == 14)
							{
								array_push($formcollapse,$formtype2);
							}
						}
						//foreach($answer_find_imp as )
						
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
