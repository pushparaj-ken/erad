<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add</h3>
                    </div>
                    <div class="box-body">
                        <form class="insert_template_data" this_id="form-9900" reload-action="true">
							<div class="row">
								<div class="col-md-4">
									<label>Label Name</label>
									<input type="text" name="name"  class="form-control">
									<span class="text-danger error-span">This input is required.</span>
									<input type="hidden" name="slug">
                                    <input type="hidden" name="table_name" value="tbl_form_template_fields">
                                    <input type="hidden" name="template_form_id" value="<?= $id ?>">
								</div>
								<div class="col-md-4">
									<label>Type of Input fields</label>
									<select name="type"  class="form-control">
										<option value="">-- Select Type --</option>
										<option value="1">Text Input</option>
										<option value="2">Select Option</option>
										<option value="3">Textarea</option>
										<option value="4">Checkbox</option>
										<option value="5">Radiobox</option>
										<option value="6">File Input</option>
										<option value="7">Buttons</option>
										<option value="8">Segment</option>
										<option value="9">Comparision Date</option>
										<option value="10">Techniques</option>
										<option value="11">Date</option>
										<option value="12">History</option>
										<option value="13">Collapse</option>
										<option value="14">Collapse Inner Options</option>
										<option value="15">Collapse Main</option>
										<option value="16">Collapse Sub</option>
										<option value="17">Collapse Child</option>
										<option value="18">Collapse Child Text</option>
										<option value="19">Pet Ct Text</option>
										<option value="20">Radiation Dose</option>
										<option value="21">Pet Ct Select</option>
										<option value="22">Pet Ct Date</option>
										<option value="23">Pet Ct Procedure</option>
										<option value="24">Pet Ct Multiple Select</option>
										<option value="25">Pet Ct Clinic History</option>
										<option value="26">Mammogram Exam Select</option>
										<option value="27">Mammogram Date</option>
										<option value="28">Mammogram Protocal</option>
										<option value="29">Mammogram Multiple Select</option>
										<option value="30">Mammogram Clinic History</option>
										<option value="31">Mammogram Text</option>
										<option value="32">Template Name</option>
										<option value="33">Clinical Indication</option>
										<option value="34">Contrast</option>
									</select>
								</div>
                                <div class="col-md-4">
									<label>Main Title</label>
                                    <select class="form-control select2" name="title"  >
										<option>Select Main Title</option>
										<?php foreach($this->common_model->get_records("tbl_main_title", "status = '0' and template_form_id='$id' order by id desc") as $label_id) :?>
											<option value="<?= $label_id->id?>"><?=$label_id->title?></option>
										<?php endforeach ;?>
									</select>
								</div>
								<?php 
									$number = $this->common_model->get_records("tbl_form_template_fields" ,"status = 0 and template_form_id = '$id' order by id asc");
									if(sizeof($number) == ""){
								?>
									<div class="col-md-6">
										<label>Order No</label>
										<input type="number" name="order_by" step="0.01" class="form-control " value="1">
										<span class="text-danger error-span">This input is required.</span>
									</div>
								<?php } else { ?>
								<?php $numbers = $this->common_model->get_record("tbl_form_template_fields" ,"status = 0 and template_form_id = '$id' order by id desc","order_by"); ?>
									<div class="col-md-6">
										<label>Order No</label>
										<input type="number" name="order_by" step="0.01" class="form-control " value="<?=$numbers + 1?>">
										<span class="text-danger error-span">This input is required.</span>
									</div>
								<?php } ?>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
							</div>
							
                        </form>
                    </div>
                </div>
            </div>
			
			<!--<div class="col-md-4">
				<label> Search </label>
				<input type="text" name="sample_search" id="sample_search" onkeyup="search_func(this.value)"> 
			</div>-->
			
            <div class="col-md-12">
                <div class="box">
					<div class="text-right" style="margin: 15px 10px;">
						<a href="<?= base_url() ?>admin/view-form-template/<?= $id ?>" class="btn btn-success btn-sm">View Template</a>
					</div>
					
					
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Label ID</th>
                                    <th>Label Name</th>
                                    <th>Field Type</th>
                                    <th>Title</th>
                                    <th class="text-center">Order No</th>
                                    <th class="text-center">Date Time</th>
									<th class="text-center">Add Options</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($records)) {
                                    $inc = 1;
                                    foreach ($records as $record) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                            </td>
                                            <td>
                                                <?= $record->form_fields_id; ?>
                                            </td>
											<td>
                                                <?= $record->name; ?>
                                            </td>
                                            <td>
                                                <?php if ($record->type == 1) {
                                                    echo "Text Input";
                                                } else if ($record->type == 2) {
                                                    echo "Select Option";
                                                } else if ($record->type == 3) {
                                                    echo "Textarea";
                                                } else if ($record->type == 4) {
                                                    echo "Checkbox";
                                                } else if ($record->type == 5) {
                                                    echo "Radio Button";
                                                } else if ($record->type == 6) {
                                                    echo "File Input";
                                                } else if ($record->type == 7) {
                                                    echo "Button";
                                                }else if ($record->type == 8) {
                                                    echo "Segment";
                                                }else if ($record->type == 9) {
                                                    echo "Comparision Date";
                                                } else if ($record->type == 10) {
                                                    echo "Techniques";
                                                } else if ($record->type == 11) {
                                                    echo "Date";
                                                }  else if ($record->type == 12) {
                                                    echo "History";
                                                } else if ($record->type == 13) {
                                                    echo "Collapse";
                                                } else if ($record->type == 14) {
                                                    echo "Collapse Inner";
												}  else if ($record->type == 15) {
                                                    echo "Collapse Main";
                                                } else if ($record->type == 16) {
                                                    echo "Collapse Sub";
                                                } else if ($record->type == 17) {
                                                    echo "Collapse Child";
                                                }else if ($record->type == 18) {
                                                    echo "Collapse Child Text";
                                                }else if ($record->type == 19) {
                                                    echo "Pet Ct Text";
                                                }else if ($record->type == 20) {
                                                    echo "Radiation Dose";
                                                }else if ($record->type == 21) {
                                                    echo "Pet Ct Select";
                                                } else if ($record->type == 22) {
                                                    echo "Pet Ct Date";
                                                } else if ($record->type == 23) {
                                                    echo "Pet Ct Procedure";
                                                } else if ($record->type == 24) {
                                                    echo "Pet Ct Multiple Select";
												} else if ($record->type == 25) {
                                                    echo "Pet Ct Clinic Select";
												} else if ($record->type == 31) {
                                                    echo "Mammogram Text";
                                                } else if ($record->type == 26) {
                                                    echo "Mammogram Exam Select";
                                                } else if ($record->type == 27) {
                                                    echo "Mammogram Date";
                                                } else if ($record->type == 28) {
                                                    echo "Mammogram Protocal";
                                                } else if ($record->type == 29) {
                                                    echo "Mammogram Multiple  Select";
												} else if ($record->type == 30) {
                                                    echo "Mammogram  Clinic Select";
                                                } else if ($record->type == 32) {
                                                    echo "Template Name";
												} else if ($record->type == 33) {
                                                    echo "Clinical Indication";
                                                } else if ($record->type == 34) {
                                                    echo "Contrast";
                                                }?>
                                            </td>
											<td>
												<?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$record->title'","title");?>
											</td>
                                            <td class="text-center">
                                                <?= $record->order_by ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
											<td class="text-center">
												<?php if ($record->type == 2) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 10) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
											    <?php } else if ($record->type == 32) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 34) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 13) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 14) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 15) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 16) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 17) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/add-checkbox-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 5) { ?>
													<a href="<?= base_url() ?>admin/add-radio-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 21) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 24) { ?>
													<a href="<?= base_url() ?>admin/add-petct-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 23) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 25) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 26) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 28) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 30) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 29) { ?>
													<a href="<?= base_url() ?>admin/add-petct-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center;">
												<?php if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/hide-show-section/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/finding-option/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-book"></i></a>
												<?php } ?>
												<?php if ($record->type == 2) { ?>
													<a href="<?= base_url() ?>admin/finding-option/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-book"></i></a>
												<?php } ?>
												<?php if ($record->type == 13) { ?>
													<a href="<?= base_url() ?>admin/add-collapse/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 15) { ?>
													<a href="<?= base_url() ?>admin/finding-option/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-book"></i></a>
												<?php } ?>
												<?php if ($record->type == 16) { ?>
													<a href="<?= base_url() ?>admin/finding-option/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-book"></i></a>
												<?php } ?>
												<?php if ($record->type == 17) { ?>
													<a href="<?= base_url() ?>admin/finding-option/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-book"></i></a>
												<?php } ?>
												<?php if ($record->type == 15 ) { ?>
													<a href="<?= base_url() ?>admin/add-collapse-main/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 16 ) { ?>
													<a href="<?= base_url() ?>admin/add-collapse-sub/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_post input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data_post input[name=label_id]').val(`<?= $record->id ?>`);$('.update_data_post input[name=name]').val(`<?= $record->name ?>`);$('.update_data_post select[name=type]').val(`<?= $record->type ?>`);$('.update_data_post select[name=title]').val(`<?= $record->title ?>`);$('.update_data_post input[name=form_fields_id]').val(`<?= $record->form_fields_id ?>`);$('.update_data_post input[name=form_field_class]').val(`<?= $record->form_field_class ?>`);$('.update_data_post input[name=order_by]').val(`<?= $record->order_by ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_form_template_fields">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill btn-success">Active</span>
                                            </td>
                                        </tr>
                                <?php
                                        $inc++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form reload-action="true" this_id="form-002" class="update_data_post" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
							<label>Label Name</label>
							<input type="text" name="name"  class="form-control">
                            <input type="hidden" name="row_id">
                            <input type="hidden" name="label_id">
                            <input type="hidden" name="table_name" value="tbl_form_template_fields">
                            <input type="hidden" name="template_form_id" value="<?= $id ?>">
                            <input type="hidden" name="form_fields_id" value="">
                            <input type="hidden" name="form_field_class" value="">
						</div>
						<div class="col-md-6">
							<label>Type of Input fields</label>
							<select name="type" class="form-control">
								<option value="">-- Select Type --</option>
								<option value="1">Text Input</option>
								<option value="2">Select Option</option>
								<option value="3">Textarea</option>
								<option value="4">Checkbox</option>
								<option value="5">Radiobox</option>
								<option value="6">File Input</option>
								<option value="7">Buttons</option>
								<option value="8">Segment</option>
								<option value="9">Comparision Date</option>
								<option value="10">Techniques</option>
								<option value="11">Date</option>
								<option value="12">History</option>
								<option value="13">Collapse</option>
								<option value="14">Collapse Inner Options</option>
								<option value="15">Collapse Main</option>
								<option value="16">Collapse Sub</option>
								<option value="17">Collapse Child</option>
								<option value="18">Collapse Child Text</option>
								<option value="19">Pet Ct Text</option>
								<option value="20">Radiation Dose</option>
								<option value="21">Pet Ct Select</option>
								<option value="22">Pet Ct Date</option>
								<option value="23">Pet Ct Procedure</option>
								<option value="24">Pet Ct Multiple Select</option>
								<option value="25">Pet Ct Clinic History</option>
								<option value="26">Mammogram Exam Select</option>
								<option value="27">Mammogram Date</option>
								<option value="28">Mammogram Protocal</option>
								<option value="29">Mammogram Multiple Select</option>
								<option value="30">Mammogram Clinic History</option>
								<option value="31">Mammogram Text</option>
								<option value="32">Template Name</option>
								<option value="33">Clinical Indication</option>
								<option value="34">Contrast</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Main Title</label>
							<select class="form-control" name="title"  >
								<option>Select Main Title</option>
								<?php foreach($this->common_model->get_records("tbl_main_title", "status = '0' and template_form_id='$id' order by id desc") as $label_id) :?>
									<option  value="<?= $label_id->id?>"><?=$label_id->title?></option>
								<?php endforeach ;?>
							</select>
						</div>
                        <div class="col-md-6">
                            <label>Order No</label>
                            <input type="number" name="order_by" step="0.01" class="form-control required">
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default pull-left" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
var req = null;

function search_func(value)
{
    $.ajax({
        type: "POST",
        url: baseURL + "admin/search" ,
        dataType: "json",
		data: "sample_search=" + value,
        success: function(response){
		  if (response.result == 1) {
			  
			   $.each(response.search, function(key, val) {
				   alert(response.search);
					var option = "<option value='" + val.id + "'>" + val.name + "</option>";
					alert(option);
					$('select[name=search_keyword]').append(option);
			   })
		   } else {
			   toastr.error('Something went wrong! Please try again later!');
		   }
        }
    });
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>
