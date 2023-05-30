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
                            <form class="insert_data" this_id="form-9900" reload-action="true">
                                <div class="col-md-12">
                                    <label>Template Name</label>
                                    <select type="text" name="template_id" required class="form-control select2" onchange="get_title(this);" >
                                        <option value="0"> -- Select Template Name -- </option>
                                        <?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0' order by id desc") as $template_name) : ?>
                                            <option  value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="table_name" value="tbl_title_answer_master">
                                </div>
								
								<div class="col-md-12">
                                    <label>Title</label>
                                    <select name="title_id"  class="form-control select2" >
                                        <option value="0">Select Title</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Finding Text</label>
                                    <textarea class="form-control" name="finding_text" rows="5"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Impressing Text</label>
                                    <textarea class="form-control" name="impressing_text" rows="5"></textarea>
                                </div>
								<div class="col-md-6">
                                    <label>Testing Text</label>
                                    <textarea class="form-control" name="testing_finding" rows="5"></textarea>
                                </div>
								<div class="col-md-6">
                                    <label>Impressing Text</label>
                                    <textarea class="form-control" name="testing_impressing" rows="5"></textarea>
                                </div>
								<div class="col-md-6">
                                    <label>Collapse Text</label>
                                    <textarea class="form-control" name="finding_collapse" rows="5"></textarea>
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
                                    <th>Title</th>
                                    <th>Finding Text</th>
                                    <th>Impressing Text</th>
                                    <th>Testing Text</th>
                                    <th>Impressing Text</th>
                                    <th>Collapse Text</th>
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
                                                <?= $this->common_model->get_record('tbl_category_with_form', "status='0' and id='$record->template_id'", "name"); ?>
                                            </td>
                                            <td>
                                                <?= $this->common_model->get_record('tbl_main_title', "status='0' and id='$record->title_id'", "title"); ?>
                                            </td>
                                            <td>
                                                <?= $record->finding_text ?>
                                            </td>
                                            <td>
                                                <?= $record->impressing_text ?>
                                            </td>
											<td>
                                                <?= $record->testing_finding ?>
                                            </td>
											<td>
                                                <?= $record->testing_impressing ?>
                                            </td>
											<td>
                                                <?= $record->finding_collapse ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center">
												<!--<a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data select[name=template_id]').val(`<?= $record->template_id ?>`);$('.update_data select[name=title_id]').val(`<?= $record->title_id ?>`);$('.update_data textarea[name=finding_text]').val(`<?= $record->finding_text ?>`);$('.update_data textarea[name=impressing_text]').val(`<?= $record->impressing_text ?>`);$('.update_data textarea[name=testing_finding]').val(`<?= $record->testing_finding ?>`);$('.update_data textarea[name=testing_impressing]').val(`<?= $record->testing_impressing ?>`);$('.update_data textarea[name=finding_collapse]').val(`<?= $record->finding_collapse ?>`);"><i class="fa fa-pencil-square-o"></i></a>-->
												<button class="btn  mb-1 btn-sm btn-warning " data-bs-toggle="modal" data-bs-target="#modal-default" onclick="gettitle(<?=$record->id?>)">
													<i class="fa fa-edit"></i>
												</button>
												<form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
													<input type="hidden" name="row_id" value="<?= $record->id ?>">
													<input type="hidden" name="status" value="1">
													<input type="hidden" name="table_name" value="tbl_title_answer_master">
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

function gettitle(id)
{
	$.ajax({
		type: 'POST',
		url: baseURL + "admin/gettitle",
		data: "id=" + id,
		success: function(response)
		{
			$('#modal-default .modal-content').html(response);
			$('#modal-default').modal();
			$('.select22').select2();
		}
	});
}

 function get_title(tis) {
	   $.ajax({
		   type: "GET",
		   url: baseURL + "admin/post/get-title/" + $(tis).val(),
		   dataType: "json",
		   success: function(response) {
			   if (response.result == 1) {
				   $('select[name=title_id]').empty();

				   var option = '<option value="">Select Title  </option>';
				   $('select[name=title_id]').append(option);

				   $.each(response.record, function(key, val) {
					   var option = "<option value='" + val.id + "'>" + val.title + "</option>";
					   $('select[name=title_id]').append(option);
				   })
			   } else {
				   toastr.error('Something went wrong! Please try again later!');
			   }
		   },
	   });
   }
   function get_option_name(tis) {
	   $.ajax({
		   type: "GET",
		   url: baseURL + "admin/post/get-option-name/" + $(tis).val(),
		   dataType: "json",
		   success: function(response) {
			   if (response.result == 1) {
				   $('select[name=option_name]').empty();
				   
				   var option = "<option value=''>Select Option Name</option>";
				   $('select[name=option_name]').append(option);
				   
				   $.each(response.record, function(key, val) {
					   var option = "<option  value='" + val.id + "'>" + val.no_ward + "</option>";
					   $('select[name=option_name]').append(option);
				   })
			   } else {
				   toastr.error('Something went wrong! Please try again later!');
			   }
		   },
	   });
   }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>