

<style>
.mousepoint {
		cursor: pointer;
	}
.custom-btn {
    position: absolute;
    left: 152px;
    top: -44px;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}
.dropdown-menu  a{
    color:#000 !important;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}

.cs-options{
	display: flex;
    flex-wrap: wrap;
    justify-content:start;
    align-items: baseline;
	border: 2px solid #6c5ffc;
	margin-bottom:20px !important;
	
}

.cs-options .radio{
 padding:20px;
}



.cs-select{
padding-bottom:20px !important;
}
.click{
	font-weight:normal !important;
}

.scroll-down{
	max-height: 300px;
    overflow-y: auto;
}

.open-close{
	background-color:green ! important;
}
.open-close:hover{
	background-color:green ! important;
}
.open-close1{
	background-color:#000 ! important;
}
.open-close1:hover{
	background-color:#000 ! important;
}
.text-box-border-scroll {
	height: 300px;
    overflow: hidden;
    overflow-y: scroll;
}


@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink_cus {
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.06s;
	-webkit-animation-iteration-count:50;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
	
}


</style>

<header class="main-header ">
    <nav class="navbar navbar-static-top" style="background:#fff;">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" style="color:#000;">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<?php $userId = $_SESSION['userId'];?>
				<?php foreach($this->common_model->get_records("tbl_category","status ='0' and find_in_set('$userId',user_id)")as $category): ?>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="javascript:void()" style="color:#000;" class="dropdown-toggle" data-toggle="dropdown"aria-expanded="false">
								<?=$category->name?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
								<li class="divider"></li>
								<?php foreach($this->common_model->get_records("tbl_sub_category","status ='0' and category_id ='$category->id'")as $sub_category): ?>
									<li class="dropdown-submenu">
										<a tabindex="-1" href="javascript:void()">
											<?=$sub_category->name?>
										</a>
										<ul class="dropdown-menu scroll-down">
											<?php foreach($this->common_model->get_custom_query("SELECT e.name , c.template_id FROM tbl_template_assign as c , tbl_category_with_form as d , tbl_child_category as e where c.status = 0 and d.status = 0 and e.status = 0 and c.assigned_to = '".$_SESSION['userId']."' and e.sub_category_id = '$sub_category->id' and d.id = c.template_id and e.id = d.child_category_id ") as $child_category_form): ?>
												<li>
													<a tabindex="-1" href="<?= base_url() ?>admin/admin-view-form-template/<?=$child_category_form->template_id?>">
														<?=$child_category_form->name?>
													</a>
												</li>
											<?php endforeach;?>	
										</ul>
									</li>
								<?php endforeach;?>
							</ul>
						</li>    
					</ul>
				<?php endforeach;?>
            </div>
			<div class="text-right" style="margin: 15px 10px;">
				<a class="btn btn-sm btn-primary2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default">
					References
				</a>
			</div>
        </div>
    </nav>
</header>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">References Documents</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">1. Prompt rad procedure</label>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188298963a6e8ed42092.docx" >
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">2. Stat portable procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188302163a6e90d1d562.docx">
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">3. Umedex procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188291563a6e8a3cd4bf.docx">
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">4. TMI procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20231901167410580263c8d3cadd6a4.pdf">
								view
							</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="content-wrapper pb-1 cs-font">
    <section class="content  color-bg1 py-6">
        <div class="row">
            <div class="col-md-12  mr-mi-30 mr-lg-0">
                <div class="">
                    <div class="">
                        <div class=" box-primary">
                            <div class="box-header py-0 ">
                                <div class="row box-card mb-6">
                                    <div class="col-sm-11">
                                        <h4 class="text-center head-title"><?= $temp_id->name ?></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 ">
                <form id="insert_template" class="insert_template" reload-action="true" method="post"
                    this_id="<?= uniqid() ?>">
                    <input type="hidden" name="template_form_id" value="<?php echo $temp_id->id ?>">
					<input type="hidden" name="user_id" value="<?= $_SESSION['userId'] ?>">
                    <div class="box-body">
                        <div class="row">
                           <?php
                                $template = $this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and copy_template_form_id='$temp_id->id'  group by order_by");
                                foreach ($template as $order) {
                                ?>
 
                            <div class="box-card mb-none">
                                <div class="box-body py-0">
                                    <?php if ($order->type != 14 && $order->type != 16 && $order->type != 17 && $order->type != 15 && $order->type != 18): ?>
									<div class="col-md-12">
										<h3>
											<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$order->title'","title");?>
										</h3>
									</div>
                                    <?php endif; ?>
                                    <?php foreach ($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and copy_template_form_id='$temp_id->id'  and order_by like '$order->order_by'") as $template_field) { ?>
                                    <?php if ($template_field->type == 10) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?></label>
                                            <select type="text" class="form-control select2" name="method[]"
                                                id="<?= $template_field->form_fields_id ?>">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id' ") as $options) : ?>
                                                <option value="<?= $options->name ?>"><?= $options->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php } else if ($template_field->type == 9) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?> <input type="checkbox" id="date" class="date-checked" name="date" onchange="datefunction()" value="1"></label>
                                            <input type="date" name="comparison_date" class="form-control h-20"
                                                id="date1">
                                        </div>
                                    </div>
                                    <?php } else if ($template_field->type == 2) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?></label>
                                            <select type="text" class="form-control select2" name="option_name[]"
                                                id="<?= $template_field->form_fields_id ?>">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id'") as $options) : ?>
                                                <option value="<?= $options->input_option_id ?>">
                                                    <?= $options->name ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
                                        <input type="hidden" value="<?= $template_field->form_fields_id ?>"
                                            name="label_id[]">
                                        <input type="hidden" value="<?= $order->title ?>" name="title_id[]">
										<input type="hidden" name="type[]" value="<?=$order->type ?>">
                                    </div>
                                    <?php } else if ($template_field->type == 4) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group " id="checkbox">
                                            <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id'") as $options) : ?>
                                            <input type="checkbox" name="option_name[]" id="<?= $template_field->id ?>"
                                                onclick="hideshow(<?= $options->id ?>)"
                                                value="<?= $options->input_option_id ?>">
                                            <?= $options->name ?>
                                            <!--<input id='testNameHidden' type='hidden' value='0' name='option_name[]'>-->
                                            <?php endforeach; ?>
                                        </div>

                                        <input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
                                        <input type="hidden" value="<?= $template_field->form_fields_id ?>"
                                            name="label_id[]">
                                        <input type="hidden" value="<?= $order->title ?>" name="title_id[]">
										<input type="hidden" name="type[]" value="<?=$order->type ?>">
                                    </div>
									<?php } else if ($template_field ->type == 12) { ?>
										<div class="col-md-12">
											<div class="form-group " id="text-input">
											<label for="exampleInputEmail1"><?= $template_field->name ?></label>
											   <input type="text" class="form-control" name="history[]" >
											</div>
										</div>
									<?php } else if ($template_field ->type == 20) { ?>
										<div class="col-md-12">
											<div class="form-group " id="text-input">
											<label for="exampleInputEmail1"><?= $template_field->name ?></label>
											   <input type="text" class="form-control" name="radiation_dose[]" >
											</div>
										</div>
									<?php } else if ($template_field ->type == 32) { ?>
										<!--<div class="col-md-12">
											<div class="form-group " id="text-input">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
											   <input type="text" class="form-control" name="description[]" >
											</div>
										</div>-->
										<div class="col-md-12">
											<div class="form-group" id="<?= $template_field->id ?>">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
												<select type="text" class="form-control" name="description[]" id="<?= $template_field->form_fields_id ?>">
													<option selected disabled >-- Select --</option>
													<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id' ") as $options) : ?>
														<option value="<?= $options->name ?>"><?= $options->name ?></option>
													<?php endforeach; ?>
												</select>
												<input type="hidden" class="form-control" name="new_template[]" value="1">
											</div>
										</div>
									<?php } else if ($template_field ->type == 34) { ?>
										
										<div class="col-md-4">
											<div class="form-group" id="<?= $template_field->id ?>">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
												<select type="text" class="form-control select2" name="contrast[]"
													id="<?= $template_field->form_fields_id ?>">
													<option value="">-- Select --</option>
													<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id' ") as $options) : ?>
													<option value="<?= $options->name ?>"><?= $options->name ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									<?php } else if ($template_field ->type == 33) { ?>
										<div class="col-md-12">
											<div class="form-group " id="text-input">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
											   <input type="text" class="form-control" name="clinic_indiction[]" >
											</div>
										</div>
									<?php } else if ($template_field ->type == 1) { ?>
										<div class="col-md-12">
											<div class="form-group " id="text-input">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
											   <input type="text" class="form-control" name="option_name[]" >
											</div>
											<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
											<input type="hidden" value="<?= $template_field->form_fields_id ?>" name="label_id[]">
											<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
											<input type="hidden" name="type[]" value="<?=$order->type ?>">
										</div>
									<?php } else if ($template_field ->type == 13 ) { ?>
										<div class="col-md-9">
											<div class="form-group" id="<?= $template_field->id ?>">
												<label for="exampleInputEmail1"><?= $template_field->name ?></label>
												<select type="text" class="form-control select2" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
													<option value="">-- Select --</option>
													<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id' ") as $options) : ?>
														<option value="<?= $options->input_option_id ?>"><?= $options->name ?></option>
													<?php endforeach; ?>
													<input type="hidden" value="0" name="collapse_type[]">
												</select>
											</div>
											<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
											<input type="hidden" value="<?= $template_field->form_fields_id ?>" name="label_id[]">
											<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
											<input type="hidden" name="type[]" value="<?=$order->type ?>">
										</div>
										<?php foreach($this->common_model->get_records("tbl_collapse_section","status=0 and input_id='$template_field->form_fields_id'") as $collapse):?>
											<div class="col-md-1">
												<div style=" margin-top: 2.5rem">
													<button class="btn btn-primary2 text-right" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1">
														Collapse
													</button>
												</div>
											</div>
											<div class="collapse" id="collapseExample1<?=$collapse->id?>">
												<div class="card card-body">
													<?php $collapse_titles = explode("," , $collapse->select_title)?>
														<?php 
															
															$data1 = array();
															foreach ($collapse_titles as $val)
															{
															 
																$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and copy_template_form_id='$temp_id->id' and title='$val'","order_by"));
																  
															}
															
															array_multisort(array_map(function($element) {
																  return $element['order'];
															  }, $data1), SORT_ASC, $data1);		
														?>
														<?php foreach($data1 as $collapse_title):?>
															<?php if(!empty($collapse_title['order'])): ?>
																<div class="col-md-12">
																	<h3>
																		<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '" . $collapse_title['value'] ."' ","title");?>
																	</h3>
																</div>
															<?php endif;?>
														
														<?php foreach($this->common_model->get_custom_query("SELECT a.form_fields_id  FROM `tbl_admin_copy_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.assign_id='".$_SESSION['userId']."' and a.copy_template_form_id = '$temp_id->id' and b.id ='" . $collapse_title['value'] ."' and a.title = b.id") as $collapse_item): ;?>
													<div class="col-md-12">
														<div class="form-group" id="<?=$collapse_item->id?>">
															<label for="exampleInputEmail1">
																<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id' and copy_template_form_id = '$temp_id->id'", "name") ?>
															</label>
															<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																<option value="" >-- Select --</option>
																<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$collapse_item->form_fields_id' and template_form_id='$temp_id->id'") as $options) : ?>
																	<option value="<?= $options->input_option_id ?>"><?= $options->name ?></option>
																<?php endforeach; ?>
																<input type="hidden" value="1" name="collapse_type[]">
															</select>
														</div>
														<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and form_fields_id='$collapse_item->form_fields_id'", "name") ?>" name="label_name[]">
														<input type="hidden" value="<?= $collapse_item->form_fields_id ?>" name="label_id[]">
														<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and form_fields_id='$collapse_item->form_fields_id'", "title") ?>" name="title_id[]">
														<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and form_fields_id='$collapse_item->form_fields_id'", "type") ?>" name="type[]">
													</div>
													<?php endforeach;?>
													<?php endforeach;?>
												</div>
											</div>
										<?php endforeach;?>	
										<?php } else if ($template_field ->type == 15 ) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
													<input type="hidden" value="<?= $template_field->form_fields_id ?>" name="label_id[]">
													<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
													<input type="hidden" name="type[]" value="<?=$order->type ?>">
													<?php foreach($this->common_model->get_records("tbl_collapse_section_main","status=0 and input_id='$template_field->form_fields_id'") as $collapse):?>
													<label for="exampleInputEmail1" class="collapseExample1<?=$collapse->id?> mousepoint" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1" id="collapsed<?= $template_field->id ?>" onclick="getClass(<?=$collapse->id?>)" >
														<h3 class="collapse-red" id="blink<?=$template_field->form_fields_id?>">
															<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$order->title'","title");?>
															<i class="fa fa-angle-down faicon<?=$collapse->id?>" data-icon="new-icon"></i>
														</h3>
													</label>
													<input type="hidden" value="0" name="option_name[]">
													<input type="hidden" value="0" name="collapse_type[]">
													<!--<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$template_field->form_fields_id'") as $options) : ?>
															<option value="<?= $options->input_option_id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
														<input type="hidden" value="0" name="collapse_type[]">
													</select>-->
												</div>
												
											</div>
											
												<!--<div class="col-md-1">
													<div style=" margin-top: 2.5rem">
														<button class="btn btn-primary2 text-right collapseExample1<?=$collapse->id?>" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClass(<?= $collapse->id ?>);">
															Collapse Sub
														</button>
													</div>
												</div>-->
												<div class="collapse" id="collapseExample1<?=$collapse->id?>">
													<div class="card card-body">
														<?php $collapse_titles = explode("," , $collapse->select_title)?>
														<?php 
															
															$data1 = array();
															foreach ($collapse_titles as $val)
															{
															 
																$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and copy_template_form_id='$temp_id->id'  and title='$val'","order_by"));
																  
															}
															
															array_multisort(array_map(function($element) {
																  return $element['order'];
															  }, $data1), SORT_ASC, $data1);		
														?>
														<?php foreach($data1 as $collapse_title):?>
															<?php if(!empty($collapse_title['order'])): ?>
																<!--<div class="col-md-12">
																	<h3>
																		<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '" . $collapse_title['value'] ."' ","title");?>
																	</h3>
																</div>-->
															<?php endif;?>
														
														<?php foreach($this->common_model->get_custom_query("SELECT a.form_fields_id,a.title,a.id  FROM `tbl_admin_copy_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.assign_id='".$_SESSION['userId']."' and a.copy_template_form_id = '$temp_id->id' and b.id ='" . $collapse_title['value'] ."' and a.title = b.id  order by a.order_by asc") as $collapse_item): ;?>
														
															<div class="col-md-12">
																<div class="form-group" id="<?=$collapse_item->form_fields_id?>">
																	<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "name") ?>" name="label_name[]">
																	<input type="hidden" value="<?= $collapse_item->form_fields_id ?>" name="label_id[]">
																	<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "title") ?>" name="title_id[]">
																	<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "type") ?>" name="type[]">
																	<?php $select_fields_id_sub = explode("," , $collapse->select_fields_id_sub)?>
															
																	<?php $collapsechild_new = $this->common_model->get_records("tbl_collapse_section_sub","status=0 and input_id='$collapse_item->form_fields_id'")[0];?>
																	<label for="exampleInputEmail1" class="collapseExample12<?=$collapse_item->form_fields_id?> mousepoint" data-toggle="collapse" href="#collapseExample12<?=$collapsechild_new->id?>"  aria-expanded="false" aria-controls="collapseExample1" id="collapsed<?= $template_field->id ?>" onclick="getClasschild(<?= $collapsechild_new->id ?>);">
																		<h4 class="collapse-green" id="blink<?=$collapse_item->form_fields_id?>">
																			<b><?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$collapse_item->title'","title");?></b>
																			<i class="fa fa-angle-down faicon2<?=$collapsechild_new->id?>" data-icon2="new-icon2"></i>
																		</h4>
																	</label>
																	<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																		<option value="" >-- Select --</option>
																		<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and input_id='$collapse_item->form_fields_id' and template_form_id='$temp_id->id' ") as $options) : ?>
																			<option value="<?= $options->input_option_id ?>"><?= $options->name ?></option>
																		<?php endforeach; ?>
																		<input type="hidden" value="1" name="collapse_type[]">
																	</select>
																</div>
																
																
															</div>
															
																<!--<div class="col-md-1">
																	<div style=" margin-top: 2.5rem">
																		<button class="btn btn-primary2 text-right collapseExample12<?=$collapsechild_new->id?>" data-toggle="collapse" href="#collapseExample12<?=$collapsechild_new->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClasschild(<?= $collapsechild_new->id ?>);">
																			Collapse child
																		</button>
																	</div>
																</div>-->
																<div class="collapse" id="collapseExample12<?=$collapsechild_new->id?>">
																	<div class="card card-body">
																		<?php $collapse_titles = explode("," , $collapsechild_new->select_title)?>
																		<?php 
																			
																			$data1 = array();
																			foreach ($collapse_titles as $val)
																			{
																			 
																				$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id = '" . $_SESSION['userId'] . "' and copy_template_form_id='$temp_id->id'  and title='$val'","order_by"));
																				  
																			}
																			
																			array_multisort(array_map(function($element) {
																				  return $element['order'];
																			  }, $data1), SORT_ASC, $data1);		
																		?>
																		<?php foreach($data1 as $collapse_title):?>
																			<?php if(!empty($collapse_title['order'])): ?>
																				<div class="col-md-12">
																					<h4 class="collapse-blue" >
																						<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '" . $collapse_title['value'] ."' ","title");?>
																					</h4>
																				</div>
																			<?php endif;?>
																		
																		<?php foreach($this->common_model->get_custom_query("SELECT a.form_fields_id ,a.id,a.type FROM `tbl_admin_copy_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.assign_id='".$_SESSION['userId']."'  and a.copy_template_form_id = '$temp_id->id' and a.title ='" . $collapse_title['value'] ."'   group by a.id order by a.order_by asc") as $collapse_item): ;?>
																		<?php if($collapse_item->type != 18){?>
																			<div class="col-md-12">
																				<div class="form-group" id="<?=$collapse_item->form_fields_id?>">
																					<label for="exampleInputEmail1" id="blink<?=$collapse_item->form_fields_id?>">
																						<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id' ", "name") ?>
																					</label>
																					<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																						<option value="" >-- Select --</option>
																						<?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and assign_id='".$_SESSION['userId']."' and input_id='$collapse_item->form_fields_id' and template_form_id='$temp_id->id' and assign_id = '" . $_SESSION['userId'] . "'") as $options) : ?>
																							<option value="<?= $options->input_option_id ?>"><?= $options->name ?></option>
																						<?php endforeach; ?>
																						<input type="hidden" value="1" name="collapse_type[]">
																					</select>
																					
																				</div>
																				
																				<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "name") ?>" name="label_name[]">
																				<input type="hidden" value="<?= $collapse_item->form_fields_id ?>" name="label_id[]">
																				<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "title") ?>" name="title_id[]">
																				<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "type") ?>" name="type[]">
																			</div>
																		<?php } else {?>
																				<div class="col-md-12">
																					<div class="form-group " id="text-input">
																						<label for="exampleInputEmail1">
																							<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id' ", "name") ?>
																						</label>
																					   <input type="text" class="form-control" name="option_name[]" >
																					</div>
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "name") ?>" name="label_name[]">
																					<input type="hidden" value="<?= $collapse_item->form_fields_id ?>" name="label_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "title") ?>" name="title_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_admin_copy_template_fields', "status='0' and assign_id='".$_SESSION['userId']."' and form_fields_id='$collapse_item->form_fields_id'", "type") ?>" name="type[]">
																				</div>
																			<?php } ?>
																		<?php endforeach;?>
																		<?php endforeach;?>
																	</div>
																</div>
														<?php endforeach;?>
														<?php endforeach;?>
														
													</div>
												</div>
												
											<?php endforeach;?>	
										<?php } }  ?>

                                </div>
                            </div>
							
                            <?php    } ?>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary2">Generate</button>
                        <a class="btn btn-primary2 clear-genrate" onclick="$('.insert_template')[0].reset()">clear</a>
                        <!--<span class="btn btn-primary2 foo" data-clipboard-target="#div1" onclick="myFunction1()">
                            Copy
                        </span>-->
                    </div>


                </form>
            </div>

			<div class="col-md-6 py-5 py-xl-0 ml-4 ml-lg-0 mr-mi-30 mr-lg-0">
                <div class="row mr-30">
                    <div class="col-md-12 box-card">

                        <div class="col-md-12">
                            <label> Search</label>
                            <label class="my-3"> Title</label>
                            <select name="search_title" id="search_title" class="form-control select2" onchange="scrollToForm()"> 
								<option value="" >-- Select Title--</option>
								<?php foreach($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$temp_id->id' and assign_id = '" . $_SESSION['userId'] . "' and title !='0' group by title  order by order_by asc ") as $title):?>
									<?php 
										$subcollapse = $this->common_model->get_record("tbl_collapse_section_main","status=0 and input_id='$title->form_fields_id'","id");
										if($subcollapse == '')
										{
											$subcollapse = $this->common_model->get_record("tbl_collapse_section_sub","status=0 and input_id='$title->form_fields_id'","id");
											if($subcollapse == '')
											{
												$subcollapse = 1;
											}
											
										}
									?>
									<option value="<?=$title->form_fields_id?>" data-collapse="<?=$title->type?>" data-subcollapse="<?=$subcollapse?>">
										<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$title->title'","title");?>
									</option>
								<?php endforeach;?>
							</select>
                        </div>


                        <ul id="searchResult"></ul>

						<div class="text-right">
							<span class="btn btn-primary2 foo mr-4 mt-4" data-clipboard-target="#div1" onclick="myFunction1()">
								Copy
							</span>
							<span class="btn btn-primary2 mr-4 mt-4" onclick="order_by()">
								Order By
							</span>
						</div>
                        <div class="col-md-6 hide-ans">
                            <h3>Findings</h3>
                            <div class="text-box-border">

                            </div>
                        </div>
                        <div class="col-md-6 hide-ans">
							
                            <h3>Impressions</h3>
						
                            <div class="text-box-border">
                                <div class="impressions_text finding"> </div>
                            </div>
                        </div>
						
						
						<div class="answer_text"></div>
						
                        <div class="answer_search1"></div>  
						
						<form class="condition-form">
							<div class="col-md-12 " id="conditions">
								<h3>Conditions</h3>
								<div class="form-group cs-options">
									<?php foreach($this->common_model->get_records("tbl_condition","status = 0 and template_id = '$temp_id->id'") as $condition):?>
										<div class="radio">
											<label>
												<input type="radio" name="condition_name_id" id="optionsRadios<?=$condition->id?>" value="<?=$condition->id?>"  onchange="get_condition(this);">
													<?=$condition->name ?>
											</label>
										</div>
									<?php endforeach;?>
								</div>
								<div class="form-group cs-select">
									<select id="cs-opt" class="form-control" onchange="$(this).parent().submit();" name="condition_name">
										<option></option>
									</select>
									<input type="hidden" name="created_by" value="<?=$_SESSION['userId']?>" >
									<input type="hidden" name="template_id" value="<?=$temp_id->id?>" >
								</div>
							</div>
						</form>
						<!-- <div class="col-md-6 hide-ans" id="answer_textss">
								<h3>Findings</h3>
								<div class="text-box-border">

								</div>
							</div>
							<div class="col-md-6 hide-ans">
								<h3>Impressions</h3>
								<div class="text-box-border">
									<div class="impressions_text"></div>
								</div>
							</div> -->
                        <!-- <div class="answer_text btn_hide_class"></div> -->
                    </div>
                </div>
				<div class="row mr-30 pt-4 pb-4 box-card">
					<div class="pannel-section">
						<div class="col-md-6"> 
							<div class="panel-section">
								<div class="panel-heading">
									<h4>Search For Instant Clicks</h4>
						  		</div>
								<div class="panel-body">
									<form class="insta-click-search">
										<div class="form-group">
											<input type="text" name="search_click" class="form-control" placeholder="Search For Instant Clicks">
										</div>
										<div class="button-group">
											<button class="btn btn-primary2" type="submit">Submit</button>
											<a class="btn btn-primary2 instant-clear" onclick="$('.insta-click-search')[0].reset()">clear</a>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6"> 
							<div class="panel-section">
								<div class="panel-heading">
									<h4>Search Results</h4>
								</div>
								<div class="panel-body">
									 <div class="result-content-section">
									 
									 </div>
								</div>
							</div>
						</div>
						<div class="col-md-12"> 
							<div class="panel-section">
								<div class="panel-heading">
									<h4 class="text-center">INSTANT CLICKS</h4>
								</div>
								<div class="panel-body">
									<div class="instant-clicks-content" >
										<p class="mb-0 searchclickhide" ><strong>BEGINNING</strong></p>
										<?php foreach($this->common_model->get_records("tbl_instant_click","status = 0 and condition_id ='1' and template_id ='$temp_id->id'") as $beginning):?>
											<label class="searchclickhide">
												<input type="checkbox" class="form-check-input insta-click"  data-clipboard-target="#click<?=$beginning->id?>" onclick="copyText(<?=$beginning->id?>)">
												<span id="click<?=$beginning->id?>" class="click">
													<?=$beginning->name?>
												</span>
											</label>
										<?php endforeach;?>
										<p class="mb-0 searchclickhide"><strong>MIDDLE</strong></p>
										<?php foreach($this->common_model->get_records("tbl_instant_click","status = 0 and condition_id ='2' and template_id ='$temp_id->id' ") as $middle):?>
											<label class="searchclickhide">
												<input type="checkbox" class="form-check-input insta-click" data-clipboard-target="#click<?=$middle->id?>" onclick="copyText(<?=$middle->id?>)">
												<span id="click<?=$middle->id?>" class="click" >
													<?=$middle->name?>
												</span>
											</label>
										<?php endforeach;?>
										
										<p class="mb-0 searchclickhide"><strong>END</strong></p>
										<?php foreach($this->common_model->get_records("tbl_instant_click","status = 0 and condition_id ='3' and template_id ='$temp_id->id' ") as $end):?>
											<label class="searchclickhide">
												<input type="checkbox" class="form-check-input insta-click" data-clipboard-target="#click<?=$end->id?>" onclick="copyText(<?=$end->id?>)">
												<span id="click<?=$end->id?>" class="click">
													<?=$end->name?>
												</span>
											</label>
										<?php endforeach;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>  
        </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
<script>
function order_by() {
    $.ajax({
		type: 'POST',
		url: baseURL + "admin/get_answer_value",
		data: "template_id=" + temp_id + "&order_by=" + 1,
		success: function(response2) {
			$('.answer_text').html(response2);
			$('.hide-ans').hide();

		}
	});
}
</script>
<script>
var temp_id = null;
var arr2 = [];
$('body').on("submit", '.condition-form', function(e){
	e.preventDefault();
	 var condition_name = $('select[name=condition_name]').val();
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/condition-form",
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		processData: false,
		success: function(response){
			if(response.result == 1)
			{
				$.ajax({
					type: 'POST',
					url: baseURL + "admin/get_answer_value",
					data: "template_id=" + temp_id + "&condition_name=" + condition_name,
					success: function(response2) {
						$('.answer_text').html(response2);
						$('.hide-ans').hide();

					}
				});
			}
			else
			{
				toastr.error("You don't have permission to update the attendance for the day.");
			}
		}
	});
});

$('body').on("submit", '.insta-click-search', function(e){
	e.preventDefault();
	var search_click = $('input[name=search_click]').val();
	//var template_id = <?=$temp_id->id?>;
	var template_id = $('input[name=template_form_id]').val();
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/insta-click-search",
		data: "template_id=" + template_id + "&search_click=" + search_click,
		dataType: "json",
		success: function(response){
			if(response.result == 1)
			{
				$.each(response.serach, function(key, val) {
					$(".result-content-section").append("<br><div class='clear-record'>" + val.name + "</div>");
				})
				//$('.searchclickhide1').hide();
				$(".instant-clicks-content").append("<br><p class='mb-0 searchclickhide1'  ><strong>BEGINNING</strong></p>");
				$.each(response.serach, function(key, val) {
					if(val.condition_id == 1)
					{
						$('.searchclickhide').hide();
						
						$(".instant-clicks-content").append("<br><div class='clear-record'>" + val.name + "</div>");
					}
				})
				//$('.searchclickhide1').hide();
				$(".instant-clicks-content").append("<br><p class='mb-0 searchclickhide1' ><strong>MIDDLE</strong></p>");
				$.each(response.serach, function(key, val) {
					if(val.condition_id == 2)
					{
						$('.searchclickhide').hide();
						
						$(".instant-clicks-content").append("<br><div class='clear-record'>" + val.name + "</div>");
					}
				})
				//$('.searchclickhide1').hide();
				$(".instant-clicks-content").append("<br><p class='mb-0 searchclickhide1' ><strong>END</strong></p>");
				$.each(response.serach, function(key, val) {
					if(val.condition_id == 3)
					{
						$('.searchclickhide').hide();
						
						$(".instant-clicks-content").append("<br><div class='clear-record'>" + val.name + "</div>");
					}
				})
				//$('.searchclickhide1').hide();
			}
			else
			{
				toastr.error("You don't have permission to update the attendance for the day.");
			}
		}
	});
});
$(document).ready(function() {

    $(".instant-clear").click(function() {
        $(".clear-record").remove();
        $(".instant-clicks-content").show();
		$('.searchclickhide').show();
		$('.searchclickhide1').hide()
    });
});

</script>

<script>
$(document).ready(function() {
	var text2 = $('#content2').text();
	console.log(text2);
   
});

</script>

<script>
datefunction();
function datefunction() {
	var b = $(".date-checked");
	$(b).each(function() {
		
		var cscheck = $(this).prop('checked');
		console.log(cscheck);
		if (cscheck==true)
		{
			$("#conditions").show();
		}
		else 
		{
			$("#conditions").hide();
		}

	});
}
</script>
<script>
$(function() {
    new Clipboard('.foo');


});

$(function() {
    new Clipboard('.insta-click');


});
</script>
<script>
$(function() {
    new Clipboard('.copy-text');


});
</script>
<script>
$(document).ready(function() {

    $(".clear-genrate").click(function() {
        $("#content3").remove();
        $("#content4").remove();
    });
});
</script>
<script>
function yesnoCheck(that) {
    if (that.value == "1") {
        document.getElementById("seg1").style.display = "block";
    } else {
        document.getElementById("seg1").style.display = "none";
    }
    if (that.value == "2") {
        document.getElementById("seg2").style.display = "block";
    } else {
        document.getElementById("seg2").style.display = "none";
    }
    if (that.value == "3") {
        document.getElementById("seg3").style.display = "block";
    } else {
        document.getElementById("seg3").style.display = "none";
    }
}
</script>


<script>

$('body').on("submit", '.insert_template', function(e) {
    e.preventDefault();

    var this_id = 'form[this_id=' + $(this).attr('this_id') + ']';
    var check = [];

    var a = $('input:checkbox:checked');
    $(a).each(function() {
        $(this).val()
    });

    var b = $("input:checkbox:not(:checked)");
    $(b).each(function() {
        $(this).addClass("unchecked");
        $(this).prop('checked', true);
        check.push($(this).val());
        $(this).attr('value', '');
        console.log(check);

    });


    if (is_required(this_id) === true) {
        $.ajax({
            type: 'POST',
            url: baseURL + "admin/insert_template",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(this_id + ' input[type=submit]').attr('disabled', 'true');
                $(this_id + ' button[type=submit]').attr('disabled', 'true');
            },
            success: function(response) {

                if (response.result == 1) {
                    n = 0;
                    $(".unchecked").each(function() {
                        $(this).prop('checked', false);
                        $(this).val(check[n]);
                        n++;
                    });
                    $(".unchecked").removeClass("unchecked");

                    toastr.success('Success!');
                    var temps_id = response.temp_id;
					temp_id = temps_id;
					var condition_name = $('select[name=condition_name]').val();
					var type = response.type;
					var type_collapse = response.type_collapse;
                    // var check = response.record;
                    // if ($('#' + check).is(":checked"))
                    // {
                    // $('input[type=checkbox]').prop('checked',true);
                    // }
                    // else 
                    // {
                    // $('input[type=checkbox]').prop('checked',false);
                    // }
                    //$('input[type=checkbox]').prop('checked',false);
                    $(this_id + ' input[type=submit]').removeAttr('disabled');
                    $(this_id + ' button[type=submit]').removeAttr('disabled');
                    $.ajax({
                        type: 'POST',
                        url: baseURL + "admin/get_answer_value",
                        data: "template_id=" + temps_id + "&condition_name=" + condition_name+ "&type=" + type + "&type_collapse=" + type_collapse,
                        success: function(response2) {
                            $('.answer_text').html(response2);
							$('.hide-ans').hide();

                        }
                    });
                } else {
                    toastr.error('Something went wrong! Please try again later!');
                    $(this_id + ' input[type=submit]').removeAttr('disabled');
                    $(this_id + ' button[type=submit]').removeAttr('disabled');
                }
            }

        });
    } else {
        toastr.error('Please check the required fields!');
    }
});
</script>



<script>
function myFunction1() {
    $('.temp').hide();
    var value = $('#content1').text() + $('#content2').text();
    var hvalue = $('#content1').text();
    var hvalue1 = $('#content2').text();
    var template_form_id = $('input[name=template_form_id]').val();
    var assign_id = $('input[name=assign_id]').val();
    var techniques = $('input[name=techniques]').val();
    var comparision_date = $('input[name=comparision_date]').val();
    $.ajax({
        type: "POST",
        url: baseURL + "admin/copy-record",
        data: "finding_text=" + hvalue + "&impressions_text=" + hvalue1 + "&template_form_id=" +
            template_form_id + "&assign_id=" + assign_id + "&techniques=" + techniques + "&comparision_date=" +
            comparision_date,
        dataType: "json",
        // beforeSend: function() {
        // $('#insert_template' + ' input[type=submit]').attr('disabled', 'true');
        // $('#insert_template' + ' button[type=submit]').attr('disabled', 'true');
        // },
        success: function(response) {
            if (response.result == 1) {
                toastr.success('Success!');
                $('.temp').show();

            } else {
                toastr.error('Something went wrong! Please try again later!');

            }
        }
    });
}

function copyclick(id) {
	new Clipboard('.click');

}
</script>
<script>
function hideshow($id) {
    $.ajax({
        type: "POST",
        url: baseURL + "admin/get-value/" + $id,
        dataType: "json",
        success: function(response) {
            if (response.result == 1) {
                $.each(response.records, function(key, val) {

                    var option = val.select_fields_id;
                    var options = val.option_id;
                    if ($('#checkboxes' + options).is(":checked")) {
                        $("#" + option).hide();
                    } else {
                        $("#" + option).show();
                    }
                })
            }
        }
    });
}
</script>
<script>
function generate($id) {
    $.ajax({
        type: "POST",
        url: baseURL + "admin/get-generator/" + $id,
        dataType: "json",
        success: function(response) {
            if (response.result == 1) {

                $('#test').text();
            }
        }
    });
}
</script>

<script>
function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea />");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
    // setup the blur event for this new textarea
    editableText.blur(editableTextBlurred);
}

function editableTextBlurred() {
    var html = $(this).val();
    var viewableText = $("<div>");
    viewableText.html(html);
    $(this).replaceWith(viewableText);
    // setup the click event for this new div
    viewableText.click(divClicked);
}

$(document).ready(function() {
    $("#content1").click(divClicked);
});
</script>
<script>
$(document).ready(function() {
    $('#searchResult').hide();
    $("#txt_search").keyup(function() {
        var hvalue = $('#content1').text();
        var hvalue1 = $('#content2').text();
        var search = $(this).val();
        if (search != "") {
            $.ajax({
                type: 'post',
                url: baseURL + 'admin/search',
                data: "search=" + search,
                dataType: 'json',
                success: function(response) {
                    $("#searchResult").empty();
                    $.each(response.serach, function(key, val) {
                        $('#searchResult').show();
                        $("#searchResult").append("<li >" + val.name + "</li>");

                    })

                }
            });
        }

    });

});
</script>
<script>
function get_condition(tis) {
	   $.ajax({
		   type: "GET",
		   url: baseURL + "admin/get-condition/" + $(tis).val(),
		   dataType: "json",
		   success: function(response) {
			   if (response.result == 1) {
				   $('select[name=condition_name]').empty();

				   var option = '<option value="">---Select Option---</option>';
				   $('select[name=condition_name]').append(option);

				   $.each(response.record, function(key, val) {
					   var option = "<option value='" + val.name + "'>" + val.name + "</option>";
					   $('select[name=condition_name]').append(option);
				   })
			   } else {
				   toastr.error('Something went wrong! Please try again later!');
			   }
		   },
	   });
   }
   
   function getClass(id) 
	{
		const element = $('.faicon'+id).attr('data-icon');
		if(element == 'new-icon')
		{
			//$('.collapseExample1'+id).removeClass('open-close');
			$('.faicon'+id).removeClass('fa-angle-down');
			$('.faicon'+id).addClass('fa-angle-up');
			$('.faicon'+id).attr('data-icon', '');
		}
		else
		{
			
			$('.faicon'+id).removeClass('fa-angle-up');
			$('.faicon'+id).addClass('fa-angle-down');
			$('.faicon'+id).attr('data-icon', 'new-icon');
		}
		
	}
	
	function getClasschild(id) 
	{
		const element = $('.faicon2'+id).attr('data-icon2');
		if(element == 'new-icon2')
		{
			$('.faicon2'+id).removeClass('fa-angle-down');
			$('.faicon2'+id).addClass('fa-angle-up');
			$('.faicon2'+id).attr('data-icon2', '');
		}
		else
		{
			$('.faicon2'+id).removeClass('fa-angle-up');
			$('.faicon2'+id).addClass('fa-angle-down');
			$('.faicon2'+id).attr('data-icon2', 'new-icon2');
		}
	}
</script>
<script>
function copyText(id){
	let copyval = $("#click"+id).text();
	localStorage.setItem("copyval1", copyval);
}
function content3() {
	let text = localStorage.getItem("copyval1");
	var string = window.getSelection().toString();
	var bolded = text;
	var selC, range;
      if (window.getSelection) {
          selC = window.getSelection();
          if (selC.rangeCount) {
              range = selC.getRangeAt(0);
              range.deleteContents();
              range.insertNode(document.createTextNode(bolded));
          }
      } else if (document.selection && document.selection.createRange) {
          range = document.selection.createRange();
          range.text = bolded;
      }
} 

function content4() {
	let text = localStorage.getItem("copyval1");
	var string = window.getSelection().toString();
	var bolded = text;
	var selC, range;
      if (window.getSelection) {
          selC = window.getSelection();
          if (selC.rangeCount) {
              range = selC.getRangeAt(0);
              range.deleteContents();
              range.insertNode(document.createTextNode(bolded));
          }
      } else if (document.selection && document.selection.createRange) {
          range = document.selection.createRange();
          range.text = bolded;
      }
} 
</script> 
<script> 
function scrollToForm() 
{
	debugger;
	let element = $('#search_title').val();
	var template_form_id = $('input[name=template_form_id]').val();
	let elementtype = $('#search_title option:selected').attr('data-collapse');
	let elementsubtype = $('#search_title option:selected').attr('data-subcollapse');
	if(elementtype == 13 || elementtype == 14 || elementtype == 15 || elementtype == 16 || elementtype == 17)
	{
		$.ajax({
			type: 'POST',
			url: baseURL + "admin/get_collapse_id",
			data: "id=" + element + "&template_id="+template_form_id,
			dataType:"json",
			success: function(response) {

				let main1=localStorage.getItem("main");
				let sub1=localStorage.getItem("sub"); 
				let total = main1 + sub1;
				if(total != "null" || total != "nullnull")
				{
					console.log(response.main_result);
					// $('#collapsed'+main1).addClass('collapsed');
					// $('#collapsed'+main1).addClass('collapsed');
					// $('#collapseExample1'+sub1).removeClass('in');
					// $('#collapseExample12'+sub1).removeClass('in');
					$('#collapsed'+element).removeClass('collapsed');
					$('#collapsed'+main1).removeClass('collapsed');
					$('#collapseExample1'+response.main_result).addClass('in');
					$('#collapseExample12'+response.sub_result).addClass('in');
					$("#collapseExample1"+response.main_result).removeAttr("style")
					$("#collapseExample12"+response.sub_result).removeAttr("style")
					$('html, body').animate({
						scrollTop: $("#"+element).offset().top
					}, 1000);
					debugger;
					$('#blink'+element).addClass('blink_cus');
					localStorage.setItem("main", response.main_result);
					localStorage.setItem("sub", response.sub_result);
				} 
				else
				{
					localStorage.setItem("main", response.main_result);
					localStorage.setItem("sub", response.sub_result);
					$('#collapsed'+element).removeClass('collapsed');
					$('#collapseExample1'+response.main_result).addClass('in');
					$('#collapseExample12'+response.sub_result).addClass('in');
					$("#collapseExample1"+response.main_result).removeAttr("style");
					$("#collapseExample12"+response.sub_result).removeAttr("style");
					debugger;
					$('#blink'+element).addClass('blink_cus');
					$('html, body').animate({
						scrollTop: $("#"+element).offset().top
					}, 1000);
					
				}
				$.ajax({
					type: 'POST',
					url: baseURL + "admin/get_answer_search",
					data: "id=" + element + "&template_id="+template_form_id,
					success: function(response) {
						$('.answer_search1').html(response);

					}
				});
				
			}
		});
	}
	else
	{
		$('html, body').animate({
			scrollTop: $("#"+element).offset().top
		}, 1000);
		$.ajax({
			type: 'POST',
			url: baseURL + "admin/get_answer_search",
			data: "id=" + element + "&template_id="+template_form_id,
			success: function(response) {
				$('.answer_search1').html(response);

			}
		});
	}
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>