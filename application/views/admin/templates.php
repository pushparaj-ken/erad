<style>
	.mousepoint {
		cursor: pointer;
	}
    .text-box-border {
        padding: 20px;
        border: 2px solid #3c8dbc;
        margin: 20px 0;
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
				<?php foreach($this->common_model->get_records("tbl_category","status ='0'")as $category): ?>
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
											<?php foreach($this->common_model->get_records("tbl_child_category","status ='0' and sub_category_id ='$sub_category->id'")as $child_category): ?>
												<li>
													<?php foreach($this->common_model->get_records("tbl_category_with_form","status ='0' and child_category_id ='$child_category->id'")as $child_category_form): ?>
														<a tabindex="-1" href="<?= base_url() ?>admin/view-form-template/<?=$child_category_form->id?>">
															<?=$child_category->name?>
														</a>
													<?php endforeach;?>
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
        </div>
    </nav>
</header>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $temp_id->name ?></h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" class="insert_template" reload-action="true" this_id="<?= uniqid() ?>">
                                <input type="hidden" name="template_form_id" value="<?php echo $temp_id->id ?>">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['userId'] ?>">
                                <div class="box-body">
                                    <div class="row">
										<?php 
											$template = $this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$temp_id->id'  group by order_by"); 
											foreach($template as $order) {
										?>
										<?php if($order->type != 14 && $order->type != 16 && $order->type != 17 && $order->type != 15 && $order->type != 18): ?> 
											<div class="col-md-12">
												<h3>
													<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$order->title'","title");?>
												</h3>
											</div>
										<?php endif;?>
										<?php foreach($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$temp_id->id' and order_by like '$order->order_by'") as $template_field) { ?>
										<?php if ($template_field ->type == 10 ) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control" name="method[]" id="<?= $template_field->form_fields_id ?>">
														<option selected disabled >-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id' and template_form_id='$temp_id->id'") as $options) : ?>
															<option value="<?= $options->name ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<?php } else if ($template_field ->type == 9 ) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?> <input type ="checkbox" id ="date" name="date" value="1"></label>
													<input type ="date" name ="comparison_date" class="form-control" id="date1">
												</div>
											</div>
										<?php } else if ($template_field ->type == 2) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field ->type == 4) { ?>
											<div class="col-md-12">
												<div class="form-group " id="checkbox">
													<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
													   <input type="checkbox"  name="option_name[]" id="checkboxes<?= $options->id ?>" onclick="hideshow(<?= $options->id ?>)" value="<?= $options->id ?>">
														<?= $options->name ?>
													<?php endforeach; ?>
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
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
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id' and template_form_id='$temp_id->id'") as $options) : ?>
															<option value="<?= $options->name ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
													</select>
													<input type="hidden" class="form-control" name="new_template[]" value="1">
												</div>
											</div>
										<?php } else if ($template_field ->type == 34) { ?> 
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control" name="contrast[]" id="<?= $template_field->form_fields_id ?>">
														<option selected disabled >-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id' and template_form_id='$temp_id->id'") as $options) : ?>
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
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 19) { ?>
											<div class="col-md-12">
												<div class="form-group " id="text-input">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
												   <input type="text" class="form-control" name="option_name[]" >
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 21) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 24) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control select2" multiple name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<?php } else if ($template_field->type == 22) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?> <input type ="checkbox" id ="date" name="date" value="1"></label>
													<input type ="date" name ="option_name[]" class="form-control" id="date1">
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 23) { ?>
											
											<?php 
												if($total != $template_field->title)
												{
													?>
													
														<div style="float:left">
															<div style="padding-left:19px">A PET CT scan was performed from the level of vertex of skull to the proximal thighs following the administration of</div>
														</div>
													
													<?php
													$total  = 0;	 
													foreach($this->common_model->get_records("tbl_form_template_fields","status=0 and template_form_id='$temp_id->id' and title='$template_field->title' order by order_by asc") as $templatemano)
													{
												?>
														
														<div class="col-md-3">
															<div class="form-group" id="<?= $templatemano->id ?>">
																<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																	<option value="">-- Select --</option>
																	<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																		<option value="<?= $options->id ?>"><?= $options->name ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
													
													<?php 
														$total = $template_field->title;
													}
												}
											?>
										<?php } else if ($template_field->type == 25) { ?>
											
											<?php 
												if($total != $template_field->title)
												{
													?>
													
														
													
													<?php
													$total  = 0;	 
													$i  = 1;	 
													foreach($this->common_model->get_records("tbl_form_template_fields","status=0 and template_form_id='$temp_id->id' and title='$template_field->title' order by order_by asc") as $templatemano)
													{
														if($i == 1){
												?>
													
														<div style="float:left">
															<div style="padding-left:19px">The patient who is </div>
														</div>
														<div class="col-md-3">
															<div class="form-group" id="<?= $templatemano->id ?>">
																<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																	<option value="">-- Select --</option>
																	<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																		<option value="<?= $options->id ?>"><?= $options->name ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
													
													<?php 
														} elseif($i == 2){
													?>
														<div style="float:left">
															<div style="padding-left:19px">yr old male/female with past medical history of </div>
														</div>
														<div class="col-md-3">
															<div class="form-group " id="text-input">
															   <input type="text" class="form-control" name="option_name[]" >
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
														<?php } elseif($i == 3){ ?>
															<div style="float:left">
																<div style="padding-left:19px">is referred for the evaluation of </div>
															</div>
															<div class="col-md-3">
																<div class="form-group" id="<?= $templatemano->id ?>">
																	<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																		<option value="">-- Select --</option>
																		<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																			<option value="<?= $options->id ?>"><?= $options->name ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
																<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
																<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
																<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
																<input type="hidden" name="type[]" value="<?=$order->type ?>">
															</div>
													<?php
														}
														$i++;
														$total = $template_field->title;
													}
													?>
													
													<?php
												}
											?>
										<?php } else if ($template_field->type == 31) { ?>
											<div class="col-md-12">
												<div class="form-group " id="text-input">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
												   <input type="text" class="form-control" name="option_name[]" >
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 26) { ?>
											<div class="col-md-3">
												<div class="form-group" id="<?= $template_field->id ?>">
													<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
											<div style="float:left">
												<div style="padding-left:19px">screening mammogram.</div>
											</div>
										<?php } else if ($template_field->type == 28) { ?>
											
											<?php 
												if($total != $template_field->title)
												{
													?>
													
														<div style="float:left">
															<div style="padding-left:19px">Digital craniocaudal and mediolateral oblique view of the both breasts performed. A clinical breast examination was </div>
														</div>
													
													<?php
													$total  = 0;	 
													foreach($this->common_model->get_records("tbl_form_template_fields","status=0 and template_form_id='$temp_id->id' and title='$template_field->title' order by order_by asc") as $templatemano)
													{
												?>
														
														<div class="col-md-3">
															<div class="form-group" id="<?= $templatemano->id ?>">
																<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																	<option value="">-- Select --</option>
																	<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																		<option value="<?= $options->id ?>"><?= $options->name ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
													
													<?php 
														$total = $template_field->title;
													}
												}
											?>
										<?php } else if ($template_field->type == 27) { ?>
											<div style="float:left">
												<div style="padding-left:19px">Previous mammogram performed in </div>
											</div>
											<div class="col-md-3">
												<div class="form-group" id="<?= $template_field->id ?>">
													<input type ="date" name ="option_name[]" class="form-control" id="date1">
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
										<?php } else if ($template_field->type == 30) { ?>
											
											<?php 
												if($total != $template_field->title)
												{
													?>
													
														
													
													<?php
													$total  = 0;	 
													$i  = 1;	 
													foreach($this->common_model->get_records("tbl_form_template_fields","status=0 and template_form_id='$temp_id->id' and title='$template_field->title' order by order_by asc") as $templatemano)
													{
														if($i == 1){
												?>
													
														<div style="float:left">
															<div style="padding-left:19px">The patient who is </div>
														</div>
														<div class="col-md-3">
															<div class="form-group" id="<?= $templatemano->id ?>">
																<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																	<option value="">-- Select --</option>
																	<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																		<option value="<?= $options->id ?>"><?= $options->name ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
													
													<?php 
														} elseif($i == 2){
													?>
														<div style="float:left">
															<div style="padding-left:19px">yr old male/female with past medical history of </div>
														</div>
														<div class="col-md-3">
															<div class="form-group " id="text-input">
															   <input type="text" class="form-control" name="option_name[]" >
															</div>
															<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														</div>
														<?php } elseif($i == 3){ ?>
															<div style="float:left">
																<div style="padding-left:19px">is referred for the evaluation of </div>
															</div>
															<div class="col-md-3">
																<div class="form-group" id="<?= $templatemano->id ?>">
																	<select type="text" class="form-control" name="option_name[]" id="<?= $templatemano->form_fields_id ?>">
																		<option value="">-- Select --</option>
																		<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$templatemano->id'") as $options) : ?>
																			<option value="<?= $options->id ?>"><?= $options->name ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
																<input type="hidden" value="<?= $templatemano->name ?>" name="label_name[]">
																<input type="hidden" value="<?= $templatemano->id ?>" name="label_id[]">
																<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
																<input type="hidden" name="type[]" value="<?=$order->type ?>">
															</div>
													<?php
														}
														$i++;
														$total = $template_field->title;
													}
													?>
													
													<?php
												}
											?>
										<?php } else if ($template_field->type == 29) { ?>
											<div class="col-md-12">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control select2" multiple name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
															<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
															<input type="hidden" name="type[]" value="<?=$order->type ?>">
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<?php } else if ($template_field ->type == 13 ) { ?>
											<div class="col-md-11">
												<div class="form-group" id="<?= $template_field->id ?>">
													<label for="exampleInputEmail1"><?= $template_field->name ?></label>
													<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
														<input type="hidden" value="0" name="collapse_type[]">
													</select>
												</div>
												<input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
												<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
												<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
												<input type="hidden" name="type[]" value="<?=$order->type ?>">
											</div>
											<?php foreach($this->common_model->get_records("tbl_collapse_section","status=0 and input_id='$template_field->id'") as $collapse):?>
												<div class="col-md-1">
													<div style=" margin-top: 2.5rem">
														<button class="btn btn-primary text-right" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1">
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
															 
																$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$temp_id->id' and title='$val'","order_by"));
																  
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
														
														<?php foreach($this->common_model->get_custom_query("SELECT a.id  FROM `tbl_form_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.template_form_id = '$temp_id->id' and b.id ='" . $collapse_title['value'] ."' and a.title = b.id order by a.order_by asc") as $collapse_item): ;?>
														
														<div class="col-md-12">
															<div class="form-group" id="<?=$collapse_item->id?>">
																<label for="exampleInputEmail1">
																	<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>
																</label>
																<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																	<option value="" >-- Select --</option>
																	<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$collapse_item->id' and template_form_id='$temp_id->id'") as $options) : ?>
																		<option value="<?= $options->id ?>"><?= $options->name ?></option>
																	<?php endforeach; ?>
																	<input type="hidden" value="1" name="collapse_type[]">
																</select>
																
															</div>
															
															<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>" name="label_name[]">
															<input type="hidden" value="<?= $collapse_item->id ?>" name="label_id[]">
															<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "title") ?>" name="title_id[]">
															<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "type") ?>" name="type[]">
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
													<input type="hidden" value="<?= $template_field->id ?>" name="label_id[]">
													<input type="hidden" value="<?= $order->title ?>" name="title_id[]">
													<input type="hidden" name="type[]" value="<?=$order->type ?>">
													<input type="hidden" value="" name="option_name[]">
													<input type="hidden" value="" name="collapse_type[]">
													<?php foreach($this->common_model->get_records("tbl_collapse_section_main","status=0 and input_id='$template_field->id'") as $collapse):?>
													<label for="exampleInputEmail1" class="collapseExample1<?=$collapse->id?> mousepoint" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClass(<?=$collapse->id?>)">
														<h3 class="collapse-red">
															<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$order->title'","title");?>
															<i class="fa fa-angle-down faicon<?=$collapse->id?>" data-icon="new-icon"></i>
														</h3>
													</label>
													<!--<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
														<option value="">-- Select --</option>
														<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$template_field->id'") as $options) : ?>
															<option value="<?= $options->id ?>"><?= $options->name ?></option>
														<?php endforeach; ?>
														<input type="hidden" value="0" name="collapse_type[]">
													</select>-->
												</div>
												
											</div>
											
												<!--<div class="col-md-1">
													<div style=" margin-top: 2.5rem">
														<button class="btn btn-primary text-right collapseExample1<?=$collapse->id?>" data-toggle="collapse" href="#collapseExample1<?=$collapse->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClass(<?= $collapse->id ?>);">
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
															 
																$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$temp_id->id' and title='$val'","order_by"));
																  
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
														
														<?php foreach($this->common_model->get_custom_query("SELECT a.id,a.title  FROM `tbl_form_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.template_form_id = '$temp_id->id' and b.id ='" . $collapse_title['value'] ."' and a.title = b.id order by a.order_by asc") as $collapse_item): ;?>
														
															<div class="col-md-12">
																<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>" name="label_name[]">
																<input type="hidden" value="<?= $collapse_item->id ?>" name="label_id[]">
																<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "title") ?>" name="title_id[]">
																<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "type") ?>" name="type[]">
																<?php $select_fields_id_sub = explode("," , $collapse->select_fields_id_sub)?>
															
																<?php $collapsechild_new = $this->common_model->get_records("tbl_collapse_section_sub","status=0 and input_id='$collapse_item->id'")[0];?>
																<div class="form-group" id="<?=$collapse_item->id?>">
																	<label for="exampleInputEmail1" class="collapseExample12<?=$collapsechild_new->id?> mousepoint" data-toggle="collapse" href="#collapseExample12<?=$collapsechild_new->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClasschild(<?= $collapsechild_new->id ?>);">
																		<h4 class="collapse-green">
																			<b><?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$collapse_item->title'","title");?></b>
																			<i class="fa fa-angle-down faicon2<?=$collapsechild_new->id?>" data-icon2="new-icon2"></i>
																		</h4>
																	</label>
																	<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																		<option value="" >-- Select --</option>
																		<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$collapse_item->id' and template_form_id='$temp_id->id'") as $options) : ?>
																			<option value="<?= $options->id ?>"><?= $options->name ?></option>
																		<?php endforeach; ?>
																		<input type="hidden" value="1" name="collapse_type[]">
																	</select>
																</div>
															</div>
															
																<!--<div class="col-md-1">
																	<div style=" margin-top: 2.5rem">
																		<button class="btn btn-primary text-right collapseExample12<?=$collapsechild_new->id?>" data-toggle="collapse" href="#collapseExample12<?=$collapsechild_new->id?>"  aria-expanded="false" aria-controls="collapseExample1" onclick="getClasschild(<?= $collapsechild_new->id ?>);">
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
																			 
																				$data1[] = array("value"=>$val,"order"=>$this->common_model->get_record('tbl_form_template_fields', "status='0' and template_form_id='$temp_id->id' and title='$val'","order_by"));
																				  
																			}
																			
																			array_multisort(array_map(function($element) {
																				  return $element['order'];
																			  }, $data1), SORT_ASC, $data1);		
																		?>
																		<?php foreach($data1 as $collapse_title):?>
																			<?php if(!empty($collapse_title['order'])): ?>
																				<div class="col-md-12">
																					<h4 class="collapse-blue">
																						<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '" . $collapse_title['value'] ."' ","title");?>
																					</h4>
																				</div>
																			<?php endif;?>
																		
																		<?php foreach($this->common_model->get_custom_query("SELECT a.id,type  FROM `tbl_form_template_fields` as a , tbl_main_title as b where a.status = 0 and b.status = 0 and a.template_form_id = '$temp_id->id' and b.id ='" . $collapse_title['value'] ."' and a.title = b.id order by a.order_by asc") as $collapse_item): ;?>
																			<?php if($collapse_item->type != 18){?>
																				<div class="col-md-12">
																					<div class="form-group" id="<?=$collapse_item->id?>">
																						<label for="exampleInputEmail1" >
																							<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>
																						</label>
																						<select type="text" class="form-control" name="option_name[]" id="<?= $template_field->form_fields_id ?>">
																							<option value="" >-- Select --</option>
																							<?php foreach ($this->common_model->get_records('tbl_input_options', "status='0' and input_id='$collapse_item->id' and template_form_id='$temp_id->id'") as $options) : ?>
																								<option value="<?= $options->id ?>"><?= $options->name ?></option>
																							<?php endforeach; ?>
																							<input type="hidden" value="1" name="collapse_type[]">
																						</select>
																						
																					</div>
																					
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>" name="label_name[]">
																					<input type="hidden" value="<?= $collapse_item->id ?>" name="label_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "title") ?>" name="title_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "type") ?>" name="type[]">
																				</div>
																			<?php } else { ?>
																				<div class="col-md-12">
																					<div class="form-group " id="text-input">
																						<label for="exampleInputEmail1">
																							<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>
																						</label>
																					   <input type="text" class="form-control" name="option_name[]" >
																					</div>
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "name") ?>" name="label_name[]">
																					<input type="hidden" value="<?= $collapse_item->id ?>" name="label_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "title") ?>" name="title_id[]">
																					<input type="hidden" value="<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse_item->id'", "type") ?>" name="type[]">
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
										<?php } } } ?> 
                                    </div>
                                </div>
                                <!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Generate</button>
									<a class="btn btn-primary" onclick="$('.insert_template')[0].reset()">clear</a>
									<span class="btn btn-primary foo" data-clipboard-target="#div1" onclick="myFunction1()">
										Copy
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
										<div class="impressions_text"></div>
									</div>
								</div>
                                <div class="answer_text"></div>
                                <!--<div class="col-md-6">
                                    <div class="answer_text"></div>
                                </div>-->
                            </form>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>

<script>
$(function() {
    new Clipboard('.foo');


});
</script>
<script>
$(function() {
    new Clipboard('.copy-text');


});
</script>
<script>
$(document).ready(function() {

    $("a").click(function() {
        $("#content3").remove();
        $("#content4").remove();
    });
});
</script>
<script>
$(document).ready(function(){
	
  $("a").click(function(){
    $("#content3").remove();
    $("#content4").remove();
  });
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
$(document).ready(function(){
	
  $("a").click(function(){
    $("#content3").remove();
    $("#content4").remove();
  });
});
</script>

<script>
    $('body').on("submit", '.insert_template', function(e) {
        e.preventDefault();

        var this_id = 'form[this_id=' + $(this).attr('this_id') + ']';
		var check = [];
		
		var a = $('input:checkbox:checked');
		$(a).each(function () {
			$(this).val()      
		});

		var b = $("input:checkbox:not(:checked)");
		$(b).each(function () {
			$(this).addClass("unchecked");
			$(this).prop('checked',true);
			check.push($(this).val());
			$(this).attr('value','');
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
						n=0;
						$(".unchecked").each(function() {
							$(this).prop('checked',false);
							$(this).val(check[n]);
							n++;
						});
						$(".unchecked").removeClass("unchecked");
						
                        toastr.success('Success!');
                        var temps_id = response.temp_id;
                        var type = response.type;
                        var type_collapse = response.type_collapse;
                        $(this_id + ' input[type=submit]').removeAttr('disabled');
                        $(this_id + ' button[type=submit]').removeAttr('disabled');
                        $.ajax({
                            type: 'POST',
                            url: baseURL + "admin/get_answer_value",
                            data: "template_id=" + temps_id + "&type=" + type + "&type_collapse=" + type_collapse,
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>