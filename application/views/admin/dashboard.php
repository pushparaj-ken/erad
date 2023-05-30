<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
			<small><?= $this->config->item('app_name') ?></small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) : ?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_category', "status='0'")) ?></h3>
							<p>Total Categories</p>
						</div>
						<a href="<?= base_url() ?>admin/category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_sub_category', "status='0'")) ?></h3>
							<p>Total Sub Categories</p>
						</div>
						<a href="<?= base_url() ?>admin/sub-category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_child_category', "status='0'")) ?></h3>
							<p>Total Child Categories</p>
						</div>
						<a href="<?= base_url() ?>admin/child-category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_category_with_form', "status='0'")) ?></h3>
							<p>Total Form Templates</p>
						</div>
						<a href="<?= base_url() ?>admin/form-templates" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($_SESSION['role'] == 1) : ?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_users', "roleId = '2'")) ?></h3>
							<p>Total Users</p>
						</div>
						<a href="<?= base_url() ?>admin/userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<?php
			endif;
			if ($_SESSION['role'] == 2) :
			?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_users', " roleId = '3' and createdBy='" . $_SESSION['userId'] . "'")) ?></h3>
							<p>Total Users</p>
						</div>
						<a href="<?= base_url() ?>admin/userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<?php
			endif;
			if ($_SESSION['role'] == 3) :
			?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_template_assign', "status='0' and assigned_to='" . $_SESSION['userId'] . "'")) ?></h3>
							<p>Total Assigned Templates</p>
						</div>
						<a href="<?= base_url() ?>admin/form-for-me" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?= sizeof($this->common_model->get_records('tbl_users', " roleId = '4' and createdBy='" . $_SESSION['userId'] . "'")) ?></h3>
							<p>Total users</p>
						</div>
						<a href="<?= base_url() ?>admin/userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
</div>