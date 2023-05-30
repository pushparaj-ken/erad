<div class="content-wrapper">

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<form class="insert_data" this_id="form-9900" reload-action="true">
								<div class="col-md-3">
                                    <label>Template Name</label>
                                    <select type="text" name="template_id" required class="form-control select2" onchange="get_title(this);" >
                                        <option value="0"> -- Select Template Name -- </option>
                                        <?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template_name) : ?>
                                            <option  value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
								<div class="col-md-3">
									<label>Condition Name</label>
									<select class="form-control select2"  name="condition_id"  >
										<option value="">Select Condition</option>
										
									</select>
								</div>
								<div class="col-md-3">
									<label> Name</label>
									<input type="text" name="name" required class="form-control">
									<input type="hidden" name="table_name" value="tbl_condition_option">
									<input type="hidden" name="created_by" value="<?= $_SESSION['userId']; ?>">
								</div>
								<div class="col-md-3">
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
									<th>Template Name.</th>
									<th class="text-center">Condition Name</th>
									<th>Title</th>
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
											<td class="text-center">
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_id'", "name"); ?>
											</td>
											<td class="text-center">
												<?=$this->common_model->get_record("tbl_condition","status = 0 and id ='$record->condition_id'","name")?>
											</td>
											<td>
												<?= $record->name ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data input[name=name]').val(`<?= $record->name ?>`);$('.update_data select[name=template_id]').val(`<?= $record->template_id ?>`);$('.update_data select[name=condition_id]').val(`<?= $record->condition_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>

												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="table_name" value="tbl_condition_option">
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
							<label>Template Name</label>
							<select class="form-control"  name="template_id"  >
								<option value="">Select Template</option>
								<?php foreach($this->common_model->get_records("tbl_category_with_form", "status = '0' order by id desc") as $type): ?>
									<option value="<?=$type->id?>"><?=$type->name?></option>
								 <?php endforeach;?>
							</select>
						</div>
						<div class="col-md-6">
							<label>Condition Name</label>
							<select class="form-control"  name="condition_id"  >
								<option value="">Select Condition</option>
								<?php foreach($this->common_model->get_records("tbl_condition", "status = '0' order by id desc") as $type): ?>
									<option value="<?=$type->id?>"><?=$type->name?></option>
								 <?php endforeach;?>
							</select>
						</div>
						<div class="col-md-6">
							<label> Name</label>
							<input type="text" name="name" required class="form-control">
							<input type="hidden" name="table_name" value="tbl_condition_option">
							<input type="hidden" name="created_by" value="<?= $_SESSION['userId']; ?>">
							<input type="hidden" name="row_id" value="">
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
 function get_title(tis) {
	   $.ajax({
		   type: "GET",
		   url: baseURL + "admin/post/get-condition-option/" + $(tis).val(),
		   dataType: "json",
		   success: function(response) {
			   if (response.result == 1) {
				   $('select[name=condition_id]').empty();

				   var option = '<option value="">Select Condition  </option>';
				   $('select[name=condition_id]').append(option);

				   $.each(response.record, function(key, val) {
					   var option = "<option value='" + val.id + "'>" + val.name + "</option>";
					   $('select[name=condition_id]').append(option);
				   })
			   } else {
				   toastr.error('Something went wrong! Please try again later!');
			   }
		   },
	   });
   }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>