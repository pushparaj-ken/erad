<?php if ($role == ROLE_RAD_ADMIN || $role == ROLE_SUPER_ADMIN) : ?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
					<div class="box-header">
						<h3 class="box-title">Add Options and Answer</h3>
					</div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_data_super_admin" this_id="form-9900" reload-action="true">
                                <div class="col-md-12">
                                    <label>Option Name</label>
                                    <input type="text" name="name" required class="form-control">
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_input_options">
									<input type="hidden" name="input_id" value="<?= $template ?>">
                                    <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                                    <input type="hidden" name="slug">
									<input type="hidden" name="names" value="<?=$form_records->name?>">
									<input type="hidden" name="type" value="<?=$form_records->type?>">
									<input type="hidden" name="title" value="<?=$form_records->title?>">
									<input type="hidden" name="order_by" value="<?=$form_records->order_by?>">
									<input type="hidden" name="form_fields_id" value="<?=$form_records->form_fields_id?>">
									<input type="hidden" name="form_field_class" value="<?=$form_records->form_field_class?>">
                                </div>
								<div class="col-md-12">
                                    <label>Finding Answer</label>
                                    <textarea rows="4" name="finding_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
                                    <label>Impression Answer</label>
                                    <textarea rows="4" name="impression_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
									<label>Score</label>
									<input type="number" name="score" class="form-control">
								</div>
								<div class="col-md-12">
									<label>Template Order No</label>
									<input type="text" name="template_order_number" class="form-control ">
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
                                    <th>Option Name</th>
                                    <th>Finding Answer</th>
                                    <th>Impression Answer</th>
                                    <th>Score</th>
                                    <th>Template Order Number</th>
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
                                                <?= $record->finding_text ?>
                                            </td>
											<td>
                                                <?= $record->impression_text ?>
                                            </td>
											<td>
                                                <?= $record->score ?>
                                            </td>
											<td>
                                                <?= $record->template_order_number ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center">
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_option input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data_option input[name=name]').val(`<?= $record->name ?>`);$('.update_data_option textarea[name=finding_text]').val(`<?= $record->finding_text ?>`);$('.update_data_option textarea[name=impression_text]').val(`<?= $record->impression_text ?>`);$('.update_data_option input[name=input_id]').val(`<?= $record->input_id ?>`);$('.update_data_option input[name=score]').val(`<?= $record->score ?>`);$('.update_data_option input[name=template_order_number]').val(`<?= $record->template_order_number ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_input_options">
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
            <form reload-action="true" this_id="form-002" class="update_data_option" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Label Name</label>
                            <input type="text" name="name" required class="form-control">
                            <span class="text-danger error-span">This input is required.</span>
                            <input type="hidden" name="row_id" value="">
                            <input type="hidden" name="slug" value="">
                            <input type="hidden" name="input_id" value="">
                            <input type="hidden" name="names" value="<?=$form_records->name?>">
                            <input type="hidden" name="type" value="<?=$form_records->type?>">
                            <input type="hidden" name="title" value="<?=$form_records->title?>">
							<input type="hidden" name="order_by" value="<?=$form_records->order_by?>">
                            <input type="hidden" name="form_fields_id" value="<?=$form_records->form_fields_id?>">
                            <input type="hidden" name="form_field_class" value="<?=$form_records->form_field_class?>">
                            <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                            <input type="hidden" name="table_name" value="tbl_input_options">
                        </div>
						<div class="col-md-12">
                            <label>Finding Answer</label>
                            <textarea rows="4" name="finding_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
                            <label>Impression Answer</label>
                            <textarea rows="4" name="impression_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
							<label>Score</label>
							<input type="number" name="score" class="form-control">
						</div>
						<div class="col-md-12">
							<label>Template Order Number</label>
							<input type="text" name="template_order_number" class="form-control">
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
<?php elseif ($role == ROLE_ADMIN) : ?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
					<div class="box-header">
						<h3 class="box-title">Add Options and Answer</h3>
					</div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_data_option" this_id="form-9900" reload-action="true">
                                <div class="col-md-12">
                                    <label>Option Name</label>
                                    <input type="text" name="name" required class="form-control">
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_input_options">
                                    <input type="hidden" name="input_id" value="<?= $template ?>">
                                    <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                                    <input type="hidden" name="slug">
									<input type="hidden" name="names" value="<?=$copy_form_records->name?>">
									<input type="hidden" name="type" value="<?=$copy_form_records->type?>">
									<input type="hidden" name="title" value="<?=$copy_form_records->title?>">
									<input type="hidden" name="order_by" value="<?=$copy_form_records->order_by?>">
									<input type="hidden" name="form_fields_id" value="<?=$copy_form_records->copy_form_field_id?>">
									<input type="hidden" name="form_field_class" value="<?=$copy_form_records->copy_form_field_class?>">
                                </div>
								<div class="col-md-12">
                                    <label>Finding Answer</label>
                                    <textarea rows="4" name="finding_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
                                    <label>Impression Answer</label>
                                    <textarea rows="4" name="impression_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
									<label>Template Order No</label>
									<input type="text" name="template_order_number" class="form-control ">
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
                                    <th>Option Name</th>
                                    <th>Finding Answer</th>
                                    <th>Impression Answer</th>
                                    <th>Template Order No</th>
                                    <th class="text-center">Date Time</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($copy_options)) {
                                    $inc = 1;
                                    foreach ($copy_options as $record) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                            </td>
                                            <td>
                                                <?= $record->name ?>
                                            </td>
											<td>
                                                <?= $record->finding_text ?>
                                            </td>
											<td>
                                                <?= $record->impression_text ?>
                                            </td>
											<td>
                                                <?= $record->template_order_number ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center">
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_admin_option input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data_admin_option input[name=name]').val(`<?= $record->name ?>`);$('.update_data_admin_option textarea[name=finding_text]').val(`<?= $record->finding_text ?>`);$('.update_data_admin_option textarea[name=impression_text]').val(`<?= $record->impression_text ?>`);$('.update_data_admin_option textarea[name=template_order_number]').val(`<?= $record->template_order_number ?>`);$('.update_data_admin_option input[name=input_id]').val(`<?= $record->input_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_copy_input_options">
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
            <form reload-action="true" this_id="form-002" class="update_data_admin_option" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Label Name</label>
                            <input type="text" name="name" required class="form-control">
                            <span class="text-danger error-span">This input is required.</span>
                            <input type="hidden" name="row_id" value="">
                            <input type="hidden" name="slug" value="">
                            <input type="hidden" name="input_id" value="">
                            <input type="hidden" name="names" value="<?=$form_records->name?>">
                            <input type="hidden" name="type" value="<?=$form_records->type?>">
                            <input type="hidden" name="title" value="<?=$form_records->title?>">
							<input type="hidden" name="order_by" value="<?=$form_records->order_by?>">
                            <input type="hidden" name="form_fields_id" value="<?=$form_records->form_fields_id?>">
                            <input type="hidden" name="form_field_class" value="<?=$form_records->form_field_class?>">
                            <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                            <input type="hidden" name="table_name" value="tbl_input_options">
                        </div>
						<div class="col-md-12">
                            <label>Finding Answer</label>
                            <textarea rows="4" name="finding_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
                            <label>Impression Answer</label>
                            <textarea rows="4" name="impression_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
							<label>Template Order No</label>
							<input type="text" name="template_order_number" class="form-control ">
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
            <div class="col-md-6">
                <div class="box">
					<div class="box-header">
						<h3 class="box-title">Add Options and Answer</h3>
					</div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_data_scribe_option" this_id="form-9900" reload-action="true">
                                <div class="col-md-12">
                                    <label>Option Name</label>
                                    <input type="text" name="name" required class="form-control">
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_input_options">
                                    <input type="hidden" name="input_id" value="<?= $template ?>">
                                    <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                                    <input type="hidden" name="slug">
									<input type="hidden" name="names" value="<?=$copy_form_records->name?>">
									<input type="hidden" name="type" value="<?=$copy_form_records->type?>">
									<input type="hidden" name="title" value="<?=$copy_form_records->title?>">
									<input type="hidden" name="order_by" value="<?=$copy_form_records->order_by?>">
									<input type="hidden" name="form_fields_id" value="<?=$copy_form_records->copy_form_field_id?>">
									<input type="hidden" name="form_field_class" value="<?=$copy_form_records->copy_form_field_class?>">
                                </div>
								<div class="col-md-12">
                                    <label>Finding Answer</label>
                                    <textarea rows="4" name="finding_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
                                    <label>Impression Answer</label>
                                    <textarea rows="4" name="impression_text" class="form-control"></textarea>
                                    <span class="text-danger error-span">This input is required.</span>
                                </div>
								<div class="col-md-12">
									<label>Template Order No</label>
									<input type="text" name="template_order_number" class="form-control ">
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
                                    <th>Option Name</th>
                                    <th>Finding Answer</th>
                                    <th>Impression Answer</th>
                                    <th>Template Order No</th>
                                    <th class="text-center">Date Time</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($copy_options)) {
                                    $inc = 1;
                                    foreach ($copy_options as $record) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                            </td>
                                            <td>
                                                <?= $record->name ?>
                                            </td>
											<td>
                                                <?= $record->finding_text ?>
                                            </td>
											<td>
                                                <?= $record->impression_text ?>
                                            </td>
											<td>
                                                <?= $record->template_order_number ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center">
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data_option_scribe input[name=row_id]').val(`<?= $record->input_option_id ?>`);$('.update_data_option_scribe input[name=name]').val(`<?= $record->name ?>`);$('.update_data_option_scribe textarea[name=finding_text]').val(`<?= $record->finding_text ?>`);$('.update_data_option_scribe textarea[name=impression_text]').val(`<?= $record->impression_text ?>`);$('.update_data_option_scribe input[name=input_id]').val(`<?= $record->input_id ?>`);$('.update_data_option_scribe input[name=template_order_number]').val(`<?= $record->template_order_number ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_copy_input_options">
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
            <form reload-action="true" this_id="form-002" class="update_data_option_scribe" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Label Name</label>
                            <input type="text" name="name" required class="form-control">
                            <span class="text-danger error-span">This input is required.</span>
                            <input type="hidden" name="row_id" value="">
                            <input type="hidden" name="slug" value="">
                            <input type="hidden" name="input_id" value="">
                            <input type="hidden" name="names" value="<?=$copy_form_records->name?>">
                            <input type="hidden" name="type" value="<?=$copy_form_records->type?>">
                            <input type="hidden" name="title" value="<?=$copy_form_records->title?>">
							<input type="hidden" name="order_by" value="<?=$copy_form_records->order_by?>">
                            <input type="hidden" name="form_fields_id" value="<?=$copy_form_records->copy_form_field_id?>">
                            <input type="hidden" name="form_field_class" value="<?=$copy_form_records->copy_form_field_class?>">
                            <input type="hidden" name="template_form_id" value="<?=$input_id?>">
                            <input type="hidden" name="table_name" value="tbl_copy_input_options">
                        </div>
						<div class="col-md-12">
                            <label>Finding Answer</label>
                            <textarea rows="4" name="finding_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
                            <label>Impression Answer</label>
                            <textarea rows="4" name="impression_text" class="form-control"></textarea>
                            <span class="text-danger error-span">This input is required.</span>
                        </div>
						<div class="col-md-12">
							<label>Template Order No</label>
							<input type="text" name="template_order_number" class="form-control ">
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

<?php endif; ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>