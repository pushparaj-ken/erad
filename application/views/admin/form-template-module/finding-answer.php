<div class="content-wrapper">

	<section class="content">
		<div class="row">		
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Finding Answer</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_hide_items" this_id="form-9900" reload-action="true">
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Select Options Items</label>
										<select class="form-control select2" name="title_id" multiple data-placeholder="Select a Options Items"  style="width: 100%;">
											<option>Select Options</option>
											<?php foreach($all_title as $check_option) : ?>
												<option value="<?= $check_option->title ?>"><?=$this->common_model->get_record("tbl_main_title","status=0 and id='$check_option->title'","title")?></option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_hide_finding_answer">
                                    <input type="hidden" name="input_id" value="<?= $input_id ?>">
                                    <input type="hidden" name="template_id" value="<?= $template_id ?>">
                                     
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Select Finding answer</label>
										<select class="form-control select2" name="title_id_hide[]" multiple="multiple" data-placeholder="Select a Hide Items"  style="width: 100%;">
											<?php foreach($all_inputs as $fields) : ?>
												<option value="<?= $fields->title ?>">
													<?=$this->common_model->get_record("tbl_main_title","status=0 and id='$fields->title'","title")?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Hiding Finding answer</label>
										<textarea class="form-control" name="hide_text_finding"></textarea>
									</div>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
										<label>Show Finding answer</label>
										<textarea class="form-control" name="show_finding_answer"></textarea>
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
						<h3 class="box-title"><?= $template_name; ?> - Finding Items</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-hover data_table">
							<thead>
								<tr>
									<th>Sl. No.</th>
									<th>Title Name</th>
									<th>Hide Title Name</th>
									<th>Hide Finding </th>
									<th>Show Finding </th>
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
												<?= $this->common_model->get_record('tbl_main_title', "status='0' and id='$record->title_id'", "title") ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_main_title', "status='0' and id='$record->title_id_hide'", "title") ?>
											</td>
											<td>
												<?= $record->hide_text_finding ?>
											</td>
											<td>
												<?= $record->show_finding_answer ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data select[name=title_id]').val(`<?= $record->title_id ?>`);$('.update_data select[name=title_id_hide]').val(`<?= $record->title_id_hide ?>`);$('.update_data textarea[name=hide_text_finding]').val(`<?= $record->hide_text_finding ?>`);$('.update_data textarea[name=show_finding_answer]').val(`<?= $record->show_finding_answer ?>`);"><i class="fa fa-pencil-square-o"></i></a>

												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_hide_finding_answer">
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
								<select class="form-control" name="title_id"  data-placeholder="Select a Options Items"  style="width: 100%;">
									<option>Select Options</option>
									<?php foreach($all_title as $check_option) : ?>
										<option value="<?= $check_option->title ?>"><?=$this->common_model->get_record("tbl_main_title","status=0 and id='$check_option->title'","title")?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<span class="text-danger error-span">This input is required.</span>
							<input type="hidden" name="table_name" value="tbl_hide_finding_answer">
							<input type="hidden" name="input_id" value="<?= $input_id ?>">
							<input type="hidden" name="template_id" value="<?= $template_id ?>">
							<input type="hidden" name="row_id" value="">
						   
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Select Finding answer</label>
								<select class="form-control" name="title_id_hide"  data-placeholder="Select a Hide Items"  style="width: 100%;">
									<?php foreach($all_inputs as $fields) : ?>
										<option value="<?= $fields->title ?>">
											<?=$this->common_model->get_record("tbl_main_title","status=0 and id='$fields->title'","title")?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<span class="text-danger error-span">This input is required.</span>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Hiding Finding answer</label>
								<textarea class="form-control" name="hide_text_finding"></textarea>
							</div>
							<span class="text-danger error-span">This input is required.</span>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Show Finding answer</label>
								<textarea class="form-control" name="show_finding_answer"></textarea>
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