<div class="content-wrapper">

	<section class="content">
		<div class="row">		
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hide Items list</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_hide_items" this_id="form-9900" reload-action="true">
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Select Options Items</label>
										<select class="form-control select2" name="option_id"  data-placeholder="Select a Options Items" required style="width: 100%;">
											<?php foreach($check_options as $check_option) : ?>
												<option value="<?= $check_option->id ?>"><?= $check_option->name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_hide_show_section">
                                    <input type="hidden" name="input_id" value="<?= $input_id ?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Select Hide Items</label>
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
												<?= $this->common_model->get_record('tbl_input_options', "status='0' and id='$record->option_id'", "name") ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_form_template_fields', "status='0' and id='$record->select_fields_id'", "name") ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data select[name=select_fields_id]').val(`<?= $record->select_fields_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>

												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_hide_show_section">
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
			<form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Select Options Items</label>
								<select class="form-control" name="option_id" required style="width: 100%;">
									<?php foreach($check_options as $check_option) : ?>
										<option value="<?= $check_option->id ?>"><?= $check_option->name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<span class="text-danger error-span">This input is required.</span>
							<input type="hidden" name="row_id" value="">
							<input type="hidden" name="table_name" value="tbl_hide_show_section">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Select Hide Items</label>
								<select class="form-control" name="select_fields_id" required style="width: 100%;">
									<?php foreach($all_inputs as $fields) : ?>
										<option value="<?= $fields->id ?>"><?= $fields->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>