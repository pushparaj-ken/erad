<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h2 class="box-title">Add Answer Text</h2>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="insert_data_collapse_main" this_id="form-9900" reload-action="true">
								<div class="col-md-12">
									<label>Template Name</label>
									<select type="text" name="template_id" required class="form-control select2" >
										<option value="0"> -- Select Template Name -- </option>
										<?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template_name) : ?>
											<option  value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
										<?php endforeach; ?>
									</select>
									<span class="text-danger error-span">This input is required.</span>
									<input type="hidden" name="table_name" value="tbl_petct_template">
								</div>
							
								<div class="col-md-12">
									<label>Collapse Main</label>
									<select type="text" name="collapse_main" required class="form-control select2"  >
										<option value="0"> -- Select Template Name -- </option>
										
									</select>
									<span class="text-danger error-span">This input is required.</span>
								</div>
								<div class="col-md-12">
									<label>Collapse Sub</label>
									<select type="text" name="collapse_sub" required class="form-control select2"  >
										<option value="0"> -- Select Sub Name -- </option>
										
									</select>
									<span class="text-danger error-span">This input is required.</span>
								</div>
								<div class="col-md-12">
									<label>Collapse Child</label>
									<select type="text" name="collapse_child[]" required class="form-control select2 collapse_child"  multiple>
										<option value="0"> -- Select Child Name -- </option>
									</select>
									<span class="text-danger error-span">This input is required.</span>
								</div>
								<div class="col-md-4">
									<button class="btn btn-sm btn-primary">Submit</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Template Name</th>
                                    <th>Collapse Main</th>
                                    <th>Collapse Sub</th>
                                    <th>Collapse Child</th>
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
                                                <?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_id'", "name"); ?>
                                            </td>
                                            <td>
                                                  <?= $this->common_model->get_record("tbl_form_template_fields","id='$record->collapse_main'","name"); ?>
                                            </td>
                                            <td>
                                                <?= $this->common_model->get_record("tbl_form_template_fields","id='$record->collapse_sub'","name"); ?>
                                            </td>
											<td>
                                                <?= $this->common_model->get_record("tbl_form_template_fields","id='$record->collapse_child'","name"); ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center">
												<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="edit_collapse_join(<?=$record->id?>)"><i class="fa fa-pencil-square-o"></i></a>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
													<input type="hidden" name="row_id" value="<?= $record->id ?>">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="table_name" value="tbl_collapse_join_impression">
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
            
        </div>
    </div>
</div>
<script>
$( "select[name=template_id]" ).change(function() 
{

	let template_id = $('select[name=template_id]').val();
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/collapse-main",
		data: "template_id=" + template_id,
		success: function(response)
		{
			console.log(response);
			$('select[name=collapse_main]').html(response);
		}
	});
});
$( "select[name=collapse_main]" ).change(function() 
{

	let template_id = $('select[name=template_id]').val();
	let collapse_main = $('select[name=collapse_main]').val();
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/collapse-sub",
		data: "template_id=" + template_id + "&collapse_main="+collapse_main,
		success: function(response)
		{
			console.log(response);
			$('select[name=collapse_sub]').html(response);
		}
	});
});

$( "select[name=collapse_sub]" ).change(function() 
{

	let template_id = $('select[name=template_id]').val();
	let collapse_sub = $('select[name=collapse_sub]').val();
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/collapse-child",
		data: "template_id=" + template_id + "&collapse_sub="+collapse_sub,
		success: function(response)
		{
			console.log(response);
			$('.collapse_child').html(response);
		}
	});
});

$('body').on("submit", '.insert_data_collapse_main', function(e) {
    e.preventDefault();

    var this_id = 'form[this_id=' + $(this).attr('this_id') + ']';

    if (is_required(this_id) === true) {
        $.ajax({
            type: 'POST',
            url: baseURL + "admin/insert_data_collapse_main",
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
function edit_collapse_join(id)
{
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/edit-collapse-join",
		data: "id=" + id,
		success: function(response)
		{
			$('#modal-default .modal-content').html(response);
			$('#modal-default').modal();
			$('.select22').select2();
		}
	});
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>