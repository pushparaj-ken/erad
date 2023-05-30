
<?php if ($role == ROLE_RAD_ADMIN || $role == ROLE_SUPER_ADMIN) : ?>
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
									<th>Updated By</th>
									<th>Scribe Admin</th>
									<th>Change Finding</th>
									<th>Change Impression</th>
									<th class="text-center">Date Time</th>
									
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
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_form_id'", "name"); ?>
											</td> 
											<td>
												<?= $this->common_model->get_record('tbl_users', "isDeleted='0' and userId='$record->assign_id'", "name"); ?>
											</td>
											<td>
												<?php 
													$scribe_admin = $this->common_model->get_records('tbl_users', "isDeleted='0' and userId='$record->assign_id'")[0]; 
												?>
												<?= $this->common_model->get_record('tbl_users', "isDeleted='0' and userId='$scribe_admin->createdBy'", "name"); ?>
											</td>
											<td>
											
												<?=$record->finding_text?>
												
											</td>
											<td class="text-center">
												<?=$record->impressions_text?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
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

<?php elseif ($role == ROLE_ADMIN) : ?>
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
									<th>Updated By</th>
									<th>Change Finding</th>
									<th>Change Impression</th>
									<th class="text-center">Date Time</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									$inc = 1;
									foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='4' and createdBy ='".$_SESSION['userId']."'") as $record) {
										foreach ($this->common_model->get_records('tbl_generate_result', "status='0' and assign_id='$record->roleId' ") as $record) {
								?>
										<tr>
											<td>
												<?php echo $inc; ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_form_id'", "name"); ?>
											</td> 
											<td>
												<?= $this->common_model->get_record('tbl_users', "isDeleted='0' and userId='$record->assign_id'", "name"); ?>
											</td>
											<td>
											
												<?=$record->finding_text?>
												
											</td>
											<td class="text-center">
												<?=$record->impressions_text?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
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
<?php elseif($role == ROLE_SCRIBE):?>
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
									<th>Updated By</th>
									<th>Change Finding</th>
									<th>Change Impression</th>
									<th class="text-center">Date Time</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									$inc = 1;
									foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='4' and userId ='".$_SESSION['userId']."'") as $record) {
										foreach ($this->common_model->get_records('tbl_generate_result', "status='0' and assign_id='$record->userId' ") as $record) {
								?>
										<tr>
											<td>
												<?php echo $inc; ?>
											</td>
											<td>
												<?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_form_id'", "name"); ?>
											</td> 
											<td>
												<?= $this->common_model->get_record('tbl_users', "isDeleted='0' and userId='$record->assign_id'", "name"); ?>
											</td>
											<td>
											
												<?=$record->finding_text?>
												
											</td>
											<td class="text-center">
												<?=$record->impressions_text?>
											</td>
											<td class="text-center" style="display: flex;justify-content: center">
												<?php $dateTime = $record->updated_at;
												$date = date("d-m-Y", strtotime($dateTime)); ?>
												<?= $date ?>
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
<?php endif;?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>