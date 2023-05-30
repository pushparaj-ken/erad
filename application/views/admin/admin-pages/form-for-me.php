<?php if ($role == ROLE_ADMIN) : ?>
<div class="content-wrapper">

	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<tr>
									<th>Sl. No.</th>
									<th>Template Name</th>
									<th>Group Name</th>
									<th class="text-center">Date Time</th>
									<th class="text-center">View</th>
									<!-- <th class="text-center">Actions</th> -->
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
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_id'", "name"); ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_group', "status='0' and id='$record->group_id'", "group_name"); ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center">
												<a href="<?= base_url() ?>admin/template-for-me/<?= $record->template_id ?>" class="btn btn-sm btn-success">View Template</a>
											</td>
											<!-- <td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data select[name=template_id]').val(`<?= $record->template_id ?>`);$('.update_data select[name=group_id]').val(`<?= $record->group_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
													<input type="hidden" name="row_id" value="<?= $record->id ?>">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="table_name" value="tbl_form_fields">
													<button class="btn btn-sm btn-danger" type="submit">
														<i class="fa fa-close"></i>
													</button>
												</form>
											</td> -->
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
							<label>Template Names</label>
							<select class="form-control required" name="template_id">
								<option value="">-- Select Template Name --</option>
								<?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template) : ?>
									<option value="<?= $template->id ?>"><?= $template->name ?></option>
								<?php endforeach; ?>
							</select>
							<span class="text-danger error-span">This input is required.</span>
							<input type="hidden" name="table_name" value="tbl_template_assign">
							<input type="hidden" name="row_id" value="">
							<input type="hidden" name="assigned_from" value="<?= $_SESSION['userId'] ?>">
							<input type="hidden" name="updated_by" value="<?= $_SESSION['userId'] ?>">
						</div>
						<div class="col-md-6">
							<label>Group Name</label>
							<select name="group_id" class="form-control required">
								<option value="">-- Select Group --</option>
								<?php foreach ($this->common_model->get_records('tbl_group', "status='0'") as $group) : ?>
									<option value="<?= $group->id ?>"><?= $group->group_name ?></option>
								<?php endforeach; ?>
							</select>
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
			<div class="col-md-12">
				<div class="box">
					<div class="box-body table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<tr>
									<th>Sl. No.</th>
									<th>Template Name</th>
									<th>Group Name</th>
									<th class="text-center">Date Time</th>
									<th class="text-center">View</th>
									<!-- <th class="text-center">Actions</th> -->
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
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_id'", "name"); ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_group', "status='0' and id='$record->group_id'", "group_name"); ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center">
												<a href="<?= base_url() ?>admin/template-for-me/<?= $record->template_id ?>" class="btn btn-sm btn-success">View Template</a>
											</td>
											<!-- <td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data select[name=template_id]').val(`<?= $record->template_id ?>`);$('.update_data select[name=group_id]').val(`<?= $record->group_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
													<input type="hidden" name="row_id" value="<?= $record->id ?>">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="table_name" value="tbl_form_fields">
													<button class="btn btn-sm btn-danger" type="submit">
														<i class="fa fa-close"></i>
													</button>
												</form>
											</td> -->
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
							<label>Template Names</label>
							<select class="form-control required" name="template_id">
								<option value="">-- Select Template Name --</option>
								<?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template) : ?>
									<option value="<?= $template->id ?>"><?= $template->name ?></option>
								<?php endforeach; ?>
							</select>
							<span class="text-danger error-span">This input is required.</span>
							<input type="hidden" name="table_name" value="tbl_template_assign">
							<input type="hidden" name="row_id" value="">
							<input type="hidden" name="assigned_from" value="<?= $_SESSION['userId'] ?>">
							<input type="hidden" name="updated_by" value="<?= $_SESSION['userId'] ?>">
						</div>
						<div class="col-md-6">
							<label>Group Name</label>
							<select name="group_id" class="form-control required">
								<option value="">-- Select Group --</option>
								<?php foreach ($this->common_model->get_records('tbl_group', "status='0'") as $group) : ?>
									<option value="<?= $group->id ?>"><?= $group->group_name ?></option>
								<?php endforeach; ?>
							</select>
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