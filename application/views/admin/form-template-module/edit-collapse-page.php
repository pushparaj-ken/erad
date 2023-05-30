<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Select Options Items</label>
			<select class="form-control" name="option_id" required style="width: 100%;">
				<?php foreach($check_options as $check_option) : ?>
					<option value="<?= $check_option->id ?>"><?= $check_option->name ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<span class="text-danger error-span">This input is required.</span>
		<input type="hidden" name="row_id" value="<?=$row_id?>">
		<input type="hidden" name="input_id" value="<?=$input_id?>">
		<input type="hidden" name="template_id" value="<?=$template_id?>">
		<input type="hidden" name="table_name" value="tbl_collapse_section">
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Select Title</label>
			<select class="form-control select22" name="select_title[]" multiple="multiple" data-placeholder="Select a Hide Items" required style="width: 100%;">
				<?php $var_id = explode(",", $records->select_title); ?>
				<?php foreach($this->common_model->get_records("tbl_main_title", "status = '0' and template_form_id='$template_id' order by id desc") as $label_id) :?>
					<option <?=(in_array($label_id->id, $var_id))?"selected":""?> value="<?= $label_id->id ?>"><?= $label_id->title?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<span class="text-danger error-span">This input is required.</span>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label>Select Hide Items</label>
			<select class="form-control select22" name="select_fields_id[]" multiple required style="width: 100%;"> 
				<?php $var_id = explode(",", $records->select_fields_id); ?>
				<?php foreach($all_inputs as $fields) : ?>
					<option <?=(in_array($fields->id, $var_id))?"selected":""?> value="<?= $fields->id ?>"><?= $fields->name?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<span class="text-danger error-span">This input is required.</span>
	</div>
</div>