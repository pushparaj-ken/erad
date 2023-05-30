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
									<th class="text-center">Date Time</th>
									<th class="text-center">View</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$scribe = $this->common_model->get_records('tbl_users', "isDeleted='0' and roleId = '3'");
								if (!empty($records)) {
									$inc = 1;
									foreach ($records as $record) {
								?>
										<tr>
											<td>
												<?php echo $inc; ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_form_id'", "name"); ?>
											</td>
											<td class="text-center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
											</td>
											<td class="text-center">
												<a href="<?= base_url() ?>admin/view-template-change/<?= $record->template_form_id ?>" class="btn btn-sm btn-success">View Template</a>
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>