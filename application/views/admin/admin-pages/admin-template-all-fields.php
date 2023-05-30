<?php if ($role == ROLE_ADMIN) : ?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add</h3>
                    </div>
                    <div class="box-body">
                        <form class="insert_data" this_id="form-9900" reload-action="true">
							<div class="row">
								<div class="col-md-4">
									<label>Label Name</label>
									<input type="text" name="name" required class="form-control">
									<span class="text-danger error-span">This input is required.</span>
									<input type="hidden" name="slug">
                                    <input type="hidden" name="table_name" value="tbl_admin_copy_template_fields">
                                    <input type="hidden" name="template_form_id" value="<?= $id ?>">
								</div>
								<div class="col-md-4">
									<label>Type of Input fields</label>
									<select name="type" required class="form-control">
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
									</select>
								</div>
                                <div class="col-md-4">
									<label>Main Title</label>
                                    <input type="text" name="title" class="form-control">
								</div>
                                <div class="col-md-4">
                                    <label>Order No</label>
                                    <input type="number" name="order_by" class="form-control required" value="">
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
							</div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="box">
					<div class="text-right" style="margin: 15px 10px;">
						<a href="<?= base_url() ?>admin/admin-view-form-template/<?= $id ?>" class="btn btn-success btn-sm">View Template</a>
					</div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
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
                                                }
                                                else if ($record->type == 15) {
                                                    echo "Collapse Main";
                                                } else if ($record->type == 16) {
                                                    echo "Collapse Sub";
                                                } else if ($record->type == 17) {
                                                    echo "Collapse Child";
                                                }else if ($record->type == 18) {
                                                    echo "Collapse Child Text";
                                                } else if ($record->type == 20) {
                                                    echo "Radiation Dose";
												} else if ($record->type == 32) {
                                                    echo "Template Name";
												} else if ($record->type == 33) {
                                                    echo "Clinical Indication";
                                                } else if ($record->type == 34) {
                                                    echo "Contrast";
                                                } ?>
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
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 10) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												 <?php } else if ($record->type == 32) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 34) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/add-checkbox-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 5) { ?>
													<a href="<?= base_url() ?>admin/add-radio-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
													<?php } else if ($record->type == 13) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 15) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 16) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 17) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
													<?php } else if ($record->type == 14) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center;">
												<?php if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/hide-show-section/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 13 ) { ?>
													<a href="<?= base_url() ?>admin/add-collapse/<?= $id ?>/<?= $record->form_fields_id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 15 ) { ?>
													<a href="<?= base_url() ?>admin/add-collapse-main/<?= $id ?>/<?= $record->form_fields_id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 16 ) { ?>
													<a href="<?= base_url() ?>admin/add-collapse-sub/<?= $id ?>/<?= $record->form_fields_id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_post_template_field input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data_post_template_field input[name=form_fields_id]').val(`<?= $record->form_fields_id ?>`);$('.update_data_post_template_field input[name=copy_form_field_id]').val(`<?= $record->copy_form_field_id ?>`);$('.update_data_post_template_field input[name=copy_form_field_class]').val(`<?= $record->copy_form_field_class ?>`);$('.update_data_post_template_field input[name=copy_template_form_id]').val(`<?= $record->copy_template_form_id ?>`);$('.update_data_post_template_field input[name=name]').val(`<?= $record->name ?>`);$('.update_data_post_template_field select[name=type]').val(`<?= $record->type ?>`);$('.update_data_post_template_field select[name=title]').val(`<?= $record->title ?>`);$('.update_data_post_template_field input[name=order_by]').val(`<?= $record->order_by ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_admin_copy_template_fields">
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
            <form reload-action="true" this_id="form-002" class="update_data_post_template_field" method="post" role="form">
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
                            <input type="hidden" name="copy_template_form_id">
                            <input type="hidden" name="form_fields_id">
                            <input type="hidden" name="copy_form_field_id">
                            <input type="hidden" name="copy_form_field_class">
                            <input type="hidden" name="table_name" value="tbl_admin_copy_template_fields">
						</div>
						<div class="col-md-6">
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
								<option value="18">Collapse Child Text</option>
								<option value="20">Radiation Dose</option>
								<option value="32">Template Name</option>
								<option value="33">Clinical Indication</option>
								<option value="34">Contrast</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Main Title</label>
							<select class="form-control" name="title"  >
								<option>Select Main Title</option>
								<?php foreach($this->common_model->get_records("tbl_copy_main_title", "status = '0' and template_form_id='$id' and assign_id='".$_SESSION['userId']."' order by id desc") as $label_id) :?>
									<option  value="<?= $label_id->title_id?>"><?=$label_id->title?></option>
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
<?php elseif ($role == ROLE_SCRIBE) : ?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!--<div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add</h3>
                    </div>
                    <div class="box-body">
                        <form class="insert_data" this_id="form-9900" reload-action="true">
							<div class="row">
								<div class="col-md-4">
									<label>Label Name</label>
									<input type="text" name="name" required class="form-control">
									<span class="text-danger error-span">This input is required.</span>
									<input type="hidden" name="slug">
                                    <input type="hidden" name="table_name" value="tbl_admin_copy_template_fields">
                                    <input type="hidden" name="template_form_id" value="<?= $id ?>">
								</div>
								<div class="col-md-4">
									<label>Type of Input fields</label>
									<select name="type" required class="form-control">
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
									</select>
								</div>
                                <div class="col-md-4">
									<label>Main Title</label>
									<select class="form-control" name="title"  >
										<option>Select Main Title</option>
										<?php foreach($this->common_model->get_records("tbl_main_title", "status = '0' order by id desc") as $label_id) :?>
											<option  value="<?= $label_id->id?>"><?=$label_id->title?></option>
										<?php endforeach ;?>
									</select>
								</div>
                                <div class="col-md-4">
                                    <label>Order No</label>
                                    <input type="number" name="order_by" class="form-control required" value="">
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
							</div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="box">
					<div class="text-right" style="margin: 15px 10px;">
						<a href="<?= base_url() ?>admin/admin-view-form-template/<?= $id ?>" class="btn btn-success btn-sm">View Template</a>
					</div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
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
                                                }else if ($record->type == 15) {
                                                    echo "Collapse Main";
                                                } else if ($record->type == 16) {
                                                    echo "Collapse Sub";
                                                } else if ($record->type == 17) {
                                                    echo "Collapse Child";
                                                } else if ($record->type == 18) {
                                                    echo "Collapse Child Text";
												} else if ($record->type == 32) {
                                                    echo "Template Name";
												} else if ($record->type == 33) {
                                                    echo "Clinical Indication";
                                                } else if ($record->type == 34) {
                                                    echo "Contrast";
                                                }  ?>
                                            </td>
											<td>
											
												<?=$this->common_model->get_record("tbl_copy_main_title","status = '0' and title_id = '$record->title'and assign_id='".$_SESSION['userId']."'","title");?>
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
													<a href="<?= base_url() ?>admin/add-select-options/<?= $id ?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 10) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?= $id ?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												 <?php } else if ($record->type == 32) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 34) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 13) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 14) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?=$id?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/add-checkbox-options/<?= $id ?>/<?= $record->form_fields_id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } else if ($record->type == 5) { ?>
													<a href="<?= base_url() ?>admin/add-radio-options/<?= $id ?>/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
												<?php } ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center;">
												<?php if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/hide-show-section/<?= $id ?>/<?= $record->id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<?php if ($record->type == 13) { ?>
													<a href="<?= base_url() ?>admin/add-collapse/<?= $id ?>/<?= $record->form_fields_id ?>" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
												<?php } ?>
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_scribe input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data_scribe input[name=label_id]').val(`<?= $record->form_fields_id ?>`);$('.update_data_scribe input[name=name]').val(`<?= $record->name ?>`);$('.update_data_scribe select[name=type]').val(`<?= $record->type ?>`);$('.update_data_scribe select[name=title]').val(`<?= $record->title ?>`);$('.update_data_scribe input[name=form_fields_id]').val(`<?= $record->copy_form_field_id ?>`);$('.update_data_scribe input[name=form_field_class]').val(`<?= $record->copy_form_field_class ?>`);$('.update_data_scribe input[name=order_by]').val(`<?= $record->order_by ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_admin_copy_template_fields">
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
            <form reload-action="true" this_id="form-002" class="update_data_scribe" method="post" role="form">
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
                            <input type="hidden" name="table_name" value="tbl_template_logs">
                            <input type="hidden" name="template_form_id" value="<?= $id ?>">
                            <input type="hidden" name="form_fields_id" value="">
                            <input type="hidden" name="form_field_class" value="">
						</div>
						<div class="col-md-6">
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
								<option value="32">Template Name</option>
								<option value="33">Clinical Indication</option>
								<option value="34">Contrast</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Main Title</label>
							<select class="form-control" name="title"  >
								<option>Select Main Title</option>
								<?php foreach($this->common_model->get_records("tbl_copy_main_title", "status = '0' and template_form_id='$id' and assign_id='".$_SESSION['userId']."' order by id desc") as $label_id) :?>
									<option  value="<?= $label_id->title_id?>"><?=$label_id->title?></option>
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
<?php endif;?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>