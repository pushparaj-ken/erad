<div class="content-wrapper">

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<form class="insert_data" this_id="form-9900" reload-action="true">
								<div class="col-md-6">
									<label>Label Name</label>
									<input type="text" name="name" required class="form-control">
									<span class="text-danger error-span">This input is required.</span>
									<input type="hidden" name="slug">
									<input type="hidden" name="table_name" value="tbl_form_fields">
								</div>
								<div class="col-md-6">
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
									</select>
								</div>
								<div class="col-md-4">
									<button class="btn btn-sm btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box">
					<div class="box-body table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<tr>
									<th>Sl. No.</th>
									<th>Label Name</th>
									<th>Input Type</th>
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
												<?= $record->name ?>
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
												} ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<?php if ($record->type == 2) { ?>
													<a href="<?= base_url() ?>admin/add-select-options/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
												<?php } else if ($record->type == 4) { ?>
													<a href="<?= base_url() ?>admin/add-checkbox-options/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
												<?php } else if ($record->type == 5) { ?>
													<a href="<?= base_url() ?>admin/add-radio-options/<?= $record->id ?>" style="margin-right: 5px;" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
												<?php } ?>
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data input[name=name]').val(`<?= $record->name ?>`);$('.update_data select[name=type]').val(`<?= $record->type ?>`);"><i class="fa fa-pencil-square-o"></i></a>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_form_fields">
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
							<label>Label Name</label>
							<input type="text" name="name" required class="form-control">
							<span class="text-danger error-span">This input is required.</span>
							<input type="hidden" name="row_id" value="">
							<input type="hidden" name="slug">
							<input type="hidden" name="table_name" value="tbl_form_fields">
						</div>
						<div class="col-md-6">
							<label>Type of Input fields</label>
							<select name="type" required class="form-control">
								<option value="">Select Type</option>
								<option value="1" <?= ($record->type == 1) ? "selected" : ""; ?>>Text Input</option>
								<option value="2" <?= ($record->type == 2) ? "selected" : ""; ?>>Select Option</option>
								<option value="3" <?= ($record->type == 3) ? "selected" : ""; ?>>Textarea</option>
								<option value="4" <?= ($record->type == 4) ? "selected" : ""; ?>>Checkbox</option>
								<option value="5" <?= ($record->type == 5) ? "selected" : ""; ?>>Radiobox</option>
								<option value="6" <?= ($record->type == 6) ? "selected" : ""; ?>>File Input</option>
								<option value="7" <?= ($record->type == 7) ? "selected" : ""; ?>>Buttons</option>
								<option value="7" <?= ($record->type == 8) ? "selected" : ""; ?>>Segment</option>
							</select>
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