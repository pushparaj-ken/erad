<form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
	<h4 class="modal-title">Edit</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<label>Template Name</label>
			<select type="text" name="template_id" required class="form-control">
				<option value="0"> -- Select Template Name -- </option>
				<?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template_name) : ?>
					<option <?=($record->template_id == $template_name->id)?"selected":""?>  value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
				<?php endforeach; ?>
			</select>
			<span class="text-danger error-span">This input is required.</span>
			<input type="hidden" name="row_id" value="<?=$record->id?>">
			<input type="hidden" name="table_name" value="tbl_collapse_join_impression">
		</div>
		<div class="col-md-12">
			<label>Collapse Main</label>
			<select type="text" name="collapse_main" required class="form-control select2"  >
				<option value="0"> -- Select Template Name -- </option>
				<?php foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$record->template_id' and type='15'") as $template_name) : ?>
					<option <?=($record->collapse_main == $template_name->id)?"selected":""?> value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
				<?php endforeach; ?>
			</select>
			<span class="text-danger error-span">This input is required.</span>
		</div>
		<div class="col-md-12">
			<label>Collapse Sub</label>
			<select type="text" name="collapse_sub" required class="form-control select2"  >
				<option value="0"> -- Select Sub Name -- </option>
				<?php foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$record->template_id' and type='16'") as $template_name) : ?>
					<option <?=($record->collapse_sub == $template_name->id)?"selected":""?> value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
				<?php endforeach; ?>
			</select>
			<span class="text-danger error-span">This input is required.</span>
		</div>
		<div class="col-md-12">
			<label>Collapse Child</label>
			<select type="text" name="collapse_child" required class="form-control select2 collapse_child" >
				<option value="0"> -- Select Child Name -- </option>
				<?php foreach ($this->common_model->get_records('tbl_form_template_fields', "status='0' and template_form_id='$record->template_id' and type='17'") as $template_name) : ?>
					<option <?=($record->collapse_child == $template_name->id)?"selected":""?> value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
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