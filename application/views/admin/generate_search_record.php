
<div id="div5" >
	<div class="col-md-6">
		<h3 class="temp1">FINDINGS</h3> 
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content1"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content11" class="impressions_text1 text-box-border text-box-border-scroll box-height-fix">
			<div id="content31">
				
				<b>FINDINGS:</b><br>
				
				<?php 
					$answer_option2 = array();
					$answer_id = array();
					
					$answer_option = array();	
					
					
					$answer_find=array();
					
					$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and title ='$record->title' and copy_template_form_id='$record->copy_template_form_id' and title != '0' and assign_id='".$_SESSION['userId']."'");
					if(sizeof($formfields) > 1)
					{
						foreach($formfields as $form)
						{
							$answer_id[] = $form->copy_form_field_id;
							$answer_option1 = array();	
							foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id ='$form->form_fields_id' and assign_id='".$_SESSION['userId']."'")as $option_find)
							{
								
								if($option_find->finding_text == "")
								{
									$answer_option_new =$option_find->name;
									foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$record->copy_template_form_id' and title_id = '$record->title'")as $title_answer)
									{
										
										$answer_find[] =$title_answer->finding_text;
									}
									array_push($answer_option1,$answer_option_new);
								}
								else
								{
									$answer_option_new =$option_find->finding_text;
									$answer_find[] =$option_find->finding_text;
									array_push($answer_option1,$answer_option_new);
								}
								
							}
							array_push($answer_option,$answer_option1);
						}
						$answer_main = [];
						foreach(range(1, 24) as $i)
						{
							$answer_main[] = $answer_id;
						}
						$finding_main = [];
						foreach(range(1, 24) as $i)
						{
							$finding_main[] = array_unique($answer_find);
						}
						
						$l = $answer_option[0];
						$m = $answer_option[1];
						$n = $answer_option[2];
						$z=0;
						$answer_new_option = array();
						foreach($l as $o)
						{
							foreach($m as $p)
							{
								foreach($n as $q)
								{
									$answer_new_option[] = array($o,$p,$q);
								}
							}
						}
						$final_result = array();
						foreach($answer_new_option as $ans)
						{		
							
							$final_result[] = str_replace($answer_main[0], $ans, $answer_find[0]);
							
						}
						$i=1;
						foreach($final_result   as $final1)
						{
							
							if($final1 != '')
							{
								?>
									<label class="searchclickhide">
										<input type="checkbox" class="form-check-input insta-click"  data-clipboard-target="#click<?=$i?>" onclick="copyText(<?=$i?>)">
										<span id="click<?=$i?>" class="click" >
											<?=$final1?><br>
										</span>
									</label>
								<?php
								echo "<br>";
							}
							
							$i++;
						}
					}
					else
					{
						
						foreach($formfields as $form)
						{
							foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id ='$form->form_fields_id' and assign_id='".$_SESSION['userId']."'")as $option_find)
							{
								
								if($option_find->finding_text == "")
								{
									if($form->title != 0) 
									{
										foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$form->copy_template_form_id' and title_id = '$form->title'")as $title_answer)
										{
											$answer_find[] =$title_answer->finding_text;
										}
									}
									$answer_option[] = $option_find->name;
									
								}
								else
								{
									$answer_option[] = $option_find->finding_text;
									$answer_find[] =$option_find->finding_text;
								}
								$answer_id[]  = $form->copy_form_field_id;	
										
							}
						}
						
						$final_result = str_replace($answer_id, $answer_option, $answer_find);
						
						$i=1;
						foreach(array_unique($final_result)   as $final1)
						{
							
							if($final1 != '')
							{
								?>
									<label class="searchclickhide">
										<input type="checkbox" class="form-check-input insta-click"  data-clipboard-target="#click<?=$i?>" onclick="copyText(<?=$i?>)">
										<span id="click<?=$i?>" class="click" >
											<?=$final1. ". "?><br>
										</span>
									</label>
								<?php
								echo "<br>";
							}
							
							$i++;
						}
					}
					
				?>
					
				
			</div>
		</div>
			
	</div>
	<div class="col-md-6" >
		<h3 class="temp1">IMPRESSION</h3>
			<!--<a class="copy-text btn btn-primary" data-clipboard-target="#content2"  href="javascript:void(0)">Copy To Clipboard</a>-->
		<?php 
			$empty_result = $this->common_model->get_records("tbl_title_answer_master","status='0' and template_id ='$template_form_id'and title_id =0")[0];
		?>
		<div contentEditable="true" id="content21" class="text-box-border  text-box-border-scroll box-height-fix">
			<div id="content41" >
				<b >IMPRESSION:</b> <br>
				<div id="content51" class="finding1" >
				
				<?php 
					$answer_id_imp = array();
					$answer_option_imp = array();
					$answer_find_imp=array();
					$formfields =$this->common_model->get_records("tbl_admin_copy_template_fields","status = 0 and title ='$record->title' and copy_template_form_id='$record->copy_template_form_id' and title != '0' and assign_id='".$_SESSION['userId']."' ");
					if(sizeof($formfields) > 1)
					{
						foreach($formfields as $form)
						{
							$answer_id_imp[] = $form->copy_form_field_id;
							$answer_option1 = array();	
							foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id ='$form->form_fields_id' and assign_id='".$_SESSION['userId']."'")as $option_find)
							{
								
								if($option_find->impression_text == "")
								{
									$answer_option_new =$option_find->name;
									foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$record->copy_template_form_id' and title_id = '$record->title'")as $title_answer)
									{
										
										$answer_find_imp[] =$title_answer->impressing_text;
									}
									array_push($answer_option1,$answer_option_new);
								}
								else
								{
									$answer_option_new=$option_find->impression_text;
									$answer_find_imp[] =$option_find->impression_text;  
									array_push($answer_option1,$answer_option_new);
								} 
								
							}
							array_push($answer_option_imp,$answer_option1);
						}
						$answer_main = [];
						foreach(range(1, 24) as $i)
						{
							$answer_main[] = $answer_id_imp;
						}
						$finding_main = [];
						foreach(range(1, 24) as $i)
						{
							$finding_main[] = array_unique($answer_find_imp);
						}
						
						$l = $answer_option_imp[0];
						$m = $answer_option_imp[1];
						$n = $answer_option_imp[2];
						$z=0;
						$answer_new_option = array();
						foreach($l as $o)
						{
							foreach($m as $p)
							{
								foreach($n as $q)
								{
									$answer_new_option[] = array($o,$p,$q);
								}
							}
						}
						$final_result = array();
						foreach($answer_new_option as $ans)
						{		
							
							$final_result[] = str_replace($answer_main[0], $ans, $answer_find_imp[0]);
							
						}
						$j=rand(100,1000);
						foreach($final_result as $final1)
						{
							
							if($final1 != '')
							{
								?>
									<label class="searchclickhide">
										<input type="checkbox" class="form-check-input insta-click"  data-clipboard-target="#click<?=$j?>" onclick="copyText(<?=$j?>)">
										<span id="click<?=$j?>" class="click" >
											<?=ucfirst($final1)?><br>
										</span>
									</label>
								<?php
								echo "<br>";
							}
							
							$j++;
						}
					}
					else
					{
						foreach($formfields as $form)
						{
							foreach($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id ='$form->form_fields_id' and assign_id='".$_SESSION['userId']."'")as $option_find)
							{
								if($option_find->impression_text == "")
								{
									
									foreach($this->common_model->get_records('tbl_title_answer_master', "status='0' and template_id='$form->copy_template_form_id' and title_id = '$form->title'")as $title_answer)
									{
										
										$answer_find_imp[]=$title_answer->impressing_text;
										
									}
									$answer_option_imp[] = $option_find->name;
								}
								else
								{
									
									$answer_find_imp[]=$option_find->impression_text;
									$answer_option_imp[] = $option_find->impression_text;
								}	
								$answer_id_imp[] = $form->copy_form_field_id;
							}
						}
						
						$final_result = str_replace($answer_id_imp, $answer_option_imp, $answer_find_imp);
						$i=1;
						$j=rand(100,1000);
						foreach(array_unique($final_result)  as $final1)
						{
							if($final1 != '')
							{
							?>
								<label class="searchclickhide">
									<input type="checkbox" class="form-check-input insta-click"  data-clipboard-target="#click<?=$j?>" onclick="copyText(<?=$j?>)">
									<span id="click<?=$j?>" class="click" >
										<?=ucfirst($final1). ". "?><br>
									</span>
								</label>
								
							<?php
								echo "<br>";
								$i++;
								$j++;
							}
							
						}
					}
					
				?>
			</div>
			</div>
			</div>
		</div>
			
	</div>
</div>
