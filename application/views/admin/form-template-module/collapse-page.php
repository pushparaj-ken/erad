<div class="content-wrapper">

	<section class="content">
		<div class="row">		
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Collapse Items list</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_collapse_items" this_id="form-9900" reload-action="true">
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Select Collapse Items</label>
										<select class="form-control" name="option_id"  required style="width: 100%;">
											<?php foreach($check_options as $check_option) : ?>
												<option value="<?= $check_option->id ?>"><?= $check_option->name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_collapse_section">
                                    <input type="hidden" name="input_id" value="<?= $input_id ?>">
                                    <input type="hidden" name="template_id" value="<?= $template_id ?>">
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Select Title</label>
										<select class="form-control select2" name="select_title[]" multiple="multiple" data-placeholder="Select a Hide Items" required style="width: 100%;">
											<?php foreach($this->common_model->get_records("tbl_main_title", "status = '0' and template_form_id='$template_id' order by id desc") as $label_id) :?>
												<option value="<?= $label_id->id ?>"><?= $label_id->title?></option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
										<label>Select Sub Collapse Items</label>
										<select class="form-control select2" name="select_fields_id[]" multiple="multiple" data-placeholder="Select a Hide Items" required style="width: 100%;">
											<?php foreach($all_inputs as $fields) : ?>
												<option value="<?= $fields->id ?>"><?= $fields->name?></option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?= $template_name; ?> - Hide Items</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<tr>
									<th>Sl. No.</th>
									<th>Item Name</th>
									<th>Title Name</th>
									<th>Label Name</th>
									<th class="text-center">Date Time</th>
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
												<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$record->input_id'", "name") ?>
											</td>
											<td>
												<?php foreach(explode("," , $record->select_title) as $collapse):?>
													<?= $this->common_model->get_record('tbl_main_title', "status='0' and id='$collapse'", "title") ?>,
												<?php endforeach;?>
											</td>
											<td>
												<?php foreach(explode("," , $record->select_fields_id) as $collapse):?>
													<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$collapse'", "name") ?>,
												<?php endforeach;?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<span class="btn btn-sm btn-warning" onclick="edit_collapse(<?= $record->id ?>,<?= $record->template_id ?>,<?= $record->input_id ?>);">
													<i class="fa fa-edit"></i>
												</span>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_collapse_section">
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
			<form reload-action="true" this_id="form-002" class="update_collapse_items" method="post" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
					
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
function edit_collapse(row_id,template_id,input_id)
{
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/edit_collapse",
		data: "row_id=" + row_id + "&template_id="+ template_id + "&input_id=" + input_id,
		success: function(response)
		{
			$('#modal-default .modal-body').html(response);
			$('#modal-default').modal();
			$('.select22').select2();
		}
	});
}
	
$('body').on("submit", '.insert_collapse_items', function(e) {
    e.preventDefault();

    var this_id = 'form[this_id=' + $(this).attr('this_id') + ']';

    if (is_required(this_id) === true) {
        $.ajax({
            type: 'POST',
            url: baseURL + "admin/insert_collapse_items",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(this_id + ' input[type=submit]').attr('disabled', 'true');
                $(this_id + ' button[type=submit]').attr('disabled', 'true');
            },
            success: function(response) {
                console.log(response)
                if (response.result == 1) {
                    toastr.success('Success!');
                    $(this_id + ' input[type=submit]').removeAttr('disabled');
                    $(this_id + ' button[type=submit]').removeAttr('disabled');

                    if ($(this_id).attr('reload-action') === 'true') {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
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

$('body').on("submit", '.update_collapse_items', function(e) {
    e.preventDefault();

    var this_id = 'form[this_id=' + $(this).attr('this_id') + ']';

    if (is_required(this_id) === true) {
        $.ajax({
            type: 'POST',
            url: baseURL + "admin/update_collapse_items",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(this_id + ' input[type=submit]').attr('disabled', 'true');
                $(this_id + ' button[type=submit]').attr('disabled', 'true');
            },
            success: function(response) {
                console.log(response)
                if (response.result == 1) {
                    toastr.success('Success!');
                    $(this_id + ' input[type=submit]').removeAttr('disabled');
                    $(this_id + ' button[type=submit]').removeAttr('disabled');

                    if ($(this_id).attr('reload-action') === 'true') {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>